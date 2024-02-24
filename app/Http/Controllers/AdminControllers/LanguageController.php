<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\LanguageRequest;
use App\Models\Language;
use App\Services\CrudService;
use Illuminate\Http\Request;

class LanguageController extends Controller
{
    protected $views = 'languages';
    protected $crudService;
    public function __construct(CrudService $crudService)
    {
        $this->crudService = $crudService;
        $this->middleware('permission:languages-index', ['only' => ['index']]);
        $this->middleware('permission:languages-create', ['only' => ['create','store']]);
        $this->middleware('permission:languages-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:languages-show', ['only' => ['show']]);
        $this->middleware('permission:languages-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        return $this->crudService->index(Language::class,$this->views);
    }

    public function create()
    {
        return $this->crudService->create($this->views);
    }

    public function store(LanguageRequest $request)
    {
        return $this->crudService->store($request,Language::class);
    }

    public function show(Language $language)
    {
        return $this->crudService->show($language,$this->views);
    }

    public function edit(Language $language)
    {
        return $this->crudService->edit($language,$this->views);
    }

    public function update(LanguageRequest $request, Language $language)
    {
        return $this->crudService->update($request,$language);
    }

    public function destroy(Language $language)
    {
        return $this->crudService->destroy($language);
    }
}
