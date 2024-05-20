<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $fillable = [
        "user_id",
        "groupname"
    ];
    use HasFactory;
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function reciever(){
        return $this->morphOne(Reciever::class, "recieveable");
    }
    public function messages(){
        return $this->reciever()->messages();
    }
    public function memberships(){
        return $this->hasMany(Membership::class);
    }
    public function members(){
        return $this->memberships()->users();
    }
}
