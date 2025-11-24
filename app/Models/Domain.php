<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Domain extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'company_id',
        'user_id',
        'domain',
        'status',
        'subdomain_count',
        'vulnerability_count',
        'port_count',
        'last_scanned_at',
        'scan_config',
    ];

    protected $casts = [
        'last_scanned_at' => 'datetime',
        'scan_config' => 'array',
    ];

    // Relationships
    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function subdomains(): HasMany
    {
        return $this->hasMany(Subdomain::class);
    }

    public function vulnerabilities(): HasMany
    {
        return $this->hasMany(Vulnerability::class);
    }

    // Scopes
    public function scopeForCompany($query, $companyId)
    {
        return $query->where('company_id', $companyId);
    }

    public function scopeActive($query)
    {
        return $query->whereIn('status', ['scanning', 'completed']);
    }
}
