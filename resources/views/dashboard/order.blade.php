@extends('dashboard.base')
@section('title')
    Orders
@endsection

@section('dashboard')
    <div class="mt-3">
        <table class="table">
            <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Name</th>
                <th scope="col">Quantity</th>
                <th scope="col">Table Number</th>
                <th scope="col">Status</th>
                <th scope="col">Actions</th>
            </tr>
            </thead>
            <tbody>
            @if ($orders->count())
                @foreach($orders as $order)
                    <tr>
                        <th scope="row">{{$order->id}}</th>
                        <td>{{$order->menu->name}}</td>
                        <td>{{$order->quantity}}</td>
                        <td>{{$order->customer->table_no}}</td>
                        <td>{{$order->status}}</td>
                        @if(auth()->user()->role == 'chef' || auth()->user()->role == 'admin')
                            <td class="d-flex">
                                <button type="button" class="btn btn-outline-success me-2" data-bs-toggle="modal"
                                        data-bs-target="#updateOrder{{$order->id}}">
                                    <i class="bi bi-pencil"></i>
                                </button>

                                <!-- Modal -->
                                <div class="modal fade" id="updateOrder{{$order->id}}" tabindex="-1" role="dialog"
                                     aria-labelledby="editMenuDialog"
                                     aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Update
                                                    Order {{$order->menu->name}}</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{route('order.update', $order->id)}}" method="post">
                                                    @csrf
                                                    @method('PATCH')
                                                    <div class="mb-3">
                                                        <label for="role">Status</label>
                                                        <select class="form-select" aria-label="Default select example"
                                                                name="status">
                                                            <option value="pending">Pending</option>
                                                            <option value="in-progress">In-Progress</option>
                                                            <option value="complete">Complete</option>
                                                        </select>
                                                    </div>
                                                    <button type="submit" class="btn btn-primary">Update</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        @else
                            <td>
                                <button type="button" class="btn btn-outline-success me-2" disabled>
                                    <i class="bi bi-pencil"></i>
                                </button>
                            </td>
                        @endif
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="5" class="text-danger">No Order Found!</td>
                </tr>
            @endif
            </tbody>
        </table>
    </div>
@endsection
