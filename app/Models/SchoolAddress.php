<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchoolAddress extends Model
{
    use HasFactory;
    protected $fillable = [
        'zip_code',
        'street',
        'neighborhood',
        'city',
        'number',
        'complement',
        'school_id',
    ];

    /**
     * Relacionamento: Um endereço pertence a uma escola
     */
    public function school()
    {
        return $this->belongsTo(School::class);
    }
}
