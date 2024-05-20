<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }
    public function groups()
    {
        return $this->hasMany(Group::class);
    }
    public function memberships()
    {
        return $this->hasMany(Membership::class);
    }
    public function reciever()
    {
        return $this->morphOne(Reciever::class, "recieveable");
    }
    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public function inboxes()
    {
        return $this->hasMany(Inbox::class);
    }

    public function contextLogue(String $cname){
        $context = $this->getContextByName($cname);
        if ($context->source_type == 'u'){
            return $this->dialogue($context);
        }
        return $this->multilogue($context);
    }
    public function dialogue(Reciever $context){
        $sent = $this->messages()->where("reciever_id", $context->id);
        $recieved = $context->messages()->where("reciever_id", $this->reciever->id);
        return $sent->union($recieved)->groupBy("id");
    }
    public function multilogue(Reciever $context){
        return $context->group->messages();
    }
    public function contextInbox(Reciever $context){
        if ($context->source_type == 'u'){
            return $this->partnerInbox($context);
        }
        return $this->groupInbox($context);
    }
    public function groupInbox(Reciever $context){
        return $this->inboxes()->intersection($context->messages())->count();
    }
    public function partnerInbox(Reciever $context)
    {
        return $this->inboxes()->intersection($this->reciever->messages()->where("user_id", $context->id))->count();
    }

    public function getContextNames()
    {
        $targets = $this->messages()->with("reciever")->groupBy("reciever_id");
        $targetsnames = $targets->where("reciever.source_type", "u")->pluck("reciever.source_id")->map(function ($id) {
            return User::find($id)->username;
        });
        $targeters = Message::where("reciever_id", $this->reciever->id)->groupBy("user_id");
        $targetersnames = $targeters->with("user")->pluck("user.username");
        
        $groupnames = $this->memberships()->with("group")->groupBy("group.groupname");

        return $targetsnames->unique()->merge($targetersnames->unique())->merge($groupnames->unique());
    }
    public function getContextByName(String $sourcename){
        if (ctype_lower($sourcename)){
            return Group::where("groupname", $sourcename)->first()->reciever();
        }
        return User::where("username", $sourcename)->first()->reciever();
    }
    public function contextInfo(){
        $cinfo = [];
        foreach($this->getContextNames() as $c){
            $cinfo[$c] = $this->contextIbox($this->getContextByName($c));
        }
        return $cinfo;
    }
}
