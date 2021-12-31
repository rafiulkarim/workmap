@extends('layouts.front-layout.front_layout')

@section('content')
    <div class="container">
        <div class="row pt-5">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <div style="background: #f4f0ec">
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
                </div>
            </div>
            <div class="col-md-2"></div>
        </div>
    </div>
@endsection
