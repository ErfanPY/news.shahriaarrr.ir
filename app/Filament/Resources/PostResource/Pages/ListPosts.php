<?php

namespace App\Filament\Resources\PostResource\Pages;

use App\Filament\Resources\PostResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPosts extends ListRecords
{
    protected static string $resource = PostResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    protected function getTableQuery()
    {
        $query = parent::getTableQuery();
        
        // If user is not admin, only show their own posts
        if (auth()->user()->role !== 'admin') {
            $query->where('user_id', auth()->id());
        }
        
        return $query;
    }
}
