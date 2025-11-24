<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DarkwebCredential extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'email',
        'password_hash',
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
