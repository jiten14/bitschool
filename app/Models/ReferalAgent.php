<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ReferalAgent extends Model
{
    use HasFactory;

    protected $fillable = [
        'full_name',
        'postal_address',
        'email',
        'phone',
    ];

    public function students(): HasMany
    {
        return $this->hasMany(Student::class);
    }

}
