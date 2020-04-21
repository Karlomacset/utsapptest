<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tenant extends Model
{
    protected $fillable = ['name','email','subdomain','alias_domain','connection','meta','admin_id'];
    //protected $connection = 'tenancy';
}
