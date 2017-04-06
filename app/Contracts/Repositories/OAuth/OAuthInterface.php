<?php


namespace Vialoja\Contracts\Repositories\OAuth;


/**
 * Interface OAuthInterface
 * @package Vialoja\Contracts\Repositories\OAuth
 */
interface OAuthInterface
{

    public function register(array $data);
    public function authenticate(array $data);
}
