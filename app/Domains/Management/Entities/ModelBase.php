<?php

namespace App\Domains\Management\Entities;

use Illuminate\Database\Eloquent\Model;

abstract class ModelBase extends Model
{

    public $module = 'Management';

}
