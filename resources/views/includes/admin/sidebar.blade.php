<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-header">Admin Panel</li>
        <li class="nav-item">
            <a href="{{route('admin.category.index')}}" class="nav-link" id="categories">
                <i class="nav-icon fas fa-align-justify"></i>
                <p>
                    Categories

                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{route('admin.post.index')}}" class="nav-link" id="posts">
                <i class="nav-icon fas fa-align-justify"></i>
                <p>
                    Posts
                </p>
            </a>
        </li>
    </ul>
</nav>
