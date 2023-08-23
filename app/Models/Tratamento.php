<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Casts\MoneyCast;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Tratamento extends Model
{
    use HasFactory;

    protected $casts = [
        'price' => MoneyCast::class,
    ];

    //um tratamento, pertence a somente um animal
    public function paciente(): BelongsTo
    {
        return $this->belongsTo(Paciente::class);
    }

}
