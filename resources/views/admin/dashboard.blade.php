@extends('admin.layouts.app')
@push('admin-lte-css')
    <link href="{{ asset('assets/css/adminlte.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
@endpush
@section('content')
    <main id="main" class="main">
        <div class="card">
            <div class="card-header">
                <h3>Dashboard</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3>{{ $newOrderCount }}</h3>
                                <p>Новые заказы</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-bag"></i>
                            </div>
                            <a href="{{ route('orderIndex') }}" class="small-box-footer">
                                Ещё <i class="fas fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>

                    <div class="col-lg-3 col-6">

                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3>{{ $clientCount }}</h3>
                                <p>Клиенты</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-stats-bars"></i>
                            </div>
                            <a href="{{ route('clients') }}" class="small-box-footer">
                                Ещё <i class="fas fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>

                    <div class="col-lg-3 col-6">

                        <div class="small-box bg-warning">
                            <div class="inner">
                                <h3>{{ $serverBalance }}</h3>
                                <p>Баланс сервера</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-cloud"></i>
                            </div>
                            <a href="#" class="small-box-footer">
                                Ещё <i class="fas fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>

                    <div class="col-lg-3 col-6">

                        <div class="small-box bg-danger">
                            <div class="inner">
                                <h3>{{ $eskizBalance }}</h3>
                                <p>СМС баланс</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-chatbox"></i>
                            </div>
                            <a href="#" class="small-box-footer">
                                Ещё <i class="fas fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
