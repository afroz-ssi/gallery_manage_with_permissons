@extends('../layouts.main')
@section('title', 'Create User ')
@section('content')
    <div class="col-md-9 col-lg-10 ml-md-auto px-0 ms-md-auto">
        <!-- top nav -->
        @include('../layouts.navbar')
        <!-- top nav end -->

        <!-- main content -->
        <main class="p-4 min-vh-100">
            <div class="jumbotron jumbotron-fluid rounded bg-white border-0 shadow-sm border-left px-4">
                <div class="container pb-5">
                    <h2 class="display-4 mb-2 text-primary">Create User</h2>
                    <form method="post" action="{{ route('save_user') }}">
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
                            <label for="pass">User Name</label>
                            <input class="form-control" type="text" name="user_name" id="user_name"
                                placeholder="User Name" required>
                            <small class="text-danger error-text password_error" id="error_user_name"></small>
                        </div>
                        <div class="form-group">
                            <label for="pass">Email </label>
                            <input class="form-control" type="text" name="email" id="email"
                                placeholder="User Email" required>
                            <small class="text-danger error-text email_error" id="error_email"></small>
                        </div>
                        <div class="form-group">
                            <label for="pass">Password</label>
                            <input class="form-control" type="password" name="password" id="password"
                                placeholder="Password" required>
                            <small class="text-danger error-text password_error" id="password_error"></small>
                        </div>

                        <div class="form-group">
                            <label for="pass">Login Status</label>
                            <select class="form-control" name="login_status" id="login_status" required>
                                <option value="1">Active</option>
                                <option value="0">Deactive</option>
                            </select>
                            <small class="text-danger error-text login_staus_error" id="login_status_error"></small>
                        </div>

                        <div class="form-group">
                            <label for="pass">Role</label>
                            <select class="form-control" name="role" id="role" required>
                                <option value="">Assign Role</option>
                                @foreach ($roles as $role)
                                    <option value="{{ $role->id }}">{{ $role->role_name }}</option>
                                @endforeach
                            </select>
                            <small class="text-danger error-text role_error" id="lrole_error"></small>
                        </div><br>
                        <div class="form-group">
                            <button class="btn btn-success btn-lg" type="submit" id="create_role">Create User</button>
                        </div>
                    </form>
                </div>
            </div>
        </main>

    </div>
@endsection
