<?php

namespace App\Domains\Management\Entities;

use App\Domains\Management\Entities\ModelBase;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends ModelBase

{
    use SoftDeletes;
    
    public $module = 'Management';
    protected $table = 'clients';
    protected $fillable= [
        'id',
        'name',
        'document',
        'created_at',
        'updated_at',
        'client_type',
        'details',
        'deleted_at'
    ];
    protected $dates = [
        'deleted_at',
        'created_at',
        'updated_at'
    ];
}