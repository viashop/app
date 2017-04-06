<?php


namespace Vialoja\Contracts\Repositories\Account;


use Vialoja\Http\Requests\Account\LoginRequest;
use Vialoja\Http\Requests\Account\RegisterRequest;

interface UserRepositoryInterface
{

    public function autheticateUser(LoginRequest $request);

    public function registerUser(RegisterRequest $request);

}