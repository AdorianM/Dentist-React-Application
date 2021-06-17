<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Programare extends Model
{
    use HasFactory;

    protected $fillable = [
        'dentist_id',
        'user_id',
        'dentist_name',
        'user_name',
        'date',
        'comment'
    ];
}
