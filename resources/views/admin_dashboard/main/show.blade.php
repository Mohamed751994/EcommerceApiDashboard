@extends('admin_dashboard.layout.master')
@section('Page_Title')   {{$title}} | @lang('text.Show')   @endsection


@section('content')

    <div class="row">
        <div class="col-lg-12 mx-auto">
            <div class="breadcrumb d-flex align-items-center justify-content-between">
                <div class="">
                    <a class="text-dark" href="{{route($routeName.'.index')}}">{{$title}}</a>
                    <span class="mx-2">-</span>
                    <strong class="text-primary">@lang('text.Show')</strong>
                </div>
            </div>
            <div class="card">
                <div class="card-body">

                    <div class="row g-3 mt-4">
                        <div class="col-12">
                            <div class="card shadow-none bg-light border">
                                <div class="card-body">
                                    <ul class="list-unstyled">
                                        @foreach($data as $value)
                                            @if(!is_null($value['value']) && $value['index'] == 1)
                                                <li class="mb-4 alert alert-light">
                                                    {!! $value['name_ar'] !!} :
                                                    @if($value['type'] == 'file')
                                                        <a href="{{$value['value']}}" download class="btn btn-sm btn-success">
                                                            <strong>@lang('text.Download')</strong>
                                                        </a>
                                                    @else
                                                        <strong>{!! $value['value'] !!}</strong>
                                                    @endif
                                                </li>
                                            @endif
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div><!--end row-->
                </div>
            </div>
        </div>
    </div>

@endsection

