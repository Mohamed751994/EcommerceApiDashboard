<?php

namespace App\Http\Controllers\APIControllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrderRequest;
use App\Http\Traits\HelperTrait;
use App\Models\Language;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Services\ApiService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    use HelperTrait;


   // store order (checkout)
    public function checkout(OrderRequest $request)
    {
        DB::beginTransaction();
        try {
            $data = $request->validated();
            //Create Order Here
            $data['user_id'] = auth()->user()->id;
            $randomNumber = $this->generateOrderRandomNumber();
            $data['orderID'] = str_replace('-','',$randomNumber);
            $data['language'] = getLanguageId();
            $created = Order::create($data);
            if($created && count($data['products']) > 0)
            {
                $total_amount = 0;
                //Save Order Details

                foreach ($data['products'] as $val)
                {
                    $product = Product::find($val['id']);
                    OrderDetail::create([
                        'order_id' =>$created->id,
                        'product_id' =>$val['id'],
                        'product_name' =>translateColumn($product, 'name'),
                        'product_price' =>translateColumn($product, 'price'),
                        'product_currency' =>translateColumn($product, 'currency'),
                        'product_qty' =>$val['qty'] ? $val['qty'] : 1,
                        'price_x_qty' =>(int)$val['qty'] * (int)translateColumn($product, 'price'),
                    ]);
                    $total_amount += $val['qty'] * translateColumn($product, 'price');
                    //Decrease Qty of product
                  //  $this->decreaseProductQty($product,$val['qty']);
                }
                $created->update(['total_amount'=>$total_amount]);
            }
            DB::commit();
            return $this->successResponse(__('text.successMessage'), []);
        } catch (\Throwable $th) {
            DB::rollBack();
            return $th;
        }
    }


    //Get All Orders of user
    public function orders()
    {
        $content = auth()->user()->orders();
        if(request('status') == 1)
        {
            $content = $content->whereStatus(1);
        }
        else
        {
            $content = $content->where('status','!=',1);
        }
        $content = $content->paginate(10);
        return $this->successResponse(__('text.orders-index'), $content);
    }

    //Get Single Order of user
    public function order($id)
    {
        $order = auth()->user()->orders()->whereId($id)->first();
        if(!$order)
        {
            return $this->errorResponse(__('text.successFalse'));
        }
        return $this->successResponse(__('text.orders-index'), $order);
    }


    //cancel_order
    public function cancel_order(Request $request,$id)
    {
        $order = Order::whereId($id)->first();
        if(!$order)
        {
            return $this->errorResponse(__('text.successFalse'));
        }
        //check if order status is pending or payment_pending
        if (in_array($order->status['index'] , ['0','1']))
        {
            $order->update(['status' => 4]);
            return $this->successResponse(__('text.orderCancellationMsg'));
        }
        return $this->successResponse(__('text.orderNotCancellationMsg'));
    }




}
