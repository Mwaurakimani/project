<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Block extends Model
{
    use HasFactory;

    public function houses(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(House::class);
    }
}
