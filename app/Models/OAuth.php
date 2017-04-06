<?php

namespace Vialoja\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class OAuth
 * @package Vialoja\Models
 */
class OAuth extends Model
{

    /**
     * @var string
     */
    protected $table = 'oauths';


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'oauth_user', 'oauth_id');
    }

}
