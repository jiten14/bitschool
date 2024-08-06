<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Lead extends Model
{
    use HasFactory;

    protected $fillable = [
        'academic_year_id',
        'admission_type_id',
        'branch_id',
        'semester_id',
        'full_name',
        'parents_name',
        'communication_address',
        'parmanent_address',
        'email',
        'phone',
        'reg_no'
    ];

    public static function boot()
    {
        parent::boot();

        static::creating(function($model){
            $model->reg_no ='KSET-'.str_pad(Lead::max('id')+1,5,'0', STR_PAD_LEFT); 
        });
    }

    public function student(): HasOne
    {
        return $this->hasOne(Student::class);
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

    public function semester(): BelongsTo
    {
        return $this->belongsTo(Semester::class);
    }

}
