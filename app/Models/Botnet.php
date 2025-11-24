<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Botnet extends Model
{
    use HasFactory;

    protected $fillable = [
        'ip_address',
        'botnet_name',
        'last_seen_at',
        'status',
        'country',
        'asn',
    ];

    protected $casts = [
        'last_seen_at' => 'datetime',
    ];
}
