@extends('admin.layouts.app')

@section('content')

    <style>
        .modal {
            display: none; /* Hidden by default */
            position: fixed; /* Stay in place */
            z-index: 999; /* Sit on top */
            left: 0;
            top: 0;
            width: 100%; /* Full width */
            height: 100%; /* Full height */
            overflow: auto; /* Enable scroll if needed */
            background-color: rgb(0,0,0); /* Fallback color */
            background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
        }

        /* Modal Content/Box */
        .modal-content {
            background-color: #fefefe;
            margin: 15% auto; /* 15% from the top and centered */
            padding: 20px;
            border: 1px solid #888;
            width: 80%; /* Could be more or less, depending on screen size */
        }

        /* The Close Button */
        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }</style>
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

        </div><!-- End Page Title -->

        <section class="section dashboard">
            <div class="row">


                <div class="col-12 table_one">
                    <div class="card recent-sales overflow-auto table_one">



                        <div class="card-body">
                            <h5 class="card-title">Recent Sales <span>| Today</span></h5>



                                <form action="{{route('category.update',$cat->id)}}" method="POST" accept-charset="UTF-8"
                                      enctype="multipart/form-data">
                                    @csrf
                                    @METHOD('PUT')


{{--                                    <div class="form-group">--}}
{{--                                        <label for="exampleInputEmail1">#id</label>--}}
{{--                                        <input type="text" class="form-control" id="exampleInputEmail1" value="{{ $cat->id }}" name="id" aria-describedby="emailHelp" placeholder="id">--}}
{{--                                        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>--}}
{{--                                    </div>--}}
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">name</label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" name="name" value="{{ $cat->name }}" aria-describedby="emailHelp" placeholder="name">
                                        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Surati ozgartirish:</label>
                                        <input type=file name="img" oninput="pic.src=window.URL.createObjectURL(this.files[0])">
                                        <img id="pic"  width="100px"/>
                                        {{--                                            <input type="file" class="form-control" id="exampleInputEmail1" name="img" aria-describedby="emailHelp" placeholder="Soni">--}}

                                    </div>


                                    <button type="submit" class="btn btn-primary">Saqlash</button>
                                </form>

                            <div class="card-body border mt-3">
                                <h5 class="card-title"><span>-/-</span></h5>
@foreach($cc as $item)
                                    <form class="form-inline" action="{{route('category.update',$item->id)}}" method="POST" accept-charset="UTF-8"
                                          enctype="multipart/form-data">
                                        @csrf
                                        @METHOD('PUT')
                                <div class="row">
                                        <div class="form-group mx-sm-3 mb-2 col-4">
                                            <label for="inputPassword2" class="sr-only">TR №</label>
                                            <input type="text" class="form-control" name="tr" value="{{ $item->tr }}" id="inputPassword2" placeholder="Tartib raqami">
                                        </div>
                                    <div class="form-group mx-sm-3 mb-2 col-4">
                                            <label for="inputPassword2" class="sr-only">Nomi</label>
                                            <input type="text" class="form-control" name="name" value="{{ $item->name }}" id="inputPassword2" placeholder="Password">
                                        </div>
                                        <div class="col-3">
                                            <button type="submit" class="btn btn-primary mb-2">Saqlash</button>
                                        </div>
                                </div>
                                    </form>

@endforeach



                            </div>
                            <div id="myModal" class="modal" >

                                <!-- Modal content -->
{{--                                <div class="modal-content">--}}
{{--                                    <span class="close">&times;</span>--}}
{{--                                    <form method="POST" action="{{ route('category.store') }}" enctype="multipart/form-data">--}}
{{--                                        @csrf--}}

{{--                                        <div class="form-group">--}}
{{--                                            <label for="exampleInputEmail1">Mahsulot toifasini tanlang tanlang</label>--}}
{{--                                            <select class="form-control form-control-sm"  name="cat_id">--}}
{{--                                                <option></option>--}}
{{--                                                @foreach($category as $item)<option value="{{$item->id}}">{{ $item->name }}</option>@endforeach--}}
{{--                                            </select>--}}
{{--                                        </div>--}}
{{--                                        <div class="form-group">--}}
{{--                                            <label for="exampleInputEmail1">name</label>--}}
{{--                                            <input type="text" class="form-control" id="exampleInputEmail1" name="name" aria-describedby="emailHelp" placeholder="name">--}}
{{--                                            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>--}}
{{--                                        </div>--}}
{{--                                        <div class="form-group">--}}
{{--                                            <label for="exampleInputEmail1">Surati:</label>--}}
{{--                                            <input type="file" class="form-control" id="exampleInputEmail1" name="img" aria-describedby="emailHelp" placeholder="Soni">--}}

{{--                                        </div>--}}


{{--                                        <button type="submit" class="btn btn-primary">Submit</button>--}}
{{--                                    </form>--}}
{{--                                </div>--}}

                            </div>
                        </div>

                    </div>
                </div>




            </div>

        </section>

    </main><!-- End #main -->

    <!-- ======= Footer ======= -->


    {{--<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>--}}

    <!-- Vendor JS Files -->


    <script src="{{asset('/js/core/jquery.3.2.1.min.js')}}"></script>
    <script src="{{asset('/js/plugin/datatables/datatables.min.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.0/xlsx.full.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.5/FileSaver.min.js"></script>



    <script>
        $(document).ready( function () {
            $('#table').DataTable({
                dom: 'Bfrtip',
                "buttons": [
                    {
                        "extend": 'excel', "text":' Малумотларни excel форматда юклаб олиш',"className": 'btn btn-primary btn-xm'
                    }
                ],
                "aLengthMenu": [200],
            });
            $('#exportButton').on('click', function() {
                exportToExcel();
            });

            function exportToExcel() {
                var wb = XLSX.utils.table_to_book(document.getElementById('table'), {sheet: 'Sheet JS'});
                var wbout = XLSX.write(wb, {bookType:'xlsx',  type: 'binary'});

                function s2ab(s) {
                    var buf = new ArrayBuffer(s.length);
                    var view = new Uint8Array(buf);
                    for (var i=0; i<s.length; i++) view[i] = s.charCodeAt(i) & 0xFF;
                    return buf;
                }

                saveAs(new Blob([s2ab(wbout)],{type:"application/octet-stream"}), 'data.xlsx');
            }

        } );
        var modal = document.getElementById("myModal");

        var btn = document.getElementById("myBtn");

        var span = document.getElementsByClassName("close")[0];

        btn.onclick = function() {
            modal.style.display = "block";
        }

        span.onclick = function() {
            modal.style.display = "none";
        }

        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }

    </script>


@endsection
