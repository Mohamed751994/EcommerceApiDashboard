<?php

namespace App\Services;

use App\Http\Traits\HelperTrait;
use App\Models\Blog;

class ApiService
{
    use HelperTrait;



    //Public Get ALL Model Data And Single Model Data
    public function getAllRecords($model, $message)
    {
        $content = $model::retrieve()->active()->sort();
        if(request('page') == 'home')
        {
            $content = $content->where('home_display', 1)->limit(\request('limit') ? \request('limit') : 6);
        }
        if($model == Blog::class && (request('category_id')) && !is_null(request('category_id')))
        {
            $content = $content->where('category_id', request('category_id'));
        }
        $content = $content->get();
        return $this->successResponse($message,$content);
    }
    public function getSingleRecord($model, $message, $slug)
    {
        $content = $model::retrieve()->active()->whereSlug($slug)->first();
        return $this->successResponse($message,$content);
    }



}
