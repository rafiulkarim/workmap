@extends('layouts.front-layout.front_layout')



@section('content')
    <section id="registration">
        <div class="container">
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    <div class="regi_form">
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
                        <form method="post" id="signup" class="form" action="{{ route('registration_process') }}">
                            @csrf
                            <div class="form-group">
                                <label for="user_name">User Name</label>
                                <input type="text" class="form-control" id="user_name" name="user_name" placeholder="Enter User Name">
                            </div>
                            <div class="form-group">
                                <label for="email">Email address</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email">
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                            </div>
                            <div class="form-group">
                                <label for="c_password">Confirm Password</label>
                                <input type="password" class="form-control" id="c_password" name="c_password" placeholder="Confirm Password">
                            </div>
                            <div class="form-group">
                                <label for="user_type">Select your User Type</label>
                                <select class="form-control" id="user_type" name="user_type">
                                    <option value="">-- Select One --</option>
                                    <option value="1">Client</option>
                                    <option value="2">Freelancer</option>
                                </select>
                            </div>
                            <div class="form-check pb-2">
                                <input type="checkbox" class="form-check-input" id="term_con" name="term_con">
                                <label class="form-check-label text-muted" for="term_con">I agree with terms and conditions</label>
                                <label id="term_con-error" class="error" for="term_con"></label>
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
            $("#signup").validate({
                rules: {
                    user_name: "required",
                    email: {
                        required: true,
                        email: true
                    },
                    password: {
                        required: true,
                        minlength: 5
                    },
                    c_password: {
                        required: true,
                        minlength: 5,
                        equalTo: "#password"
                    },
                    user_type: "required",
                    term_con: "required"
                },
                messages: {
                    user_name: "Please enter your name",
                    email: "Please enter a valid email address",
                    password: {
                        required: "Please provide a password",
                        minlength: "Your password must be at least 5 characters long"
                    },
                    c_password: {
                        required: "Please provide confirm password",
                        minlength: "Your password must be at least 5 characters long",
                        equalTo: "Please enter the same password as above"
                    },
                    user_type: "Please select one option",
                    term_con: "Please agree with terms and conditions"
                }
            });
        });
    </script>
@endsection


