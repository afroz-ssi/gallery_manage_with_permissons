@extends('../layouts.main')
@section('title', 'All Gallery')


@section('content')
    <div class="col-md-9 col-lg-10 ml-md-auto px-0 ms-md-auto">
        <!-- top nav -->
        @include('../layouts.navbar')
        <!-- top nav end -->

        <!-- main content -->
        <main class="p-4 min-vh-100">
            <div class="jumbotron jumbotron-fluid rounded bg-white border-0 shadow-sm border-left px-4">
                <div class="container pb-5">
                    <h2 class="display-4 mb-2 text-info">Gallery Lists</h2>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Gallery Name</th>
                                <th>Creation Time</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($galleries as $g)
                                <tr>
                                    <td>
                                        <a href="{{ route('showgalleries', ['id' => $g->id]) }}" data-toggle="tooltip"
                                            data-placement="top" title="View gallery">
                                            {{ $g->gallery_name }}
                                        </a>
                                    </td>
                                    <td>{{ $g->created_at->format('d-m-Y') }}</td>
                                    <td><button class="btn btn-success">Delete</button></td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>

                </div>
            </div>
        </main>

    </div>
@endsection
