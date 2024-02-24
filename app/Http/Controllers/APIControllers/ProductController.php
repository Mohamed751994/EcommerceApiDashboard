<?php

namespace App\Http\Controllers\APIControllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Http\Traits\HelperTrait;
use App\Models\Product;
use App\Models\ProductTranslation;
use App\Services\ApiService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    use HelperTrait;


    //Get All Products
    public function products()
    {
        $content = Product::with(['category.translations','translations'])->filter(request())->active()->sort();
        if(request('page_size') && !is_null(request('page_size')) && request('page_size') != 0)
        {
            $paginate = request('page_size');
        }
        else
        {
            $paginate = 50;
        }

        if(request('is_offer'))
        {
            $content =  $content->offer();
        }
        $content =  $content->limit(\request('limit'))->paginate($paginate);
        ProductResource::collection($content);
        return $this->successResponse(__('text.successTrue'),$content);
    }

    //Get Single Product
    public function product($id)
    {
        $content = Product::with(['category.translations','translations'])->active()->whereId($id)->first();
        if(!$content)
        {
            return $this->errorResponse(__('text.successFalse'));
        }
        return $this->successResponse(__('text.successTrue'), new ProductResource($content));
    }

    //Related Products
    public function related_products($id)
    {
        $product = Product::find($id);
        if(!$product)
        {
            return $this->errorResponse(__('text.successFalse'));
        }
        $content = Product::with(['category.translations','translations'])->where('category_id', $product->category_id)->where('id', '!=', $product->id)->sort()->limit(10)->get();
        return $this->successResponse(__('text.successTrue'),ProductResource::collection($content));
    }

    //Related Products
    public function realtime_search()
    {
        $content = ProductTranslation::where('language_id', getLanguageId())
            ->where('name', 'LIKE', '%'.request('keyword').'%')
            ->select('product_id AS id', 'name')
            ->get();
        (request('keyword') && request('keyword') != '') ? $content : $content=[];
        return $this->successResponse(__('text.successTrue'),$content);
    }



}
