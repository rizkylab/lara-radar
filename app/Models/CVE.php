<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CVE extends Model
{
    use HasFactory;

    protected $table = 'cves';

    protected $fillable = [
        'cve_id',
        'description',
        'cvss_score',
        'published_at',
        'last_modified_at',
        'references',
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'last_modified_at' => 'datetime',
        'references' => 'array',
    ];
}
