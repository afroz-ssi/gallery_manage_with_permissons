@extends('../layouts.main')
@section('title', 'User Dashboard')
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

                        <div class="col-md-6 col-lg-12">
                            <article class="p-4 rounded shadow-sm border-left mb-4">
                                <a href="#" class="d-flex align-items-center">
                                    <span class="bi bi-person-check h5"></span>
                                    <h1 class="ml-2">Welcome <span>{{ auth()->user()->name }}</span></h1>
                                </a>
                            </article>
                        </div>
                    </section>
                </div>
            </div>
        </main>

    </div>
@endsection
