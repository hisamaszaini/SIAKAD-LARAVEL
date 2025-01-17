<ul class="sidebar-menu">
    <li class="menu-header">Dashboard</li>
    <li class="{{$pages=='dashboard' ? 'active' : ''}}">
        <a href="{{ route('dashboard') }}" class="nav-link"><i class="fas fa-home"></i><span>Dashboard</span></a>
    </li>
    <li class="menu-header">SIAKAD</li>
    <li class="{{$pages=='settings' ? 'active' : ''}}">
        <a class="nav-link" href="{{ route('settings') }}">
        <i class="fas fa-cog"></i>
            <span>Settings</span>
        </a>
    </li>
    <li class="menu-header">Akademik</li>
    <li class="dropdown {{$pages=='users' || $pages=='jampelajaran' || $pages=='siswa' || $pages=='guru' || $pages=='kelas' || $pages=='ruang' || $pages=='mapel' || $pages=='kategori' ? 'active' : ''}}">
        <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-dumpster"></i> <span>Mastering</span></a>
        <ul class="dropdown-menu">
            <li class="{{$pages=='guru' ? 'active' : ''}}">
                <a class="nav-link" href="{{ route('guru.index') }}">
                    <i class="fas fa-chalkboard-teacher"></i>
                    <span>Guru</span>
                </a>
            </li>
            <li class="{{$pages=='kelas' ? 'active' : ''}}">
                <a class="nav-link" href="{{ route('kelas.index') }}">
                    <i class="fas fa-school"></i>
                    <span>Kelas</span>
                </a>
            </li>
            <li class="{{$pages=='siswa' ? 'active' : ''}}">
                <a class="nav-link" href="{{ route('siswa.index') }}">
                    <i class="fas fa-user-graduate"></i>
                    <span>Siswa</span>
                </a>
            </li>
            <li class="{{$pages=='ruang' ? 'active' : ''}}">
                <a class="nav-link" href="{{ route('ruang.index') }}">
                    <i class="fas fa-hotel"></i>
                    <span>Ruang</span>
                </a>
            </li>
            <li class="{{$pages=='kategori' ? 'active' : ''}}">
                <a class="nav-link" href="{{ route('kategori.index') }}">
                    <i class="fas fa-folder"></i>
                    <span>Kategori</span>
                </a>
            </li>
            <li class="{{$pages=='mapel' ? 'active' : ''}}">
                <a class="nav-link" href="{{ route('mapel.index') }}">
                    <i class="fab fa-monero"></i>
                    <span>Mata Pelajaran</span>
                </a>
            </li>
            <li class="{{$pages=='jampelajaran' ? 'active' : ''}}">
                <a class="nav-link" href="{{ route('jampelajaran.index') }}">
                    <i class="fas fa-clock"></i>
                    <span>Jam Pelajaran</span>
                </a>
            </li>
        </ul>
    </li>
    <li class="dropdown {{$pages=='jadwal' || $pages=='absensi' || $pages=='nilai' ? 'active' : ''}}">
        <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i> <span>Pembelajaran</span></a>
        <ul class="dropdown-menu">
            <li class="{{$pages=='jadwal' ? 'active' : ''}}">
                <a class="nav-link" href="{{ route('jadwal.index') }}">
                    <i class="fas fa-calendar"></i>
                    <span>Jadwal</span>
                </a>
            </li>
            <li class="{{$pages=='absensi' ? 'active' : ''}}">
                <a class="nav-link" href="{{ route('absensi.index') }}">
                    <i class="fas fa-user-check"></i>
                    <span>Absensi</span>
                </a>
            </li>
            <li class="{{$pages=='nilai' ? 'active' : ''}}">
                <a class="nav-link" href="{{ route('nilai.index') }}">
                    <i class="fas fa-chart-bar"></i>
                    <span>Nilai</span>
                </a>
            </li>
        </ul>
    </li>
    <li class="{{$pages=='tagihan' || $pages=='penagihan' ? 'active' : ''}}">
        <a href="{{ route('tagihan.index') }}" class="nav-link"><i class="fas fa-money-bill"></i><span>Tagihan</span></a>
    </li>
    <li class="{{$pages=='pengumuman' ? 'active' : ''}}">
        <a href="{{ route('pengumuman.index') }}" class="nav-link"><i class="fas fa-bullhorn"></i><span>Pengumuman</span></a>
    </li>
    <li class="menu-header">Blog</li>
    <li class="dropdown {{$pages=='blogpost' || $pages=='blogkategori'  ? 'active' : ''}}">
        <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-blog"></i> <span>Blog</span></a>
        <ul class="dropdown-menu">
            <li class="{{$pages=='blogpost' ? 'active' : ''}}">
                <a class="nav-link" href="{{ route('blog.listpost') }}">
                    <i class="fas fa-pencil-alt"></i>
                    <span>Post</span>
                </a>
            </li>
            <li class="{{$pages=='blogkategori' ? 'active' : ''}}">
                <a class="nav-link" href="{{ route('blog.listkategori') }}">
                    <i class="fas fa-tags"></i>
                    <span>Kategori</span>
                </a>
            </li>
        </ul>
    </li>
    <li class="menu-header">Akun</li>
    <li class="{{$pages=='profile' ? 'active' : ''}}">
        <a class="nav-link" href="{{ route('profile') }}">
        <i class="fas fa-user-cog"></i>
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