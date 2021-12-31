@extends('layouts.adminlayout. frontlayout')

@section('header_script')
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card" >
                <div class="card-header">
                    <h4 class="card-title">User Login</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <form action="{{ route('user_login_process') }}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="email">Email address</label>
                                    <input type="email" class="form-control" name="email" id="email" placeholder="Enter user email">
                                </div>
                                <button type="submit" value="submit" class="btn btn-primary">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('footer_script')
@endsection
