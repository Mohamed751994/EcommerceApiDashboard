<?php

namespace App\Http\Controllers\AdminControllers;


use App\Http\Requests\RoleRequest;
use App\Services\CrudService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{
    protected $views = 'roles';
    protected $crudService;
    function __construct(CrudService $crudService)
    {
        $this->middleware('permission:roles-index', ['only' => ['index']]);
        $this->middleware('permission:roles-create', ['only' => ['create','store']]);
        $this->middleware('permission:roles-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:roles-show', ['only' => ['show']]);
        $this->middleware('permission:roles-delete', ['only' => ['destroy']]);

        $this->crudService = $crudService;
    }


    public function index()
    {
        return $this->crudService->index(Role::class,$this->views);
    }

    public function create()
    {
        $compact['permission'] = Permission::get();
        return $this->crudService->create($this->views,$compact);
    }

    public function store(RoleRequest $request)
    {
        DB::beginTransaction();
        try {
            $data = $request->validated();
            $role = Role::create(['name' => $data['name']]);
            $role->permissions()->sync($data['permission']);
            DB::commit();
            toastr()->success(__('text.insertMsg'), 'success', ['timeOut' => 8000]);
            return redirect()->back();
        } catch (\Throwable $th) {
            DB::rollBack();
            return $th;
        }

    }
    public function show(Role $role)
    {
        $rolePermissions = Permission::join("role_has_permissions","role_has_permissions.permission_id","=","permissions.id")
            ->where("role_has_permissions.role_id",$role->id)
            ->get();
        $content = $role;
        return view('admin_dashboard.roles.show',compact('content','rolePermissions'));
    }

    public function edit(Role $role)
    {
        $permission = Permission::get();
        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id",$role->id)
            ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
            ->all();
        $content = $role;
        return view('admin_dashboard.roles.edit',compact('content','permission','rolePermissions'));
    }

    public function update(RoleRequest $request, Role $role)
    {
        DB::beginTransaction();
        try {
            $data = $request->validated();
            $role->update(['name' => $data['name']]);
            $role->permissions()->sync($data['permission']);
            DB::commit();
            toastr()->success(__('text.updateMsg'), 'success', ['timeOut' => 8000]);
            return redirect()->back();
        } catch (\Throwable $th) {
            DB::rollBack();
            return $th;
        }
    }
    public function destroy(Role $role)
    {
        try {
            DB::table("roles")->where('id',$role->id)->delete();
            toastr()->success(__('text.deleteMsg'), 'success', ['timeOut' => 8000]);
            return redirect()->back();
        } catch (\Throwable $th) {
            DB::rollBack();
            return $th;
        }

    }
}
