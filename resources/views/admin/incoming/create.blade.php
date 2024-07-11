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
            <h1>Dashboard</h1>

            <div class="btn-add">
                <a id="myBtn" href="#">Qoshish</a>
            </div>

        </div><!-- End Page Title -->

        <section class="section dashboard">
            <div class="row">


    <div class="main-content" style="margin-left: 0 !important;">

        <div class="page-content">
            <div class="container-fluid">



                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">

                            <div class="text-sm-end">

                                <button type="button" class="btn btn-primary mt-2 m-2" data-bs-toggle="modal"
                                        data-bs-target="#exampleModal"
                                        data-bs-whatever="@getbootstrap">Maxsulot qoshish
                                </button>
{{--                                <form action="{{ route('admin.ordercancel') }}" method="post">--}}
{{--                                    @csrf--}}
{{--                                    <input type="submit" value="bekor qilish" class="btn btn-warning m-2 mt-2">--}}
{{--                                </form>--}}


                                <div class="modal fade" id="exampleModal" tabindex="-1"
                                     aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Maxsulot qoshish</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                            </div>


                                            <div class="modal-body">

                                                <div class="mb-3">


                                                    <div class="col-lg-4 col-md-6">
                                                        <form action="{{ route('incoming.store') }}">
                                                            <div class="mb-3 form-group">
                                                                <label for="checkbox-1"
                                                                       class="multiselect_label">product</label>
                                                                <select id="checkbox" name="product_id"
                                                                        class="form-control">
{{--                                                                    @foreach($products as $product)--}}
{{--                                                                        <option--}}
{{--                                                                            value="{{ $product->id }}">{{ $product->name }}</option>--}}
{{--                                                                    @endforeach--}}
                                                                </select>
                                                            </div>
                                                            <div class="mb-3 form-group">
                                                                <label for="checkbox-1"
                                                                       class="multiselect_label">count</label>
                                                                <input type="number" class="form-control"
                                                                       name="count">
                                                            </div>

                                                            <input type="submit" class="btn btn-primary"
                                                                   value="qoshish">
                                                        </form>
                                                    </div>
                                                    <script
                                                        src="https://cdn.jsdelivr.net/npm/jquery/dist/jquery.min.js"></script>

                                                </div>
                                                <div class="modal-footer">
                                                    {{--                                                                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>--}}


                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="card-body">
                                <h4 class="card-title mb-4">Yetkazib beruvchi malumotlarini kiriting</h4>
                                <div class="table-responsive"><?php @session_start();?>
{{--                                    <form action="{{ route('incoming.store') }}">--}}
{{--                                        'product_id','count','price','total_price','tel','org','zapas','miqdori'--}}
                                    <label for="">Shtrix kod</label>
                                    <input type="number" name="code" id="code" onchange="product(code)">
                                    <label for="">ID:</label>
                                    <input type="number" name="id" id="id" onchange="product(id)">
                                        <table>
                                            <form action="{{ route('addcart') }}">
                                            <tr style="width: 100% !important;margin-bottom: 10px">
                                                <td>
                                                    <label for="">Nomi</label>
                                                    <input type="text" id="name" name="name" value="">
                                                </td>
                                                <td>
                                                    <label for="">Narxi</label>
                                                    <input type="number" name="price" id="price">
                                                </td>
                                                <td>
                                                    <label for="">Sotuv Narxi</label>
                                                    <input type="number" name="sell_price" id="sell_price">
                                                </td>

                                                <td>
                                                    <label for="">Soni</label>
                                                    <input type="number" onchange="totalprice(count)" name="count" id="count" >
                                                </td>
                                                <td>
                                                    <label for="">Miqdori</label>
                                                    <input type="number" name="miqdori" onchange="totalprice(count)" id="miqdori" >
                                                </td>


                                            </tr>
                                            <tr style="width: 100% !important;">
                                                <td>
                                                    <label for="">Umumiy narxi</label>
                                                    <input type="number" class="disabled" name="total_price" id="total_price">
                                                </td>
                                                <td>
                                                    <label for="">Telefon</label>
                                                    <input type="number" name="tel" id="tel" >
                                                </td>
                                                <td>
                                                    <label for="">Tashkilot</label>
                                                    <input type="text" name="org" id="org">
                                                </td>
                                                <td align="center">

                                                    <input type="submit" class="btn btn-primary" value="qoshish">
                                                </td>

                                                    <input type="hidden" name="product_id" id="product_id">


                                            </tr>
                                            </form>
                                        </table>

                                    <table class="table align-middle table-nowrap table-check">
                                        <thead class="table-light">
                                        <tr>
                                            <th style="width: 20px;" class="align-middle">
                                                <div class="form-check font-size-16">
                                                    <input class="form-check-input" type="checkbox" id="checkAll">
                                                    <label class="form-check-label" for="checkAll"></label>
                                                </div>
                                            </th>
                                            <th class="align-middle"> ID</th>
                                            <th class="align-middle">Nomi</th>
                                            <th class="align-middle">soni</th>
                                            <th class="align-middle">Narxi</th>
                                            <th class="align-middle">Umumiy Narxi</th>
                                            <th class="align-middle">Tel</th>

                                            <th class="align-middle">Tashkilot</th>
                                        </tr>
                                        </thead>
                                        <tbody>
{{--                                        @dd($_SESSION['cart'])--}}
                                        <?php
                                        if (isset($_SESSION['cart'])){
                                            $count = 0;
                                            $ammount = 0;
                                        foreach ($_SESSION['cart'] as $key=>$value){
                                            ?>
                                        <tr>
                                            <td>
                                                <div class="form-check font-size-16">
                                                    <input class="form-check-input" type="checkbox"
                                                           id="orderidcheck01">
                                                    <label class="form-check-label" for="orderidcheck01"></label>
                                                </div>
                                            </td>
                                            <td>{{ $value[0]['product_id'] }}</td>
                                            <td>{{ $value[0]['name'] }}</td>
                                            <td>{{ $value[0]['count'] }}</td>
                                            <td>{{ $value[0]['price'] }}</td>
                                            <td>{{ $value[0]['total_price'] }}</td>
                                            <td>{{ $value[0]['tel'] }}</td>
                                            <td>{{ $value[0]['org'] }}</td>
{{--                                            <td>{{$value['count'] }}</td>--}}
{{--                                            <td>--}}
{{--                                                {{$value['ammount'] }}--}}
{{--                                            </td>--}}
{{--                                            <td>--}}

{{--                                                <a class="btn btn-primary "--}}
{{--                                                   href="">--}}
{{--                                    <span class="btn-label" style="padding-left:0 !important; ">--}}
{{--                                        <i class="fa fa-pen"></i>--}}
{{--                                    </span>--}}
{{--                                                </a>--}}
{{--                                                <button type="submit" class="btn btn-danger "><span--}}
{{--                                                        class="btn-label" style="padding-left:0 !important; ">--}}
{{--                                        <i class="fa fa-trash"></i>--}}
{{--                                    </span></button>--}}
{{--                                            </td>--}}
                                        </tr>
                                            <?php
//                                            $count = $count + $value['count'];
//                                            $ammount = $ammount + $value['ammount'];
                                        } }?>
                                        </tbody>
                                    </table>
                                    <a href="{{ route('clearcart') }}" class="btn btn-warning">Tozalash </a>
                                    <form action="{{ route('incoming.store') }}" method="post">
                                        @csrf
                                        <input type="submit" class="btn btn-primary" value="Saqlash">

                                    </form>
                                </div>
                                <script src="{{asset('/js/core/jquery.3.2.1.min.js')}}"></script>
                                <script>
                                    function ispay(){
                                        // var ispay=Document.getElementById('isPayed').val()

                                        if($('#isPayed').val() == 1){
                                            $('#pay').css('display', 'block');
                                        }else{
                                            $('#pay').css('display', 'none');
                                        }
                                    }
                                    function totalprice(count){
                                        // $price=$('#price').val();
                                        // totalprice=count*$price;
                                        // $('#total_price').val(totalprice);


                                            var value2 = parseFloat($('#count').val());
                                            var value1 = parseFloat($('#price').val());
                                            var value3 = parseFloat($('#miqdori').val());

                                            // Check if both values are numbers
                                            if (!isNaN(value1) && !isNaN(value2)) {
                                                $('#total_price').val(value1 * value2);
                                            }
                                        if (!isNaN(value1) && !isNaN(value3)) {
                                            $('#total_price').val(value1 * value3);
                                        }

                                        console.log(value1 * value2)
                                    }
                                    function product(code) {
                                        code = code.value;
                                        id = id.value;
                                        // 'product_id','count','price','total_price','tel','org','zapas','miqdori'
                                        $.ajax(
                                            "{{route('code.search')}}",
                                            {
                                                method: 'post',
                                                headers: {
                                                    'X-CSRF-TOKEN': '{{csrf_token()}}'
                                                },
                                                data: {
                                                    code: code,
                                                    id: id,
                                                },
                                                success: function (data) {


                                                    $('#name').val(data.name);
                                                    $('#product_id').val(data.id);
                                                    console.log(data.name)

                                                }
                                            });
                                    }
                                </script>
                            </div>

                            <!-- end row -->

                        </div> <!-- container-fluid -->
                    </div>
                    <!-- End Page-content -->


                </div>
            </div>
        </div>
    </div>
            </div>
        </section>
    </main>
@endsection
