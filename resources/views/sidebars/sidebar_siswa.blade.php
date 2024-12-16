<ul class="sidebar-menu">
    <li class="{{$pages=='dashboard' ? 'active' : ''}}">
        <a href="{{ route('dashboard') }}" class="nav-link"><i class="fas fa-home"></i><span>Dashboard</span></a>
    </li>
    <li class="{{$pages=='biodata' ? 'active' : ''}}">
        <a href="{{ route('siswa.biodata') }}" class="nav-link"><i class="fas fa-user-tag fa-fw"></i><span>Biodata</span></a>
    </li>
</ul>