<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subdomain extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'domain_id',
        'subdomain',
        'ip_address',
        'status_code',
        'title',
        'server',
        'content_length',
        'screenshot_path',
        'is_monitored',
        'last_scanned_at',
    ];

    protected $casts = [
        'is_monitored' => 'boolean',
        'last_scanned_at' => 'datetime',
    ];

    public function domain(): BelongsTo
    {
        return $this->belongsTo(Domain::class);
    }

    public function ports(): HasMany
    {
        return $this->hasMany(Port::class);
    }

    public function techStacks(): HasMany
    {
        return $this->hasMany(TechStack::class);
    }

    public function vulnerabilities(): HasMany
    {
        return $this->hasMany(Vulnerability::class);
    }
}
