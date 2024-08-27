<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class compoCart extends Model
{
    use HasFactory;
    public function compo()
    {
        return $this->belongsTo(compo::class);
    }
}
