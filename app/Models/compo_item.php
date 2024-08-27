<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class compo_item extends Model
{
    use HasFactory;
    public function product()
    {
        return $this->belongsTo(dishes_data::class);
    }
}
