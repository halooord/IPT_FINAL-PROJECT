<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'counselor_id',
        'appointment_date',
        'purpose',
        'student_concern',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'appointment_date' => 'datetime',
        ];
    }

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }

    public function counselor(): BelongsTo
    {
        return $this->belongsTo(Counselor::class);
    }

    public function counselingRecord(): HasOne
    {
        return $this->hasOne(CounselingRecord::class);
    }
}
