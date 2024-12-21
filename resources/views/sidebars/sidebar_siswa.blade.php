<ul class="sidebar-menu">
    <li class="{{$pages=='dashboard' ? 'active' : ''}}">
        <a href="{{ route('dashboard') }}" class="nav-link"><i class="fas fa-home"></i><span>Dashboard</span></a>
    </li>
    <li class="{{$pages=='biodata' ? 'active' : ''}}">
        <a href="{{ route('siswa.biodata') }}" class="nav-link"><i class="fas fa-user-tag fa-fw"></i><span>Biodata</span></a>
    </li>
    <li class="{{$pages=='jadwal' ? 'active' : ''}}">
        <a href="{{ route('siswa.jadwal') }}" class="nav-link"><i class="fas fa-calendar"></i><span>Jadwal</span></a>
    </li>
    <li class="{{$pages=='kehadiran' ? 'active' : ''}}">
        <a href="{{ route('siswa.jadwal') }}" class="nav-link"><i class="fas fa-user-check"></i><span>Kehadiran</span></a>
    </li>
    <li class="{{$pages=='tagihan' ? 'active' : ''}}">
        <a href="{{ route('siswa.jadwal') }}" class="nav-link"><i class="fas fa-wallet"></i><span>Tagihan</span></a>
    </li>
</ul>