<?php

namespace App\Filament\Resources\CommentResource\Pages;

use App\Filament\Resources\CommentResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListComments extends ListRecords
{
    protected static string $resource = CommentResource::class;

    protected function getTableQuery(): ?\Illuminate\Database\Eloquent\Builder
    {
        $query = parent::getTableQuery();
        
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