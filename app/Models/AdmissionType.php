<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AdmissionType extends Model
{
    use HasFactory;

    protected $fillable = [
        'admission_type',
    ];

    public function students(): HasMany
    {
        return $this->hasMany(Student::class);
    }

}
