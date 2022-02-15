<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 * @OA\Xml(name="Notebook"),
 * @OA\Property(property="id", type="integer", readOnly="true", example="1"),
 * @OA\Property(property="name", type="string", maxLength=32, example="Alexandr"),
 * @OA\Property(property="company", type="string", maxLength=32, example="ozon"),
 * @OA\Property(property="phone", type="string", maxLength=32, example="88004002020"),
 * @OA\Property(property="email", type="string", maxLength=32, example="ozon@mail.ru"),
 * @OA\Property(property="data", type="string", maxLength=32, example="12.01.1990"),
 * @OA\Property(property="foto", type="string", maxLength=32, example="no foto"),
 * )
 */
class Notebook extends Model
{
    use HasFactory;

    protected $table = "Notebooks";

    protected $fillable = [
        'name', 'company', 'phone', 'email', 'data', 'foto'
    ];
}
