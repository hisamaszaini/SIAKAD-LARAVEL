<ul class="sidebar-menu">
    <li class="{{$pages=='dashboard' ? 'active' : ''}}">
        <a href="{{ route('dashboard') }}" class="nav-link"><i class="fas fa-home"></i><span>Dashboard</span></a>
    </li>
    <li class="{{$pages=='biodata' ? 'active' : ''}}">
        <a href="{{ route('guru.biodata') }}" class="nav-link"><i class="fas fa-user-tag fa-fw"></i><span>Biodata</span></a>
    </li>
    <li class="menu-header">Pembelajaran</li>
    <li class="{{$pages=='jadwal' ? 'active' : ''}}">
        <a href="{{ route('guru.jadwal') }}" class="nav-link"><i class="fas fa-calendar"></i><span>Jadwal</span></a>
    </li>
    <li class="{{$pages=='absensi' ? 'active' : ''}}">
        <a class="nav-link" href="{{ route('guru.absensi.index') }}">
            <i class="fas fa-user-check"></i>
            <span>Absensi</span>
        </a>
    </li>
    <li class="{{$pages=='nilai' ? 'active' : ''}}">
        <a class="nav-link" href="{{ route('guru.nilai.index') }}">
            <i class="fas fa-chart-bar"></i>
            <span>Input Nilai</span>
        </a>
    </li>
    <li class="menu-header">Akun</li>
    <li class="{{$pages=='profile' ? 'active' : ''}}">
        <a class="nav-link" href="{{ route('profile') }}">
            <i class="fas fa-cog"></i>
            <span>Settings</span>
        </a>
    </li>
    <li class="{{$pages=='logout' ? 'active' : ''}}">
        <form id="logout-form" method="POST" action="{{ route('logout') }}" style="display: none;">
            @csrf
        </form>
        <a href="#" class="dropdown-item has-icon text-danger" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class="fas fa-sign-out-alt"></i> <span>Logout</span>
        </a>
    </li>
</ul>