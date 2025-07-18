<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CommentResource\Pages;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class CommentResource extends Resource
{
    protected static ?string $model = Comment::class;

    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-left-right';

    protected static ?string $navigationLabel = 'نظرات';

    public static function getNavigationLabel(): string
    {
        return 'نظرات';
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('user_id')
                    ->relationship('user', 'name')
                    ->required()
                    ->label('کاربر'),
                Select::make('post_id')
                    ->relationship('post', 'name')
                    ->required()
                    ->label('پست'),
                Textarea::make('content')
                    ->required()
                    ->label('متن نظر')
                    ->rows(3),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.name')
                    ->sortable()
                    ->searchable()
                    ->label('کاربر'),
                TextColumn::make('post.name')
                    ->sortable()
                    ->searchable()
                    ->label('پست'),
                TextColumn::make('content')
                    ->limit(50)
                    ->label('متن نظر'),
                TextColumn::make('created_at')
                    ->formatStateUsing(function ($state) {
                        return \App\Services\JalaliDateService::toJalali($state, 'Y/m/d H:i');
                    })
                    ->sortable()
                    ->label('تاریخ'),
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
            'index' => Pages\ListComments::route('/'),
            'edit' => Pages\EditComment::route('/{record}/edit'),
        ];
    }

    public static function canViewAny(): bool
    {
        return true; // All users can view comments
    }

    public static function canCreate(): bool
    {
        return false; // No one can create comments from admin panel
    }

    public static function canEdit(Model $record): bool
    {
        // Users can edit their own comments, admins can edit all
        return auth()->user()->role === 'admin' || $record->user_id === auth()->id();
    }

    public static function canDelete(Model $record): bool
    {
        // Users can delete their own comments or comments on their posts, admins can delete all
        return auth()->user()->role === 'admin' || 
               $record->user_id === auth()->id() || 
               $record->post->user_id === auth()->id();
    }

    public static function getEloquentQuery(): Builder
    {
        $query = parent::getEloquentQuery();
        
        // If user is not admin, only show their own comments or comments on their posts
        if (auth()->user()->role !== 'admin') {
            $query->where(function($q) {
                $q->where('user_id', auth()->id())
                  ->orWhereHas('post', function($postQuery) {
                      $postQuery->where('user_id', auth()->id());
                  });
            });
        }
        
        return $query;
    }
} 