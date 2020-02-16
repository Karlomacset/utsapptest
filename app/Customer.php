<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

class Customer extends Model implements HasMedia
{
    use HasMediaTrait;
    
    protected $fillable = [
        'firstName',
        'lastName',
        'middleName',
        'motherMaidenName',
        'dateOfBirth',
        'age',
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
        'companyAddress1',
        'companyAddress2',
        'companyCity',
        'companyProvince',
        'companyState',
        'companyZipCode',
        'companyCountry',
        'notes',
    ];


}