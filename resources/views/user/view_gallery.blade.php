@extends('../layouts.main')
@section('title', 'Create role ')


@section('content')
    <div class="col-md-9 col-lg-10 ml-md-auto px-0 ms-md-auto">
        <!-- top nav -->
        @include('../layouts.navbar')
        <!-- top nav end -->

        <!-- main content -->
        <main class="p-4 min-vh-100">
            <div class="jumbotron jumbotron-fluid rounded bg-white border-0 shadow-sm border-left px-4">
                <div class="container pb-5">
                    <a href="{{ route('galleries') }}" class="btn btn-success">
                        <i class="fa fa-backward"></i> Back</a>
                    <h2 class="display-4 mb-2 text-info">Gallery Lists </h2>
                    <div class="row">
                        @foreach ($gallery->gallery_img as $key => $g)
                            <div class="col-md-3 image-container" id="lightGallery">
                                <a class="px-5" href="{{ asset($g) }}" data-fancybox="group"
                                    data-caption="Image {{ $key + 1 }}">
                                    <img src="{{ asset($g) }}" style="width:280px;" />
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </main>

    </div>
    <form id="delteImg" method="post">
        @csrf
        @method('DELETE');
    </form>
@endsection
