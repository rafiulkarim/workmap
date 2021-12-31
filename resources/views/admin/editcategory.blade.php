@extends('layouts.adminlayout. frontlayout')

@section('header_script')
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card" >
                <div class="card-header">
                    <h4 class="card-title">Edit Category</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            @if (session('success'))
                                <div class="alert alert-success text-center">
                                    {{ session('success') }}
                                </div>
                            @endif
                            <form action="{{ route('adminCategory') }}" method="post">
                                @csrf
                                <input type="hidden" name="action" value="edit">
                                <input type="hidden" name="cat_id" value="{{ $category->id }}">
                                <div class="form-group">
                                    <label for="name">Category Name</label>
                                    <input type="text" class="form-control form-control-sm" id="name" name="name"
                                           placeholder="" value="{{ $category->name }}">
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
