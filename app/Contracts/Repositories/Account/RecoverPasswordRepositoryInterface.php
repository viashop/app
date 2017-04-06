<?php


namespace Vialoja\Contracts\Repositories\Account;


use Vialoja\Http\Requests\Account\RecoverPasswordRequest;
use Vialoja\Http\Requests\Account\ResetPasswordRequest;
use Illuminate\Http\Request;

interface RecoverPasswordRepositoryInterface
{

    public function isTokenResetPassord(Request $request);

    public function recoverPassword(RecoverPasswordRequest $request);

    public function resetPassword(ResetPasswordRequest $request);

}