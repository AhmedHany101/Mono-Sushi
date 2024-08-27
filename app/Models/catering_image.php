<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class catering_image extends Model
{
    use HasFactory;
    protected $fillable=[
        'catering_id',
        'image',
    ];
}
