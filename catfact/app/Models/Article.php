<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = ["title", "description", "topics", "thumbnail", "content", "is_public"];
    public function comments(){
        return $this->hasMany(Comment::class);
    }
    public function topComments()
    {
        return $this->hasMany(Comment::class)->where('parent_id', null);
    }

    public function likes()
    {
        return $this->hasMany(Likes::class);
    }    
}
