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
                    <h2 class="display-4 mb-2 text-info">Gallery Lists</h2>
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
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Gallery Name</th>
                                <th>Creation Time</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($galleries) > 0)
                                @foreach ($galleries as $g)
                                    <tr>
                                        <td>
                                            <a href="{{ route('showgalleries', ['id' => $g->id]) }}" data-toggle="tooltip"
                                                data-placement="top" title="View gallery">
                                                {{ $g->gallery_name }}
                                            </a>
                                        </td>
                                        <td>{{ $g->created_at->format('d-m-Y') }}</td>
                                        <td>
                                            <a class="btn btn-success" href="{{ route('showgalleries', ['id' => $g->id]) }}"
                                                data-toggle="tooltip" data-placement="top" title="View gallery">
                                                <i class="fa fa-eye"></i>
                                            </a>
                                            <a class="btn btn-success" href="{{ route('edit_gallery', ['id' => $g->id]) }}"
                                                data-toggle="tooltip" data-placement="top" title="Edit gallery">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="7" class="text-danger text-center">No Records Found!.</td>
                                </tr>
                            @endif

                        </tbody>
                    </table>

                </div>
            </div>
        </main>

    </div>
@endsection
