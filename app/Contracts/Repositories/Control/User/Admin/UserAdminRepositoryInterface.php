<?php


namespace Vialoja\Contracts\Repositories\Control\User\Admin;


use Vialoja\Http\Requests\Control\User\UserRegisterRequest;
use Vialoja\Http\Requests\Control\User\UserUpdateRequest;

interface UserAdminRepositoryInterface
{

    public function getUser($id=null);

    public function createPost(UserRegisterRequest $request);

    public function updatePost(UserUpdateRequest $request);

    public function updatePostTrashed(UserUpdateRequest $request);


}