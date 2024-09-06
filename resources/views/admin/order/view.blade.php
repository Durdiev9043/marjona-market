@extends('admin.layouts.app')

@section('content')


    <!-- ======= Header ======= -->


    <!-- ======= Sidebar ======= -->


    <main id="main" class="main">
        @if (\Session::has('success'))
            <div class="alert alert-success">
                <ul>
                    <li>{!! \Session::get('success') !!}</li>
                </ul>
            </div>
        @endif
        <div class="pagetitle">
            <h1>Buyurtmalar holati boyicha ma'lumot</h1>

            {{--            <div class="btn-add">--}}
            {{--                <a href="{{ route('patient.create') }}">Be`mor qoshish</a>--}}
            {{--            </div>--}}

        </div><!-- End Page Title -->

        <section class="section dashboard">
            <div class="row">


                <div class="col-12 table_one">
                    <div class="card recent-sales overflow-auto table_one">

                        <div class="filter">
                            <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                <li class="dropdown-header text-start">
                                    <h6>Filter</h6>
                                </li>

                                <li><a class="dropdown-item" href="#">Today</a></li>
                                <li><a class="dropdown-item" href="#">This Month</a></li>
                                <li><a class="dropdown-item" href="#">This Year</a></li>
                            </ul>
                        </div>

                        <div class="card-body">
                            <h5 class="card-title">{{ $order->id }} sonli buyurtma haqida ma'lumot</h5>
                            <h6>Buyurtmachi tel: {{ $order->user->phone }}</h6>
                            <h6>Buyurtmaning umumiy Bahosi: {{ $orderproducts->sum('total_price') }}</h6>
                            <h6>Buyurtmaning manzili: {{ $orderproducts->sum('address_name') }}</h6>

                            <table class="table table-borderless datatable">
                                <thead>
                                <tr>
                                    {{--                                    <th scope="col">#</th>--}}
                                    <th scope="col">№</th>

                                    <th scope="col">Mahsulot</th>

                                    <th scope="col">Narxi</th>
                                    <th scope="col">miqdori</th>
                                    <th scope="col" colspan="2">Amallar</th>
                                    <th scope="col" colspan="2"></th>

                                </tr>
                                </thead>
                                <tbody>
                                @foreach($orderproducts as $orderproduct)
                                    <tr>

                                        <th scope="row"><a href="#">{{$order -> id }}</a></th>


                                <th>


                                                   {{$orderproduct->product->name }}

                                </th>


                                        <th>{{$orderproduct->total_price }} so'm </th>
                                            <th>@if($orderproduct->count == 0)
                                                                 {{$orderproduct->miqdor }} KG
                                           @else
                                                          {{$orderproduct->count }} ta
                                             @endif</th>
                                    <th>
                                        @if($orderproduct->comment)..@else
                                        <form action="{{ route('orderProduct.cancel',$orderproduct ->id) }}" method="POST">
                                            @csrf
                                            <input  type="text" name="comment"  >


                                            <button type="submit" class="btn btn-danger m-1 btn-sm"><span class="btn-label">
                                                                            <i class="fa fa-trash"></i>
                                                                       </span></button>
                                        </form>
                                        @endif
                                            @if($order->type == -1)  Dokon olib ketuvchi @endif
                                </th>
                                        <th>
                                            @if($orderproduct->comment) Bekor qilinish sababi: {{ $orderproduct->comment }}@endif
                                        </th>

                                    </tr>
                                    @endforeach

                                </tbody>
                            </table>

                        </div>

                    </div>
                </div>




            </div>

        </section>

    </main><!-- End #main -->

    <!-- ======= Footer ======= -->


    {{--<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>--}}

    <!-- Vendor JS Files -->





@endsection
