@extends('dashboard.base')
@section('title')
    Payment
@endsection
@section('title-buttons')
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#newPayment">
        Create Payment
    </button>

    <!-- Modal -->
    <div class="modal fade" id="newPayment" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Create Payment</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{route('payment.create')}}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="exampleInputName" class="form-label">Customer</label>
                            <select class="form-select" aria-label="menu" name="customer_id">
                                @if($customers->count())
                                    @foreach($customers as $customer)
                                        <option value="{{$customer->id}}">{{$customer->name}}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Create</button>
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
            <tbody>
            @if ($payments->count())
                <div class="accordion accordion-flush" id="accordionFlushExample">

                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">S.N</th>
                            <th scope="col">Customer</th>
                            <th scope="col">Table Number</th>
                            <th scope="col">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php $sn = 1; @endphp
                        @foreach($payments as $payment)
                            <tr>
                                <th scope="row">{{$sn++}}</th>
                                <td>{{$payment->customer->name}}</td>
                                <td><span class="badge bg-primary">{{$payment->customer->table_no}}</span></td>
                                <td>
                                    <div class="d-flex">
                                        <button class="btn btn-outline-primary me-2" data-bs-toggle="modal"
                                                data-bs-target="#viewBill-{{$payment->id}}">View Bill
                                        </button>
                                        <!-- Modal -->
                                        <div class="modal fade" id="viewBill-{{$payment->id}}" tabindex="-1"
                                             aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered modal-xl">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Bill
                                                            of {{$payment->customer->name}}</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <table class="table">
                                                            <thead>
                                                            <tr>
                                                                <th scope="col">S.N</th>
                                                                <th scope="col">Order Items</th>
                                                                <th scope="col">Quantity</th>
                                                                <th scope="col">Price</th>
                                                            </tr>
                                                            </thead>
                                                            @php $osn = 1; @endphp
                                                            @foreach($payment->customer->orders as $order)
                                                                <tr>
                                                                    <th scope="row">{{$osn++}}</th>
                                                                    <td>{{$order->menu->name}}</td>
                                                                    <td>{{$order->quantity}}</td>
                                                                    <td>{{$order->price}}</td>
                                                                </tr>
                                                            @endforeach
                                                            <tr>
                                                                <td colspan="2" class="text-right"></td>
                                                                <td>
                                                                    Total Price
                                                                </td>
                                                                <td>{{$payment->total_price}}</td>
                                                            </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Close
                                                        </button>
                                                        <button type="button" class="btn btn-info">Print Bill
                                                        </button>
                                                        {{$payment->is_paid}}
                                                        @if($payment->is_paid)
                                                            <button type="button" class="btn btn-success" disabled>Paid
                                                            </button>
                                                        @else
                                                            <form action="{{route('payment.update' ,$payment->id )}}"
                                                                  method="post">
                                                                @csrf
                                                                @method('PATCH')
                                                                <button type="submit" class="btn btn-primary">Paid
                                                                </button>
                                                            </form>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end model -->
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>


                </div>
            @else
                <tr>
                    <td colspan="5" class="text-danger">No Payment Found!</td>
                </tr>
            @endif
            </tbody>
        </table>
    </div>

@endsection
