<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use App\Models\CategoryTranslation;
use App\Models\Language;
use App\Services\CrudService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    protected $views = 'categories';
    protected $crudService;
    public function __construct(CrudService $crudService)
    {
        $this->crudService = $crudService;
        $this->middleware('permission:categories-index', ['only' => ['index']]);
        $this->middleware('permission:categories-create', ['only' => ['create','store']]);
        $this->middleware('permission:categories-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:categories-show', ['only' => ['show']]);
        $this->middleware('permission:categories-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $content = Category::with(['translations','translationRelation.language'])->paginate($this->paginate);
        return view('admin_dashboard.'.$this->views.'.index', compact('content'));
    }

    public function create()
    {
        $currentLang = Language::whereCode(currentLanguage())->first();
        return view('admin_dashboard.'.$this->views.'.create',compact('currentLang'));
    }

    public function store(CategoryRequest $request)
    {
        DB::beginTransaction();
        try {
            $data = $request->validated();
            isset($data['status']) ? $data['status']=1 : $data['status'] = 0;
            $created = Category::create($data);
            if($created)
            {
                $translateData = $data;
                $translateData['language_id'] = getLanguageId();
                $translateData['category_id'] = $created->id;
                CategoryTranslation::create($translateData);
            }
            DB::commit();
            toastr()->success(__('text.insertMsg'), 'success', ['timeOut' => 8000]);
            return redirect()->back();
        } catch (\Throwable $th) {
            DB::rollBack();
            return $th;
        }
    }



    public function edit(Category $category)
    {
        $content = Category::where('categories.id',$category->id)->first();
        $currentLang = Language::whereCode(currentLanguage())->first();
        return view('admin_dashboard.'.$this->views.'.edit', compact('content','currentLang'));
    }

    public function update(CategoryRequest $request, Category $category)
    {
        DB::beginTransaction();
        try {
            $data = $request->validated();
            isset($data['status']) ? $data['status']=1 : $data['status'] = 0;
            $category->update($data);
            if(isset($data['translate_id']))
            {
                CategoryTranslation::whereId($data['translate_id'])->update([
                    'name' => $data['name'],
                ]);
            }
            else
            {
                $translateData = $data;
                $translateData['language_id'] = getLanguageId();
                $translateData['category_id'] = $category->id;
                CategoryTranslation::create($translateData);
            }

            DB::commit();
            toastr()->success(__('text.updateMsg'), 'success', ['timeOut' => 8000]);
            return redirect()->back();
        } catch (\Throwable $th) {
            DB::rollBack();
            return $th;
        }
    }

    public function destroy(Category $category)
    {
        DB::beginTransaction();
        try {
            $category->translations()->delete();
            $category->delete();
            DB::commit();
            toastr()->success(__('text.deleteMsg'), 'success', ['timeOut' => 8000]);
            return redirect()->back();
        } catch (\Throwable $th) {
            DB::rollBack();
            return $th;
        }
    }
}
