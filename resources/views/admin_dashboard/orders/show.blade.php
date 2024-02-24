@extends('admin_dashboard.layout.master')
@section('Page_Title')   @lang('text.orders-index') | @lang('text.Show')   @endsection

@push('styles')
    <!-- Custom Stylesheet -->
    <link type="text/css" rel="stylesheet" href="{{asset('admin_dashboard/invoice/assets/css/style.css')}}">
@endpush

@section('content')

    <div class="row">
        <div class="col-lg-12 mx-auto">
            <div class="breadcrumb d-flex align-items-center justify-content-between">
                <div class="">
                    <a class="text-dark" href="{{route('orders.index')}}">@lang('text.orders-index')</a>
                    <span class="mx-2">-</span>
                    <strong class="text-primary">@lang('text.Show') </strong>
                </div>
            </div>
            <div class="card">
                <div class="card-body">

                    <div class="row g-3 mt-4">
                        <div class="col-12">
                            <div class="card shadow-none bg-light border">
                                <div class="card-body">
                                    <!--Invoice Details Here-->
                                    <div class="invoice-1 invoice-content" dir="{{currentLanguage() == 'ar' ? 'rtl' : 'ltr'}}">
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="invoice-inner clearfix">
                                                        <div class="invoice-info clearfix" id="invoice_wrapper">
                                                            <div class="invoice-headar">
                                                                <div class="row">
                                                                    <div class="col-sm-6">
                                                                        <div class="invoice-logo">
                                                                            <!-- logo started -->
                                                                            <div class="logo">
                                                                                <img src="{{ asset('admin_dashboard/assets/images/logo.png')}}" alt="logo">
                                                                            </div>
                                                                            <!-- logo ended -->
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <div class="invoice-id">
                                                                            <div class="info text-white">
                                                                                <h1 class="inv-header-1 text-white">@lang('text.Invoice')</h1>
                                                                                <strong class="mb-1">@lang('text.invoiceNumber') : <span class="primary-color">{{$content->orderID}}</span></strong><br />
                                                                                <strong class="mb-0">@lang('text.invoiceDate') : <span class="primary-color">{{ date('d-m-Y', strtotime($content->created_at))}}</span></strong>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="invoice-top">
                                                                <div class="row">
                                                                    <div class="col-sm-6">
                                                                        <div class="invoice-number mb-30">
                                                                            <h4 class="inv-title-1">@lang('text.invoiceTo')</h4>
                                                                            <h2 class="name">{{$content->user_name}}</h2>
                                                                            <p class="invo-addr-1">
                                                                                {{$content->user_email}} <br/>
                                                                                {{$content->user_phone}} <br />
                                                                               @if($content->company_name) {{$content->company_name}} <br /> @endif
                                                                                {{$content->user_address}}, {{$content->user_city}} <br/>
                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="invoice-center">
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
                                                            </div>
                                                            <div class="invoice-bottom">
                                                                <div class="row">
                                                                    @if($content->notes)
                                                                    <div class="col-lg-12">
                                                                        <div class="terms-conditions mb-30">
                                                                            <p><strong class="mx-2">@lang('text.customerNotes') : </strong>{{$content->notes}}</p>
                                                                        </div>
                                                                    </div>
                                                                    @endif
                                                                    <div class="col-lg-12">
                                                                        <div class="terms-conditions text-center mb-30">
                                                                            <p>@lang('text.reservedText')</p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="invoice-btn-section clearfix d-print-none">
                                                            <a id="print" class="btn btn-lg btn-print">
                                                                <i class="fa fa-print"></i> @lang('text.Print')
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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
    <script src="{{asset('admin_dashboard/invoice/assets/js/jspdf.min.js')}}"></script>
    <script src="{{asset('admin_dashboard/invoice/assets/js/html2canvas.js')}}"></script>
    <script src="{{asset('admin_dashboard/invoice/assets/js/app.js')}}"></script>
    <script src="{{ asset('admin_dashboard/invoice/assets/js/print.js')}}"></script>
    <script>
        $('#print').on('click', function(e){
            e.preventDefault();
            $('.invoice-content').printElement({
            });
        })
    </script>
@endpush
