@extends('layouts.front-layout.front_layout')



@section('content')
    <section id="registration">
        <div class="container">
            <div class="row pt-5">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    @if (session('danger'))
                        <div class="alert alert-danger">
                            {{ session('danger') }}
                        </div>
                    @endif
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    <div class="regi_form">
                        <form method="post" id="login" class="form" action="{{ route('login_process') }}">
                            @csrf
                            <div class="form-group">
                                <label for="email">Email address</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email">
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                            </div>
                            <button type="submit" class="btn search-btn" value="submit">Submit</button>
                        </form>
                    </div>
                </div>
                <div class="col-md-3"></div>
            </div>
        </div>
    </section>
@endsection

@section('footer_script')
    <script src="{{ asset('assets/js/jquery.validate.js') }}"></script>
    <script>
        // var form = $("#registration");
        // var validator = form.validate();
        $().ready(function(){
            $("#login").validate({
                rules: {
                    email: {
                        required: true,
                        email: true
                    },
                    password: {
                        required: true,
                        minlength: 5
                    }
                },
                messages: {
                    email: "Please enter a valid email address",
                    password: {
                        required: "Please provide a password",
                        minlength: "Your password must be at least 5 characters long"
                    }
                },
            });
        });
    </script>
@endsection


