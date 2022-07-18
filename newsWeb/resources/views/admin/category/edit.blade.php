
@extends('layouts.admin')

@section('title')
<title>Trang chu</title>
@endsection


@section('content')

<div class="content-wrapper">
    @include('partials.content-header', ['name' => 'category', 'key' => 'Edit'])

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <form action="{{ route('category.update', ['id' => $category->id]) }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label>Category Name: </label>
                            <input type="text"
                                   class="form-control"
                                   name="name"
                                   value="{{ $category->name }}"
                                   placeholder="Enter Category Name"
                            >
                        </div>

                        <div class="form-group">
                            <label>Category Parent:</label>
                            <select class="form-control" name="parent_id">
                                <option value="0">-- Parent's Category --</option>
                                {!! $htmlOption !!}
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

