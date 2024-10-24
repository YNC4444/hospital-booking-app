<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Patient extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    // mass-assignable attributes
    protected $fillable = [
        'fname',
        'lname',
        'email',
        'password',
        'dob',
        'gender',
        'phone',
        'address',
        'emergency_contact_name',
        'emergency_contact_phone',
    ];
}
