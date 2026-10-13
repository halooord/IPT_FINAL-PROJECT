<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CounselingRecord extends Model
{
    use HasFactory;

    protected $fillable = [
        'appointment_id',
        'session_date',
        'notes',
        'outcome',
        'follow_up_date',
    ];

    protected function casts(): array
    {
        return [
            'session_date' => 'date',
            'follow_up_date' => 'date',
        ];
    }

    public function appointment(): BelongsTo
    {
        return $this->belongsTo(Appointment::class);
    }

    public function referrals(): HasMany
    {
        return $this->hasMany(Referral::class);
    }
}