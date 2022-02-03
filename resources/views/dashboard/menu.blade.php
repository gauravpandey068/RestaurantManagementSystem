@extends('dashboard.base')
@section('title')
    Menu
@endsection
@section('title-buttons')
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#addMenu">
        Add Menu
    </button>

    <!-- Modal -->
    <div class="modal fade" id="addMenu" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Menu</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{route('menu.store')}}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="exampleInputName" class="form-label">Name</label>
                            <input type="text" class="form-control" id="exampleInputName"
                                   name="name">
                        </div>
                        <div class="mb-3">
                            <label for="price" class="form-label">Price</label>
                            <input type="number" class="form-control" id="price"
                                   name="price">
                        </div>
                        <div class="mb-3">
                            <label for="role">Type</label>
                            <select class="form-select" aria-label="Default select example" name="type">
                                <option value="veg">Veg</option>
                                <option value="non-veg">Non-Veg</option>
                            </select>
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
                <th scope="col">Type</th>
                <th scope="col">Price</th>
                <th scope="col">Actions</th>
            </tr>
            </thead>
            <tbody>
            @if ($menues->count())
            @foreach($menues as $menu)
                <tr>
                    <th scope="row">{{$menu->id}}</th>
                    <td>{{$menu->name}}</td>
                    <td>{{$menu->type}}</td>
                    <td>{{$menu->price}}</td>
                    <td class="d-flex">
                        <button type="button" class="btn btn-outline-success me-2" data-bs-toggle="modal"
                                data-bs-target="#editMenu{{$menu->id}}">
                            <i class="bi bi-pencil"></i>
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="editMenu{{$menu->id}}" tabindex="-1" role="dialog" aria-labelledby="editMenuDialog"
                             aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Edit Menu {{$menu->name}}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{route('menu.update', $menu->id)}}" method="post">
                                            @csrf
                                            @method('PATCH')
                                            <div class="mb-3">
                                                <label for="exampleInputName" class="form-label">Name</label>
                                                <input type="text" class="form-control" id="exampleInputName"
                                                       name="name" value="{{$menu->name}}">
                                            </div>
                                            <div class="mb-3">
                                                <label for="price" class="form-label">Price</label>
                                                <input type="number" class="form-control" id="price"
                                                       name="price" value="{{$menu->price}}">
                                            </div>
                                            <div class="mb-3">
                                                <label for="role">Type</label>
                                                <select class="form-select" aria-label="Default select example"
                                                        name="type">
                                                    <option value="veg">Veg</option>
                                                    <option value="non-veg">Non-Veg</option>
                                                </select>
                                            </div>
                                            <button type="submit" class="btn btn-primary">Update</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <form action="{{route('menu.destroy', $menu->id)}}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger"><i
                                    class="bi bi-trash"></i></button>
                        </form>
                    </td>
                </tr>
            @endforeach
            @else
                <tr>
                    <td colspan="5" class="text-danger">No Menu Found!</td>
                </tr>
            @endif
            </tbody>
        </table>
    </div>
@endsection
