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
        'services',
        'license_number',
        'employment_date',
        'status',
    ];

    // automatically cast services attribute to array when retrieved
    protected $casts = [
        'services' => 'array',
    ];

    // converts services array to json string before saving
    public function setServicesAttribute($value)
    {
        if (is_array($value)) {
            $this->attributes['services'] = json_encode($value);
        } else {
            $this->attributes['services'] = $value;
        }
    }

    // converts services json string to array when retrieved
    public function getServicesAttribute($value)
    {
        return json_decode($value, true);
    }
}
