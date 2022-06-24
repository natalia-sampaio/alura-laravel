<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Season extends Model
{
    use HasFactory;

    public function show()
    {
        return $this->belongsTo(Show::class);
    }

    public function episodes()
    {
        return $this->hasMany(Episodes::class);
    }
}
