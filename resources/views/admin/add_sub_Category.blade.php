@extends('layouts.adminlayout. frontlayout')

@section('header_script')
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card" >
                <div class="card-header">
                    <h4 class="card-title">Add Sub-category</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            @if (session('success'))
                                <div class="alert alert-success text-center">
                                    {{ session('success') }}
                                </div>
                            @endif
                            <form action="{{ route('adminsubcategory') }}" method="post">
                                @csrf
                                <input type="hidden" name="action" value="create">
                                <div class="form-group">
                                    <label for="name" style="color: #000000;">Sub-category Name</label>
                                    <input type="text" class="form-control form-control-sm" id="name" name="name"
                                           placeholder="Enter sub-category Name">
                                </div>
                                <div class="form-group">
                                    <label for="cat_id" style="color: #000000;">Example select</label>
                                    <select class="form-control form-control-sm" id="cat_id" name="cat_id">
                                        <option disabled selected>Select</option>
                                        @foreach($categories as $category)
                                            <option value="{{$category->id}}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <button class="btn btn-primary" type="submit" value="submit">Submit</button>
                            </form>
                        </div>
                        <div class="col-md-6"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer_script')
@endsection
