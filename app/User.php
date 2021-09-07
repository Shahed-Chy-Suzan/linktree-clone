<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'email', 'password', 'background_color', 'text_color'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    public function links()
    {
        return $this->hasMany(Link::class);
    }

    public function visits()
    {
        return $this->hasManyThrough(Visit::class, Link::class);
    }
    //--ekhane each visits belongsTo a links, and that links belongsTo an User.	 Now however if we skip links table and want to see how many visits a particular user's has in his account, this relationship is--> goto User Model, make a "hasManyThrough" relation,//here hasManyThrough accept two argumant (1) the final class u want to collect & (2) the intermediatary class that passes through.

    public function getRouteKeyName() {
        return 'username';
    }
    //--amra UserController er @show method e Route-Model binding e return $user korechilam && then browser route/url e "domain/admin" (admin=username) diyechi error dicchilo, but "domain/1" (1=id) dile sob oi user er sob info json format e dekhachhilo jodio amra chacchilam username dile show korte tail ekn UserController e eshe ei "getRouteKeyName()" function ta likhechi jar fole amader browser url e "domain/admin" (admin=username) likleo User er sob info show hocchilo.
}
