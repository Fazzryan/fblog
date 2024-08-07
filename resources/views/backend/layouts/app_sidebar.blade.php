<aside class="left-sidebar" data-sidebarbg="skin6">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar" data-sidebarbg="skin6">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('be.dashboard') }}" aria-expanded="false">
                        <i data-feather="layout" class="feather-icon"></i>
                        <span class="hide-menu">Dashboard</span>
                    </a>
                </li>
                <li class="list-divider"></li>
                <li class="nav-small-cap">
                    <span class="hide-menu">Applications</span>
                </li>

                <li
                    class="sidebar-item {{ Route::currentRouteNamed('be.postingan.add') || Route::currentRouteNamed('be.postingan.edit') ? 'selected' : '' }}">
                    <a class="sidebar-link" href="{{ route('be.postingan.list') }}" aria-expanded="false">
                        <i data-feather="layers" class="feather-icon"></i>
                        <span class="hide-menu">Postingan </span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('be.kategori.list') }}" aria-expanded="false">
                        <i data-feather="package" class="feather-icon"></i>
                        <span class="hide-menu">Kategori</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('be.pesan.list') }}" aria-expanded="false">
                        <i data-feather="message-circle" class="feather-icon"></i>
                        <span class="hide-menu">Pesan</span>
                    </a>
                </li>
                <li class="list-divider"></li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('auth.act_logout') }}" aria-expanded="false">
                        <i data-feather="log-out" class="feather-icon"></i>
                        <span class="hide-menu">Logout</span>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>
