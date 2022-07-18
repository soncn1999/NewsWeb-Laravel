@extends('layouts.admin')

@section('title')
    <title>Trang chu</title>
@endsection

@section('css')
    <link href="{{ asset('vendors/select2/select2.min.css') }}" rel="stylesheet"/>
    <link href="{{ asset('admins/user/add/add.css') }}" rel="stylesheet"/>
@endsection

@section('js')
    <script src="{{ asset('admins/role/add.js') }}"></script>
@endsection

@section('content')

    <div class="content-wrapper">
        @include('partials.content-header', ['name' => 'role', 'key' => 'Edit'])

        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <form action="{{ route('roles.update',['id'=>$role->id]) }}" method="post" style="width: 60%">
                        <div class="col-md-12">
                            @csrf
                            <div class="form-group">
                                <label>Role name: </label>
                                <input type="text"
                                       class="form-control"
                                       name="name"
                                       placeholder="Enter Role Name"
                                       value="{{ $role->name }}"
                                >
                            </div>

                            <div class="form-group">
                                <label>Description: </label>
                                <textarea class="form-control"
                                          name="code"
                                          rows="3"
                                >{{ $role->code }}</textarea>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="">
                                        <input type="checkbox" name="" class="checkall">
                                        CHECK ALL
                                    </label>
                                </div>
                                @foreach($permissionsParent as $permissionsParentItem)
                                    <div class="card bg-light mb-3 col-md-12">
                                        <div class="card-header bg-dark">
                                            <label>
                                                <input type="checkbox" value="" class="checkbox_wrapper">
                                            </label>
                                            {{ $permissionsParentItem->name }}
                                        </div>
                                        <div class="row">
                                            @foreach($permissionsParentItem->permissionsChildrent as $permissionsChildrentItem)
                                                <div class="card-body text-primary col-md-3">
                                                    <h5 class="card-title">
                                                        <label>
                                                            <input type="checkbox"
                                                                   {{ $permissionsChecked->contains('id',$permissionsChildrentItem->id)
                                                                    ? 'checked' : '' }}
                                                                   value="{{ $permissionsChildrentItem->id}}"
                                                                   name="permission_id[]"
                                                                   class="checkbox_childrent"
                                                            >
                                                        </label>
                                                        {{ $permissionsChildrentItem->name }}
                                                    </h5>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>

    </div>

@endsection

