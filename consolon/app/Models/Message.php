<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = [
        "user_id",
        "reciever_id",
        "content"
    ];
    use HasFactory;
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function reciever()
    {
        return $this->belongsTo(Reciever::class);
    }
    public function inboxs()
    {
        return $this->hasMany(Inbox::class);
    }
}
