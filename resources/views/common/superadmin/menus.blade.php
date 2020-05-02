{{--  Home  --}}
<li class="nav-item">
    <a href="{{route('home')}}"
        class="nav-link {{Route::currentRouteName() == 'superadmin.dashboard' ? 'active' : ''}}">
        <i class="nav-icon fas fa-tachometer-alt"></i>
        <p>
            Dashboard
        </p>
    </a>
</li>

{{--  Institutes  --}}
<li class="nav-item has-treeview">
    <a href="#"
        class="nav-link {{Route::currentRouteName() == 'superadmin.institute.list' ? 'active menu-open' : ''}} {{Route::currentRouteName() == 'superadmin.institute.create' ? 'active menu-open' : ''}}">
        <i class="nav-icon fas fa-university"></i>
        <p>
            Institutes
            @if((Route::currentRouteName() == 'superadmin.institute.list') || (Route::currentRouteName() ==
            'superadmin.institute.create'))
            <i class="fas fa-angle-left right"></i>
            @else
            <i class="right fas fa-angle-left"></i>
            @endif
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="{{route('superadmin.institute.list')}}"
                class="nav-link {{Route::currentRouteName() == 'superadmin.institute.list' ? 'active' : ''}}">
                <i class="fas fa-list nav-icon"></i>
                <p>List</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{route('superadmin.institute.create')}}"
                class="nav-link {{Route::currentRouteName() == 'superadmin.institute.create' ? 'active' : ''}}">
                <i class="fas fa-plus nav-icon"></i>
                <p>Add</p>
            </a>
        </li>
    </ul>
</li>
