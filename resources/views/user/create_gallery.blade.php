@extends('../layouts.main')
@section('title', 'Create Gallery')
@section('content')

    <div class="col-md-9 col-lg-10 ml-md-auto px-0 ms-md-auto">
        <!-- top nav -->
        @include('../layouts.navbar')
        <!-- top nav end -->

        <!-- main content -->
        <main class="p-4 min-vh-100">
            <div class="jumbotron jumbotron-fluid rounded bg-white border-0 shadow-sm border-left px-4">
                <div class="container pb-5">
                    <h2 class="display-4 mb-2 text-primary">Create Gallery</h2>
                    <form method="post" action="{{ route('store_gallery') }}" enctype="multipart/form-data">
                        @csrf
                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                <strong>Success!</strong> {{ session('success') }}
                            </div>
                        @endif
                        @if (session('error'))
                            <h3>
                                <div class="alert alert-error alert-danger alert-dismissible">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <strong>Error!</strong> {{ session('error') }}
                                </div>
                            </h3>
                        @endif

                        <div class="form-group">
                            <label for="pass">Gallery Name</label>
                            <input class="form-control" type="text" name="gallery_name" id="gallery_name"
                                placeholder="User Name" required>
                            <small class="text-danger error-text gallery_name_error" id="error_gallery_name"></small>
                        </div>
                        <div class="form-group">
                            <label for="pass">Gallery Type </label>
                            <input class="form-control" type="text" name="gallery_type" id="gallery_type"
                                placeholder="Gallery Type" required>
                            <small class="text-danger error-text gallery_type_error" id="error_gallery_type"></small>
                        </div>
                        <div class="form-group">
                            <label for="pass">Gallery Image</label>
                            <div class="input-images-1" style="padding-top: 0.5rem"></div>
                            <small class="text-danger error-text error_gallery_image" id="error_gallery_image"></small>
                        </div>
                        <br>
                        <div class="form-group">
                            <button class="btn btn-success btn-lg" type="submit" id="create_role">Create Gallery</button>
                        </div>
                    </form>
                </div>
            </div>
        </main>

    </div>
    <script>
        $(function() {
            $(".input-images-1").imageUploader();
        });

        $(function() {
            $(".material-icons").hide();
        })
    </script>
@endsection
