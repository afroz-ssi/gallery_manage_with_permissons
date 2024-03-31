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
                    <h2 class="display-4 mb-2 text-primary">Create Role</h2>
                    <form method="POST" action="{{ route('create_role') }}">
                        @csrf
                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                <strong>Success!</strong> {{ session('success') }}
                            </div>
                        @endif
                        @if (session('error'))
                            <div class="alert alert-error alert-dismissible">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                <strong>Error!</strong> {{ session('error') }}
                            </div>
                        @endif

                        <div class="form-group">
                            <label for="pass">Role Name</label>
                            <input class="form-control" type="text" name="role_name" id="role_nmae"
                                placeholder="Role Name" required>
                            <small class="text-danger error-text password_error" id="error_role_name"></small>
                        </div>

                        <div class="form-group">
                            <label for="pass">Permission</label>
                            <select class="select form-control" name="permissions[]"
                                style="width:70em; height:45px !important;" multiple multiselect-search="true"
                                multiselect-search-all="true" multiselect-select-all="true" multiselect-max-items="8"
                                required>
                                @foreach ($permissions as $p)
                                    <option value="{{ $p->name }}">{{ $p->name }}</option>
                                @endforeach

                            </select>
                        </div><br>
                        <div class="form-group">
                            <button class="btn btn-success btn-lg" type="submit" id="create_role">Create Role</button>
                        </div>
                    </form>
                </div>
            </div>
        </main>

    </div>

@endsection
