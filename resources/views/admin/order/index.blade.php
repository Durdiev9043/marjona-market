@extends('admin.layouts.app')

@section('content')
    <main id="main" class="main">
        @if (\Session::has('success'))
            <div class="alert alert-success">
                <ul>
                    <li>{!! \Session::get('success') !!}</li>
                </ul>
            </div>
        @endif
        <div class="pagetitle">
            <h1>Bekor qilingan buyurtmalar ro'yxati</h1>
        </div>
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
                            <h5 class="card-title"></h5>
                            <table class="table table-borderless datatable">
                                <thead>
                                <tr>
                                    <th scope="col">№</th>
                                    <th scope="col">Buyurmachi</th>
                                    <th scope="col">Mahsulot</th>
                                    <th scope="col">Narxi</th>
                                    <th scope="col">Holat</th>
                                    <th scope="col">Yetkazib beruvchi</th>
                                    <th scope="col">Buyurtma qilinga vaqti</th>
                                    <th scope="col" colspan="2"></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($orders as $order)
                                    <tr>
                                        <th scope="row"><a href="#">{{$order->id }}</a></th>
                                        <td> {{$order->user->phone }} </td>
                                        <td>
                                            @foreach($order->products as $product)
                                                <b>{{$product->product->name }}
                                                    @if($product->count == 0)
                                                        | {{$product->miqdor }} KG |
                                                    @else
                                                        | {{  $product->count }} ta |
                                                    @endif
                                                    <br>
                                                </b>
                                        @endforeach
                                        <td>{{ $order->products_sum_total_price }} so'm</td>
                                        <td>
                                            @if($order->status == 0)
                                                <form action="{{ route('orderstatus', $order->id) }}" method="post">
                                                    @csrf
                                                    @method('put')
                                                    <input type="hidden" name="status" value="1">
                                                    <button>Yig`ilmoqda</button>
                                                </form>
                                            @elseif($order->status == 1)
                                                <form action="{{ route('orderstatus', $order->id) }}" method="post">
                                                    @csrf
                                                    @method('put')
                                                    <input type="hidden" name="status" value="2">
                                                    <button>Yetkazib beruvchiga topshirish</button>
                                                </form>
                                                {{--                                                {{$order->st[$order->status] }}  {{$order->updated_at->addMinutes(300)->format('d.m.Y  H:i') }}--}}
                                            @elseif($order->status == 2)
                                                <form action="{{ route('orderstatus', $order->id) }}" method="post">
                                                    @csrf
                                                    @method('put')
                                                    <input type="hidden" name="status" value="3">
                                                    <button>Buyurutmani tugatish</button>
                                                </form>
                                            @endif
                                            @if($order->type == -1)
                                                Dokon olib ketuvchi
                                            @endif
                                        </td>
                                        <td>{{ $order->supplier ? $order->supplier->name : ' ' }} {{ $order->supplier ? $order->supplier->phone : ' ' }}</td>
                                        <td>{{$order->created_at->format('d.m.Y  H:i') }}  </td>
                                        <td><a href="{{ route('check', $order->id) }}" target="_blank"
                                               class="btn btn-outline-danger"> checkni yuklab olish</a></td>
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
                            {{ $orders->links('pagination::bootstrap-4')  }}
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
