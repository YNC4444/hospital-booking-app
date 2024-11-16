<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Appointment extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'schedule_id',
        'patient_id',
        'provider_id',
        'date',
        'start_time',
        'end_time',
        'status',
    ];

    // each appointment belongs to only one schedule
    public function schedule()
    {
        return $this->belongsTo(Schedule::class);
    }

    // each appointment belongs to only one patient
    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    // each appointment belongs to only one provider
    public function provider()
    {
        return $this->belongsTo(Provider::class);
    }
}
