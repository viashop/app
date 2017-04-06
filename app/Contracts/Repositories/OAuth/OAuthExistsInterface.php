<?php


namespace Vialoja\Contracts\Repositories\OAuth;


/**
 * Interface OAuthExistsInterface
 * @package Vialoja\Repositories\OAuth
 */
interface OAuthExistsInterface
{
    public function existsOAuthID($value);
}