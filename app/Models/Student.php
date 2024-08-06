<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'lead_id',
        'referal_agent_id',
        'academic_year_id',
        'admission_type_id',
        'branch_id',
        'semester_id',
        'payment_status',
    ];

    public function academic_year(): BelongsTo
    {
        return $this->belongsTo(AcademicYear::class);
    }

    public function admission_type(): BelongsTo
    {
        return $this->belongsTo(AdmissionType::class);
    }

    public function branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class);
    }

    public function semester(): BelongsTo
    {
        return $this->belongsTo(Semester::class);
    }

    public function referal_agent(): BelongsTo
    {
        return $this->belongsTo(ReferalAgent::class);
    }

    public function lead(): BelongsTo
    {
        return $this->belongsTo(Lead::class);
    }

}
