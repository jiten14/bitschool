<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'referal_agent_id',
        'academic_year_id',
        'admission_type_id',
        'branch_id',
        'full_name',
        'parents_name',
        'communication_address',
        'parmanent_address',
        'email',
        'phone',
        'reg_no',
        'student_status',
        'payment_status',
    ];

    public static function boot()
    {
        parent::boot();

        static::creating(function($model){
            $model->reg_no ='KSET-'.str_pad(Student::max('id')+1,5,'0', STR_PAD_LEFT); 
        });
    }

    public function fees(): HasMany
    {
        return $this->hasMany(Fee::class);
    }

    public function referal_agent(): BelongsTo
    {
        return $this->belongsTo(ReferalAgent::class);
    }

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

}
