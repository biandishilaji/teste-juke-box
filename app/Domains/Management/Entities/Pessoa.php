<?php

namespace App\Domains\Management\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Domains\Management\Entities\ModelBase;

class Pessoa extends ModelBase
{
    use HasFactory;
    public $table = "pessoas";
    public $timestamps = false;
    protected $fillable = [
        'id',
        'name',
        'category',
        'code',
        'author',
        'ebook',
        'file_size',
        'weight'
    ];
}
