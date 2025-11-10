<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'cnpj',
        'telephone',
        'email',
        'director',
        'year_of_foundation',
    ];

    /**
     * Relacionamento: Uma escola tem muitos estudantes
     */
    public function students()
    {
        return $this->hasMany(Student::class);
    }

    /**
     * Relacionamento: Uma escola tem um endereço
     */
    public function address()
    {
        return $this->hasOne(SchoolAddress::class);
    }
}
