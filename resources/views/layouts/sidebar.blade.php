 <!-- sidebar -->
 <div class="col-md-3 col-lg-2 px-0 position-fixed h-100 bg-white shadow-sm sidebar" id="sidebar">
     <h1 class="bi bi-bootstrap text-primary d-flex my-4 justify-content-center"></h1>
     <div class="list-group rounded-0">
         @if ($admin = auth('admin')->user())
             <a href="{{ route('admin_dash') }}"
                 class="list-group-item list-group-item-action 
         {{ Route::currentRouteName() === 'admin_dash' ? 'active' : '' }}
          border-0 d-flex align-items-center">
                 <span class="bi bi-border-all"></span>
                 <span class="ml-2">Dashboard</span>
             </a>


             <a href="{{ route('create_role_pg') }}"
                 class="list-group-item list-group-item-action 
         {{ Route::currentRouteName() === 'create_role_pg' ? 'active' : '' }}
          border-0 d-flex align-items-center">
                 <span class="bi bi-border-all"></span>
                 <span class="ml-2">Create Role</span>
             </a>
             <a href="{{ route('role_details') }}"
                 class="list-group-item list-group-item-action 
         {{ Route::currentRouteName() === 'role_details' ? 'active' : '' }}
          border-0 d-flex align-items-center">
                 <span class="bi bi-border-all"></span>
                 <span class="ml-2"> Role Details</span>
             </a>

             <a href="{{ route('create_user_pg') }}"
                 class="list-group-item list-group-item-action 
         {{ Route::currentRouteName() === 'create_user_pg' ? 'active' : '' }}
          border-0 d-flex align-items-center">
                 <span class="bi bi-border-all"></span>
                 <span class="ml-2">Create User</span>
             </a>
             <a href="{{ route('userists') }}"
                 class="list-group-item list-group-item-action 
         {{ Route::currentRouteName() === 'userists' ? 'active' : '' }}
          border-0 d-flex align-items-center">
                 <span class="bi bi-border-all"></span>
                 <span class="ml-2"> Users</span>
             </a>

             {{-- <a href="{{ route('galleries_list') }}"
                 class="list-group-item list-group-item-action 
         {{ Route::currentRouteName() === 'galleries_list' ? 'active' : '' }}
          border-0 d-flex align-items-center">
                 <span class="bi bi-border-all"></span>
                 <span class="ml-2"> Galleries</span>
             </a> --}}
         @else
             <a href="{{ route('user_dash') }}"
                 class="list-group-item list-group-item-action 
         {{ Route::currentRouteName() === 'user_dash' ? 'active' : '' }}
          border-0 d-flex align-items-center">
                 <span class="bi bi-border-all"></span>
                 <span class="ml-2">Dashboard</span>
             </a>


             <a href="{{ route('create_gallery') }}"
                 class="list-group-item list-group-item-action 
         {{ Route::currentRouteName() === 'create_gallery' ? 'active' : '' }}
          border-0 d-flex align-items-center">
                 <span class="bi bi-border-all"></span>
                 <span class="ml-2"> Create Gallery</span>
             </a>

             <a href="{{ route('galleries') }}"
                 class="list-group-item list-group-item-action 
         {{ Route::currentRouteName() === 'galleries' ? 'active' : '' }}
          border-0 d-flex align-items-center">
                 <span class="bi bi-border-all"></span>
                 <span class="ml-2">Gallery List</span>
             </a>
         @endif





         <div class="collapse" id="purchase-collapse" data-parent="#sidebar">
             <div class="list-group">
                 <a href="#" class="list-group-item list-group-item-action border-0 pl-5">Sellers</a>
                 <a href="#" class="list-group-item list-group-item-action border-0 pl-5">Purchases</a>
             </div>
         </div>
     </div>
 </div>
 <!-- sidebar end here-->
