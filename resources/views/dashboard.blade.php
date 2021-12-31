@extends('layouts.front-layout.front_layout')

@section('header_script')
@endsection

@section('content')
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
                                Add Your details to create gig <a href="{{ route('profile') }}">Click here</a>
                            </div>
                        @endif
                    @endif
                </div>
                @if(Auth::user()->userrole == 2)
                    <table class="table">
                        <thead>
                        <tr class="text-center">
                            <th scope="col">#</th>
                            <th scope="col">Title</th>
                            <th scope="col">Image</th>
                            <th scope="col">Price</th>
                            <th scope="col">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $i=0
                        ?>
                        @foreach($gigs as $gig)
                            <?php
                            $i++
                            ?>
                            <tr>
                                <th class="align-middle text-center " scope="row">{{ $i }}</th>
                                <td class="align-middle text-center title">
                                    <a href="{{ url('single/gig/view/'.$gig->id) }}">
                                        {{ \Illuminate\Support\Str::limit($gig->title, 20, $end='...') }}
                                    </a>
                                </td>
                                <td class="align-middle text-center">
                                    <img height="80px" width="80px" src="{{ asset('assets/img/gig/'. $gig->image) }}" alt="">
                                </td>
                                <td class="align-middle text-center">${{ $gig->price }}</td>
                                <td class="align-middle text-center">
                                    @if($gig->status == 1)
                                        <button class="btn btn-primary gig-inactive" gig-id="{{ $gig->id }}">Inactive</button>
                                    @else
                                        <button class="btn btn-primary gig-active" gig-id="{{ $gig->id }}">Active</button>
                                    @endif
                                    <a href="{{ url('/edit/gig/view/'.$gig->id) }}" class="btn search-btn">Edit</a>
                                    <button class="btn btn-danger gig-delete" gig-id="{{ $gig->id }}">Delete</button>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @elseif(Auth::user()->userrole == 1)
                    <table class="table">
                        <thead>
                            <tr class="text-center">
                                <th scope="col">#</th>
                                <th scope="col">Gig title</th>
                                <th scope="col">Freelancer</th>
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
                                    <td>{{ $order->user->name }}</td>
                                    <td>{{ date_format($order->created_at,"Y-m-d") }}</td>
                                    <td>
                                        @if($order->payment_status == 0)
                                            <a href="" class="btn btn-outline-primary btn-sm">Pay Now</a>
                                        @else
                                            <p class="badge badge-primary">Paid</p>
                                        @endif
                                    </td>
                                    <td>
                                        @if($order->review_status  == 0)
                                            <button class="btn btn-outline-primary btn-sm" data-toggle="modal"
                                                    data-target="#review">Review</button>
                                            <div class="modal fade" id="review" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Review & Rating</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form method="post" action="{{ route('review_rating') }}">
                                                                @csrf
                                                                <input type="hidden" name="freelancer_id" value="{{ $order->user_id }}">
                                                                <input type="hidden" name="client_id" value="{{ Auth::user()->id }}">
                                                                <input type="hidden" name="gig_id" value="{{ $order->gig_id }}">
                                                                <input type="hidden" name="order_id" value="{{ $order->id }}">
                                                                <div class="form-group">
                                                                    <label for="recipient-name" class="col-form-label float-left">Rating</label>
                                                                    <div class="form-group">
                                                                        <select class="form-control form-control-sm" id="rating" name="rating">
                                                                            <option value="1">1</option>
                                                                            <option value="2">2</option>
                                                                            <option value="3">3</option>
                                                                            <option value="4">4</option>
                                                                            <option value="5">5</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="message-text" class="col-form-label float-left">Review</label>
                                                                    <textarea class="form-control" id="message-text" name="review" ></textarea>
                                                                </div>
                                                                <hr>
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-primary" value="submit">Send Review</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @else
                                            <p class="badge badge-primary">Reviewed</p>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>
    <div class="loading"></div>
    <form id="deleteEntity" method="post" novalidate="novalidate"
          action="{{ route('process_gig') }}">
        <div id="deleteModal" class="modal fade bs-example-modal-center" tabindex="-1" role="dialog"
             aria-labelledby="mySmallModalLabel"
             aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-sm">
                @csrf
                <input id="delete_id" type="hidden" name="delete_id" value="">
                <input id="action" type="hidden" name="action" value="delete">
                <div class="modal-content">
                    <div class="modal-body">
                        <p>Are you sure you want to delete this?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" id="deleteConfirm" class="btn btn-primary">Yes</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection

@section('footer_script')
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js" ></script>
    <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap4.min.js" ></script>
    <script>
        $(document.body).on('click', '.gig-active', function (e) {
            var gig_id = $(this).attr('gig-id');
            var url = '{{ route("gig_active", ":id") }}';
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
                        }else if(res.data){
                            $( ".loading" ).hide();
                            swal("Oops...!", "something went wrong", "error");
                        }
                    },
                })
            }, 500);
        });

        $(document.body).on('click', '.gig-inactive', function (e) {
            var gig_id = $(this).attr('gig-id');
            var url = '{{ route("gig_inactive", ":id") }}';
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
                        }else if(res.data){
                            $( ".loading" ).hide();
                            swal("Oops...!", "something went wrong", "error");
                        }
                    },
                })
            }, 500);
        });

        $(function (e) {
            $('#datatable').DataTable();
        });

        //Delete Event
        $('.gig-delete').click(function () {
            $('#deleteModal').modal('show');
            let delete_id = $(this).attr('gig-id');
            $('#delete_id').val(delete_id);
        });

        $("#deleteEntity").submit(function (e) {
            e.preventDefault();
            $('#deleteConfirm').attr('disabled', true);
            var FormData = $(this).serialize();
            $.ajax({
                url: $(this).attr('action'),
                type: "POST",
                data: FormData,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                cache: false,
                processData: false,
                success: function (data) {
                    $('#deleteConfirm').attr('disabled', false);
                    window.location.reload();
                }
            });
        });

    </script>
@endsection
