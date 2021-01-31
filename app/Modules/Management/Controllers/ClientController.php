<?php
namespace App\Modules\Management\Controllers;

use App\Core\Http\Controllers\ApiController;
use App\Infrastructure\Repositories\Modules\Management\ClientRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ClientController extends ApiController
{
    private $_clientRepository;

    public function __construct(ClientRepository $clientRepository)
    {
        $this->_clientRepository = $clientRepository;
    }
    public function postCreateClient(Request $request)
    {
        try {
            //filtramos os dados que chegam da request
            $data = $request->only(['name', 'document', 'client_type', 'details']);
            //vamos verificar se os dados necessários estão sendo informados.
            $validator = Validator::make($data, [
                'name' => 'required|max:50|',
                'document' => 'required|max:15',
            ]);
            // caso haja algum dado informado de forma indevida retornamos a seguinte resposta.
            if ($validator->fails()) {
                throw new \Exception('Favor preencher todos os campos obrigatórios corretamente!');
            }
            // portanto, passando pela nossa validação mandamos o array com os dados recebidos para o repositório.
            $client = $this->_clientRepository->create($data);
            // sendo assim, informamos o usuário que a operação foi um sucesso.
            return $this->responseSuccess('Cliente cadastrado com sucesso!', []);
        } catch (\Exception$e) {
            return $this->responseError($e->getMessage(), []);
        }
    }

    public function getClientById($id)
    {
        try {
            if (!$client = $this->_clientRepository->find(($id))) {
                throw new \Exception('Cliente não encontrado!');
            }
        } catch (\Exception$e) {
            return $this->responseError($e->getMessage(), []);
        }
        return $this->responseSuccess('', $client);
    }

    public function getClients()
    {
        try {
            return $this->responseSuccess('', $this->_clientRepository->paginate(8));
        } catch (\Exception$e) {
            return $this->responseError($e->getMessage(), []);
        }
    }

    public function deleteClient($id)
    {
        try {
            $data = ['id' => $id];
            $validator = Validator::make($data, [
                'id' => 'required|integer',
            ]);
            if ($validator->fails()) {
                throw new \Exception('Favor informar um id correto!');
            }
            $rows = $this->_clientRepository->delete((int) $id);
            if ($rows == 0) {
                throw new \Exception('Cliente não encontrado!');
            }
            return $this->responseSuccess('Deletado com sucesso!', []);
        } catch (\Exception$e) {
            return $this->responseError($e->getMessage(), []);
        }
    }
    public function updateClient(Request $request)
    {
        try {
            $data = $request->only(['id', 'name', 'document', 'client_type', 'details']);
            $validator = Validator::make($data, [
                'id' => 'required',
                'name' => 'required|max:50|',
                'document' => 'required|max:15',
            ]);
            if ($validator->fails()) {
                throw new \Exception('Favor preencher todos os campos obrigatórios corretamente!');
            }
            $rows = $this->_clientRepository->update($data, (int) $data['id']);
            if ($rows == 0) {
                throw new \Exception('Cliente não encontrado!');
            } 
            return $this->responseSuccess('Editado com sucesso!', []);
        } catch (\Exception$e) {
            return $this->responseError($e->getMessage(), []);
        }
    }
}
