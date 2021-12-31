@extends('layouts.front-layout.front_layout')

@section('header_script')
@endsection


@section('content')
    <section id="profile">
        <div class="container">
            <div class="row bg-white mt-3">
                @if($userDetails)
                    <div class="col-md-3"></div>
                    <div class="col-md-6 pt-3 pb-3">
                        <h3 class="text-center"> About Yourself </h3>
                        <div style="border: 3px solid #7ed957; padding: 10px;">
                            <form action="{{ route('save_profile') }}" method="post" id="edit_profile" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="action" value="edit">
                                <div class="form-group">
                                    <label for="state">State</label>
                                    <input class="form-control form-control-sm" type="text" placeholder="Enter State ( Example Dhaka )"
                                           id="state" name="state" value="{{ $userDetails->State }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="country">Country</label>
                                    <input class="form-control form-control-sm" type="text" placeholder="Enter country"
                                           id="country" name="country" value="{{ $userDetails->country }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea class="form-control" id="description" rows="3" name="description" required>
                                        {{ $userDetails->description }}
                                    </textarea>
                                </div>
                                <div class="form-group">
                                    <label for="image">Profile Image</label>
                                    <input type="file" class="form-control-file" id="image" name="image" required>
                                </div>
                                <button class="btn search-btn" type="submit" value="submit">Submit</button>
                            </form>
                        </div>
                    </div>
                    <div class="col-md-3"></div>
                @else
                    <div class="col-md-3"></div>
                    <div class="col-md-6 pt-3 pb-3">
                        <h3 class="text-center"> About Yourself </h3>
                        <div style="border: 3px solid #7ed957; padding: 10px;">
                            <form action="{{ route('save_profile') }}" method="post" id="save_profile" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="action" value="save">
                                <div class="form-group">
                                    <label for="state">State</label>
                                    <input class="form-control form-control-sm" type="text" placeholder="Enter State ( Example Dhaka )"
                                           id="state" name="state" required>
                                </div>
                                <div class="form-group">
                                    <label for="country">Country</label>
                                    <input class="form-control form-control-sm" type="text" placeholder="Enter country"
                                           id="country" name="country" required>
                                </div>
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea class="form-control" id="description" rows="3" name="description" required>
                                    </textarea>
                                    <label id="description-error" class="error" for="description"></label>
                                </div>
                                <div class="form-group">
                                    <label for="image">Profile Image</label>
                                    <input type="file" class="form-control-file" id="image" name="image" required>
                                </div>
                                <button class="btn search-btn" type="submit" value="submit">Submit</button>
                            </form>
                        </div>
                    </div>
                    <div class="col-md-3"></div>
                @endif

            </div>
        </div>
    </section>
@endsection


@section('footer_script')
    <script src="{{ asset('assets/js/jquery.validate.js') }}"></script>
    <script>
        var edit_form = $("#edit_profile");
        var validate = edit_form.validate();

        var form = $("#save_profile");
        var validator = form.validate();
    </script>
@endsection
