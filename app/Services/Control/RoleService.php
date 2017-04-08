<?php

namespace Vialoja\Services\Control;

use Exception;
use stdClass;
use Vialoja\Events\Logs\User\EventActivityRecordUserTypeAdded;
use Vialoja\Events\Logs\User\EventActivityRecordUserTypeChangead;
use Vialoja\Events\Logs\User\EventActivityRecordUserTypeRemoved;
use Vialoja\Http\Requests\Control\Authorization\RoleRequest;
use Vialoja\Http\Requests\Control\Authorization\RoleUpdateRequest;
use Vialoja\Repositories\Control\RoleRepository;

class RoleService
{

    /**
     * @var RoleRepository
     */
    protected $repository;

    /**
     * @var stdClass
     */
    private $std;


    /**
     * RoleService constructor.
     * @param RoleRepository $repository
     * @param stdClass $std
     */
    public function __construct(RoleRepository $repository, stdClass $std)
    {
        $this->repository = $repository;
        $this->std = $std;
    }


    /**
     * Create
     * @param RoleRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function create(RoleRequest $request)
    {

        $this->std->new = $this->repository->create($request);
        event(new EventActivityRecordUserTypeAdded($this->std));

    }

    /**
     * Update
     * @param RoleUpdateRequest $request
     * @throws Exception
     */
    public function update(RoleUpdateRequest $request)
    {

        if (!$this->repository->exists($request->input('role_id'))) {
            throw new Exception();
        }

        $this->std->old = $this->repository->findOrFail($request->input('role_id'));
        $this->repository->update($request);

        $this->std->new = $this->repository->findOrFail($request->input('role_id'));
        event(new EventActivityRecordUserTypeChangead($this->std));

    }

    /**
     * Delete
     * @param $id
     */
    public function delete($id)
    {

        $this->std->old = $this->repository->findOrFail($id);
        $this->repository->delete($id);
        event(new EventActivityRecordUserTypeRemoved($this->std));

    }

}
