<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\SettingRequest;
use App\Models\Setting;
use App\Services\CrudService;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    protected $views = 'settings';
    protected $crudService;
    public function __construct(CrudService $crudService)
    {
        $this->crudService = $crudService;
        $this->middleware('permission:settings-index', ['only' => ['index']]);
        $this->middleware('permission:settings-create', ['only' => ['create','store']]);
        $this->middleware('permission:settings-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:settings-show', ['only' => ['show']]);
        $this->middleware('permission:settings-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $setting = Setting::first();
        return view('admin_dashboard.'.$this->views.'.index', compact('setting'));
    }

    public function store(SettingRequest $request)
    {
        $data = $request->validated();
        Setting::updateOrCreate(['id' => $request->get('setting_id')],$data);
        toastr()->success(__('text.updateMsg'), 'success', ['timeOut' => 8000]);
        return redirect()->back();
    }

}
