<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

class Provider extends Model implements HasMedia
{
    use HasMediaTrait;

    protected $fillable = [
        'companyName',
            'narrative',
            'address1',
            'city',
            'state',
            'zipCode',
            'contactPerson',
            'phoneNo',
            'mobileNo',
            'email',
            'website',
            'apiKey',
            'apiSecret',
    ];

    
}
