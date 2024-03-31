<nav class="w-100 d-flex justify-content-center px-4 py-2 mb-4 shadow-sm ">
    <!-- close sidebar -->
    <div class=" mt-4">
        <div class="sub_nav" id="logout-dropdown">
            @if ($admin = auth('admin')->user())
                <span class="fa fa-user text-primary text-capitalize h4">
                    {{ $admin->username }}
                </span>
                &nbsp; &nbsp; &nbsp;
                <a href="{{ route('ad_logout') }}">
                    <span class="fa fa-sign-out ml-1 mb-2 small"> Logout</span></a>
            @elseif ($customer = auth()->user())
                <span class="fa fa-user text-primary h4">
                    {{ $customer->name }}
                </span>
                &nbsp; &nbsp; &nbsp;
                <a href="{{ route('u_logout') }}">
                    <span class="fa fa-sign-out ml-1 mb-2 small"> Logout</span></a>
            @endif

        </div>
    </div>

</nav>
