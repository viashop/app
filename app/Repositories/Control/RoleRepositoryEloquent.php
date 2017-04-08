<?php

namespace Vialoja\Repositories\Control;

use InvalidArgumentException;
use Vialoja\Entities\Role;
use Vialoja\Http\Requests\Control\Authorization\RoleRequest;
use Vialoja\Http\Requests\Control\Authorization\RoleUpdateRequest;

class RoleRepositoryEloquent implements RoleRepository
{

    /**
     * @var Role
     */
    private $role;

    /**
     * RoleRepositoryEloquent constructor.
     * @param Role $role
     */
    public function __construct(Role $role)
    {
        $this->role = $role;
    }

    /**
     * Read Roles
     * @param $string
     * @return mixed
     */
    public function read($string)
    {

        $string = tools_sanitize_search($string);
        if (!empty($string)) {
            return $this->role->where('description', 'like', "%$string%")->paginate(50);
        }
        return $this->role->paginate(50);

    }

    /**
     * Register new role
     * @param RoleRequest $request
     */
    public function create(RoleRequest $request)
    {

        if ($this->total($request) > 0) {
            throw new InvalidArgumentException();
        }

        return $this->role->create([
            'name' => str_slug( $request->input('name'), '_' ),
            'description' => $request->input('description')
        ]);

    }

    /**
     * Count Roles
     * @param RoleRequest $request
     * @return mixed
     */
    public function total(RoleRequest $request)
    {
        return $this->role->where(function ($query) use ($request) {
            $query->where('name', str_slug($request->input('name')))
                ->orWhere('description', $request->input('description'));
        })->count();
    }

    /**
     * Get data via ID
     * @param $id
     * @return array
     */
    public function findOrFail($id)
    {
        return $this->role->findOrFail($id);
    }

    /**
     * Update Role
     * @param RoleUpdateRequest $request
     * @return array
     */
    public function update(RoleUpdateRequest $request)
    {

        if (!$this->exists($request->input('role_id'))) {
            throw new InvalidArgumentException();
        }

        if ($this->isRoleDefault($request->input('role_id'))) {

            return $this->role->where('id', $request->input('role_id'))
                ->update([
                    'description' => $request->input('description')
                ]);

        }

        return $this->role->where('id', $request->input('role_id'))->where('default', '=', 1)
            ->update([
                'name' => str_slug( $request->input('name'), '_' ),
                'description' => $request->input('description')
            ]);


    }

    /**
     * Delete Role
     * @param $id
     */
    public function delete($id)
    {

        if ($this->isRoleDefault($id)) {
            throw new InvalidArgumentException();
        }

        $this->role->destroy($id);

    }

    /**
     * Verify Is Exists id
     * @param $id
     * @return boolean
     */
    public function exists($id)
    {
        return $this->role->where('id', '=', intval($id))->exists();
    }

    /**
     * Is Role Default
     * @param $id
     * @return boolean
     */
    private function isRoleDefault($id)
    {
        return $this->role->where('id', intval($id))->where('default', '=', 1)->exists();
    }

}
