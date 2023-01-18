<div class="main-sidebar sidebar-light-primary elevation-4">
    <!-- Brand Logo -->
    <a href="" class="brand-link">
        <span class="brand-text font-weight-dark">Skills Job Match</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="info">
                <a href="#" class="d-block">{{ auth()->user()->name }}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="{{ route('editor.index') }}" class="nav-link {{ request()->is('editor') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Editor Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('editor.programme.index') }}" class="nav-link {{ request()->is('editor/programmes') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-university"></i>
                        <p>Courses</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('editor.levels.index') }}" class="nav-link {{ request()->is('editor/levels') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-walking"></i>
                        <p>Levels</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('editor.modules.index') }}" class="nav-link {{ request()->is('editor/modules') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-book-reader"></i>
                        <p>Modules</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('editor.practicals.index') }}" class="nav-link {{ request()->is('editor/practicals') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-dumbbell"></i>
                        <p>Practicals</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('editor.skill-categories.index') }}" class="nav-link {{ request()->is('editor/skill-categories') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-border-all"></i>
                        <p>Skill Categories</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('editor.skills.index') }}" class="nav-link {{ request()->is('editor/skills') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-hammer"></i>
                        <p>Skills</p>
                    </a>
                </li>

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</div>
