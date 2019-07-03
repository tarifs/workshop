<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    const ADMIN = true;
    const USER  = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','is_admin',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getRuleAttribute()
    {
        if ($this->is_admin) {
         echo '<p style="color:blue;">Admin</p>';
        }else {
           echo '<p style="color:black;">User</p>';
        }
    }
    public function getReverseRuleAttribute()
    {
        if(!$this->is_admin){
            return 'Admin';
        }else{
            return 'User';
        }
    }

    public function tasks()
    {
        return $this->hasMany(Task::class)->orderBy('title');
    }
}
