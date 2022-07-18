
@extends('layouts.admin')

@section('title')
    <title>Trang chu</title>
@endsection


@section('content')

    <div class="content-wrapper">
        @include('partials.content-header', ['name' => 'menus', 'key' => 'Edit'])

        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <form action="{{ route('menu.update', ['id' => $menuFollowIdEdit->id]) }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label>Menu Name: </label>
                                <input type="text"
                                       class="form-control"
                                       name="name"
                                       placeholder="Enter Menu Name"
                                       value="{{ $menuFollowIdEdit->name }}"
                                >
                            </div>

                            <div class="form-group">
                                <label>Menu Parent: </label>
                                <select class="form-control" name="parent_id">
                                    <option value="0">-- Parent's Menu --</option>
                                    {!! $optionSelect !!}
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

