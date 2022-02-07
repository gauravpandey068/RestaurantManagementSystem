@extends('dashboard.base')
@section('title')Dashboard @endsection

@section('dashboard')
    <div class="col-12">
        <div class="row">
            <div class="col-3">
                <div class="card">
                    <div class="card-header bg-white border-white">
                        <p class="fs-4 fw-bold text-primary text-center ">Today Menu</p>
                    </div>
                    <div class="card-body">
                        <div class="row">

                            <table class="table table-borderless">
                                <thead class="text-primary">
                                <tr>
                                    <th scope="col">S.N</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Price</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php $sn= 1; @endphp
                                @foreach($menus as $menu)
                                    <tr>
                                        <th scope="row" class="text-primary">{{$sn++}}</th>
                                        <td class="text-primary">{{$menu->name}}</td>
                                        <td class="text-primary">{{$menu->price}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-2">
                <div class="card">
                    <div class="card-header text-primary text-center fs-4 fw-bold bg-white border-white">
                        <p>Total Sales</p>
                    </div>
                    <div class="card-body text-center ">
                        <span class="badge bg-primary">Rs.{{$total_sale}}</span>
                    </div>
                </div>
            </div>
            <div class="col-2">
                <div class="card">
                    <div class="card-header text-primary text-center fs-4 fw-bold bg-white border-white">
                        <p>Today Sales</p>
                    </div>
                    <div class="card-body text-center">
                       <span class="badge bg-primary">Rs.{{$today_sale}}</span>
                    </div>
                </div>
            </div>
            <div class="col-2">
                <div class="card">
                    <div class="card-header text-primary text-center fs-4 fw-bold bg-white border-white">
                        <p>Today Customers</p>
                    </div>
                    <div class="card-body text-center">
                        <span class="badge bg-info">{{$today_customer}}</span>
                    </div>
                </div>
            </div>
            <div class="col-2">
                <div class="card">
                    <div class="card-header text-primary text-center fs-4 fw-bold bg-white border-white">
                        <p>Total Staff</p>
                    </div>
                    <div class="card-body text-center">
                        <span class="badge bg-info">{{$total_users}}</span>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
