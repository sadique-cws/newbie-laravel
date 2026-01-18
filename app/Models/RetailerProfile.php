<?php

namespace App\Models;

use App\Enums\KYCStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RetailerProfile extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $casts = [
        'kyc_status' => KYCStatus::class,
        'document_urls' => 'array',
        'approved_at' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function approver(): BelongsTo
    {
        return $this->belongsTo(User::class, 'approved_by');
    }
}
