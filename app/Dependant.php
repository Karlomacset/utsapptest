<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

class Dependant extends Model implements HasMedia
{
    use HasMediaTrait;

    protected $fillable = [
        'customer_id',
            'dependantType',
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

    
    //
}
