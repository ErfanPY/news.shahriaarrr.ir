<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UserResource extends Resource
{
    protected static ?string $model = User::class;
    protected static ?string $navigationLabel = 'profile ';
    public static function getNavigationLabel(): string
        {
            return in_array(
                User::find(auth()->id())->role,
                [
                    'admin',
                    'author',
                ]
            ) ? 'لیست کاربران' : static::$navigationLabel;
        }

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([


                TextInput::make('name'),
                TextInput::make('email'),
                Select::make('role')
                    ->options(['user','author','admin'])
                    ->visible(function(){
                        return auth()->user()->role === 'admin';
                    }),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([

                TextColumn::make('name')->sortable()->searchable(),
                TextColumn::make('email')->sortable()->searchable(),
                TextColumn::make('role')->sortable()->searchable(),
                // TextColumn::make('role'),
            ])
            ->filters([
                // Filter::make('email')->form([
                    // Select::make('email')->
                    //     label('Filter By Class')->placeholder('Select a Class')->options(Classes::pluck('name','id')->toArray()),
                    // Select::make('section_id')->
                    //     label('Filter By Section')->placeholder('Select a Section')->options(function(Get $get){
                    //         $classId = $get('class_id');
                    //         if($classId){
                    //             return Section::where('class_id',$classId)->pluck('name','id')->toArray();
                    //         }
                    //     })
                // ])
            ])->query(
                function(){
                    $rol = in_array(
                User::find(auth()->id())->role,
                [
                    'admin',
                    'author',
                ]
            ) ;
            return $rol ?
                    User::query()->where('','') :
                    User::query()->where('id',auth()->id()) ;
                }
            )
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }

    public static function canViewAny(): bool
    {
        return true; // All users can view users list
    }

    public static function canCreate(): bool
    {
        return auth()->user()->role === 'admin'; // Only admins can create users
    }

    public static function canEdit(Model $record): bool
    {
        // Users can edit their own profile, admins can edit all
        return auth()->user()->role === 'admin' || $record->id === auth()->id();
    }

    public static function canDelete(Model $record): bool
    {
        return auth()->user()->role === 'admin'; // Only admins can delete users
    }

    public static function getEloquentQuery(): Builder
    {
        $query = parent::getEloquentQuery();
        
        // If user is not admin, only show their own profile
        if (auth()->user()->role !== 'admin') {
            $query->where('id', auth()->id());
        }
        
        return $query;
    }
}
