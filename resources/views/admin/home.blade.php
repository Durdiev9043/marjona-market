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
            <h1>Dashboard</h1>

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
                            <h5 class="card-title">Buyurmalar tarixi</span></h5>

                            <table class="table table-borderless datatable">
                                <thead>
                                <tr>
{{--                                    <th scope="col">#</th>--}}
                                    <th scope="col">№</th>
                                    <th scope="col">Buyurmachi</th>
                                    <th scope="col">Narxi</th>
                                    <th scope="col">Mahsulot</th>
                                    <th scope="col">Miqdori</th>
                                    <th scope="col">Holat</th>
                                    <th scope="col">Buyurtma qilinga vaqti</th>
                                    <th scope="col" colspan="2"></th>

                                </tr>
                                </thead>
                                <tbody>

                                @foreach($orders as $order)
                                        <?php
                                        $pri=0;
                                        ?>
                                        @foreach($orderproducts as $orderproduct)
                                            @if($orderproduct->order_id == $order->id)
                                                    <?php
                                                    $pri=$pri+$orderproduct->total_price;
                                                    ?>
                                                <tr>
                                                    <th scope="row"><a href="#">{{$order -> id }}</a></th>
                                                    <td>{{$order ->user->phone }} </td>
                                                    <td>{{$pri }} </td>
                                                    <td>{{$orderproduct->product->name }}  </td>
                                                    <td>
                                                        @if($orderproduct->count == 0)
                                                            {{$orderproduct->miqdor }}
                                                        @else
                                                            {{$orderproduct->count }}
                                                       @endif
                                                    </td>
                                                    <td>{{$order->st[$order->status] }}  </td>
                                                    <td>{{$order->created_at->addMinutes(300)->format('d.m.Y  H:i') }}  </td>


                                                </tr>
                                            @endif
                                        @endforeach

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
