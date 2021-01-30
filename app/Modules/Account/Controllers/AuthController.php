<?php


namespace App\Modules\Account\Controllers;


use App\Core\Http\Controllers\ApiController;

use App\Domains\Account\Traits\sendMustVerifyEmail;
use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Validator;
use App\Domains\Account\Entities\User;


class AuthController extends ApiController
{

    use sendMustVerifyEmail;

    public function __construct()
    {
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        if (!$token = auth()->attempt($validator->validated())) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $User = User::where('id', auth()->user()->id)->first();

        if (!$User->hasVerifiedEmail()) {
            return $this->responseError('E-mail não verificado. Favor verificar seu e-mail.');
        }

        return $this->sendVerificationMail($request);

        $User->logged_at = Carbon::now()->toDateTimeString();
        $User->save();

        return $this->createNewToken($token);
    }

    public function register(Request $request)
    {

//        $validator = Validator::make($request->all(), [
//            'name' => 'required|string|between:2,100',
//            'email' => 'required|string|email|max:100|unique:users',
//            'password' => 'required|string|confirmed|min:6',
//            'document' => 'required|string'
//        ]);
//
//        if ($validator->fails()) {
//            return response()->json($validator->errors()->toJson(), 400);
//        }
//
//        $user = User::create(array_merge(
//            $validator->validated(),
//            ['password' => bcrypt($request->password)]
//        ));

        $user = User::where('id', 1)->first();

        $this->sendVerificationMail($user);

//        return response()->json([
//            'message' => 'Usuário cadastrado com sucesso!',
//            'user' => $user
//        ], 201);
    }

    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Usuário deslogado com sucesso!']);
    }

    public function refresh()
    {
        return $this->createNewToken(auth()->refresh());
    }

    public function userProfile()
    {
        return response()->json(auth()->user());
    }

    protected function createNewToken($token)
    {
        return response()->json([
            'token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
            'user' => auth()->user()
        ]);
    }
}
