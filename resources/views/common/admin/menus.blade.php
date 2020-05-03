{{--  Home  --}}
<li class="nav-item">
    <a href="{{route('home')}}"
        class="nav-link {{Route::currentRouteName() == 'admin.dashboard' ? 'active' : ''}}">
        <i class="nav-icon fas fa-tachometer-alt"></i>
        <p>
            Dashboard
        </p>
    </a>
</li>

{{--  Courses  --}}
<li class="nav-item">
    <a href="{{route('admin.course.list')}}"
        class="nav-link {{Route::currentRouteName() == 'admin.course.list' ? 'active' : ''}}  {{Route::currentRouteName() == 'admin.course.create' ? 'active' : ''}} {{Route::currentRouteName() == 'admin.course.edit' ? 'active' : ''}}">
        <i class="nav-icon fas fa-graduation-cap"></i>
        <p>
            Courses
        </p>
    </a>
</li>
{{--  Subject  --}}
<li class="nav-item">
    <a href="{{route('admin.subject.list')}}"
        class="nav-link {{Route::currentRouteName() == 'admin.subject.list' ? 'active' : ''}}  {{Route::currentRouteName() == 'admin.subject.create' ? 'active' : ''}} {{Route::currentRouteName() == 'admin.subject.edit' ? 'active' : ''}}">
        <i class="nav-icon fas fa-book"></i>
        <p>
            Subjects
        </p>
    </a>
</li>
{{--  Chapter  --}}
<li class="nav-item">
    <a href="{{route('admin.chapter.list')}}"
        class="nav-link {{Route::currentRouteName() == 'admin.chapter.list' ? 'active' : ''}}  {{Route::currentRouteName() == 'admin.chapter.create' ? 'active' : ''}} {{Route::currentRouteName() == 'admin.chapter.edit' ? 'active' : ''}}">
        <i class="nav-icon fas fa-book-open"></i>
        <p>
            Chapters
        </p>
    </a>
</li>
{{--  Profile  --}}
<li class="nav-item">
    <a href="{{route('admin.profile.details')}}"
        class="nav-link {{Route::currentRouteName() == 'admin.profile.details' ? 'active' : ''}}">
        <i class="nav-icon fas fa-user-circle"></i>
        <p>
            Profile
        </p>
    </a>
</li>

{{--  Settings  --}}
<li class="nav-item">
    <a href="{{route('admin.setting.details')}}"
        class="nav-link {{Route::currentRouteName() == 'admin.setting.details' ? 'active' : ''}}">
        <i class="nav-icon fas fa-cogs"></i>
        <p>
            Settings
        </p>
    </a>
</li>