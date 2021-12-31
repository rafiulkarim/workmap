@extends('layouts.adminlayout. frontlayout')

@section('header_script')
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card" >
                <div class="card-header">
                    <h4 class="card-title">Category Table</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table header-border " style="color: #000000">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Sub Category Name</th>
                                <th scope="col">Category Name</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $i = 1; ?>
                            @foreach($sub_categories as $sub_category)
                                <tr>
                                    <th> {{ $i++ }}</th>
                                    <td>{{ $sub_category->name }}</td>
                                    <td>{{ $sub_category->category->name }}</td>
                                    <td>
                                        <button data-id="{{ $sub_category->id }}" class="btn btn-danger remove-category">Delete</button>
                                        <a href="{{ url('/admin/subcategory/'.$sub_category->id) }}" class="btn btn-primary">Edit</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="loading"></div>
@endsection

@section('footer_script')
    <script>
        $(document.body).on('click', '.remove-category', function (e) {
            e.preventDefault();

            let cat_id = $(this).attr('data-id');
            var url = '{{ route("delete_subcategory", ":id") }}';
            url = url.replace(':id', cat_id );
            if(confirm('Are you sure want to delete')){
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
            }else {

            }
        })
    </script>
@endsection
