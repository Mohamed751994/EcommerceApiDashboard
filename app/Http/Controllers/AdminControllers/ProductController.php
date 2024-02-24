<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Http\Requests\ProductRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\CategoryTranslation;
use App\Models\Language;

use App\Models\ProductTranslation;
use App\Services\CrudService;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    protected $views = 'products';
    protected $crudService;
    public function __construct(CrudService $crudService)
    {
        $this->crudService = $crudService;
        $this->middleware('permission:products-index', ['only' => ['index']]);
        $this->middleware('permission:products-create', ['only' => ['create','store']]);
        $this->middleware('permission:products-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:products-show', ['only' => ['show']]);
        $this->middleware('permission:products-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
         $content = Product::with(['translations','translationRelation.language'])->latest()->paginate($this->paginate);
        return view('admin_dashboard.'.$this->views.'.index', compact('content'));
    }

    public function create()
    {
        $currentLang = Language::whereCode(currentLanguage())->first();
        $categories = Category::active()->get();
        return view('admin_dashboard.'.$this->views.'.create',compact('currentLang','categories'));
    }

    public function store(ProductRequest $request)
    {
        DB::beginTransaction();
        try {
            $data = $request->validated();
            isset($data['new']) ? $data['new']=1 : $data['new'] = 0;
            isset($data['featured']) ? $data['featured']=1 : $data['featured'] = 0;
            isset($data['offer']) ? $data['offer']=1 : $data['offer'] = 0;
            isset($data['status']) ? $data['status']=1 : $data['status'] = 0;
            if ($request->hasFile('image')) {
                $data['image'] = $this->uploadFileTrait($request, 'image', 'uploads/');
            }
            $created = Product::create($data);
            if($created)
            {
                $translateData = $data;
                $translateData['language_id'] = getLanguageId();
                $translateData['product_id'] = $created->id;
                ProductTranslation::create($translateData);
            }
            DB::commit();
            toastr()->success(__('text.insertMsg'), 'success', ['timeOut' => 8000]);
            return redirect()->back();
        } catch (\Throwable $th) {
            DB::rollBack();
            return $th;
        }
    }



    public function edit(Product $product)
    {
        $content = Product::where('products.id',$product->id)->first();
        $currentLang = Language::whereCode(currentLanguage())->first();
        $categories = Category::active()->get();
        return view('admin_dashboard.'.$this->views.'.edit', compact('content','categories','currentLang'));
    }

    public function update(ProductRequest $request, Product $product)
    {
        DB::beginTransaction();
        try {
            $data = $request->validated();
            isset($data['new']) ? $data['new']=1 : $data['new'] = 0;
            isset($data['featured']) ? $data['featured']=1 : $data['featured'] = 0;
            isset($data['offer']) ? $data['offer']=1 : $data['offer'] = 0;
            isset($data['status']) ? $data['status']=1 : $data['status'] = 0;
            if ($request->hasFile('image')) {
                $data['image'] = $this->uploadFileTrait($request, 'image', 'uploads/');
            }
            $product->update($data);

            if(isset($data['translate_id']))
            {
                ProductTranslation::whereId($data['translate_id'])->update([
                    'name' => $data['name'],
                    'price' => $data['price'],
                    'currency' => $data['currency'],
                    'description' => $data['description'],
                    'benefits' => $data['benefits'],
                ]);
            }
            else
            {
                $translateData = $data;
                $translateData['language_id'] = getLanguageId();
                $translateData['product_id'] = $product->id;
                ProductTranslation::create($translateData);
            }

            DB::commit();
            toastr()->success(__('text.updateMsg'), 'success', ['timeOut' => 8000]);
            return redirect()->back();
        } catch (\Throwable $th) {
            DB::rollBack();
            return $th;
        }
    }

    public function destroy(Product $product)
    {
        DB::beginTransaction();
        try {

            $product->translationRelation()->delete();
            ($product->image) ? $this->delete_file_before_delete_item(parse_url($product->image)['path']) : '';
            $product->delete();
            DB::commit();
            toastr()->success(__('text.deleteMsg'), 'success', ['timeOut' => 8000]);
            return redirect()->back();
        } catch (\Throwable $th) {
            DB::rollBack();
            return $th;
        }
    }
}
