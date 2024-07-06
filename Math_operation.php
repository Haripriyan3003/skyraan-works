<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Math_operation extends Model
{
    use HasFactory;

    protected $fillable = [
        'inputs_operations',
        'operation',
        'answer',
    ];
}
