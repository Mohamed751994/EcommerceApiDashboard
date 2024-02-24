@extends('admin_dashboard.layout.master')
@section('Page_Title')  @lang('text.orders-index') @endsection

@include('admin_dashboard.main.styles.indexStyles')

@push('styles')
    <style>
        .statistics
        {
            padding: 20px;
            border-radius: 5px;
            color: #fff;
        }
        .statistics.col1
        {
            background: #3F51B5;
        }
        .statistics.col2
        {
            background: #e91e63;
        }
    </style>
@endpush
@section('content')

    <div class="card">
        <div class="card-body">
            <div class="d-flex align-items-center">
                <h5 class="mb-0"> <i class="bi bi-grid-fill"></i>   @lang('text.orders-index') <small> ({{$content->total()}})</small> </h5>
            </div>



            <div class="filterData">
                <form class="d-flex align-items-center mt-4 mb-3" action="{{\Request::url()}}" method="GET" id="filter">

                        <select class="form-control form-select mx-1" name="lang" onchange="$('#filter').submit();">
                            <option value="">@lang('text.FilterByLanguage') ....</option>
                            @foreach($languages as $lang)
                                <option @selected($lang->id == request('lang')) value="{{$lang->id}}">{{$lang->name}}</option>
                            @endforeach
                        </select>
                </form>
            </div>


            @if(request('lang') && request('lang') != null)
            <!--Stats-->
            <div class="row">
                <div class="col-6">
                    <div class="statistics col1">
                        <h6>@lang('text.totalOrdersLang') ({{$currentLang?->name}}) </h6>
                        <h4>{{$content->total()}}</h4>
                    </div>
                </div>
                <div class="col-6">
                    <div class="statistics col2">
                        <h6>@lang('text.totalAmountOrdersLang') ({{$currentLang?->name}}) </h6>
                        <h4>{{number_format($total_amount)}} <strong class="mx-2">{{$currentLang?->currency}}</strong></h4>
                    </div>
                </div>
            </div>
            @endif

            <!--Table Index-->
            <div class="table-responsive mt-4">
                <table class="table align-middle table-hover">
                    <thead class="table-secondary">
                    <tr>
                        <th>@lang('text.OrderLanguage')</th>
                        <th>@lang('text.orderID')</th>
                        <th>@lang('text.Name')</th>
                        <th>@lang('text.Phone')</th>
                        <th>@lang('text.OrderTotal')</th>
                        <th>@lang('text.OrderDate')</th>
                        <th>@lang('text.Status')</th>
                        <th>@lang('text.Action')</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($content as $key => $con)
                        <tr>
                            <td><img src="{{$con->languageIcon?->icon}}" width="20px" class="mx-2" title="{{$con->languageIcon?->name}}"></td>
                            <td>{{$con->orderID}}</td>
                            <td>{{$con->user_name}}</td>
                            <td>{{$con->user_phone}}</td>
                            <td>
                                <span class="fw-bold text-primary">{{number_format($con->total_amount)}}</span> <strong class="mx-2">{{$con->languageIcon?->currency}}</strong>
                            </td>
                            <td>{{$con->created_at->diffForHumans()}}</td>
                            <td>
                                <span class="badge bg-light-{{$con->status['class']}} text-{{$con->status['class']}}">{{$con->status['status']}}</span>
                            </td>
                            <td>
                                <div class="table-actions d-flex align-items-center gap-3 fs-6">
                                    @can('orders-edit')
                                        <a href="{{route('orders.edit', $con->id)}}" class="text-success" data-bs-toggle="tooltip" data-bs-placement="bottom"
                                           title="@lang('text.Edit')"><i class="bi bi-pencil-fill"></i></a>
                                    @endcan
                                    @can('orders-show')
                                        <a href="{{route('orders.show', $con->id)}}" class="text-warning" data-bs-toggle="tooltip" data-bs-placement="bottom"
                                           title="@lang('text.Show')"><i class="lni lni-eye"></i></a>
                                    @endcan

                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">
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

