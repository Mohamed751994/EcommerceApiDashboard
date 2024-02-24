@extends('admin_dashboard.layout.master')
@section('Page_Title')   @lang('text.orders-index') | @lang('text.Edit')   @endsection



@section('content')

    <div class="row">



        <div class="col-lg-12 mx-auto">
            <div class="breadcrumb d-flex align-items-center justify-content-between">
                <div class="">
                    <a class="text-dark" href="{{route('orders.index')}}">@lang('text.orders-index')</a>
                    <span class="mx-2">-</span>
                    <strong class="text-primary">@lang('text.Edit') </strong>
                </div>
            </div>
            <div class="card">
                <div class="card-body">

                    <div class="row g-3 mt-4">

                        <div class="col-sm-6">
                            <div class="invoice-id">
                                <div class="info">
                                    <strong class="mb-1">@lang('text.invoiceNumber') : <span class="">{{$content->orderID}}</span></strong><br />
                                    <strong class="mb-0">@lang('text.invoiceDate') : <span class="">{{ date('d-m-Y', strtotime($content->created_at))}}</span></strong>
                                </div>
                                <h2 class="name">{{$content->user_name}}</h2>
                                <p class="invo-addr-1">
                                    {{$content->user_email}} <br/>
                                    {{$content->user_phone}} <br />
                                    @if($content->company_name) {{$content->company_name}} <br /> @endif
                                    {{$content->user_address}}, {{$content->user_city}} <br/>
                                </p>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <form class="form" method="post" action="{{route('orders.update', $content->id)}}" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="status">@lang('text.Status') </label>
                                    <select class="form-control form-select" name="status" required>
                                        <option value="0" @selected($content->getRawOriginal('status') == 0)>@lang('text.pending')</option>
                                        <option value="1" @selected($content->getRawOriginal('status') == 1)>@lang('text.payment_pending')</option>
                                        <option value="2" @selected($content->getRawOriginal('status') == 2)>@lang('text.shipping')</option>
                                        <option value="3" @selected($content->getRawOriginal('status') == 3)>@lang('text.approved')</option>
                                        <option value="4" @selected($content->getRawOriginal('status') == 4)>@lang('text.cancelled')</option>
                                        <option value="5" @selected($content->getRawOriginal('status') == 5)>@lang('text.rejected')</option>
                                    </select>
                                </div>
                               @include('admin_dashboard.inputs.edit_btn')
                            </form>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-hover mb-0 table-striped invoice-table">
                                <thead class="bg-active">
                                <tr class="tr">
                                    <th>#</th>
                                    <th>@lang('text.Name')</th>
                                    <th>@lang('text.Price')</th>
                                    <th>@lang('text.QtyRequire')</th>
                                    <th>@lang('text.totalPrice')</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($content->details as $detail)
                                    <tr class="tr">
                                        <td><strong>{{$detail->id}}</strong> </td>
                                        <td>{{$detail->product_name}}</td>
                                        <td>{{number_format($detail->product_price)}} <span class="mx-2">{{$detail->product_currency}}</span></td>
                                        <td>{{$detail->product_qty}}</td>
                                        <td>{{number_format($detail->price_x_qty)}} <span class="mx-2">{{$detail->product_currency}}</span></td>
                                    </tr>
                                @endforeach
                                <tr class="tableFooter">
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td class="td1">@lang('text.totalPriceForInvoice')</td>
                                    <td class="td2">{{(number_format($content->details?->sum('price_x_qty')))}} <span class="mx-2">{{$content->details[0]?->product_currency}}</span></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>

                        @if($content->notes)
                            <div class="col-lg-12">
                                <div class="terms-conditions mb-30">
                                    <p><strong class="mx-2">@lang('text.customerNotes') : </strong>{{$content->notes}}</p>
                                </div>
                            </div>
                        @endif
                    </div><!--end row-->
                </div>
            </div>
        </div>
    </div>

@endsection
