<?php

namespace App\Http\Controllers\AdminControllers;
use App\Models\Menu;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Permission;

class MenuController extends Controller
{

    public function index()
    {
        $content = Menu::with('children')->whereType('parent')->orderBy('sort','asc')->orderBy('name','asc')->get();
        return view('admin_dashboard.menus.index',compact('content'));
    }

    public function create()
    {
        $parents = Menu::whereType('parent')->pluck('id', 'name');
        return view('admin_dashboard.menus.create',compact('parents'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'type' =>'required',
            'parent_id' =>'nullable',
            'name' =>'required',
            'model_name' =>'required',
            'icon' =>'required' ,
            'route_name' =>'required',
            'sort'=>'required'
        ]);
        $created = Menu::create($data);
        if($created)
        {
            $endPoint = strtolower($created->route_name);
            $controllerName = $created->model_name.'Controller';
            Artisan::call('make:model '. $created->model_name.' -m');
            Artisan::call('make:controller AdminControllers/'.$controllerName);
            $filename = '../routes/admin.php'; // the file to change
            $search = '//Routes'; // the content after which you want to insert new stuff
            $insert = "Route::resource('$endPoint', '$controllerName');"; // your new stuff
            $replace = $search. "\n". $insert;
            file_put_contents($filename, str_replace($search, $replace, file_get_contents($filename)));
            $path = resource_path('views/admin_dashboard/'.$endPoint);
            if(!File::isDirectory($path)){
                File::makeDirectory($path, 0777, true, true);
                File::put($path.'/create.blade.php','');
                File::put($path.'/edit.blade.php','');
                File::put($path.'/index.blade.php','');
                File::put($path.'/show.blade.php','');
            }

            $permissions = [
                $endPoint.'-index',
                $endPoint.'-create',
                $endPoint.'-edit',
                $endPoint.'-show',
                $endPoint.'-delete',
            ];
            foreach ($permissions as $permission) {
                Permission::create(['name' => $permission]);
            }
        }
        return redirect()->back();
    }



    public function edit(Menu $menu)
    {
        $parents = Menu::whereType('parent')->pluck('id', 'name');
        $content = $menu;
        return view('admin_dashboard.menus.edit',compact('content','parents'));
    }

    public function update(Request $request, Menu $menu)
    {
        $data = $request->validate([
            'type' =>'required',
            'parent_id' =>'nullable',
            'name' =>'required',
            'model_name' =>'required',
            'icon' =>'required' ,
            'route_name' =>'required',
            'sort'=>'required'
        ]);
        $menu->update($data);
        return redirect()->back();
    }


}
