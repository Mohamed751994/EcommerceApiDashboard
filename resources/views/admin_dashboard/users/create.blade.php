@extends('admin_dashboard.layout.master')
@section('Page_Title')   @lang('text.'.\Request::segment(2).'-index') | @lang('text.Create')   @endsection


@section('content')

    <div class="row">
        <div class="col-lg-12 mx-auto">
            <div class="breadcrumb d-flex align-items-center justify-content-between">
                <div class="">
                    <a class="text-dark" href="{{route('users.index')}}">@lang('text.users-index')</a>
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
                                          action="{{route('users.store')}}">
                                        @csrf

                                        <div class="col-12 mb-3">
                                            <div class="form-group">
                                                <label for="name"> @lang('text.Name') <span class="text-danger">*</span> </label>
                                                <input type="text" name="name" id="name" class="form-control" required  placeholder="@lang('text.Name') ">
                                            </div>
                                        </div>
                                        <div class="col-12 mb-3">
                                            <div class="form-group">
                                                <label for="email"> @lang('text.Email')  <span class="text-danger">*</span> </label>
                                                <input type="email" name="email" id="email" class="form-control" required  placeholder="@lang('text.Email') ">
                                            </div>
                                        </div>
                                        <div class="col-12 mb-3">
                                            <div class="form-group">
                                                <label for="password"> @lang('text.Password')  <span class="text-danger">*</span> </label>
                                                <input type="password" name="password" id="password" class="form-control" required  placeholder="@lang('text.Password') ">
                                            </div>
                                        </div>

                                        <div class="col-12 mb-3">
                                            <div class="form-group">
                                                <label for="password"> @lang('text.roles-index')  <span class="text-danger">*</span> </label>
                                                <select class="form-control form-select my-3" name="roles[]">
                                                    <option>@lang('text.roles-index')</option>
                                                    @foreach($compact['roles'] as $key => $val)
                                                        <option value="{{$key}}">{{$val}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
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

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js" integrity="sha512-rstIgDs0xPgmG6RX1Aba4KV5cWJbAMcvRCVmglpam9SoHZiUCyQVDdH2LPlxoHtrv17XWblE/V/PP+Tr04hbtA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>

        $(document).ready(function () {
            $("#validateForm").validate({
                rules: {

                     'name': {
                         required: true,
                     },
                    'email': {
                        required: true,
                        email:true
                    },
                    'password': {
                        required: true,
                    },
                    'roles[]': {
                        required: true,
                    },


                },
                messages: {

                    'name': {
                        required: "@lang('text.required')",
                    },
                    'email': {
                        required: "@lang('text.required')",
                        email: "@lang('text.emailValid')",
                    },
                    'password': {
                        required: "@lang('text.required')",
                    },
                    'roles[]': {
                        required: "@lang('text.required')",
                    },


                }
            });
        });
    </script>



@endpush
