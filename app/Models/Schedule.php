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
        'date',
        'start_time',
        'end_time',
    ];

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($schedule) {
            $schedule->appointments()->each(function ($appointment) {
                $appointment->delete();
            });
        });
    }

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
