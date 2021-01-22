<?php

namespace App\Core\Http\Controllers;

use Illuminate\Support\Facades\Auth;


class ApiController extends Controller
{

//    protected $user;

    public function responseSuccess($message = '', $data = [], $code = 200)
    {
        return response()->json([
            'status' => 'success',
            'message' => $message,
            'data' => $data
        ], $code);
    }


//    public function __construct()
//    {
//        $this->user = Auth::user();
//    }

    public function responseError($message, $data = [], $code = 200)
    {
        return response()->json([
            'status' => 'error',
            'message' => $message,
            'data' => $data
        ], $code);
    }
}
