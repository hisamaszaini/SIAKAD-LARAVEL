@if (Auth::user()->role == 'Admin')
@include('sidebars.sidebar_admin')
@elseif (Auth::user()->role == 'Guru')
@include('sidebars.sidebar_guru')
@elseif (Auth::user()->role == 'Siswa')
@include('sidebars.sidebar_siswa')
@endif