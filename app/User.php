<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use App\Employee;
use App\Customer;

class User extends Authenticatable
{
    use Notifiable, HasApiTokens, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','userDB','dispatchDB','psc_token'
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

    public function customer()
    {
        return $this->hasOne(client::class, 'user_id');
    }

    public function getProfilePic()
    {
        if($this->client != null){
            $loc = $this->client->getFirstMediaUrl('profile');
            if($loc == null){
                $loc = '/assets/images/users/1.jpg';
            }
        }else{
            $loc = '/assets/images/users/1.jpg';
        }

        return $loc;
    }



}
