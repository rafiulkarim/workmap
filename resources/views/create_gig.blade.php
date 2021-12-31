@extends('layouts.front-layout.front_layout')

@section('header_script')
@endsection

@section('content')
    <section id="create-gig">
        <div class="container">
            <div class="row mt-4">
                <div class="col-md-2"></div>
                <div class="col-md-8 create-gig p-4">
                    @if (session('danger'))
                        <div class="alert alert-danger text-center">
                            {{ session('danger') }}
                        </div>
                    @endif
                    @if (session('success'))
                        <div class="alert alert-success text-center">
                            {{ session('success') }}
                        </div>
                    @endif
                    <form action="{{ route('process_gig') }}" method="post" id="create_gig" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="action" value="create">
                        <div class="form-group">
                            <label for="title">Gig Title</label>
                            <input type="text" class="form-control form-control-sm" id="title" placeholder="Enter Title" name="title" required>
                        </div>
                        <div class="form-group">
                            <textarea id="editor" placeholder="Write down the gig description" name="description" required></textarea>
                            <label id="editor-error" class="error" for="editor"></label>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="title">Service Price</label>
                                    <input type="text" class="form-control form-control-sm" id="price" placeholder="Enter Price" name="price" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="title">Delivery time</label>
                                    <input type="text" class="form-control form-control-sm" id="time" placeholder="Enter Delivery Time " name="time" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="category">Select Gig Category</label>
                                    <select class="form-control form-control-sm" id="category" name="category" required>
                                        <option value="" selected disabled>-- Select One --</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="sub_cat">Select Gig Sub-Category</label>
                                    <select class="form-control form-control-sm" id="sub_cat" name="sub_cat" required>
                                        <option selected disabled>Select</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="image">Gig Image</label>
                                    <input type="file" class="form-control-file form-control-sm" id="image" name="image" required>
                                </div>
                            </div>
                        </div>
                        <button class="btn search-btn" value="submit" type="submit">Submit</button>
                    </form>
                </div>
                <div class="col-md-2"></div>
            </div>
        </div>
    </section>
@endsection

@section('footer_script')
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script src="{{ asset('assets/js/jquery.validate.js') }}"></script>
    <script>
        tinymce.init({
            selector: 'textarea#editor',
            menubar: false
        });
    </script>
    <script>
        var form = $("#create_gig");
        var validator = form.validate();

        $(document.body).on('change', '#category', function (e) {
            let category = $(this).val();
            var url = '{{ route("sub_cat", ":id") }}';
            url = url.replace(':id', category );
            $.ajax({
                type: "GET",
                url: url,
                success: function (response) {
                    $('#sub_cat').html(response);
                }
            });
        });

    </script>
@endsection
