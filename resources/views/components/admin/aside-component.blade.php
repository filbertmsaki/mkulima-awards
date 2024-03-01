   <!-- Main Sidebar Container -->
   <aside class="main-sidebar sidebar-dark-primary elevation-4">
       <!-- Brand Logo -->
       <a href="{{ route('admin.dashboard') }}" class="brand-link">
           <img src="{{ asset('admin/img/AdminLTELogo.png') }}" alt="{{ config('app.name') }} Logo"
               class="brand-image img-circle elevation-3" style="opacity: .8">
           <span class="brand-text font-weight-light">{{ config('app.name') }}</span>
       </a>
       <!-- Sidebar -->
       <div class="sidebar">
           <!-- SidebarSearch Form -->
           <div class="form-inline mt-2">
               <div class="input-group" data-widget="sidebar-search">
                   <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                       aria-label="Search">
                   <div class="input-group-append">
                       <button class="btn btn-sidebar">
                           <i class="fas fa-search fa-fw"></i>
                       </button>
                   </div>
               </div>
           </div>
           <!-- Sidebar Menu -->
           <nav class="mt-2">
               <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                   data-accordion="false">
                   <li class="nav-item ">
                       <a href="{{ route('admin.dashboard') }}"
                           class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                           <i class="nav-icon fas fa-tachometer-alt"></i>
                           <p>
                               Dashboard
                           </p>
                       </a>
                   </li>
                   <li
                       class="nav-item {{ request()->routeIs('admin.award-category.*') ? 'menu-is-opening menu-open' : '' }}">
                       <a href="#"
                           class="nav-link {{ request()->routeIs('admin.award-category.*') ? 'active' : '' }}">
                           <i class="nav-icon fas fa-copy"></i>
                           <p>
                               Awards Categories
                               <i class="fas fa-angle-left right"></i>
                           </p>
                       </a>
                       <ul class="nav nav-treeview">
                           <li class="nav-item">
                               <a href="{{ route('admin.award-category.create') }}"
                                   class="nav-link {{ request()->routeIs('admin.award-category.create') ? 'active' : '' }}">
                                   <i class="far fa-circle nav-icon"></i>
                                   <p>Create Category</p>
                               </a>
                           </li>
                           <li class="nav-item">
                               <a href="{{ route('admin.award-category.index') }}"
                                   class="nav-link {{ request()->routeIs('admin.award-category.index') ? 'active' : '' }}">
                                   <i class="far fa-circle nav-icon"></i>
                                   <p>Categories List</p>
                               </a>
                           </li>
                       </ul>
                   </li>
                   <li
                       class="nav-item {{ request()->routeIs('admin.award-nominee.*') ? 'menu-is-opening menu-open' : '' }}">
                       <a href="#"
                           class="nav-link {{ request()->routeIs('admin.award-nominee.*') ? 'active' : '' }}">
                           <i class="nav-icon fas fa-chart-pie"></i>
                           <p>
                               Award Nominees
                               <i class="right fas fa-angle-left"></i>
                           </p>
                       </a>
                       <ul class="nav nav-treeview">
                           <li class="nav-item">
                               <a href="{{ route('admin.award-nominee.create') }}"
                                   class="nav-link {{ request()->routeIs('admin.award-nominee.create') ? 'active' : '' }}">
                                   <i class="far fa-circle nav-icon"></i>
                                   <p>Create Nominee</p>
                               </a>
                           </li>
                           <li class="nav-item">
                               <a href="{{ route('admin.award-nominee.index') }}"
                                   class="nav-link {{ request()->routeIs('admin.award-nominee.index') ? 'active' : '' }}">
                                   <i class="far fa-circle nav-icon"></i>
                                   <p>Nominees List</p>
                               </a>
                           </li>
                           <li
                               class="nav-item {{ request()->routeIs('admin.award-nominee.show*') ? 'menu-is-opening menu-open' : '' }}">
                               <a href="javascript:void(0)"
                                   class="nav-link {{ request()->routeIs('admin.award-nominee.show*') ? 'active' : '' }}">
                                   <i class="far fa-circle nav-icon"></i>
                                   <p>
                                       Nominees List Per Year
                                       <i class="right fas fa-angle-left"></i>
                                   </p>
                               </a>
                               <ul class="nav nav-treeview">
                                   @foreach (award_years() as $item)
                                       <li class="nav-item">
                                           <a href=""
                                               class="nav-link {{ Request::is('admin/award-nominee/' . $item->year) ? 'active' : '' }}">
                                               <i class="far fa-dot-circle nav-icon"></i>
                                               <p>{{ $item }}</p>
                                           </a>
                                       </li>
                                   @endforeach
                               </ul>
                           </li>
                       </ul>
                   </li>
                   <li
                       class="nav-item {{ request()->routeIs('admin.award-voting.*') ? 'menu-is-opening menu-open' : '' }}">
                       <a href="#"
                           class="nav-link {{ request()->routeIs('admin.award-voting.*') ? 'active' : '' }}">
                           <i class="nav-icon fa fa-vote-yea"></i>
                           <p>
                               Nominees Votes
                               <i class="right fas fa-angle-left"></i>
                           </p>
                       </a>
                       <ul class="nav nav-treeview">
                           @foreach ($vote_years as $vote_year)
                               <li class="nav-item">
                                   <a href="{{ route('admin.award-voting.show', $vote_year->year) }}"
                                       class="nav-link {{ request()->is('admin/award-voting/' . $vote_year->year) ? 'active' : '' }}">
                                       <i class="far fa-circle nav-icon"></i>
                                       <p>{{ $vote_year->year }} - <span class=" badge badge-success">
                                               {{ number_format($vote_year->total_votes, 0, '.', ',') }}</span></p>
                                   </a>
                               </li>
                           @endforeach
                       </ul>
                   </li>
                   <li
                       class="nav-item {{ request()->routeIs('admin.settings.*') ? 'menu-is-opening menu-open' : '' }}">
                       <a href="#" class="nav-link {{ request()->routeIs('admin.settings.*') ? 'active' : '' }}">
                           <i class="nav-icon fas fa-cogs"></i>
                           <p>
                               Settings
                               <i class="right fas fa-angle-left"></i>
                           </p>
                       </a>
                       <ul class="nav nav-treeview">
                           <li class="nav-item">
                               <a href="{{ route('admin.settings.events.index') }}"
                                   class="nav-link {{ request()->routeIs('admin.settings.events.*') ? 'active' : '' }}">
                                   <i class="far fa-circle nav-icon"></i>
                                   <p>Events Settings</p>
                               </a>
                           </li>
                       </ul>
                   </li>
                   <li class="nav-item">
                       <a class="nav-link" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                              document.getElementById('logout-form').submit();">
                           <i class="nav-icon fa fa-sign-out-alt text-info"></i>
                           <p>Logout</p>
                       </a>
                       <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                           @csrf
                       </form>
                   </li>
               </ul>
           </nav>
           <!-- /.sidebar-menu -->
       </div>
       <!-- /.sidebar -->
   </aside>
