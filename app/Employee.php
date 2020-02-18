<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

class Employee extends Model implements HasMedia
{
    use HasMediaTrait;
    
    protected $fillable = [
        'firstName',
        'lastName',
        'user_id',
        'middleName',
        'dateOfBirth',
        'age',
        'gender',
        'maritalStatus',
        'address1',
        'address2',
        'city',
        'province',
        'state',
        'zipCode',
        'country',
        'landline',
        'mobileNo',
        'companyName',
        'position',
        'notes',
    ];
}
