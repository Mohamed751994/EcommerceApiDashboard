<?php

namespace App\Http\Controllers\APIControllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Http\Traits\HelperTrait;
use App\Models\Category;


class CategoryController extends Controller
{
    use HelperTrait;


    //Get All categories
    public function categories()
    {
        $content = Category::with('translations')->active()->sort()->get();
        return $this->successResponse(__('text.successTrue'),CategoryResource::collection($content));
    }

}
