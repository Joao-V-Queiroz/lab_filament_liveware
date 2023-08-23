<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Proprietario extends Model
{
   //ou seja, um proprietário, pode ter vários pacientes(animais)
    public function pacientes(): HasMany
    {
        return $this->hasMany(Paciente::class);
    }
}
