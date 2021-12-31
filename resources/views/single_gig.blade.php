@extends('layouts.front-layout.front_layout')

@section('header_section')
@endsection


@section('content')
    <section id="single_gig">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="gig mt-4">
                        <h1>{{ $single_gig_datas->title }}</h1>
                        <img src="{{ asset('assets/img/gig/'.$single_gig_datas->image) }}" width="100%" alt="">
                        <h4>About this Gig</h4>
                        <p>{!! $single_gig_datas->description !!}</p>
                        @if(Auth::user()->Userrole != 2)
                        <h3><b>About The Seller</b></h3>
                        <ul class="list-inline">
                            <li class="list-inline-item">
                                <a href="">
                                    <img width="80px" height="80px" class="rounded-circle" src="{{ asset('assets/img/'.$single_gig_datas->giguserdetails->image) }}" alt="">
                                </a>
                            </li>
                            <li class="list-inline-item text-center">
                                <p><b>{{ $single_gig_datas->giguser->name }}</b></p>
                            </li>
                            <li class="list-inline-item">
                                <a class="btn search-btn" id="request_to_chat">Request to Chat</a>
                                <button type="button" class="btn search-btn" data-toggle="modal" data-target="#report" data-whatever="@mdo">Report</button>
                                <div class="modal fade" id="report" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Report</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                @if (session('success'))
                                                    <div class="alert alert-success text-center">
                                                        {{ session('success') }}
                                                    </div>
                                                @endif
                                                <form method="post" id="service-report" autocomplete="off">
                                                    @csrf
{{--                                                    <input type="hidden" name="client_id" value="{{ $single_gig_datas->user_id }}">--}}
{{--                                                    <input type="hidden" name="freelancer_id" value="{{ Auth::user()->id }}">--}}
{{--                                                    <input type="hidden" name="gig_id" value="{{ $single_gig_datas->id }}">--}}
                                                    <div class="form-group">
                                                        <label for="report-message" class="col-form-label">Message:</label>
                                                        <textarea class="form-control" id="report-message" name="message" required></textarea>
                                                    </div>
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn search-btn" value="submit">Report Now</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                        <p>{{ $single_gig_datas->giguserdetails->description }}</p>
                        @endif
                        <hr>
                        <h5 style="text-decoration: underline">Review</h5>
                        @foreach($reviews as $review)
                            <ul class="list-inline">
                                <li class="list-inline-item">
                                    <img height="50px" width="50px" class="rounded-circle" src="{{ asset('assets/img/'.$review->client_details->image) }}" alt="">
                                </li>
                                <li class="list-inline-item">
                                    <h6 style="color: #7ed957">{{ $review->client->name }}</h6>
                                </li>
                                <p class="pl-5">{{ $review->review }}</p>
                            </ul>
                        @endforeach
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="additional-info mt-4">
                        <a href="{{ route('dashboard') }}" class="pb-2">Go Back</a>
                        <div class="gig-additional">
                            <p>
                                <i class="fa fa-product-hunt" aria-hidden="true"></i>
                                Gig Price: <b>${{ $single_gig_datas->price }}</b> </p>
                            <p>
                                <i class="fa fa-clock-o" aria-hidden="true">
                                </i>Delivery Time: <b>
                                    @if($single_gig_datas->delivery_time == 1)
                                    {{ $single_gig_datas->delivery_time }} Day
                                    @else
                                    {{$single_gig_datas->delivery_time}} Days
                                    @endif
                                </b>
                            </p>
                            <p>
                                <i class="fa fa-registered" aria-hidden="true"></i>
                                Rating: <b>{{ number_format($rating, 2)}}</b>/5
                            </p>
                            <p>
                                <i class="fa fa-cart-arrow-down" aria-hidden="true"></i>
                                Ordered: ({{$order}})
                            </p>
                            @if(Auth::user()->Userrole != 2)
                                @if($details)
                                    <button class="btn search-btn btn-block addToCart">Buy Service (${{ $single_gig_datas->price }})</button>
                                @else
                                    Add your details to buy service <a href="{{ route('profile') }}">Click here</a>
                                @endif
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="loading"></div>
    </section>
@endsection

@section('footer_script')
    <script src="{{ asset('assets/js/jquery.validate.js') }}"></script>
    <script>
        var form = $("#service-request");
        var validator = form.validate();

        $(document.body).on('click', '.addToCart', function (e) {
            var gig_id = "{{ $single_gig_datas->id }}";
            var url = '{{ route("add.to.cart", ":id") }}';
            url = url.replace(':id', gig_id);
            $(".loading").show();

            setTimeout(function () {
                $.ajax({
                    method: "GET",
                    url: url,
                    success: function(res) {
                        if(res.data){
                            $( ".loading" ).hide();
                            window.location.reload();
                            // swal("Success...!", "Product added Successfully", "success");
                        }else if(res.data){
                            $( ".loading" ).hide();
                            swal("Oops...!", "something went wrong", "error");
                        }
                    },
                })
            }, 500);
        });

        $(document.body).on('submit', '#service-report', function (e) {
            e.preventDefault();
            var client_id = "{{ Auth::user()->id }}";
            var freelancer_id = "{{ $single_gig_datas->user_id }}";
            var gig_id = "{{ $single_gig_datas->id }}";
            var report_msg = $('#report-message').val();
            var url = "{{ route('gig_report') }}";
            $("#report").modal('hide');
            $(".loading").show();
            setTimeout(function () {
                $.ajax({
                    method: "POST",
                    url: url,
                    data: {
                        _token: "{{ csrf_token() }}",
                        client_id: client_id,
                        freelancer_id: freelancer_id,
                        gig_id: gig_id,
                        report_msg: report_msg
                    },
                    success: function(res) {
                        if(res.data){
                            $( ".loading" ).hide();
                            swal("Success...!", "Reported Successfully, Team will review your report", "success");
                        }else if(res.data){
                            $( ".loading" ).hide();
                            swal("Oops...!", "something went wrong", "error");
                        }
                    },
                })
            }, 500);
        });

        $(document.body).on('click', '#request_to_chat', function (e) {
            var client_id = "{{ Auth::user()->id }}";
            var freelancer_id = "{{ $single_gig_datas->user_id }}";
            var url = "{{ route('chat_request') }}";
            $(".loading").show();
            setTimeout(function () {
                $.ajax({
                    method: "POST",
                    url: url,
                    data: {
                        _token: "{{ csrf_token() }}",
                        client_id: client_id,
                        freelancer_id: freelancer_id,
                    },
                    success: function(res) {
                        if(res.data){
                            $( ".loading" ).hide();
                            swal("Success...!", "Request send Successfully & Go to message menu", "success");
                        }
                        if (res.error){
                            $( ".loading" ).hide();
                            swal("Oops...!", "Already in Chat List", "error");
                        }
                    },
                })
            }, 500);
        });
    </script>
@endsection
