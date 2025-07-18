<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PostResource\Pages;
use App\Filament\Resources\PostResource\RelationManagers;
use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class PostResource extends Resource
{
    protected static ?string $model = Post::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'پست ها';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')->required()->label('عنوان'),
                FileUpload::make('url')->image()
                    ->label('تصویر')
                    ->getUploadedFileNameForStorageUsing(
                        fn (TemporaryUploadedFile $file): string => (string) str($file->getClientOriginalName())
                            ->prepend('custom-prefix-'),
                    )
                    ->disk('public')
                    ->directory('form-attachments')
                    ->visibility('public'),
                RichEditor::make('body')->required()->label('متن'),
                Select::make('category_id')
                    ->relationship('category', 'name')
                    ->required()
                    ->label('دسته بندی'),
                Select::make('status')
                    ->options(['pending' => 'در انتظار', 'done' => 'تایید شده', 'stop' => 'متوقف'])
                    ->default('pending')
                    ->label('وضعیت')
                    ->disabled(function(){
                        return auth()->user()->role != 'admin';
                    }),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->sortable()->searchable()->label('عنوان'),
                TextColumn::make('user.name')->sortable()->searchable()->label('نویسنده'),
                TextColumn::make('category.name')->sortable()->searchable()->label('دسته بندی'),
                TextColumn::make('created_at')
                    ->formatStateUsing(function ($state) {
                        return \App\Services\JalaliDateService::toJalali($state, 'Y/m/d');
                    })
                    ->sortable()
                    ->label('تاریخ'),
                ImageColumn::make('url')->label('تصویر')
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPosts::route('/'),
            'create' => Pages\CreatePost::route('/create'),
            'edit' => Pages\EditPost::route('/{record}/edit'),
        ];
    }
    public static function shouldRegisterNavigation(): bool
    {
        return true; // All users can see the Posts resource in navigation
    }

    public static function getNavigationLabel(): string
    {
        return 'پست ها';
    }

    public static function canViewAny(): bool
    {
        return true; // All users can view posts
    }

    public static function canCreate(): bool
    {
        return true; // All users can create posts
    }

    public static function canEdit(Model $record): bool
    {
        // Users can only edit their own posts, admins can edit all
        return auth()->user()->role === 'admin' || $record->user_id === auth()->id();
    }

    public static function canDelete(Model $record): bool
    {
        // Users can only delete their own posts, admins can edit all
        return auth()->user()->role === 'admin' || $record->user_id === auth()->id();
    }

    public static function getEloquentQuery(): Builder
    {
        $query = parent::getEloquentQuery();
        
        // If user is not admin, only show their own posts
        if (auth()->user()->role !== 'admin') {
            $query->where('user_id', auth()->id());
        }
        
        return $query;
    }
}
