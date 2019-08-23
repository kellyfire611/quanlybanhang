<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    public $timestamps = false; // không sử dụng cột UPDATED_AT, CREATED_AT

    protected $table        = 'employees';
    
    protected $fillable     = ['username', 'last_name', 'first_name', 'email', 'avatar', 'password', 'job_title', 'manager_id', 'phone', 'address1', 'address2', 'city', 'state', 'postal_code', 'country', 'remember_token'];
    protected $guarded      = ['id'];
    protected $primaryKey   = 'id';

}
