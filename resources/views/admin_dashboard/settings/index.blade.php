@extends('admin_dashboard.layout.master')
@section('Page_Title')  @lang('text.settings-index') | @lang('text.Create')   @endsection


@section('content')

    <div class="row">
        <div class="col-lg-12 mx-auto">
            <div class="breadcrumb d-flex align-items-center justify-content-between">
                <div class="">
                    <a class="text-dark" href="{{route('settings.index')}}"> @lang('text.settings-index')</a>
                    <span class="mx-2">-</span>
                    <strong class="text-primary">@lang('text.Create')</strong>
                </div>
            </div>
            <div class="card">
                <div class="card-body">

                    <div class="row g-3 mt-4">
                        <div class="col-12">
                            <div class="card shadow-none bg-light border">
                                <div class="card-body">
                                    <form class="row g-3" id="validateForm" method="post" enctype="multipart/form-data"
                                          action="{{route('settings.store')}}">
                                        @csrf
                                        <input type="hidden" name="setting_id" value="{{$setting?->id}}">

                                        <div class="col-md-12 mb-3">
                                            <label class="form-label">@lang('text.Email') </label>
                                            <input type="email" value="{{$setting?->email}}" class="form-control" id="email" name="email" placeholder="@lang('text.Email')" />
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label class="form-label">@lang('text.Phone1') </label>
                                            <input type="number" value="{{$setting?->phone1}}" min="0" class="form-control" name="phone1" placeholder="@lang('text.Phone1')" />
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label class="form-label">@lang('text.Phone2') </label>
                                            <input type="number" value="{{$setting?->phone2}}" min="0" class="form-control" name="phone2" placeholder="@lang('text.Phone2')" />
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label class="form-label">@lang('text.Whatsapp') </label>
                                            <input type="number" value="{{$setting?->whatsapp}}" min="0" class="form-control" id="whatsapp" name="whatsapp" placeholder="@lang('text.Whatsapp')" />
                                        </div>
                                        <div class="col-md-12 mb-3">
                                            <label class="form-label">@lang('text.MapIframe') </label>
                                            <input type="text" value="{{$setting?->map}}"  class="form-control" id="map" name="map" placeholder="@lang('text.MapIframe')" />
                                        </div>
                                        <div class="col-md-12 mb-3">
                                            <label class="form-label">@lang('text.Facebook') </label>
                                            <input type="url" value="{{$setting?->facebook}}" class="form-control" id="facebook" name="facebook" placeholder="@lang('text.Facebook')" />
                                        </div>
                                        <div class="col-md-12 mb-3">
                                            <label class="form-label">@lang('text.Twitter') </label>
                                            <input type="url" value="{{$setting?->twitter}}" class="form-control" id="twitter" name="twitter" placeholder="@lang('text.Twitter')" />
                                        </div>
                                        <div class="col-md-12 mb-3">
                                            <label class="form-label">@lang('text.Tiktok') </label>
                                            <input type="url" value="{{$setting?->tiktok}}" class="form-control" id="tiktok" name="tiktok" placeholder="@lang('text.Tiktok')" />
                                        </div>
                                        <div class="col-md-12 mb-3">
                                            <label class="form-label">@lang('text.Instagram') </label>
                                            <input type="url" value="{{$setting?->instagram}}" class="form-control" id="instagram" name="instagram" placeholder="@lang('text.Instagram')" />
                                        </div>
                                        @include('admin_dashboard.inputs.add_btn')
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


