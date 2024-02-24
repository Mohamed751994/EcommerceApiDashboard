<?php

namespace App\Http\Controllers\APIControllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContactRequest;
use App\Http\Requests\OrderRequest;
use App\Http\Traits\HelperTrait;
use App\Models\About;
use App\Models\Blog;
use App\Models\Career;
use App\Models\Category;
use App\Models\Contact;
use App\Models\Faq;
use App\Models\Feature;
use App\Models\Industry;
use App\Models\Language;
use App\Models\News;
use App\Models\Order;
use App\Models\Seo;
use App\Models\Service;
use App\Models\Setting;
use App\Models\Solution;
use App\Models\Team;
use App\Models\Testimonial;
use App\Services\ApiService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;

class CMSController extends Controller
{
    use HelperTrait;

    protected $apiService;
    public function __construct(ApiService $apiService)
    {
        $this->apiService = $apiService;
    }

    public function languages()
    {
        $content = Language::select(['name', 'code', 'icon'])->active()->sort()->get();
        return $this->successResponse(__('text.successTrue'), $content);
    }

    public function settings()
    {
        $content = Setting::first();
        return $this->successResponse(__('text.successTrue'), $content);
    }

    public function contacts(ContactRequest $request)
    {
        Contact::create($request->validated());
        return $this->successResponse(__('text.successMessage'),[]);
    }

    public function gender_list()
    {
        $content = collect([['id'=>0, 'name'=>__('text.female')], ['id'=>1, 'name'=>__('text.male')]]);
        return $this->successResponse(__('text.successTrue'),$content);
    }

}
