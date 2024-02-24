<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Services\CrudService;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    protected $views = 'contacts';
    protected $crudService;
    public function __construct(CrudService $crudService)
    {
        $this->crudService = $crudService;
        $this->middleware('permission:contacts-index', ['only' => ['index']]);
        $this->middleware('permission:contacts-create', ['only' => ['create','store']]);
        $this->middleware('permission:contacts-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:contacts-show', ['only' => ['show']]);
        $this->middleware('permission:contacts-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        return $this->crudService->index(Contact::class,$this->views);
    }

    public function show(Contact $contact)
    {
        return $this->crudService->show($contact,$this->views);
    }

    public function destroy(Contact $contact)
    {
        return $this->crudService->destroy($contact);
    }
}
