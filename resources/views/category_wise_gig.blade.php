@extends('layouts.front-layout.front_layout')

@section('header_script')
@endsection


@section('content')
    <section id="category">
        <div class="container">
            <h4 class="pt-3 text-center"><p>@if($breadcumb){{ $breadcumb }} @endif</p></h4>
            <ul class="list-inline">
                <li class="list-inline-item">
                    <div class="form-group">
                        <select class="form-control form-control-sm" id="delivery_id" name="delivery_time">
                            <option selected disabled>Delivery Time</option>
                            <option value="1">1 Day</option>
                            <option value="3">Up to 3 Days</option>
                            <option value="7">Up to 7 Days</option>
                        </select>
                    </div>
                </li>
                <li class="list-inline-item">
                    <div class="form-group">
                        <form class="form-inline" method="get" id="min_max_search">
                            <input type="hidden" name="cat_id" id="cat_id" value="{{ $cat_id }}">
                            <input type="hidden" name="sub_cat_id" id="sub_cat_id" value="{{ $sub_cat_id }}">
                            <div class="form-group">
                                <input style="width: 60px" type="text" class="form-control form-control-sm" name="min" id="min" value="0" placeholder="Min">
                            </div>
                            <div class="form-group mx-sm-2">
                                <input style="width: 60px" type="text" class="form-control form-control-sm" id="max" name="max" placeholder="Max">
                            </div>
                            <button type="submit" class="btn search-btn btn-sm " value="submit">Budget</button>
                        </form>
                    </div>
                </li>
{{--                <li class="list-inline-item">--}}
{{--                    <div class="custom-control custom-switch">--}}
{{--                        <input type="checkbox" class="custom-control-input" id="local_seller" name="local_seller">--}}
{{--                        <label class="custom-control-label" for="local_seller">Local Seller</label>--}}
{{--                    </div>--}}
{{--                </li>--}}
            </ul>
            <div class="row" id="search_cat">
                @foreach($gigs as $gig)
                <div class="col-md-3" id="gig_search">
                    <div class="category-single-gig">
                        <a href="{{ url('/single/gig/view/'.$gig->id) }}">
                            <img width="100%" src="{{ asset('assets/img/gig/'.$gig->image) }}" alt="">
                            <h6 class="pt-2 pb-2">{{ \Illuminate\Support\Str::limit($gig->title, 20, $end='...') }}</h6>
                        </a>
                        Seller Name: <b>{{ $gig->giguser->name }}</b><br>
                        <i class="fa fa-product-hunt" aria-hidden="true"></i>
                        Gig Price: <b>${{ $gig->price }}</b><br>
                        <i class="fa fa-clock-o" aria-hidden="true">
                        </i>Delivery Time: <b>
                            @if($gig->delivery_time > 1)
                                {{ $gig->delivery_time }} Days
                            @else
                                {{$gig->delivery_time}} Day
                            @endif
                        </b>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    <div class="loading"></div>
@endsection


@section('footer_script')
    <script>
        $(document.body).on('change', '#delivery_id', function (e) {
            let delivery_id = $('#delivery_id').val();
            let cat_id = "{{ $cat_id }}";
            let sub_cat_id = "{{ $sub_cat_id }}";
            var url = '{{ route("delivery_time") }}';
            $(".loading").show();
            setTimeout(function () {
                $.ajax({
                    method: "GET",
                    url: url,
                    data:{
                        delivery_id: delivery_id,
                        cat_id: cat_id,
                        sub_cat_id: sub_cat_id
                    },
                    //dataType: 'json',
                    success: function(response) {
                        if (response.data){
                            $( ".loading" ).hide();
                            var resultData = response.data

                            if (resultData.length > 0){
                                $('#search_cat').html("");
                                $.each(resultData, function (key, item) {
                                    var title = jQuery.trim(item.title).substring(0, 30)
                                        .split(" ").slice(0, -1).join(" ") + "...";
                                    $('#search_cat').append(
                                        '<div class="col-md-3">\
                                            <div class="category-single-gig">\
                                                <a href="/single/gig/view/'+ item.id +'">\
                                                    <img width="100%" src="/assets/img/gig/'+ item.image +'" alt="nai">\
                                                    <h6 class="pt-2 pb-2"></h6>'+ title +'</h6><br>\
                                                </a>\
                                                Seller Name:<b>' + item["giguser"].name + '</b><br>\
                                                <i class="fa fa-product-hunt" aria-hidden="true"></i>\
                                                Gig Price: <b>$'+ item.price +'</b><br>\
                                                <i class="fa fa-clock-o" aria-hidden="true">\
                                                </i>Delivery Time: <b>'+ item.delivery_time +' Days </b>\
                                            </div>\
                                        </div>'
                                    );
                                })
                            }else {
                                $('#search_cat').html('Not match any gig with your search');
                            }
                        }
                    },
                })
            }, 1000);
        });

        $(document.body).on('submit', '#min_max_search', function (e) {
            e.preventDefault();

            let min = $('#min').val();
            let max = $('#max').val();
            let cat_id = $('#cat_id').val();
            let sub_cat_id = $('#sub_cat_id').val();
            var url = '{{ route("min_max_search") }}';
            $(".loading").show();
            setTimeout(function () {
                $.ajax({
                    method: "GET",
                    url: url,
                    data:{
                        min: min,
                        max: max,
                        cat_id: cat_id,
                        sub_cat_id: sub_cat_id
                    },
                    //dataType: 'json',
                    success: function(response) {
                        if (response.data){
                            $( ".loading" ).hide();
                            var resultData = response.data

                            if (resultData.length > 0){
                                $('#search_cat').html("");
                                $.each(resultData, function (key, item) {
                                    var title = jQuery.trim(item.title).substring(0, 30)
                                        .split(" ").slice(0, -1).join(" ") + "...";
                                    $('#search_cat').append(
                                        '<div class="col-md-3">\
                                            <div class="category-single-gig">\
                                                <a href="/single/gig/view/'+ item.id +'">\
                                                    <img width="100%" src="/assets/img/gig/'+ item.image +'" alt="nai">\
                                                    <h6 class="pt-2 pb-2"></h6>'+ title +'</h6><br>\
                                                </a>\
                                                Seller Name:<b>' + item["giguser"].name + '</b><br>\
                                                <i class="fa fa-product-hunt" aria-hidden="true"></i>\
                                                Gig Price: <b>$'+ item.price +'</b><br>\
                                                <i class="fa fa-clock-o" aria-hidden="true">\
                                                </i>Delivery Time: <b>'+ item.delivery_time +' Days </b>\
                                            </div>\
                                        </div>'
                                    );
                                })
                            }else {
                                $('#search_cat').html('Not match any gig with your search');
                            }
                        }
                    },
                })
            }, 1000);
        });

        {{--$(document.body).on('change', '#local_seller', function (e) {--}}
        {{--    if($(this).is(":checked")) {--}}
        {{--        let local_seller = "{{ Auth::user()->details->country }}";--}}
        {{--        let cat_id = "{{ $cat_id }}";--}}
        {{--        let sub_cat_id = "{{ $sub_cat_id }}";--}}
        {{--        var url = '{{ route("local_seller") }}';--}}
        {{--        $(".loading").show();--}}
        {{--        setTimeout(function () {--}}
        {{--            $.ajax({--}}
        {{--                method: "GET",--}}
        {{--                url: url,--}}
        {{--                data:{--}}
        {{--                    local_seller: local_seller,--}}
        {{--                    cat_id: cat_id,--}}
        {{--                    sub_cat_id: sub_cat_id--}}
        {{--                },--}}
        {{--                //dataType: 'json',--}}
        {{--                success: function(response) {--}}
        {{--                    if (response.data){--}}
        {{--                        $( ".loading" ).hide();--}}
        {{--                        var resultData = response.data--}}

        {{--                        if (resultData.length > 0){--}}
        {{--                            $('#search_cat').html("");--}}
        {{--                            $.each(resultData, function (key, item) {--}}
        {{--                                var title = jQuery.trim(item.title).substring(0, 30)--}}
        {{--                                    .split(" ").slice(0, -1).join(" ") + "...";--}}
        {{--                                $('#search_cat').append(--}}
        {{--                                    '<div class="col-md-3">\--}}
        {{--                                        <div class="category-single-gig">\--}}
        {{--                                            <a href="/single/gig/view/'+ item.id +'">\--}}
        {{--                                            <img width="100%" src="/assets/img/gig/'+ item.image +'" alt="nai">\--}}
        {{--                                            <h6 class="pt-2 pb-2"></h6>'+ title +'</h6><br>\--}}
        {{--                                        </a>\--}}
        {{--                                        Seller Name:<b>' + item["giguser"].name + '</b><br>\--}}
        {{--                                        <i class="fa fa-product-hunt" aria-hidden="true"></i>\--}}
        {{--                                        Gig Price: <b>$'+ item.price +'</b><br>\--}}
        {{--                                        <i class="fa fa-clock-o" aria-hidden="true">\--}}
        {{--                                        </i>Delivery Time: <b>'+ item.delivery_time +' Days </b>\--}}
        {{--                                    </div>\--}}
        {{--                                </div>'--}}
        {{--                                );--}}
        {{--                            })--}}
        {{--                        }else {--}}
        {{--                            $('#search_cat').html('Not match any gig with your search');--}}
        {{--                        }--}}
        {{--                    }--}}
        {{--                },--}}
        {{--            })--}}
        {{--        }, 1000);--}}
        {{--    }--}}
        {{--});--}}
    </script>
@endsection
