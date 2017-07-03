<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laratrust\Traits\LaratrustUserTrait;

class User extends Authenticatable
{
    use LaratrustUserTrait;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'slug', 'bio'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function posts(){

        return $this->hasMany('App\Post','author_id','id');

    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function scopeLatest($query)
    {
        return $query->orderBy('created_at', 'desc');
    }

    public function RoleLabel(){

       if ($this->roles()->first()->id == '5'){
           return '<span class="label label-danger">Admin</span>';
       }
       elseif ($this->roles->first()->id == '6'){
           return '<span class="label label-info">Edior</span>';
       }
       else
           return '<span class="label label-success">Author</span>';

    }
}
