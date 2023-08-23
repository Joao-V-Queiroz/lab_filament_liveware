<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Paciente extends Model
{
   //um paciente(animal), pertence a somente um proprietário
    public function proprietario(): BelongsTo
    {
        return $this->belongsTo(Proprietario::class);
    }

   //um paciente(animal), pode ter vários tratamentos
    public function tratamentos(): HasMany
    {
        return $this->hasMany(Tratamento::class);
    }
}
