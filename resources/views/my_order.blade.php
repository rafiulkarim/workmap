@extends('layouts.front-layout.front_layout')

@section('header_script')
@endsection

@section('content')
    <section id="my-order">
        <div class="container">
            <div class="row pt-3">
                <div class="col-md-3 gig-profile" style="min-height: 250px">
                    @if($details)
                        <img src="{{ asset('assets/img/'.Auth::user()->details->image) }}" height="100px" width="100px" class="rounded-circle" alt="">
                    @else
                        <img src="{{ asset('assets/img/profile.jpeg') }}" height="100px" width="100px" class="rounded-circle" alt="">
                    @endif
                    <h4>{{ Auth::user()->name }}</h4>
                    @if($details)
                        <p>{{ $details->description }}</p>
                    @else
                        Add your description <a href="{{ route('profile') }}">Click here</a>
                    @endif
                </div>
                <div class="col-md-8 dashboard-gig">
                    <div class="pb-2 text-right">
                        @if(Auth::user()->userrole == 1)
                            @if(!$details)
                                <div class="alert alert-danger">
                                    Add Your details to buy service <a href="{{ route('profile') }}">Click here</a>
                                </div>
                            @endif
                        @elseif(Auth::user()->userrole != 1)
                            @if($details)
                                <a href="{{ route('create_gig') }}" class="btn search-btn"> + Create Gig</a>
                            @else
                                <div class="alert alert-danger">
                                    Add Your details to create gig <a href="">Click here</a>
                                </div>
                            @endif
                        @endif
                    </div>
                    <table class="table">
                        <thead>
                        <tr class="text-center">
                            <th scope="col">#</th>
                            <th scope="col">Gig title</th>
                            <th scope="col">Client</th>
                            <th scope="col">Order Date</th>
                            <th scope="col">Payment Status</th>
                            <th scope="col">Review</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $i = 1; ?>
                        @foreach($orders as $order)
                            <tr class="text-center">
                                <th scope="row">{{ $i++ }}</th>
                                <td>
                                    <a style="color: #0b0b0b; text-decoration: none;"
                                       href="{{ url('/single/gig/view/'.$order->gig_id)  }}">
                                        {{ \Illuminate\Support\Str::limit($order->gig->title, 20, $end='...') }}</a>
                                </td>
                                <td>{{ $order->client->name }}</td>
                                <td>{{ date_format($order->created_at,"Y-m-d") }}</td>
                                <td>
                                    @if($order->payment_status == 0)
                                        <a href="" class="badge badge-danger">Unpaid</a>
                                    @else
                                        <p class="badge badge-primary">Paid</p>
                                    @endif
                                </td>
                                <td>
                                    @if($order->review_status  == 0)
                                        <a href="" class="badge badge-danger">unreviewed</a>
                                    @else
                                        <p class="badge badge-primary">Reviewed</p>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="loading"></div>
    </section>
@endsection

@section('footer_script')
@endsection
