<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

// changed case of name

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
        // 'services', add relationship to the new services model
        'license_number',
        'employment_date',
        'status',
    ];

    //many to many relationship with services
    public function services()
    {
        return $this->belongsToMany(Service::class, 'provider_service');
    }

    //each provider has many schedules
    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }
}
