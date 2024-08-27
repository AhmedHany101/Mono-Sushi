<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class compo_orders extends Model
{
    use HasFactory;
    protected $table = 'compo_orders';
    public function compo()
    {
        return $this->belongsTo(compo::class);
    }
}
