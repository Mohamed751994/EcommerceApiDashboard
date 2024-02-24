<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use App\Models\Language;
use App\Models\Order;
use App\Services\CrudService;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    protected $views = 'orders';
    protected $crudService;
    public function __construct(CrudService $crudService)
    {
        $this->crudService = $crudService;
        $this->middleware('permission:orders-index', ['only' => ['index']]);
        $this->middleware('permission:orders-create', ['only' => ['create','store']]);
        $this->middleware('permission:orders-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:orders-show', ['only' => ['show']]);
        $this->middleware('permission:orders-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $content = Order::with(['details', 'languageIcon']);
        if(request('lang') && !empty(request('lang')))
        {
            $content = $content->whereLanguage(request('lang'));
        }
        if(request('user_id') && !empty(request('user_id')))
        {
            $content = $content->where('user_id',request('user_id'));
        }

        $content = $content->latest()->paginate($this->paginate);
        $languages = Language::get();
        $currentLang = Language::whereId(request('lang'))->first();
        $total_amount = Order::whereLanguage(request('lang'))->sum('total_amount');

        return view('admin_dashboard.'.$this->views.'.index', compact('content','languages','currentLang','total_amount'));
    }


    public function show(Order $order)
    {
        $content = $order;
        return view('admin_dashboard.'.$this->views.'.show', compact('content'));
    }


    public function edit(Order $order)
    {
        $content = $order;
        return view('admin_dashboard.'.$this->views.'.edit', compact('content'));
    }

    public function update(Request $request,Order $order)
    {
        $order->update(['status'=>$request->status]);
        toastr()->success(__('text.updateMsg'), 'success', ['timeOut' => 8000]);
        return redirect()->back();
    }

}
