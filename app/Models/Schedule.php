<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Schedule extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'provider_id',
        'day_of_week',
        'start_time',
        'end_time',
    ];

    // one schedule only has one provider
    public function provider()
    {
        return $this->belongsTo(Provider::class);
    }

    // each schedule has many appointments
    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }
}
