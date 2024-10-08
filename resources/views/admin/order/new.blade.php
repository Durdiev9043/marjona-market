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
                            <h5 class="card-title">Buyurmalar tarixi</h5>

                            <table class="table table-borderless datatable">
                                <thead>
                                <tr>
                                    {{--                                    <th scope="col">#</th>--}}
                                    <th scope="col">№</th>
                                    <th scope="col">Buyurmachi</th>
                                    <th scope="col">Mahsulot</th>

                                    <th scope="col">Narxi</th>
                                    <th scope="col">Holat</th>
                                    <th scope="col">Buyurtma qilinga vaqti</th>
                                    <th scope="col" colspan="2"> Amallar</th>

                                </tr>
                                </thead>
                                <tbody>

                                @foreach($orders as $order)
                                    <tr @if($order->type == 1) style="background: rgb(220 53 69 / 21%)" @endif>
                                        <th scope="row" ><a href="#">{{$order -> id }}</a></th>
                                        <td> {{$order->user->phone }} </td>
                                            <?php
                                            $pri=0;
                                            ?>
                                        <td>

                                            @foreach($orderproducts as $orderproduct)
                                                @if($orderproduct->order_id == $order->id)
                                                        <?php
                                                        $pri=$pri+$orderproduct->total_price;
                                                        ?>

                                                    <b>{{$orderproduct->product->name }} (
                                                        @if($orderproduct->count == 0)
                                                            {{$orderproduct->miqdor }} KG
                                                        @else
                                                            {{$orderproduct->count }} ta
                                                        @endif
                                                    )

                                                            {{--                                                                            <img src="{{ asset('/storage/galereya/'.$product->img) }}" width="150px" alt="">--}}
                                                            <div class="image-container" style="display: inline;">
                                                                <img src="{{ asset('/storage/galereya/'.$orderproduct->product->img) }}"
                                                                     alt="Geeks Image"  width="30px" />
                                                            </div>

                                                        <br></b>

                                        @endif
                                        @endforeach

                                        <td>{{$pri }} so'm </td>
                                        <style>
                                            .image-container img {
                                                transition: transform 0.3s ease-in-out;
                                            }

                                            .image-container img:hover {

                                                transform: scale(10);

                                            }
                                        </style>

                                        <td>
                                            @if($order->type == -1)
                                                <form action="{{ route('orderstatus', $order->id) }}" method="post">
                                                    @csrf
                                                    @method('put')
                                                    <input type="hidden" name="status" value="3">
                                                    {{--                                                    <div class="form-group">--}}
                                                    {{--                                                        <select class="form-control" name="status" id="exampleFormControlSelect1">--}}
                                                    {{--                                                            <option value="{{ $order->status }}">{{$order->st[$order->status] }}</option>--}}
                                                    {{--                                                            <option value="1">Bajarildi</option>--}}
                                                    {{--                                                            <option value="-1">Bekor qilish</option>--}}
                                                    {{--                                                        </select>--}}
                                                    {{--                                                    </div>--}}
                                                    <button>Tugatish</button><br>
                                                    <span>Dokondan olib ketish</span>
                                                </form>
                                            @else
                                            @if($order->status == 0)
                                                <form action="{{ route('orderstatus', $order->id) }}" method="post">
                                                    @csrf
                                                    @method('put')
                                                    <input type="hidden" name="status" value="1">
                                                    {{--                                                    <div class="form-group">--}}
                                                    {{--                                                        <select class="form-control" name="status" id="exampleFormControlSelect1">--}}
                                                    {{--                                                            <option value="{{ $order->status }}">{{$order->st[$order->status] }}</option>--}}
                                                    {{--                                                            <option value="1">Bajarildi</option>--}}
                                                    {{--                                                            <option value="-1">Bekor qilish</option>--}}
                                                    {{--                                                        </select>--}}
                                                    {{--                                                    </div>--}}
                                                    <button>Boshlash</button>
                                                </form>
                                            @elseif($order->status == 1)
                                                <form action="{{ route('orderstatus', $order->id) }}" method="post">
                                                    @csrf
                                                    @method('put')
                                                    <input type="hidden" name="status" value="2">
                                                    <button>Yolda</button>
                                                </form>
                                                {{--                                                {{$order->st[$order->status] }}  {{$order->updated_at->addMinutes(300)->format('d.m.Y  H:i') }}--}}
                                            @elseif($order->status == 2)
                                                <form action="{{ route('orderstatus', $order->id) }}" method="post">
                                                    @csrf
                                                    @method('put')
                                                    <input type="hidden" name="status" value="3">
                                                    <button>Bajarildi</button>
                                                </form>
                                            @endif
                                            @endif
                                        </td>

                                        <td>{{$order->created_at->format('d.m.Y  H:i') }}  </td>
                                        <td>
                                            <a class="btn btn-warning btn-sm m-1" href="{{ route('orderView',$order->id) }}">
                                                                                    <span class="btn-label">
                                                                                        <i class="fa fa-edit"></i>
                                                                                    </span>
                                            </a>                                        </td>
                                        <td>
                                            <form action="{{ route('cancel', ) }}" method="post">
                                                @csrf
                                                @method('post')
                                                <input type="hidden" name="order_id" value="{{$order->id}}">
                                                <button>Bekor qilish</button>
                                            </form>
                                        </td>
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
