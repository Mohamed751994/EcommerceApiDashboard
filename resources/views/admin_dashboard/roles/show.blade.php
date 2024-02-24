@extends('admin_dashboard.layout.master')
@section('Page_Title')   الأدوار والصلاحيات | عرض   @endsection


@section('content')

    <div class="row">
        <div class="col-lg-12 mx-auto">
            <div class="breadcrumb d-flex align-items-center justify-content-between">
                <div class="">
                    <a class="text-dark" href="{{route('roles.index')}}">الأدوار والصلاحيات</a>
                    <span class="mx-2">-</span>
                    <strong class="text-primary">عرض</strong>
                </div>
            </div>
            <div class="card">
                <div class="card-body">

                    <div class="row g-3 mt-4">
                        <div class="col-12">
                            <div class="card shadow-none bg-light border">
                                <div class="card-body">
                                   <h4>{{$content->name}}</h4>
                                    <ul class="list-unstyled">
                                        @if(!empty($rolePermissions))
                                            @foreach($rolePermissions as $v)
                                                <li class="badge text-light-success text-bg-success">{{ $v->name }},</li>
                                            @endforeach
                                        @endif
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
