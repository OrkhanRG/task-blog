<nav class="sidebar">
    <div class="sidebar-header">
        <a href="#" class="sidebar-brand">
            Noble<span>UI</span>
        </a>
        <div class="sidebar-toggler not-active">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>
    <div class="sidebar-body">
        <ul class="nav">
            <li class="nav-item nav-category">Main</li>
            <li class="nav-item {{ Route::is('admin.index') ? 'active' : '' }}">
                <a href="{{ route('admin.index') }}" class="nav-link">
                    <i class="link-icon" data-feather="box"></i>
                    <span class="link-title">Dashboard</span>
                </a>
            </li>
            <li class="nav-item nav-category">Xəbərlər</li>
            <li class="nav-item {{ Route::is('admin.news.create', 'admin.news.index') ? 'active' : '' }}">
                <a class="nav-link" data-bs-toggle="collapse" href="#news" role="button" aria-expanded="false" aria-controls="emails">
                    <i class="link-icon" data-feather="list"></i>
                    <span class="link-title">Xəbərlər</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse {{ Route::is('admin.news.create', 'admin.news.index') ? 'show' : '' }}" id="news">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="{{ route('admin.news.index') }}" class="nav-link {{ Route::is('admin.news.index') ? 'active' : '' }}">List</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.news.create') }}" class="nav-link {{ Route::is('admin.news.create') ? 'active' : '' }}">Yeni xəbər yarat</a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item {{ Route::is('admin.category.create', 'admin.category.index') ? 'active' : '' }}">
                <a class="nav-link" data-bs-toggle="collapse" href="#categories" role="button" aria-expanded="false" aria-controls="emails">
                    <i class="link-icon" data-feather="list"></i>
                    <span class="link-title">Kateqoriyalar</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse {{ Route::is('admin.category.create', 'admin.category.index') ? 'show' : '' }}" id="categories">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="{{ route('admin.category.index') }}" class="nav-link {{ Route::is('admin.category.index') ? 'active' : '' }}">List</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.category.create') }}" class="nav-link {{ Route::is('admin.category.create') ? 'active' : '' }}">Yeni kateqoriya yarat</a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item {{ Route::is('admin.tag.create', 'admin.tag.index') ? 'active' : '' }}">
                <a class="nav-link" data-bs-toggle="collapse" href="#tags" role="button" aria-expanded="false" aria-controls="emails">
                    <i class="link-icon" data-feather="mail"></i>
                    <span class="link-title">Taglar</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse {{ Route::is('admin.tag.create', 'admin.tag.index') ? 'show' : '' }}" id="tags">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="{{ route('admin.tag.index') }}" class="nav-link {{ Route::is('admin.tag.index') ? 'active' : '' }}">List</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.tag.create') }}" class="nav-link {{ Route::is('admin.tag.create') ? 'active' : '' }}">Yeni tag yarat</a>
                        </li>
                    </ul>
                </div>
            </li>
        </ul>
    </div>
</nav>
