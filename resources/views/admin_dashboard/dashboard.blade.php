@extends('admin_dashboard.layout.master')

@section('Page_Title') @lang('text.Home') @endsection

@section('content')


    <div class="row mb-2">
        <div class="col-6 col-lg-3">
            <a href="{{route('customers.index')}}" class="card radius-10 bg-purple">
                <div class="card-body text-center">
                    <div class="widget-icon mx-auto mb-3 bg-white-1 text-white">
                        <i class="bi bi-people-fill"></i>
                    </div>
                    <h3 class="text-white">{{$users}}</h3>
                    <p class="mb-0 text-white">@lang('text.Customers')</p>
                </div>
            </a>
        </div>
        <div class="col-6 col-lg-3">
            <a href="{{route('categories.index')}}" class="card radius-10 bg-bronze">
                <div class="card-body text-center">
                    <div class="widget-icon mx-auto mb-3 bg-white-1 text-white">
                        <i class="lni lni-car"></i>
                    </div>
                    <h3 class="text-white">{{$categories}}</h3>
                    <p class="mb-0 text-white">@lang('text.Categories')</p>
                </div>
            </a>
        </div>
        <div class="col-6 col-lg-3">
            <a href="{{route('products.index')}}" class="card radius-10 bg-orange">
                <div class="card-body text-center">
                    <div class="widget-icon mx-auto mb-3 bg-white-1 text-white">
                        <i class="lni lni-car"></i>
                    </div>
                    <h3 class="text-white">{{$products}}</h3>
                    <p class="mb-0 text-white">@lang('text.Products')</p>
                </div>
            </a>
        </div>
        <div class="col-6 col-lg-3">
            <a href="{{route('orders.index')}}" class="card radius-10 bg-success">
                <div class="card-body text-center">
                    <div class="widget-icon mx-auto mb-3 bg-white-1 text-white">
                        <i class="lni lni-car"></i>
                    </div>
                    <h3 class="text-white">{{$orders}}</h3>
                    <p class="mb-0 text-white">@lang('text.Orders')</p>
                </div>
            </a>
        </div>

    </div>


    <div class="row mb-5">
        <div class="col-12 col-lg-6 d-flex">
            <div class="card rounded-4 w-100">
                <div class="card-header bg-transparent border-0">
                    <div class="row g-3 align-items-center">
                        <div class="col">
                            <h6 class="mb-0 mt-3">@lang('text.mostProducts')</h6>
                        </div>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="best-product p-2 mb-3">
                        @forelse($mostProducts as $key => $val)
                            <div class="best-product-item">
                                <a href="{{route('products.edit', $val->id)}}" class="d-flex align-items-center gap-3">
                                    <div class="product-box border">
                                        <img src="{{$val->image}}" alt="">
                                    </div>
                                    <div class="product-info flex-grow-1">
                                        <div class="progress-wrapper">
                                            <div class="progress" style="height: 5px;">
                                                <div class="progress-bar bg-success" role="progressbar" @if($key == 0) style="width: 80%;"
                                                     @elseif($key ==1)  style="width: 70%;" @elseif($key == 2)  style="width: 60%;"
                                                     @elseif($key == 3)  style="width: 50%;"
                                                     @elseif($key == 4)  style="width: 40%;" @elseif($key == 5)  style="width: 30%;" @endif></div>
                                            </div>
                                        </div>
                                        <p class="product-name mb-0 mt-2 fs-6">  {{translateColumn($val,'name')}}</p>
                                    </div>
                                </a>
                            </div>
                        @empty
                            <strong>@lang('text.no_data')</strong>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-6  d-flex">
            <div class="card radius-10 w-100">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <h6 class="mb-0 mt-3">@lang('text.latest_5_orders')</h6>
                    </div>
                    <div class="table-responsive mt-2">
                        <table class="table align-middle mb-0">
                            <thead class="table-light">
                            <tr>
                                <th>@lang('text.orderID')</th>
                                <th>@lang('text.OrderDate')</th>
                                <th>@lang('text.Name')</th>
                                <th>@lang('text.Action')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($latest_5_orders as $order)
                                <tr>
                                    <td>{{$order->orderID}}</td>
                                    <td>{{ date('Y-m-d H:i A', strtotime($order->created_at)) }}</td>
                                    <td>{{$order->user_name}}</td>
                                    <td>
                                        <div class="d-flex align-items-center gap-3 fs-6">
                                            <a href="{{route('orders.show', $order->id)}}" class="text-primary" data-bs-toggle="tooltip" data-bs-placement="bottom"
                                               title="@lang('text.Show')"><i class="bi bi-eye-fill"></i></a></div>
                                    </td>
                                </tr>
                            @empty
                                <tr class="text-center">
                                    <td colspan="4"><p>@lang('text.no_data') </p></td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>



@endsection

@push('scripts')

@endpush
