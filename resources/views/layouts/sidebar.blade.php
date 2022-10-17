<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Project Manajer</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="index.html">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Users
            </div>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('list-user') }}">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Daftar User</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('roles.index') }}">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Daftar Role</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('proyek-type.index') }}">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Daftar Project Type</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('proyek.index') }}">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Daftar Proyek</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Type Proyek</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">List Type</h6>
                        <a class="collapse-item" href="buttons.html">Proyek bulanan</a>
                        <a class="collapse-item" href="cards.html">Graphic Design</a>
                    </div>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('task.index') }}">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>List Task</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="charts.html">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Laporan</span></a>
            </li>
            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>
        </ul>