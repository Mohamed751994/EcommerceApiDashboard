@extends('admin_dashboard.layout.master')
@section('Page_Title')  @lang('text.categories-index') @endsection

@include('admin_dashboard.main.styles.indexStyles')

@section('content')

    <div class="card">
        <div class="card-body">
            <div class="d-flex align-items-center">
                <h5 class="mb-0"> <i class="bi bi-grid-fill"></i>   @lang('text.categories-index') <small> ({{$content->total()}})</small> </h5>
                @can('categories-create')

                    <div class="ms-auto position-relative">
                        <a href="{{route('categories.create')}}" class="btnIcon btn btn-outline-primary px-5"><i class="lni lni-circle-plus"></i> @lang('text.Create') </a>
                    </div>

                @endcan
            </div>

        <!--Table Buttons-->
            <div class="row mt-4">
                @can('categories-delete')
                        <div class="col-md-6">
                            <div class="d-flex justify-content-start align-items-center">
                                <button class="btn btn-sm btn-danger" id="deleteSelected"><i class="mx-1  lni lni-close"></i> @lang('text.SelectedDeleted')</button>
                            </div>
                        </div>
                @endcan
            </div>

            <!--Table Index-->
            <div class="table-responsive mt-2">
                <table class="table align-middle table-hover">
                    <thead class="table-secondary">
                    <tr>
                        @can('categories-delete')
                                <th>
                                    <input type="checkbox" class="form-check-input" id="checkAll">
                                </th>
                        @endcan
                            <th>@lang('text.Name')</th>
                            <th>@lang('text.Status')</th>
                            <th>@lang('text.ProductTranslatedTo')</th>
                            <th>@lang('text.Action')</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($content as $con)
                        <tr>
                            @can('categories-delete')
                                    <td>
                                        <input type="checkbox" class="form-check-input checkAll" name="checkboxes[]" value="{{$con->id}}">
                                    </td>
                            @endcan
                            <td>
                                {{translateColumn($con,'name')}}
                            </td>
                            <td>
                                <div class="form-check form-switch">
                                    <input class="form-check-input customSliderCheckbox" type="checkbox"
                                           name="status" onchange="quickChange(this, '{{Category::class}}', '{{$con->id}}', 'status')" id="flexSwitchCheckChecked" @if($con->status) value="0" checked="" @else value="1" @endif>
                                </div>
                            </td>
                                <td>
                                    @foreach($con->translationRelation as $lang)
                                        <img src="{{$lang->language?->icon}}" width="20px" class="mx-2" title="{{$lang->language?->name}}">
                                    @endforeach
                                </td>
                            <td>
                                <div class="table-actions d-flex align-items-center gap-3 fs-6">

                                    @can('categories-edit')
                                            <a href="{{route('categories.edit', $con->id)}}" class="text-warning" data-bs-toggle="tooltip" data-bs-placement="bottom"
                                               title="@lang('text.Edit')"><i class="bi bi-pencil-fill"></i></a>
                                    @endcan
                                    @can('categories-delete')
                                            <a href="javascript:;"  data-bs-toggle="modal" data-bs-target="#deleteItem{{$con->id}}" class="text-danger" data-bs-toggle="tooltip"
                                               data-bs-placement="bottom" title="@lang('text.Delete')"><i class="bi bi-trash-fill"></i></a>
                                            <div class="modal fade" id="deleteItem{{$con->id}}" tabindex="-1" aria-labelledby="link{{$con->id}}" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="link{{$con->id}}">@lang('text.AreYouSure')</h5>
                                                            <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button class="btn btn-outline-default btn-sm me-2" type="button" data-bs-dismiss="modal">@lang('text.No')</button>
                                                            <form action="{{route('categories.destroy',$con->id)}}" method="POST">
                                                                @method('DELETE')
                                                                @csrf
                                                                <button type="submit" class="btn btn-outline-danger btn-sm" type="button">@lang('text.Yes')</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                    @endcan
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center">
                                <p>@lang('text.no_data') </p>
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
                <div>
                    {{$content->links()}}
                </div>
            </div>

        </div>
    </div>

@endsection

@push('scripts')
    <script src="{{asset('admin_dashboard/assets/plugins/notifications/js/lobibox.min.js')}}"></script>
    <script src="{{asset('admin_dashboard/assets/plugins/notifications/js/notifications.min.js')}}"></script>
    <script src="{{asset('admin_dashboard/assets/plugins/notifications/js/notification-custom-script.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>

        //Change Status Quickly
        function quickChange(element , item, id, col)
        {
            var val = $(element).val();
            $.ajax({
                url: "{{route('admin.quickChange')}}",
                type: 'post',
                data: {_token: '{{csrf_token()}}', id:id, item:item, val:val, col:col},
                success: function(response) {
                    if(response.success)
                    {
                        if(val === '1')
                        {
                            $(element).attr('value', '0');
                        }
                        else
                        {
                            $(element).attr('value', '1');
                        }
                    }
                },
                error: function (reject) {

                },
            });
        }


        //checkAll
        $(document).on('click', '#checkAll', function(){
            if (this.checked) {
                $(".checkAll").prop("checked", true);
            } else {
                $(".checkAll").prop("checked", false);
            }
        });
        $(document).on('click', '.checkAll', function(){
            var numberOfCheckboxes = $('.checkAll').length;
            var numberOfCheckboxesChecked = $('.checkAll:checked').length;
            if(numberOfCheckboxes === numberOfCheckboxesChecked) {
                $("#checkAll").prop("checked", true);
            } else {
                $("#checkAll").prop("checked", false);
            }
        });


        //deleteSelected
        $(document).on('click','#deleteSelected', function(){
            var numberOfCheckboxesChecked = $('.checkAll:checked').length;
            var valuesOfCheckboxesChecked = $('.checkAll:checked');
            if(numberOfCheckboxesChecked > 0)
            {

                Swal.fire({
                    title: "@lang('text.AreYouSure')",
                    text: "@lang('text.AreYouSure')",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "@lang('text.Yes')",
                    cancelButtonText: "@lang('text.No')"
                }).then((result) => {
                    if (result.isConfirmed) {


                        var Ids = [];
                        $(valuesOfCheckboxesChecked).each(function(key, val){
                            Ids.push(val.value);
                        })
                        $.ajax({
                            url: "{{route('admin.deleteSelectedItems')}}",
                            type: 'post',
                            data: {_token: '{{csrf_token()}}', ids:Ids,model:'{{Category::class}}' },
                            success: function(response) {
                                if(response.success)
                                {
                                    location.reload();
                                }
                            },
                            error: function (reject) {

                            },
                        });



                    }
                });

            }
            else
            {
                Lobibox.notify('error', {
                    pauseDelayOnHover: true,
                    icon: 'bx bx-info-circle',
                    rounded: true,
                    continueDelayOnInactiveTab: false,
                    position: 'top left',
                    size: 'mini',
                    msg: '@lang('text.MustSelectedFirstly')'
                });
            }
        });


    </script>
@endpush

