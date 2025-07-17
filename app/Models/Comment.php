<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'post_id', 'body'];

    public function image()
    {
        return $this->belongsTo(Post::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function scopeForUser($query, User $user){
        // Image::whereBelongsTo($user) => where('user_id', $user->id)
        return $query->whereIn('image_id', Post::whereBelongsTo($user)->pluck('id'));
    }
    public function scopeApproved($query){
        return $query->where('approved', true);
    }
}
