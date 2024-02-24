@extends('admin_dashboard.layout.master')
@section('Page_Title')  {{$title}} @endsection

@include('admin_dashboard.main.styles.indexStyles')

@section('content')

    <div class="card">
        <div class="card-body">
            <div class="d-flex align-items-center">
                <h5 class="mb-0"> <i class="bi bi-grid-fill"></i>   {{$title}} <small> ({{$content->total()}})</small> </h5>
                @can($routeName.'-create')
                    @if($create)
                    <div class="ms-auto position-relative">
                        <a href="{{route($routeName.'.create')}}" class="btnIcon btn btn-outline-primary px-5"><i class="lni lni-circle-plus"></i> @lang('text.Create') </a>
                    </div>
                    @endif
                @endcan
            </div>
            @if(isset($filter))
                <div class="filterData">
                    <form class="d-flex align-items-center mt-4 mb-3" action="{{\Request::url()}}" method="GET">
                        @foreach($filter as $f)
                            @if($f['input_type'] == 'select')
                            <select class="form-control form-select mx-1" name="{{$f['col']}}">
                                <option value="">@lang('text.FilterBy') {{$f['col_ar']}} ....</option>
                                @foreach($f['data'] as $d)
                                    <option @selected($d['value'] == request($f['col'])) value="{{$d['value']}}">{{$d['name_ar']}}</option>
                                @endforeach
                            </select>
                            @endif
                        @endforeach
                        <button type="submit" class="btn w-100 btn-success">@lang('text.SearchNow')</button>
                    </form>
                </div>
            @endif

            <!--Table Buttons-->
            <div class="row mt-4">
                @can($routeName.'-delete')
                @if($delete)
                <div class="col-md-6">
                    <div class="d-flex justify-content-start align-items-center">
                        <button class="btn btn-sm btn-danger" id="deleteSelected"><i class="mx-1  lni lni-close"></i> @lang('text.SelectedDeleted')</button>
                    </div>
                </div>
                @endif
                @endcan
            </div>

            <!--Table Index-->
            <div class="table-responsive mt-2">
                <table class="table align-middle table-hover">
                    <thead class="table-secondary">
                    <tr>
                        @can($routeName.'-delete')
                        @if($delete)
                        <th>
                            <input type="checkbox" class="form-check-input" id="checkAll">
                        </th>
                        @endif
                        @endcan
                        @foreach($thNames as $key =>$col)
                        <th>{{$key}}</th>
                        @endforeach
                            @if($routeName == 'users')
                                <th>@lang('text.roles-index')</th>
                            @endif
                        <th>@lang('text.Action')</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($content as $con)
                        <tr>
                            @can($routeName.'-delete')
                            @if($delete)
                            <td>
                                <input type="checkbox" class="form-check-input checkAll" name="checkboxes[]" value="{{$con->id}}">
                            </td>
                            @endif
                            @endcan
                            @foreach($thNames as $key =>$col)
                            <td>
                                @if($col == 'image' || $col == 'icon')
                                    <img src="{{ $con->$col }}" class="rounded-circle imageList" alt="">
                                @elseif($col == 'status')
                                    <div class="form-check form-switch">
                                        <input class="form-check-input customSliderCheckbox" type="checkbox"
                                               name="status" onchange="quickChange(this, '{{$model}}', '{{$con->id}}', 'status')" id="flexSwitchCheckChecked" @if($con->$col) value="0" checked="" @else value="1" @endif>
                                    </div>
                                @else
                                {!! $con->$col !!}
                                @endif
                            </td>
                            @endforeach
                                @if($routeName == 'users')
                                    <td>
                                        @if(!empty($con->getRoleNames()))
                                            @foreach($con->getRoleNames() as $v)
                                                <label class="badge text-success bg-light-success">{{ $v }}</label>
                                            @endforeach
                                        @endif
                                    </td>
                                @endif
                            <td>
                                <div class="table-actions d-flex align-items-center gap-3 fs-6">
                                    @can($routeName.'-show')
                                    @if($show)
                                    <a href="{{route($routeName.'.show', $con->id)}}" class="text-primary" data-bs-toggle="tooltip" data-bs-placement="bottom"
                                       title="@lang('text.Show')"><i class="lni lni-eye"></i></a>
                                    @endif
                                    @endcan
                                    @can($routeName.'-edit')
                                    @if($edit)
                                    <a href="{{route($routeName.'.edit', $con->id)}}" class="text-warning" data-bs-toggle="tooltip" data-bs-placement="bottom"
                                       title="@lang('text.Edit')"><i class="bi bi-pencil-fill"></i></a>
                                    @endif
                                    @endcan
                                    @can($routeName.'-delete')
                                    @if($delete)
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
                                                    <form action="{{route($routeName.'.destroy',$con->id)}}" method="POST">
                                                        @method('DELETE')
                                                        @csrf
                                                        <button type="submit" class="btn btn-outline-danger btn-sm" type="button">@lang('text.Yes')</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                    @endcan
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="{{count($thNames)+2}}" class="text-center">
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

@include('admin_dashboard.main.scripts.indexScripts')
