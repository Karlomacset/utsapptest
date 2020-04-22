<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

class Tenant extends Model implements HasMedia
{
    use HasMediaTrait;
    
    protected $fillable = ['name','email','subdomain','alias_domain','connection','meta','admin_id'];
    //protected $connection = 'tenancy';

    public function client(){
        return $this->belongsTo(Client::class,'client_id');
    }
}
