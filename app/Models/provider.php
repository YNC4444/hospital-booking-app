<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class provider extends Model
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
        'specialization',
        'license_number',
        'employment_date',
        'status',
    ];
}
