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
                        <form class="form-inline">
                            <div class="form-group">
                                <input style="width: 60px" type="text" class="form-control form-control-sm" name="min" id="min" value="0" placeholder="Min">
                            </div>
                            <div class="form-group mx-sm-2">
                                <input style="width: 60px" type="text" class="form-control form-control-sm" id="max" name="max" placeholder="Max">
                            </div>
                            <button type="submit" class="btn search-btn btn-sm ">Budget</button>
                        </form>
                    </div>
                </li>
                <li class="list-inline-item">
                    <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input" id="customSwitch1">
                        <label class="custom-control-label" for="customSwitch1">Local Seller</label>
                    </div>
                </li>
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
            let sub_Cat_id = "{{ $sub_cat_id }}";
            console.log(cat_id);
            console.log(sub_Cat_id);
            {{--var url = '{{ route("delivery_time") }}';--}}
            {{--$(".loading").show();--}}
            {{--setTimeout(function () {--}}
            {{--    $.ajax({--}}
            {{--        method: "GET",--}}
            {{--        url: url,--}}
            {{--        data:{--}}
            {{--            delivery_id: delivery_id,--}}
            {{--            cat_id: cat_id--}}
            {{--        },--}}
            {{--        //dataType: 'json',--}}
            {{--        success: function(response) {--}}
            {{--            if (response.data){--}}
            {{--                $( ".loading" ).hide();--}}
            {{--                var resultData = response.data--}}

            {{--                if (resultData.length > 0){--}}
            {{--                    $('#search_cat').html("");--}}
            {{--                    $.each(resultData, function (key, item) {--}}
            {{--                        var title = jQuery.trim(item.title).substring(0, 10)--}}
            {{--                            .split(" ").slice(0, -1).join(" ") + "...";--}}
            {{--                        $('#search_cat').append(--}}
            {{--                            '<div class="col-md-3">\--}}
            {{--                                <div class="category-single-gig">\--}}
            {{--                                    <a href="/single/gig/view/'+ item.id +'">\--}}
            {{--                                        <img width="100%" src="/assets/img/gig/'+ item.image +'" alt="nai">\--}}
            {{--                                        <h6 class="pt-2 pb-2"></h6>'+ title +'</h6>\--}}
            {{--                                    </a>\--}}
            {{--                                    Seller Name:<b>' + item["giguser"].name + '</b><br>\--}}
            {{--                                    <i class="fa fa-product-hunt" aria-hidden="true"></i>\--}}
            {{--                                    Gig Price: <b>$'+ item.price +'</b><br>\--}}
            {{--                                    <i class="fa fa-clock-o" aria-hidden="true">\--}}
            {{--                                    </i>Delivery Time: <b>'+ item.delivery_time +' Days </b>\--}}
            {{--                                </div>\--}}
            {{--                            </div>'--}}
            {{--                        );--}}
            {{--                    })--}}
            {{--                }else {--}}
            {{--                    $('#search_cat').html('Not match any gig with your search');--}}
            {{--                }--}}
            {{--            }--}}
            {{--        },--}}
            {{--    })--}}
            {{--}, 1000);--}}
        });
    </script>
@endsection
