<?php


namespace Vialoja\Contracts\Repositories\Control\User\Search;


interface SearchUserShopRepositoryInterface
{
    public function search($search, $type);
}