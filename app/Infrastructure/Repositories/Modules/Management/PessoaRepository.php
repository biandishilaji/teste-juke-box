<?php

namespace App\Infrastructure\Repositories\Modules\Management;

use App\Domains\Management\Entities\Pessoa;
use App\Infrastructure\Repositories\BaseRepository;
Use App\Infrastructure\Repositories\Modules\Management\Interfaces\IPessoaRepository;


class PessoaRepository extends BaseRepository implements IPessoaRepository
{
    
    function model()
    {
        return Pessoa::class;
    }
}
