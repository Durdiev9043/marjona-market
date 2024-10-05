@extends('admin.layouts.app')

@section('content')
    <main id="main" class="main">
        <section class="section dashboard">
            <div class="row">
                <div class="col-12 table_one">
                    <div class="card recent-sales overflow-auto table_one">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-7">
                                    <h5 class="card-title">Клиенты</h5>
                                </div>
                                <div class="col-5 mt-3">
                                    <form action="{{ route('clients') }}" method="get" class="d-inline">
                                        <div class="d-flex">
                                            <input name="search" class="form-control me-2" placeholder="Поиск" value="{{ request('search') }}">
                                            <button type="submit" class="btn btn-primary">
                                                <i class="fa fa-search"></i>
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <table class="table table-bordered">
                                <thead class="border">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Имя</th>
                                    <th scope="col">Фамилия</th>
                                    <th scope="col">День рождения</th>
                                    <th scope="col">Телефон</th>
                                    <th scope="col">Заказы</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($users as $user)
                                    <tr>
                                        <th scope="row"><a href="#">{{ $user -> id }}</a></th>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->surename }}</td>
                                        <td>{{ $user->birthday }}</td>
                                        <td>{{ $user->phone }}</td>
                                        <td>{{ $user->orders_count }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            {{ $users->links('pagination::bootstrap-4') }}
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
