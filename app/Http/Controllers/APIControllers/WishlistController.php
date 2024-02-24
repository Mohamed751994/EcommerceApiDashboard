<?php

namespace App\Http\Controllers\APIControllers;

use App\Http\Requests\WishlistRequest;
use App\Http\Resources\ProductResource;
use App\Http\Traits\HelperTrait;
use App\Models\Product;
use App\Models\User;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class WishlistController extends Controller
{
    use HelperTrait;


    //add to wishlist
    public function add_or_delete_wishlist(WishlistRequest $request)
    {
        try {
            $data = $request->validated();
            $wishlistData = ['user_id' => $this->user_id(), 'product_id' =>$data['product_id']];
            $wishlist = Wishlist::where($wishlistData);
            if($wishlist->exists())
            {
                $wishlist->delete();
                $message = __('text.removedItem');
            }
            else
            {
                Wishlist::create($wishlistData);
                $message =__('text.addedItem');
            }
            return $this->successResponse($message);
        } catch (\Throwable $th) {
            return $this->errorResponse($th->getMessage());
        }
    }


    //Get All Wishlists of user
    public function wishlists()
    {
        return $this->successResponse(__('text.Wishlists'),ProductResource::collection(auth()->user()->wishlists));
    }


}
