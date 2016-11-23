<?php

namespace Modules\User\Http\Controllers\Admin;

use Breadcrumbs;
use Modules\User\Http\Requests\RolesRequest;
use Modules\User\Permissions\PermissionManager;
use Modules\User\Repositories\RoleRepository;
use URL;

class RolesController extends BaseUserModuleController
{
    /**
     * @var RoleRepository
     */
    private $role;

    public function __construct(PermissionManager $permissions, RoleRepository $role)
    {
        parent::__construct();

        $this->permissions = $permissions;
        $this->role = $role;

        Breadcrumbs::addCrumb(trans('user::roles.title.roles'), URL::route('admin.user.role.index'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $roles = $this->role->all();

        return view('user::admin.roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        Breadcrumbs::addCrumb(trans('user::roles.breadcrumb.new'));

        return view('user::admin.roles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param RolesRequest $request
     *
     * @return Response
     */
    public function store(RolesRequest $request)
    {
        $data = $this->mergeRequestWithPermissions($request);

        $this->role->create($data);

        flash(trans('user::messages.role created'));

        return redirect()->route('admin.user.role.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        Breadcrumbs::addCrumb(trans('user::roles.breadcrumb.edit'));

        if (!$role = $this->role->find($id)) {
            flash()->error(trans('user::messages.role not found'));

            return redirect()->route('admin.user.role.index');
        }

        return view('user::admin.roles.edit', compact('role'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param int          $id
     * @param RolesRequest $request
     *
     * @return Response
     */
    public function update($id, RolesRequest $request)
    {
        $data = $this->mergeRequestWithPermissions($request);

        $this->role->update($id, $data);

        flash(trans('user::messages.role updated'));

        return redirect()->route('admin.user.role.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $this->role->delete($id);

        flash(trans('user::messages.role deleted'));

        return redirect()->route('admin.user.role.index');
    }
}
