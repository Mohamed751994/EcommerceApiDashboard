@extends('admin_dashboard.layout.master')
@section('Page_Title')   {{$title}} | @lang('text.Edit')   @endsection


@section('content')

    <div class="row">
        <div class="col-lg-12 mx-auto">
            <div class="breadcrumb d-flex align-items-center justify-content-between">
                <div class="">
                    <a class="text-dark" href="{{route($routeName.'.index')}}">{{$title}}</a>
                    <span class="mx-2">-</span>
                    <strong class="text-primary">@lang('text.Edit') </strong>
                </div>
            </div>
            <div class="card">
                <div class="card-body">

                    <div class="row g-3 mt-4">
                        <div class="col-12">
                            <div class="card shadow-none bg-light border">
                                <div class="card-body">
                                    <form class="row g-3" id="validateForm" method="post" enctype="multipart/form-data"
                                          action="{{route($routeName.'.update', $content->id)}}">
                                        @method('put')
                                        @csrf

                                        @foreach($inputs as $input)
                                            <div class="col-md-12 mb-3">
                                                <label class="form-label"> {{$input['label']}} @if($input['required'] == true) <span class="text-danger">*</span>@endif </label>
                                                @if($input['type'] == 'select')
                                                    <select class="form-select form-control" @if($input['required']==true) required @endif name="{{$input['name'] }}">
                                                        <option value="0"> @lang('text.Choose')  ....</option>
                                                        @foreach($compact[$input['name']] as $key => $val)
                                                            <option @if($key == $input['value']) selected @endif value="{{$key}}">{{$val}}</option>
                                                        @endforeach
                                                    </select>
                                                @elseif($input['type'] == 'textarea')
                                                    <textarea name="{{$input['name']}}" id="{{$input['name']}}" class="form-control ckeditor" @if($input['required']) required @endif>{!! $input['value'] !!}</textarea>
                                                @elseif($input['type'] == 'file')
                                                    <div class="col-md-12">
                                                        <div class="uploadAndPreviewImage align-items-center row">
                                                            <div class="col-md-8">
                                                                <label class="form-label">  @if($input['name'] == 'brochure') <small class="text-danger">(PDF - DOC - DOCX) - 10 MB</small>  @else  <small class="text-danger">@lang('text.imageMimes') - @lang('text.imageMax')</small> @endif </label>
                                                                <input type="{{$input['type']}}" id="{{$input['name']}}" name="{{$input['name']}}" class="form-control" @if($input['required'] == true) required @endif>
                                                            </div>
                                                            @if($input['name'] == 'brochure')
                                                            <div class="col-md-2">
                                                                <div class=" text-center">
                                                                    <a download href="{{($input['value']) ? $input['value'] : ''}}" class="btn btn-sm btn-secondary py-3 w-100">@lang('text.Download') @lang('text.Brochure')</a>
                                                                </div>
                                                            </div>
                                                            @else
                                                            <div class="col-md-2">
                                                                <div class="preview{{$input['name']}} text-center">
                                                                    <img src="{{($input['value']) ? $input['value'] : asset('admin_dashboard/assets/images/no_image.png')}}" width="100%">
                                                                </div>
                                                            </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                @else
                                                    <input type="{{$input['type']}}" value="{{ $input['value'] }}" name="{{$input['name']}}" id="{{$input['name']}}" class="form-control" @if($input['required']) required @endif placeholder=" {{$input['label']}}">
                                                @endif
                                            </div>
                                        @endforeach



                                        @include('admin_dashboard.inputs.edit_status_sort')

                                        @include('admin_dashboard.inputs.edit_btn')
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div><!--end row-->
                </div>
            </div>
        </div>
    </div>

@endsection

@include('admin_dashboard.main.scripts.editScripts')
