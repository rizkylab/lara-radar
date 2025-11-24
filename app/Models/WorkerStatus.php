<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkerStatus extends Model
{
    use HasFactory;

    protected $fillable = [
        'worker_name',
        'status',
        'last_heartbeat_at',
        'current_job',
        'queue_size',
    ];

    protected $casts = [
        'last_heartbeat_at' => 'datetime',
    ];
}
