<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;


class Client extends Model implements HasMedia
{
    use HasMediaTrait;

    //
    protected $fillable = ['companyName', 'firstName', 'lastName','userName','admin_id','status_id','approvalToken','client_id','description'];

    public function user(){
        return $this->hasOne(User::class,'id','admin_id')->withDefault();
    }

    public function fullname()
    {
        return $this->firstName.' '.$this->lastName;
    }

}
