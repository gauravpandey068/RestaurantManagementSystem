@extends('dashboard.base')
@section('title')
    Users
@endsection
@section('title-buttons')
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#addUser">
        Add User
    </button>

    <!-- Modal -->
    <div class="modal fade" id="addUser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add New User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{route('users.store')}}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="exampleInputName" class="form-label">Name</label>
                            <input type="text" class="form-control" id="exampleInputName"
                                   name="name">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Email address</label>
                            <input type="email" class="form-control" id="exampleInputEmail1"
                                   aria-describedby="emailHelp" name="email">
                        </div>
                        <div class="mb-3">
                            <label for="role">Role</label>
                            <select class="form-select" aria-label="Default select example" name="role">
                                <option value="admin">Admin</option>
                                <option value="waiter">Waiter</option>
                                <option value="chef">Chef</option>
                                <option value="cashier">Cashier</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Password</label>
                            <input type="password" name="password" class="form-control"
                                   id="exampleInputPassword1">
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
                <th scope="col">Email</th>
                <th scope="col">Role</th>
                <th scope="col">Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr>
                    <th scope="row">{{$user->id}}</th>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td>{{$user->role}}</td>
                    <td class="d-flex">
                        <button type="button" class="btn btn-outline-success me-2" data-bs-toggle="modal"
                                data-bs-target="#editUser{{$user->id}}">
                            <i class="bi bi-pencil"></i>
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="editUser{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="editUserDialog"
                             aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Edit User {{$user->name}}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{route('users.update', $user->id)}}" method="post">
                                            @csrf
                                            @method('PATCH')
                                            <div class="mb-3">
                                                <label for="exampleInputName" class="form-label">Name</label>
                                                <input type="text" class="form-control" id="exampleInputName"
                                                       name="name" value="{{$user->name}}">
                                            </div>
                                            <div class="mb-3">
                                                <label for="exampleInputEmail1" class="form-label">Email address</label>
                                                <input type="email" class="form-control" id="exampleInputEmail1"
                                                       aria-describedby="emailHelp" name="email" value="{{$user->email}}">
                                            </div>
                                            <div class="mb-3">
                                                <label for="role">Role</label>
                                                <select class="form-select" aria-label="Default select example"
                                                        name="role">
                                                    <option value="admin">Admin</option>
                                                    <option value="waiter">Waiter</option>
                                                    <option value="chef">Chef</option>
                                                    <option value="cashier">Cashier</option>
                                                </select>
                                            </div>
                                            <button type="submit" class="btn btn-primary">Update</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--change password-->
                        <button type="button" class="btn btn-outline-info me-2" data-bs-toggle="modal"
                                data-bs-target="#changeUserPassword{{$user->id}}">
                            Change Password
                        </button>
                        <div class="modal fade" id="changeUserPassword{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="editUserDialog"
                             aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Change Password of {{$user->name}}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{route('users.password', $user->id)}}" method="post">
                                            @csrf
                                            @method('PATCH')
                                            <div class="mb-3">
                                                <label for="password" class="form-label">Password</label>
                                                <input type="password" class="form-control" id="password"
                                                       name="password">
                                            </div>
                                            <button type="submit" class="btn btn-primary">Change Password</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <form action="{{route('users.destroy', $user->id)}}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger"><i
                                    class="bi bi-trash"></i></button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
