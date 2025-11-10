<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'cpf',
        'birth_date',
        'school_id',
    ];

    /**
     * Relacionamento: Um estudante pertence a uma escola
     */
    public function school()
    {
        return $this->belongsTo(School::class);
    }
}
