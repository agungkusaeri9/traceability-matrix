<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item">
            <div class="d-flex sidebar-profile">
                <div class="sidebar-profile-image">
                    <img src="{{ asset('assets') }}/images/faces/face29.png" alt="image">
                    <span class="sidebar-status-indicator"></span>
                </div>
                <div class="sidebar-profile-name">
                    <p class="sidebar-name">
                        {{ auth()->user()->name }}
                    </p>
                    <p class="sidebar-designation">
                        Active
                    </p>
                </div>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('dashboard') }}">
                <i class="typcn typcn-device-desktop menu-icon"></i>
                <span class="menu-title">Dashboard </span>
            </a>
        </li>
        @canany(['Project Index', 'Fitur Index'])
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#m_project" aria-expanded="false"
                    aria-controls="m_project">
                    <i class="typcn typcn-th-small-outline menu-icon"></i>
                    <span class="menu-title">Manajemen Project</span>
                    <i class="typcn typcn-chevron-right menu-arrow"></i>
                </a>
                <div class="collapse" id="m_project">
                    <ul class="nav flex-column sub-menu">
                        @can('Project Index')
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('project.index') }}">Project</a>
                            </li>
                        @endcan
                        @can('Fitur Index')
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('fitur.index') }}">Fitur</a>
                            </li>
                        @endcan
                    </ul>
                </div>
            </li>
        @endcanany
        @can('Bug Report Index')
            <li class="nav-item">
                <a class="nav-link" href="{{ route('bug-report.index') }}">
                    <i class="typcn typcn-warning menu-icon"></i>
                    <span class="menu-title">Bug Report </span>
                </a>
            </li>
        @endcan
        @can('Repository Index')
            <li class="nav-item">
                <a class="nav-link" href="{{ route('repository.index') }}">
                    <i class="typcn typcn-archive menu-icon"></i>
                    <span class="menu-title">Repository </span>
                </a>
            </li>
        @endcan
        @canany(['Role Index', 'Permission Index', 'User Index'])
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
                    <i class="typcn typcn-briefcase menu-icon"></i>
                    <span class="menu-title">Manajemen User</span>
                    <i class="typcn typcn-chevron-right menu-arrow"></i>
                </a>
                <div class="collapse" id="ui-basic">
                    <ul class="nav flex-column sub-menu">
                        @can('Role Index')
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('roles.index') }}">Role</a>
                            </li>
                        @endcan
                        @can('Permission Index')
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('permissions.index') }}">Permission</a>
                            </li>
                        @endcan
                        @can('User Index')
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('users.index') }}">User</a>
                            </li>
                        @endcan
                    </ul>
                </div>
            </li>
        @endcanany
</nav>
