<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminRequest;
use App\Http\Requests\MainRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\Category;
use App\Models\User;
use App\Services\CrudService;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class CustomerController extends Controller
{
    protected $views = 'customers';
    protected $crudService;
    public function __construct(CrudService $crudService)
    {
        $this->crudService = $crudService;
        $this->middleware('permission:customers-index', ['only' => ['index']]);
        $this->middleware('permission:customers-create', ['only' => ['create','store']]);
        $this->middleware('permission:customers-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:customers-show', ['only' => ['show']]);
        $this->middleware('permission:customers-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $conditions = [['type', '=', 2]];
        return $this->crudService->index(User::class,$this->views,$conditions, ['orders']);
    }

    public function create()
    {
        return $this->crudService->create($this->views);
    }

    public function store(RegisterRequest $request)
    {
        $setData = [['key' => 'type', 'val' =>2], ['key'=>'email_verified_at', 'val'=>date('Y-m-d H:i:s')]];
        return $this->crudService->store($request,User::class, $setData);
    }

    public function show(User $customer)
    {
        return $this->crudService->show($customer,$this->views);
    }

    public function edit(User $customer)
    {
        return $this->crudService->edit($customer,$this->views);
    }

    public function update(RegisterRequest $request, User $customer)
    {
        return $this->crudService->update($request,$customer);
    }

    public function destroy(User $customer)
    {
        return $this->crudService->destroy($customer);
    }
}
