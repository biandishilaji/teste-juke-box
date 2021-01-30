<?php


namespace App\Modules\Account\Controllers;

use App\Core\Http\Controllers\ApiController;
use App\Traits\SendsPasswordResetEmails;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Password;


class ForgotPasswordController extends ApiController
{
    use SendsPasswordResetEmails;

    public function __construct()
    {
        $this->middleware('guest');
    }

    public function postForgotPassword(Request $request)
    {
        return $this->sendResetLinkEmail($request);
    }

    /**
     * Get the response for a successful password reset link.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  string $response
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    protected function sendResetLinkResponse(Request $request, $response)
    {
        return $this->responseSuccess('E-mail de redefinição de senha enviado com sucesso!', $response);
    }

    protected function sendResetLinkFailedResponse(Request $request, $response)
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

}
