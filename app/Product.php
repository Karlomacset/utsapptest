<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

class Product extends Model implements HasMedia
{
    use HasMediaTrait;

    protected $fillable = [
        'title',
            'description',
            'provider_id',
            'premium_amt',
            'service_fee',
    ];

    
    //
}
