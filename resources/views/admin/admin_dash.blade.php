@extends('../layouts.main')
@section('title', 'Admin Dashboard')
@section('content')
    <div class="col-md-9 col-lg-10 ml-md-auto px-0 ms-md-auto">
        <!-- top nav -->
        @include('../layouts.navbar')
        <!-- top nav end -->

        <!-- main content -->
        <main class="p-4 min-vh-100">
            <div class="jumbotron jumbotron-fluid rounded bg-white border-0 shadow-sm border-left px-4">
                <div class="container pb-5">
                    <section class="row">
                        <h2>Welcome <span class="text-capitalize">{{ auth('admin')->user()->username }}</span></h2>
                        <div class="col-md-6 col-lg-4 border-1 shadow-sm border-left px-4">
                            <!-- card -->
                            <article class="p-4 rounded shadow-sm border-left mb-4">
                                <a href="{{ route('role_details') }}" class="d-flex align-items-center">
                                    <span class="bi bi-box h5"></span>
                                    <h5 class="ml-2">Total Role {{ $roleCount }}</h5>
                                </a>
                            </article>
                        </div>
                        <div class="col-md-2 col-lg-2"></div>

                        <div class="col-md-6 col-lg-4 shadow-sm">
                            <article class="p-4 rounded shadow-sm border-left mb-4">
                                <a href="{{ route('userists') }}" class="d-flex align-items-center">
                                    <span class="bi bi-person h5"></span>
                                    <h5 class="ml-2">Total Users {{ $userCount }}</h5>
                                </a>
                            </article>
                        </div>
                        {{-- <div class="col-md-6 col-lg-4">
                            <article class="p-4 rounded shadow-sm border-left mb-4">
                                <a href="{{ route('role_details') }}" class="d-flex align-items-center">
                                    <span class="bi bi-person-check h5"></span>
                                    <h5 class="ml-2">Total Galleries {{ $galleryCount }}</h5>
                                </a>
                            </article>
                        </div> --}}
                        <div class="col-md-2 col-lg-2"></div>

                    </section>
                </div>
            </div>
        </main>

    </div>
@endsection
