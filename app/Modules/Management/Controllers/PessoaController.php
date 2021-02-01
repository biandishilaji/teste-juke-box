<?php
namespace App\Modules\Management\Controllers;

use App\Core\Http\Controllers\ApiController;
use App\Infrastructure\Repositories\Modules\Management\PessoaRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class PessoaController extends ApiController
{

    private $_pessoaRepository;

    public function __construct(PessoaRepository $pessoaRepository)
    {
        $this->_pessoaRepository = $pessoaRepository;
    }

    public function postCreatePessoa(Request $request)
    {
        try {
            $data = $request->only(['name', 'category', 'code','author','ebook','file_size','weight']);
            $validator = Validator::make($data, [
                'name' => 'required',
                'category' => 'required',
                'code' => 'required',
                'author' => 'required',
                'ebook' => 'required|boolean',
            ]);
            if ($validator->fails()) {
                throw new \Exception('Favor preencher todos os campos obrigatórios corretamente!');
            }
            $pessoa = $this->_pessoaRepository->create($data);
           
        } catch (\Exception $e) {
            return $this->responseError($e->getMessage(), []);
        }
        return $this->responseSuccess("Livro cadastrado com sucesso!", []);
    }
    public function getPessoaById($id)
    {
        try {
            if(!$pessoa = $this->_pessoaRepository->find(($id))){
                throw new \Exception('Livro não encontrado!');
            }
        } catch (\Exception $e) {
            return $this->responseError($e->getMessage(), []);
        }
        return $this->responseSuccess('', $pessoa);
    } 

    public function getPessoas()
    {
        try {
            return $this->responseSuccess('', $this->_pessoaRepository->paginate(5));
        } catch (\Exception $e) {
            return $this->responseError($e->getMessage(), []);
        }
    }
 
    public function deletePessoa($id)
    {
        try {
            $data = ['id' => $id];
            $validator = Validator::make($data, [
                'id' => 'required|integer',
            ]);
            if ($validator->fails()) {
                throw new \Exception('Favor informar um id válido!');
            }
            $rows = $this->_pessoaRepository->delete((int) $id);
            if ($rows == 0) {
                throw new \Exception('Livro não encontrado!');
            } 
          
        } catch (\Exception $e) {
            return $this->responseError($e->getMessage(), []);
        }
        return $this->responseSuccess('Deletado com sucesso!', []);
    }
    public function updatePessoa(Request $request)
    {
        try {
            $data = $request->only([ 'id','name', 'category', 'code','author','ebook','file_size','weight']);
            $validator = Validator::make($data, [
                'id' =>'required',
                'name' => 'required',
                'category' => 'required',
                'code' => 'required',
                'author' => 'required',
                'ebook' => 'required|boolean',
            ]);
            if ($validator->fails()) {
                throw new \Exception('Favor preencher todos os campos obrigatórios corretamente!');
            }
            $rows = $this->_pessoaRepository->update($data, (int)$data['id']);
            if ($rows == 0) {
                throw new \Exception('Livro não encontrado!');
            } 
               
        } catch (\Exception $e) {
            return $this->responseError($e->getMessage(), []);
        }
        return $this->responseSuccess('Editado com sucesso!', []);
    }
}
