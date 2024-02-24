<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminRequest;
use App\Http\Requests\MainRequest;
use App\Models\Category;
use App\Models\User;
use App\Services\CrudService;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    protected $views = 'users';
    protected $crudService;
    public function __construct(CrudService $crudService)
    {
        $this->crudService = $crudService;
        $this->middleware('permission:users-index', ['only' => ['index']]);
        $this->middleware('permission:users-create', ['only' => ['create','store']]);
        $this->middleware('permission:users-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:users-show', ['only' => ['show']]);
        $this->middleware('permission:users-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $conditions = [['type', '=', 1]];
        return $this->crudService->index(User::class,$this->views,$conditions);
    }

    public function create()
    {
        $compact['roles'] = Role::pluck('name','name')->all();
        return $this->crudService->create($this->views,$compact);
    }

    public function store(AdminRequest $request)
    {
        $setData = [['key' => 'type', 'val' =>1]];
        return $this->crudService->store($request,User::class, $setData);
    }

    public function show(User $user)
    {
        return $this->crudService->show($user,$this->views);
    }

    public function edit(User $user)
    {
        $compact['roles'] = Role::pluck('name','name')->all();
        $compact['userRole']  = $user->roles->pluck('name','name')->all();
        return $this->crudService->edit($user,$this->views,$compact);
    }

    public function update(AdminRequest $request, User $user)
    {
        return $this->crudService->update($request,$user);
    }

    public function destroy(User $user)
    {
        return $this->crudService->destroy($user);
    }
}
