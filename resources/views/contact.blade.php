@extends('layouts.front-layout.front_layout')

@section('header_script')
@endsection

@section('content')
    <section id="contact">
        <div class="container">
            <div class="row mt-3">
                <div class="col-md-3"></div>
                <div class="col-md-6 bg-white p-3">
                    @if (session('success'))
                        <div class="alert alert-success text-center">
                            {{ session('success') }}
                        </div>
                    @endif
                    <form action="{{ route('contact_process') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="name">Full Name</label>
                            <input type="text" class="form-control form-control-sm" id="name" placeholder="Enter Full Name" name="name">
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control form-control-sm" id="email" placeholder="Enter Email" name="email">
                        </div>
                        <div class="form-group">
                            <label for="subject">Password</label>
                            <input type="text" class="form-control form-control-sm" id="subject" placeholder="Enter Subject" name="subject">
                        </div>
                        <div class="form-group">
                            <label for="message">Message</label>
                            <textarea class="form-control" id="message" name="message" rows="3"></textarea>
                        </div>
                        <button type="submit" value="submit" class="btn search-btn">Submit</button>
                    </form>
                </div>
                <div class="col-md-3"></div>
            </div>
        </div>
    </section>
@endsection

@section('footer_script')
@endsection
