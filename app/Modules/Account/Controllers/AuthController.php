<?php


namespace App\Modules\Account\Controllers;


use App\Core\Http\Controllers\ApiController;
use App\Domains\Account\Entities\User;
use Illuminate\Http\Request;

class AuthController extends ApiController
{

    public function login(Request $request){

        $user = User::all();
    }
}
