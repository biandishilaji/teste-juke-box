<?php

namespace App\Infrastructure\Repositories\Modules\Management;

use App\Domains\Management\Entities\Client;
use App\Infrastructure\Repositories\BaseRepository;
use App\Infrastructure\Repositories\Modules\Management\Interfaces\IClientRepository;


class ClientRepository extends BaseRepository implements IClientRepository
{
   function model(){
    return Client::class;
   }
}