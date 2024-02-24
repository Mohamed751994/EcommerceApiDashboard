@extends('admin_dashboard.layout.master')
@section('Page_Title')   القائمة | الكل   @endsection


@section('content')

    <div class="row">
        <div class="col-lg-12 mx-auto">
            <div class="card">
                <div class="card-body">

                    <div class="d-flex align-items-center">
                        <h5 class="mb-0"> <i class="bi bi-grid-fill"></i>   قائمة الداشبورد  </h5>
                        <div class="ms-auto position-relative">
                            <a href="{{route('menus.create')}}" class="btnIcon btn btn-outline-primary px-5"><i class="lni lni-circle-plus"></i> إنشاء جديد </a>
                        </div>
                    </div>


                    <div class="row g-3 mt-4">
                        <div class="col-md-8 mx-auto">
                            <div class="card shadow-none bg-light border">
                                <div class="card-body">

                                   <ul class="list-unstyled parentMenu">
                                       @foreach($content as $con)
                                           <li class="@if(count($con->children) <= 0) parent @else parentUp @endif">
                                               @if(count($con->children) > 0)
                                               <i class="{{$con->icon}} mx-2"></i> {{$con->name}}
                                                   <ul class="list-unstyled">
                                                       <li class="child">
                                                           <strong><i class="{{$con->icon}} mx-2"></i> {{$con->name}}</strong>
                                                           <div>
                                                               <a href="{{route('menus.edit', $con->id)}}" class="text-warning" data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                                  title="تعديل"><i class="bi bi-pencil-fill"></i></a>
                                                           </div>
                                                       </li>
                                                       @foreach($con->children as $child)
                                                           <li class="child">
                                                              <strong> <i class="{{$con->icon}} mx-2"></i> {{$child->name}}</strong>
                                                               <div>
                                                                   <a href="{{route('menus.edit', $child->id)}}" class="text-warning" data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                                      title="تعديل"><i class="bi bi-pencil-fill"></i></a>
                                                               </div>
                                                           </li>
                                                       @endforeach
                                                   </ul>
                                               @else
                                                   <strong><i class="{{$con->icon}} mx-2"></i> {{$con->name}}</strong>
                                                   <div>
                                                       <a href="{{route('menus.edit', $con->id)}}" class="text-warning" data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                          title="تعديل"><i class="bi bi-pencil-fill"></i></a>
                                                   </div>
                                               @endif
                                           </li>
                                       @endforeach
                                   </ul>
                                </div>
                            </div>
                        </div>
                    </div><!--end row-->
                </div>
            </div>
        </div>
    </div>



@endsection

