<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notebook extends Model
{
    use HasFactory;

    protected $table = "Notebooks";

    protected $fillable = [
        'name', 'company', 'phone', 'email', 'data', 'foto'
    ];
}