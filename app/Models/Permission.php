<?php

namespace Vialoja\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Permission extends Model
{

    use SoftDeletes;

    /**
     * @var array
     */
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'name', 'description',
    ];

    public function roles()
    {
       return $this->belongsToMany(\Vialoja\Models\Role::class);
    }

}
