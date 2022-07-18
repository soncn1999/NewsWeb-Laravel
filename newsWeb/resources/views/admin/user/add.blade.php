
@extends('layouts.admin')

@section('title')
    <title>Trang chu</title>
@endsection

@section('css')
    <link href="{{ asset('vendors/select2/select2.min.css') }}" rel="stylesheet"/>
    <link href="{{ asset('admins/user/add/add.css') }}" rel="stylesheet"/>
@endsection

@section('js')
    <script src="{{ asset('vendors/select2/select2.min.js') }}"></script>
    <script src="{{ asset('admins/user/add/add.js') }}"></script>
@endsection

@section('content')

    <div class="content-wrapper">
        @include('partials.content-header', ['name' => 'user', 'key' => 'Add'])

        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <form action="{{ route('users.store') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label>Name: </label>
                                <input type="text"
                                       class="form-control"
                                       name="name"
                                       placeholder="Enter Your Name"
                                >
                            </div>
                            <div class="form-group">
                                <label>Email: </label>
                                <input type="email"
                                       class="form-control"
                                       name="email"
                                       placeholder="Enter Your Email"
                                >
                            </div>
                            <div class="form-group">
                                <label>Password: </label>
                                <input type="password"
                                       class="form-control"
                                       name="password"
                                       placeholder="Enter Your Password"
                                >
                            </div>
                            <div class="form-group">
                                <label>Role: </label>
                                <select class="form-control select2_init" name="role_id[]" multiple>
                                    <option value=""></option>
                                    @foreach($roles as $role)
                                        <option value=" {{ $role->id }}">{{ $role->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection

