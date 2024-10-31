<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    //many to many relationship with providers
    public function providers()
    {
        return $this->belongsToMany(Provider::class, 'provider_service');
    }
}

