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
                    <h2 class="display-4 mb-2 text-info">Role Lists</h2>
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <strong>Success!</strong> {{ session('success') }}
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-danger alert-dismissible">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <strong>Error!</strong> {{ session('error') }}
                        </div>
                    @endif
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Permissions</th>
                                <th>Created Time</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($roles) > 0)
                                @foreach ($roles as $role)
                                    <tr>
                                        <td>{{ $role->role_name }}</td>
                                        <td>
                                            @foreach ($role->permissions as $p)
                                                @if ($p != null)
                                                    {{ $p }}
                                                    ,
                                                @endif
                                            @endforeach
                                        </td>
                                        <td>{{ $role->created_at->format('d-m-Y') }}</td>
                                        <td>
                                            <a href="{{ route('delete_role', ['id' => $role->id]) }}"
                                                class="btn btn-xs btn-danger"><i class="fa fa-trash"></i> </a>
                                            <a href="{{ route('edit_role', ['id' => $role->id]) }}"
                                                class="btn btn-xs btn-success"><i class="fa fa-pencil"></i> </a>
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

    {{-- <script>
        $(document).ready(function() {
            $('#multiselect').multiselect({
                buttonWidth: '160px',
                includeSelectAllOption: true,
                nonSelectedText: 'Select an Option'
            });
        });

        function getSelectedValues() {
            var selectedVal = $("#multiselect").val();
            for (var i = 0; i < selectedVal.length; i++) {
                function innerFunc(i) {
                    setTimeout(function() {
                        location.href = selectedVal[i];
                    }, i * 2000);
                }
                innerFunc(i);
            }
        }
    </script> --}}
@endsection
