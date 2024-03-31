@extends('../layouts.main')
@section('title', 'User Lists ')


@section('content')
    <div class="col-md-9 col-lg-10 ml-md-auto px-0 ms-md-auto">
        <!-- top nav -->
        @include('../layouts.navbar')
        <!-- top nav end -->

        <!-- main content -->
        <main class="p-4 min-vh-100">
            <div class="jumbotron jumbotron-fluid rounded bg-white border-0 shadow-sm border-left px-4">
                <div class="container pb-5">
                    <h2 class="display-4 mb-2 text-info">User Lists</h2>
                    <h3 id="error"></h3>
                    @if (session('error'))
                        <h3>
                            <div class="alert alert-danger alert-dismissible">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                <strong>Error!</strong> <span class="text-white">{{ session('error') }}</span>
                            </div>
                        </h3>
                    @endif
                    @if (session('success'))
                        <h3>
                            <div class="alert alert-success alert-dismissible">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                <strong>Success!</strong> <span class="text-white">{{ session('success') }}</span>
                            </div>
                        </h3>
                    @endif
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Password</th>
                                <th>Roles</th>
                                <th>Login Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($users) > 0)
                                @foreach ($users as $user)
                                    <tr>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>
                                            <input type="password" class="passwordField" id="passwordHideShow"
                                                tabindex="-1" readonly value="{{ $user->view_password }}" disabled
                                                style="border:none !important;">
                                            <i class="fa fa-eye" onclick="togglePassword(this.previousElementSibling)"></i>
                                        </td>
                                        <td>
                                            @if (isset($user->role) && $user->role != null)
                                                <a href="{{ route('role_details') }}"
                                                    title="Role details">{{ $user->role->role_name }}</a>
                                            @endif
                                        </td>
                                        <td>
                                            <span id="user_status_{{ $user->id }}"
                                                data-status="{{ $user->login_status }}">
                                                @if ($user->login_status == 1)
                                                    <span class="badge badge-success">Active</span>
                                                @elseif($user->is_status == 0)
                                                    <span class="badge badge-danger">Inactive</span>
                                                @endif
                                            </span>
                                        </td>
                                        <td>
                                            <a id="btn_status_{{ $user->id }}" data-user-id="{{ $user->id }}"
                                                data-id="{{ $user->login_status }}"
                                                class="admin_act_deact_acc btn btn-xs btn-success">{{ $user->login_status == 1 ? 'Inactive' : 'Active' }}</a>
                                            <a href="{{ route('delte_user', ['id' => $user->id]) }}"
                                                class="btn btn-xs btn-danger"><i class="fa fa-trash"></i> </a>
                                            <a href="{{ route('edit_user', ['id' => $user->id]) }}"
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
