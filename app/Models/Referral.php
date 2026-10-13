<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Referral extends Model
{
    use HasFactory;

    protected $fillable = [
        'counseling_record_id',
        'referral_type',
        'destination',
        'reason',
        'status',
        'referral_date',
    ];

    protected function casts(): array
    {
        return [
            'referral_date' => 'date',
        ];
    }

    public function counselingRecord(): BelongsTo
    {
        return $this->belongsTo(CounselingRecord::class);
    }
}