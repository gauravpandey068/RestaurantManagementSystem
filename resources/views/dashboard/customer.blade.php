@extends('dashboard.base')
@section('title')
    Customer's
@endsection
@section('title-buttons')
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#newCust">
        New Customer
    </button>

    <!-- Modal -->
    <div class="modal fade" id="newCust" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Customer</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{route('customer.store')}}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="exampleInputName" class="form-label">Name</label>
                            <input type="text" class="form-control" id="exampleInputName"
                                   name="name">
                        </div>
                        <div class="mb-3">
                            <label for="table_no" class="form-label">Table Number</label>
                            <input type="number" class="form-control" id="table_no"
                                   name="table_no">
                        </div>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('dashboard')
    <div class="mt-3">
        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <table class="table">
            <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Name</th>
                <th scope="col">Table Number</th>
                <th scope="col">Action</th>
            </tr>
            </thead>
            <tbody>
            @if ($customers->count())
                @foreach($customers as $customer)
                    <tr>
                        <th scope="row">{{$customer->id}}</th>
                        <td>{{$customer->name}}</td>
                        <td>
                            <span class="badge bg-primary">{{$customer->table_no}}</span>
                        </td>
                        <td>
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal"
                                    data-bs-target="#newOrder{{$customer->id}}">
                                Place Order
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="newOrder{{$customer->id}}" tabindex="-1" aria-labelledby="exampleModalLabel"
                                 aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Place Order</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{route('order.store', $customer->id)}}" method="post">
                                                @csrf
                                                <div class="mb-3">
                                                    <label for="menu" class="form-label">Food</label>
                                                    <select class="form-select" aria-label="menu" name="menu_id">
                                                        @if($menus->count())
                                                            @foreach($menus as $menu)
                                                                <option value="{{$menu->id}}">{{$menu->name}}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="qty" class="form-label">Quantity</label>
                                                    <input type="number" class="form-control" id="qty"
                                                           name="quantity">
                                                </div>
                                                <button type="submit" class="btn btn-primary">Place Order</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-sm ms-2 btn-outline-success" data-bs-toggle="modal"
                                    data-bs-target="#viewOrder{{$customer->id}}">
                                View Order
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="viewOrder{{$customer->id}}" tabindex="-1" aria-labelledby="exampleModalLabel"
                                 aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Order of {{$customer->name}}</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            @if($customer->orders->count())
                                                @foreach($customer->orders as $order)
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <h5 class="card-title">{{$order->menu->name}}</h5>
                                                            <p class="card-text">
                                                                <span class="badge bg-success">Quantity: {{$order->quantity}}</span>
                                                            </p>
                                                            <p class="card-text">
                                                                <span class="badge bg-warning">Price: {{$order->price}}</span>
                                                            </p>
                                                            <p class="card-text">
                                                                <span class="badge bg-info">Status: {{$order->status}}</span>
                                                            </p>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @else
                                                <p>No order yet</p>
                                            @endif
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-success" data-bs-dismiss="modal">
                                                Close
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="5" class="text-danger">No Active Customer Found!</td>
                </tr>
            @endif
            </tbody>
        </table>
    </div>
@endsection
