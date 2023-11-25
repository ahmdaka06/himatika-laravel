<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Participants extends Model
{
    use HasFactory;

    protected $fillable = [
        'invoice',
        'name',
        'email',
        'institutional_origin',
        'whatsapp',
        'pay_sender',
        'pay_proof',
        'follow_proof',
        'recom_by',
        'is_paid',
        'certificate',
    ];

    protected $casts = [
        'is_paid' => 'boolean',
    ];

    protected function name(): Attribute
    {
        return Attribute::make(
            set: fn (string $value) => ucwords(strtolower($value)),
        );
    }
}
