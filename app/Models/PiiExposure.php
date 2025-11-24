<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PiiExposure extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'data_type',
        'exposed_data',
        'source',
        'leaked_at',
    ];

    protected $casts = [
        'leaked_at' => 'datetime',
    ];

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }
}
