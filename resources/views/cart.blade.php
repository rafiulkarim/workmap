@extends('layouts.front-layout.front_layout')

@section('header_script')
@endsection


@section('content')
    <section id="cart">
        <div class="container">
            <div class="row bg-white m-3">
                <div class="col-md-1"></div>
                <div class="col-md-10">
                    <div class="cart-section ">
                        <h3 class="text-center">Cart</h3>
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">Gig</th>
                                <th scope="col">Price</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Subtotal</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(session('cart'))
                                @foreach(session('cart') as $id => $details)
                                    <tr data-id="{{ $id }}">
                                        <td>
                                            <img src="{{ asset('assets/img/gig/'.$details['image']) }}" alt="" width="80px" height="80px">
                                            {{ \Illuminate\Support\Str::limit($details['title'], 20, $end='...') }}
                                        </td>
                                        <td class="align-middle">${{$details['price']}}</td>
                                        <td class="align-middle">
                                            <input type="number"  class="quantity" style="width: 50px;" name="quantity" min="1" max="10" value="{{ $details['quantity'] }}">
                                        </td>
                                        <td class="align-middle">${{$details['price'] * $details['quantity'] }}</td>
                                        <td class="align-middle">
                                            <a href="" class="remove-from-cart"><i class="fa fa-trash text-danger" aria-hidden="true"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                        <hr>
                        <?php
                            $total = 0;
                            foreach ((array) session('cart') as $id => $details){
                                $total += $details['quantity'] * $details['price'];
                            }
                        ?>
                        <div class="total text-right">
                            <p>Subtotal: ${{ $total }}</p>
                            <h5>Total: ${{ $total }}</h5>
                        </div>
                        <hr>
                        <div class="pb-3 text-right">
                            <button id="place_order" class="btn search-btn">Confirm To Order Place</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-1"></div>
            </div>
        </div>
        <div class="loading"></div>
    </section>
@endsection


@section('footer_script')
    <script>
        $(document.body).on('change', '.quantity', function (e){
            e.preventDefault();
            var ele = $(this);
            $(".loading").show();
            setTimeout(function () {
                $.ajax({
                    method: "patch",
                    url: '{{ route('itemUpdate.cart') }}',
                    data: {
                        _token: '{{ csrf_token() }}',
                        id: ele.parents("tr").attr("data-id"),
                        quantity: ele.parents("tr").find(".quantity").val()
                    },
                    success: function(res) {
                        if(res.data){
                            $( ".loading" ).hide();
                            window.location.reload();
                        }
                    },
                })
            }, 500);
        });

        $(document.body).on('click', '.remove-from-cart', function (e){
            e.preventDefault();
            var ele = $(this);

            if(confirm("Are you sure want to remove?")) {
                $.ajax({
                    method: "delete",
                    url: '{{ route('removeItem.cart') }}',
                    data: {
                        _token: '{{ csrf_token() }}',
                        id: ele.parents("tr").attr("data-id")
                    },
                    success: function(res) {
                        if(res.data){
                            window.location.reload();
                        }
                    },
                })
            }
        });

        var total = "{{ $total }}";
        if(total <= 0){
            $('#place_order').prop("disabled",true);
        }

        $(document.body).on('click', '#place_order', function (e){
            var url = "{{ route('confirmPlaceOrder') }}";
            $(".loading").show();
            setTimeout(function () {
                $.ajax({
                    method: "post",
                    url: url,
                    data: {
                        _token: '{{ csrf_token() }}',
                    },
                    success: function(res) {
                        if(res.data){
                            $( ".loading" ).hide();
                            swal("success...!", "Successfully placed Your Order", "success");
                        }
                    },
                })
            }, 500);

        });
    </script>
@endsection
