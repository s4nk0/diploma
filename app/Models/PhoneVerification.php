<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PhoneVerification extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'phone_number',
        'verification_code',
        'status',
    ];
}
