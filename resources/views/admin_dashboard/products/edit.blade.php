@extends('admin_dashboard.layout.master')
@section('Page_Title')   @lang('text.products-index') | @lang('text.Edit')   @endsection


@section('content')

    <div class="row">
        <div class="col-lg-12 mx-auto">
            <div class="breadcrumb d-flex align-items-center justify-content-between">
                <div class="">
                    <a class="text-dark" href="{{route('products.index')}}">@lang('text.products-index')</a>
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
                                          action="{{route('products.update', $content->id)}}">
                                        @method('put')
                                        @csrf
                                        <input type="hidden" value="{{translateColumn($content,'id')}}" name="translate_id">

                                        <div class="col-md-12 mt-3">
                                            <label class="form-label">
                                                @lang('text.categories-index')  <span class="text-danger mx-1">*</span>
                                            </label>
                                            <select class="form-select form-control" required name="category_id">
                                                <option value="">@lang('text.Choose') @lang('text.Category')</option>
                                                @foreach($categories as $category)
                                                    <option @selected($category->id == $content->category_id) value="{{$category->id}}">{{ translateColumn($category,'name')}}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="uploadAndPreviewImage align-items-center row">
                                                <div class="col-md-8">
                                                    <label class="form-label"> @lang('text.Image')  <small class="text-danger">@lang('text.imageMimes') - @lang('text.imageMax')</small> </label>
                                                    <input type="file" id="image"  name="image" class="form-control">
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="preview-image text-center">
                                                        <img src="{{$content->image ? $content->image : asset('admin_dashboard/assets/images/no_image.png')}}" width="100%">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="col-md-12 mt-3">
                                            <label class="form-label d-flex align-items-center">
                                                @lang('text.Name')  <span class="text-danger mx-1">*</span>
                                                <span class="mx-3"></span>
                                                <img src="{{$currentLang?->icon}}" width="20px">
                                            </label>
                                            <input type="text" required name="name" value="{{translateColumn($content,'name')}}" class="form-control" placeholder="@lang('text.Name')">
                                        </div>



                                        <div class="col-md-6 mt-3">
                                            <label class="form-label d-flex align-items-center">
                                                @lang('text.Price')  <span class="text-danger mx-1">*</span>
                                                <span class="mx-3"></span>
                                                <img src="{{$currentLang?->icon}}" width="20px">
                                            </label>
                                            <input type="number" min="0" required name="price" value="{{translateColumn($content,'price')}}" class="form-control" placeholder="0.00">
                                        </div>
                                        <div class="col-md-2 mt-3">
                                            <label class="form-label d-flex align-items-center">
                                                @lang('text.Currency')  <span class="text-danger mx-1">*</span>
                                                <span class="mx-3"></span>
                                                <img src="{{$currentLang?->icon}}" width="20px">
                                            </label>
                                            <input type="text"  onkeydown="return false;" name="currency" value="{{$currentLang?->currency}}" class="form-control" placeholder="@lang('text.Currency')">
                                        </div>

                                        <div class="col-md-6 mt-3">
                                            <label class="form-label d-flex align-items-center">
                                                @lang('text.Weight')
                                            </label>
                                            <input type="number" min="0"  name="weight" class="form-control" value="{{$content->weight}}" placeholder="@lang('text.Weight')">
                                        </div>
                                        <div class="col-md-6 mt-3">
                                            <label class="form-label d-flex align-items-center">
                                                @lang('text.Size')
                                                <span class="mx-3"></span>
                                                <img src="{{$currentLang?->icon}}" width="20px">
                                            </label>
                                            <input type="text"  name="size" class="form-control"  value="{{translateColumn($content,'size')}}" placeholder="@lang('text.Size')">
                                        </div>

                                        <div class="col-md-6 mt-3">
                                            <label class="form-label d-flex align-items-center">
                                                @lang('text.Description') <span class="text-danger mx-1">*</span>
                                                <span class="mx-3"></span>
                                                <img src="{{$currentLang?->icon}}" width="20px">
                                            </label>
                                            <textarea rows="3" cols="3" name="description" class="form-control" required>{{translateColumn($content,'description')}}</textarea>
                                        </div>
                                        <div class="col-md-6 mt-3">
                                            <label class="form-label d-flex align-items-center">
                                                @lang('text.Benefits')
                                                <span class="mx-3"></span>
                                                <img src="{{$currentLang?->icon}}" width="20px">
                                            </label>
                                            <textarea rows="3" cols="3" name="benefits" class="form-control" >{{translateColumn($content,'benefits')}}</textarea>
                                        </div>

                                        <div class="col-md-12 mt-3">
                                            <label class="form-label">
                                                @lang('text.Quantity') <span class="text-danger mx-1">*</span>
                                            </label>
                                            <input type="number" min="0" required value="{{$content->quantity}}"  name="quantity" class="form-control" placeholder="@lang('text.Quantity')">
                                        </div>

                                        <div class="col-md-2 mt-3">
                                            <label class="form-label">
                                                @lang('text.Calories')
                                            </label>
                                            <input type="number" min="0" value="{{$content->calories}}"  name="calories" class="form-control" placeholder="0">
                                        </div>
                                        <div class="col-md-2 mt-3">
                                            <label class="form-label">
                                                @lang('text.Carbohydrates')
                                            </label>
                                            <input type="number" min="0" value="{{$content->carbohydrates}}"  name="carbohydrates" class="form-control" placeholder="0">
                                        </div>
                                        <div class="col-md-2 mt-3">
                                            <label class="form-label">
                                                @lang('text.Fiber')
                                            </label>
                                            <input type="number" min="0" value="{{$content->fiber}}"  name="fiber" class="form-control" placeholder="0">
                                        </div>

                                        <div class="col-md-2 mt-3">
                                            <label class="form-label">
                                                @lang('text.Cholesterol')
                                            </label>
                                            <input type="number" min="0" value="{{$content->cholesterol}}"  name="cholesterol" class="form-control" placeholder="0">
                                        </div>
                                        <div class="col-md-2 mt-3">
                                            <label class="form-label">
                                                @lang('text.Sugar')
                                            </label>
                                            <input type="number" min="0" value="{{$content->sugar}}"  name="sugar" class="form-control" placeholder="0">
                                        </div>
                                        <div class="col-md-2 mt-3">
                                            <label class="form-label">
                                                @lang('text.Fats')
                                            </label>
                                            <input type="number" min="0" value="{{$content->fats}}" name="fats" class="form-control" placeholder="0">
                                        </div>


                                        <div class="col-md-4 mt-3">
                                            <label class="form-check-label" for="flexSwitchCheckChecked_new">@lang('text.NewProduct')</label>
                                            <div class="form-check form-switch mt-2">
                                                <input class="form-check-input customSliderCheckbox" type="checkbox"
                                                       name="new" @if($content->new == 1) checked="" value="1" @else value="0" @endif  id="flexSwitchCheckChecked_new">
                                            </div>
                                        </div>

                                        <div class="col-md-4 mt-3">
                                            <label class="form-check-label" for="flexSwitchCheckChecked_featured">@lang('text.Featured')</label>
                                            <div class="form-check form-switch mt-2">
                                                <input class="form-check-input customSliderCheckbox" type="checkbox"
                                                       name="featured" @if($content->featured == 1) checked="" value="1" @else value="0" @endif  id="flexSwitchCheckChecked_featured">
                                            </div>
                                        </div>

                                        <div class="col-md-4 mt-3">
                                            <label class="form-check-label" for="flexSwitchCheckChecked_offer">@lang('text.OfferProduct')</label>
                                            <div class="form-check form-switch mt-2">
                                                <input class="form-check-input customSliderCheckbox" type="checkbox"
                                                       name="offer" @if($content->offer == 1) checked="" value="1" @else value="0" @endif  id="flexSwitchCheckChecked_offer">
                                            </div>
                                        </div>


                                        <div class="col-md-6 mt-3">
                                            <label class="form-label">@lang('text.Sort')</label>
                                            <input type="number" min="0" value="{{$content->sort}}" name="sort" required class="form-control" placeholder="@lang('text.Sort')">
                                        </div>
                                        <div class="col-md-12 mt-3">
                                            <label class="form-check-label" for="flexSwitchCheckChecked">@lang('text.Status')</label>
                                            <div class="form-check form-switch mt-2">
                                                <input class="form-check-input customSliderCheckbox" type="checkbox"
                                                       name="status" @if($content->status == 1) checked="" value="1" @else value="0" @endif  id="flexSwitchCheckChecked" checked="">
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

            //Validation
            $("#validateForm").validate({
                rules: {
                    'name' : {
                        required:true
                    },
                    'description' : {
                        required:true
                    },
                    'quantity' : {
                        required:true
                    },
                    'category_id' : {
                        required:true
                    },
                    'price' : {
                        required:true
                    },
                    'currency' : {
                        required:true
                    }

                },
                messages: {
                    'name' : {
                        required:"@lang('text.required')",
                    },

                    'description' : {
                        required:"@lang('text.required')",
                    },
                    'quantity' : {
                        required:"@lang('text.required')",
                    },
                    'category_id' : {
                        required:"@lang('text.required')",
                    },
                    'price' : {
                        required:"@lang('text.required')",
                    },
                    'currency' : {
                        required:"@lang('text.required')",
                    }

                },
            });
            //End Validation


            //PreviewImage
            if (window.File && window.FileList && window.FileReader) {
                $("#image").on("change", function(e) {
                    var files = e.target.files,
                        filesLength = files.length;
                    for (var i = 0; i < filesLength; i++) {
                        var f = files[i]
                        var fileReader = new FileReader();
                        fileReader.onload = (function(e) {
                            var file = e.target;
                            $('.preview-image img').attr('src', e.target.result);
                        });
                        fileReader.readAsDataURL(f);
                    }
                });
            } else {

            }




        });

    </script>




@endpush

