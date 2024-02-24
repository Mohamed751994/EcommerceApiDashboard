<?php

namespace App\Http\Controllers\AdminControllers;
use App\Http\Requests\UpdateProfileRequest;
use App\Models\Blog;
use App\Models\Career;
use App\Models\Category;
use App\Models\Industry;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\Service;
use App\Models\Solution;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class DashboardController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function dashboard()
    {
        //count products , categories and orders
        $counts = DB::table('users')->where('type',2)
            ->selectRaw('COUNT(*) as users_count')
            ->addSelect(DB::raw('(SELECT COUNT(*) FROM categories) as categories_count'))
            ->addSelect(DB::raw('(SELECT COUNT(*) FROM products) as products_count'))
            ->addSelect(DB::raw('(SELECT COUNT(*) FROM orders) as orders_count'))
            ->first();
        $users = $counts?->users_count;
        $categories = $counts?->categories_count;
        $products = $counts?->products_count;
        $orders = $counts?->orders_count;

        //most products ordered
        $mostProductsOrdered = OrderDetail::select(['product_id', DB::raw('COUNT(product_id) as count')])
           ->groupBy('product_id')->orderBy('count', 'desc')->pluck('product_id');
        $mostProducts = Product::with('translations')->whereIn('id', $mostProductsOrdered)->limit(5)->get();

        //Latest 5 orders
        $latest_5_orders = Order::latest()->limit(5)->get();

        return view('admin_dashboard.dashboard', compact('users','categories', 'products', 'orders', 'mostProducts','latest_5_orders'));
    }


    public function quickChange(Request $request)
    {
        $item =  app("App\Models\\".$request->item);
        $id = $request->id;
        $val = $request->val;
        $col = $request->col;
        $item::whereId($id)->update([$col=> $val]);
        return response()->json(['success'=>true]);
    }
    public function deleteSelectedItems(Request $request)
    {
        $model =  app("App\Models\\".$request->model);
        $ids = $request->ids;
        $model::whereIn('id',$ids)->delete();
        toastr()->success( __('text.deleteSelectedItems'), 'success', ['timeOut' => 8000]);
        return response()->json(['success'=>true]);
    }



    public function userProfile()
    {
        return view('admin_dashboard.userProfile');
    }


    public function updateUserProfile(UpdateProfileRequest $request)
    {
        try {
            $data = $request->validated();
            if(isset($data['password']))
            {
                auth()->user()->update($data);
            }
            else
            {
                auth()->user()->update(['name'=>$data['name'], 'email' =>$data['email']]);

            }
            toastr()->success(__('text.updateMsg'), 'success', ['timeOut' => 8000]);
            return redirect()->back();
        } catch (\Throwable $th) {
            return $th;
        }
    }


    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('admin.login_page');
    }


}
