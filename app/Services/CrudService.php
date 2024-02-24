<?php

namespace App\Services;

use App\Http\Traits\HelperTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class CrudService
{
    use HelperTrait;


    //INDEX
    public function index($model,$view,$conditions=[],$withCount=[])
    {
        $content = $model::withCount($withCount)->latest();
        if(count($conditions) > 0)
        {
            $content = $content->where($conditions);
        }
        $content = $content->paginate($this->paginate);
        return view('admin_dashboard.'.$view.'.index', compact('content'));
    }

    //CREATE
    public function create($view, $compact=null)
    {
        return view('admin_dashboard.'.$view.'.create',compact('compact'));
    }

    //STORE
    public function store($request,$model,$setData = [])
    {
        DB::beginTransaction();
        try {
            $data = $request->validated();
            if ($request->hasFile('image')) {
                $data['image'] = $this->uploadFileTrait($request, 'image', 'uploads/');
            }
            if ($request->hasFile('icon')) {
                $data['icon'] = $this->uploadFileTrait($request, 'icon', 'uploads/');
            }
            if ($request->hasFile('brochure')) {
                $data['brochure'] = $this->uploadFileTrait($request, 'brochure', 'uploads/');
            }
            isset($data['status']) ? $data['status']=1 : $data['status'] = 0;
            isset($data['home_display']) ? $data['home_display']=1 : $data['home_display'] = 0;
            if(isset($data['slug']))
            {
                $data['slug']=str_replace(' ', '-', $data['slug']);
            }

            if(count($setData) > 0)
            {
               foreach ($setData as $set)
               {
                   $data[$set['key']] = $set['val'];
               }
            }
            $created = $model::create($data);
            if(isset($data['roles']))
            {
                $created->assignRole($data['roles']);
            }
            DB::commit();
            toastr()->success(__('text.insertMsg'), 'success', ['timeOut' => 8000]);
            return redirect()->back();
        } catch (\Throwable $th) {
            DB::rollBack();
            return $th;
        }
    }

    //SHOW
    public function show($model, $view, $compact=null)
    {
        $content = $model;
        return view('admin_dashboard.'.$view.'.show', compact('content','compact'));
    }

    //EDIT
    public function edit($model, $view, $compact=null)
    {
        $content = $model;
        return view('admin_dashboard.'.$view.'.edit', compact('content','compact'));
    }

    //UPDATE
    public function update($request,$model)
    {
        DB::beginTransaction();
        try {
            $data = $request->validated();
            if ($request->hasFile('image')) {
                ($model->image) ? $this->delete_file_before_delete_item(parse_url($model->image)['path']) : '';
                $data['image'] = $this->uploadFileTrait($request, 'image', 'uploads/');
            }
            if ($request->hasFile('icon')) {
                ($model->icon) ? $this->delete_file_before_delete_item(parse_url($model->icon)['path']) : '';
                $data['icon'] = $this->uploadFileTrait($request, 'icon', 'uploads/');
            }
            if ($request->hasFile('brochure')) {
                ($model->brochure) ? $this->delete_file_before_delete_item(parse_url($model->brochure)['path']) : '';
                $data['brochure'] = $this->uploadFileTrait($request, 'brochure', 'uploads/');
            }
            isset($data['status']) ? $data['status']=1 : $data['status'] = 0;
            isset($data['active']) ? $data['active']=1 : $data['active'] = 0;
            isset($data['home_display']) ? $data['home_display']=1 : $data['home_display'] = 0;
            if(isset($data['slug']))
            {
                $data['slug']=str_replace(' ', '-', $data['slug']);
            }
            $model->update($data);

            if(isset($data['roles']))
            {
                DB::table('model_has_roles')->where('model_id',$model->id)->delete();
                $model->assignRole($data['roles']);
            }

            DB::commit();
            toastr()->success(__('text.updateMsg'), 'success', ['timeOut' => 8000]);
            return redirect()->back();
        } catch (\Throwable $th) {
            DB::rollBack();
            return $th;
        }
    }

    //DELETE
    public function destroy($model)
    {
        DB::beginTransaction();
        try {
            ($model->image) ? $this->delete_file_before_delete_item(parse_url($model->image)['path']) : '';
            ($model->icon) ? $this->delete_file_before_delete_item(parse_url($model->icon)['path']) : '';
            ($model->brochure) ? $this->delete_file_before_delete_item(parse_url($model->brochure)['path']) : '';
            $model->delete();
            DB::commit();
            toastr()->success(__('text.deleteMsg'), 'success', ['timeOut' => 8000]);
            return redirect()->back();
        } catch (\Throwable $th) {
            DB::rollBack();
            return $th;
        }
    }



}
