<?php

namespace App\Modules\Account\Controllers;


use Illuminate\Support\Facades\Password;
use Validator;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;

use App\Core\Http\Controllers\ApiController;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;


class ResetPasswordController extends ApiController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function callResetPassword(Request $request)
    {

        try {

            $validator = Validator::make($request->all(), [
                'token' => 'required',
                'email' => 'required|email',
                'password' => 'required|min:6|max:35',
                'password_confirmation' => 'required|min:6|max:35|required_with:password|same:password',
            ]);

            if ($validator->fails()) {
                return $this->responseError('Favor verificar os campos informados!', $validator->errors());
            }

            return $this->reset($request);

        } catch (ValidationException $e) {
            return $this->responseError('Oops! Erro ao redefinir a senha!', $e->errors());
        }

    }

    /**
     * Reset the given user's password.
     *
     * @param  \Illuminate\Contracts\Auth\CanResetPassword $user
     * @param  string $password
     * @return void
     */
    protected function resetPassword($user, $password)
    {
        $user->password = Hash::make($password);
        $user->save();

        event(new PasswordReset($user));
    }

    /**
     * Get the response for a successful password reset.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  string $response
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    protected function sendResetResponse(Request $request, $response)
    {
        return $this->responseSuccess('Senha redefinida com sucesso!', $response);
    }

    /**
     * Get the response for a failed password reset.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  string $response
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    protected function sendResetFailedResponse(Request $request, $response)
    {
        switch ($response) {
            case Password::INVALID_USER:
                return $this->responseError('Oops! E-mail inválido. Verifique o E-mail informado! ', $response);

            case Password::INVALID_TOKEN:
                return $this->responseError('Oops! Token expirado. Verifique novamente a caixa de e-mail! ', $response);

            default:
                return $this->responseError('Oops! Erro desconhecido! Entre em contato com a equipe de suporte! ',
                    $response);
        }

    }

    protected function reset(Request $request)
    {
        $response = $this->broker()->reset(
            $this->credentials($request), function ($user, $password) {
            $this->resetPassword($user, $password);
        }
        );

        // If the password was successfully reset, we will redirect the user back to
        // the application's home authenticated view. If there is an error we can
        // redirect them back to where they came from with their error message.
        return $response == Password::PASSWORD_RESET
            ? $this->sendResetResponse($request, $response)
            : $this->sendResetFailedResponse($request, $response);
    }

    /**
     * Get the broker to be used during password reset.
     *
     * @return \Illuminate\Contracts\Auth\PasswordBroker
     */
    public function broker()
    {
        return Password::broker();
    }

    /**
     * Get the password reset credentials from the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    protected function credentials(Request $request)
    {
        return $request->only(
            'email', 'password', 'password_confirmation', 'token'
        );
    }

}
