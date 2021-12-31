@extends('layouts.front-layout.front_layout')

@section('header_script')
@endsection

@section('content')
    <section id="checkout">
        <div class="container">
            <div class="row mt-2 bg-white pt-4 pb-4">
                <div class="col-md-9">
                    <div class="row">
                        <div class="col-md-4">
                            <img width="100%" src="{{ asset('assets/img/gig/'.$gig->image) }}" alt="">
                        </div>
                        <div class="col-md-8">
                            <h6>{{ $gig->title }}</h6>
                            <h6>Rating: <b>5/5</b></h6>
                            <div class="form-group">
                                <label for="qty">Quantity</label>
                                <select class="form-control form-control-sm" style="box-sizing: border-box; width: 60px;"
                                        id="qty" name="qty">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                    <option value="9">9</option>
                                    <option value="10">10</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div style="border: 2px solid #7ed957; padding: 5px;">
                        Subtotal: <b  class="float-right subtotal" id="subtotal">${{ $gig->price }}</b><br>
                        <hr>
                        Total: <b  class="float-right" id="total">${{ $gig->price }}</b><br>
                        @if($gig->delivery_time > 1)
                            Delivery Time: <b class="float-right">{{ $gig->delivery_time }} days</b>
                        @else
                            Delivery Time: <b class="float-right">{{ $gig->delivery_time }} day</b>
                        @endif
                        <div class="pt-3">
                            <button class="btn search-btn btn-block" id="checkout">Checkout</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('footer_script')
    <script>
        $(document).on('change', '#qty', function (e) {
            e.preventDefault();

            var price = "{{ $gig->price }}";
            var qty = $('#qty').val();
            url = "{{ route('checkout_change') }}";
            $.ajax({
                method: "GET",
                url: url,
                data: {
                    _token: '{{ csrf_token() }}',
                    price: price,
                    qty: qty
                },
                success: function(res) {
                    $('#subtotal').html(res);
                },
            })
        });
        // $(document).on('click', '#checkout', function (e) {
        //     console.log("comes");
        //     var a = $(this).attr('data');
        //     console.log(a);
        // });
    </script>
@endsection
