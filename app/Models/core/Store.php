<?php

namespace App\Models\core;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    use HasFactory;

    protected $table = "Store";
    protected $primary = "id"; //Por padrão o laravel já pega o id, mas caso seja outro campo tem que alterar na variável

    protected $fillable = [
        'name_fantasy',
        'cnpj',
        'street',
        'number',
        'complement',
        'city',
        'state',
        'cellphone',
        'site',
        'email',
        'image'
    ];

}
