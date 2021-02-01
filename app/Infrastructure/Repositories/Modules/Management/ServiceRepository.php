<?php

namespace App\Infrastructure\Repositories\Modules\Management;

use App\Domains\Management\Entities\Service;
use App\Infrastructure\Repositories\BaseRepository;
Use App\Infrastructure\Repositories\Modules\Management\Interfaces\IServiceRepository;


class ServiceRepository extends BaseRepository implements IServiceRepository
{
    
    public function getListServices($filter){
        
        $queryBuilder = $this->model;
        
        if ($filter){
        foreach($filter as $name => $value){
            
//             $filter = [
//                 'name' = 'TESTE'
//                ];
            
            switch($name){
                    
                case 'name':
                    $queryBuilder->where('name', 'LIKE', "%$value%");
                    break;
            }
        }
            
            return $queryBuilder;
    }
        
        public function getListServicesPaginate($filter, $itemsByPage){
        
        $queryBuilder = $this->getListServices($filter);
            
        return $queryBuilder->paginate($itemsByPage);
        }
    
    function model()
    {
        return Service::class;
    }
}
