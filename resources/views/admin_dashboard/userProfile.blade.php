@extends('admin_dashboard.layout.master')
@section('Page_Title')   @lang('text.Profile')  | @lang('text.Edit')   @endsection


@section('content')

    <div class="row">
        <div class="col-lg-12 mx-auto">
            <div class="breadcrumb d-flex align-items-center justify-content-between">
            </div>
            <div class="card">
                <div class="card-body">

                    <div class="row g-3 mt-4">
                        <div class="col-12">
                            <div class="card shadow-none bg-light border">
                                <div class="card-body">
                                    <form class="row g-3" id="validateForm" method="post" enctype="multipart/form-data"
                                          action="{{route('admin.updateUserProfile')}}">
                                        @method('put')
                                        @csrf

                                        <div class="col-12 mb-3">
                                            <div class="form-group">
                                                <label for="name"> @lang('text.Name') <span class="text-danger">*</span> </label>
                                                <input type="text" name="name" value="{{auth()->user()->name}}" id="name" class="form-control" required  placeholder=" @lang('text.Name') ">
                                            </div>
                                        </div>
                                        <div class="col-12 mb-3">
                                            <div class="form-group">
                                                <label for="email">  @lang('text.Email')  <span class="text-danger">*</span> </label>
                                                <input type="email" value="{{auth()->user()->email}}" name="email" id="email" class="form-control" required  placeholder="@lang('text.Email')">
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <a href="#" id="togglePassword" class="text-decoration-underline" >@lang('text.changePassword') ?</a>
                                        </div>
                                        <div class="col-12 mb-3 d-none" id="changePassword">
                                            <div class="form-group">
                                                <label for="password"> @lang('text.newPassword')</label>
                                                <input type="text"  name="password" id="password" class="form-control"  placeholder="@lang('text.newPassword') ">
                                            </div>
                                        </div>
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
                    },


                },
                messages: {

                    'name': {
                        required: 'الحقل مطلوب',
                    },
                    'email': {
                        required: 'الحقل مطلوب',
                    },


                }
            });
        });

        $(document).on('click', '#togglePassword', function(){
            $('#changePassword').toggleClass('d-none');
        });

    </script>



@endpush
