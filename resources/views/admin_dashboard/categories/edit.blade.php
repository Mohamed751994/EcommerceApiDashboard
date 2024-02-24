@extends('admin_dashboard.layout.master')
@section('Page_Title')   @lang('text.categories-index') | @lang('text.Edit')   @endsection


@section('content')

    <div class="row">
        <div class="col-lg-12 mx-auto">
            <div class="breadcrumb d-flex align-items-center justify-content-between">
                <div class="">
                    <a class="text-dark" href="{{route('categories.index')}}">@lang('text.categories-index')</a>
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
                                          action="{{route('categories.update', $content->id)}}">
                                        @method('put')
                                        @csrf


                                        <div class="col-md-12 mt-3">
                                            <label class="form-label">
                                                @lang('text.Name')
                                                <span class="mx-3"></span>
                                                <img src="{{$currentLang?->icon}}" width="20px">
                                            </label>
                                            <input type="hidden"  name="translate_id" value="{{translateColumn($content,'id')}}">
                                            <input type="text" name="name" value="{{translateColumn($content,'name')}}" class="form-control" placeholder="@lang('text.Name')">
                                        </div>

                                        <div class="row align-items-center justify-content-start">
                                                <div class="col-md-4 mt-3">
                                                    <label class="form-label"> @lang('text.Sort')</label>
                                                    <input type="number" min="0" value="{{$content->sort}}" name="sort" class="form-control" placeholder="@lang('text.Sort')">
                                                </div>

                                                <div class="col-md-4 mt-3">
                                                    <label class="form-check-label" for="flexSwitchCheckChecked">@lang('text.Status')</label>
                                                    <div class="form-check form-switch mt-2">
                                                        <input class="form-check-input customSliderCheckbox" type="checkbox"
                                                               name="status" id="flexSwitchCheckChecked" @if($content->status == 1) checked="" value="1" @else value="0" @endif  >
                                                    </div>
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
                    'sort' : {
                        required:true
                    }

                },
                messages: {
                    'sort' : {
                        required:"@lang('text.required')",
                    }

                },
            });
        });

    </script>

@endpush

