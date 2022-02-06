@extends('layouts.base')

@section('content')
    <nav class="navbar navbar-light bg-light">
        <div class="container-md">
            <div class="navbar-brand fs-2">
                <p class="text-primary fw-bold text-center">
                    Restaurant Management System
                </p>
            </div>
        </div>
    </nav>
    <div class="container-md mt-5 mb-5 p-5">
        <div class="card">
            <div class="card-header bg-white p-3 border-0">
                <h3 class="text-center text-primary fs-3 mt-3">
                    Sign in to your account
                </h3>
            </div>
            <div class="card-body">
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
                <form action="{{route('login')}}" method="post">
                    @csrf
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Email address</label>
                        <input type="email" class="form-control" name="email" id="exampleInputEmail1"
                               aria-describedby="emailHelp" required>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Password</label>
                        <input type="password" class="form-control" name="password" id="exampleInputPassword1" required>
                    </div>
                    <div class="mb-4 form-check">
                        <input type="checkbox" name="remember" class="form-check-input" id="exampleCheck1">
                        <label class="form-check-label" for="exampleCheck1">Remember me </label>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
    <footer id="sticky-footer" class="flex-shrink-0 py-5 bg-light text-dark fs-4 fixed-bottom">
        <div class="container text-center ">
            <small>Copyright &copy; Restaurant Management System</small>
        </div>
    </footer>
@endsection
