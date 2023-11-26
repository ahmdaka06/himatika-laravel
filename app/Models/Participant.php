<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Participant extends Model
{
    use HasFactory;

    protected $fillable = [
        'invoice',
        'name',
        'email',
        'sid_number',
        'institutional_origin',
        'whatsapp',
        'payment',
        'pay_sender',
        'pay_proof',
        'recom_by',
        'price',
        'is_paid',
        'status',
        'reason',
        'certificate',
    ];

    protected $casts = [
        'is_paid' => 'boolean',
        'institutional_origin' => 'array',
        'payment' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'update_by', 'id');
    }

    protected function name(): Attribute
    {
        return Attribute::make(
            set: fn (string $value) => strtoupper($value),
        );
    }
}
