@extends('layouts.master', ['title' => 'Dashboard'])

@section('plugins_css')

@endsection

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Dashboard</h1>
    </div>
    <div class="section-body">
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-primary">
                        <i class="fas fa-user-graduate"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Jumlah Siswa</h4>
                        </div>
                        <div class="card-body">
                            {{ $laki+$perempuan }} Siswa
                            <div class="text-muted text-small"><span class="text-primary"><i class="fas fa-caret-up"></i></span> {{ $kelas->count() }} Kelas</div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-success">
                        <i class="fas fa-chalkboard-teacher"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Jumlah Guru</h4>
                        </div>
                        <div class="card-body">
                            {{ $guru->count() }} Guru
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-warning">
                        <i class="fab fa-monero"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Jumlah Mata Pelajaran</h4>
                        </div>
                        <div class="card-body">
                            {{ $mapel->count() }} Mapel
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-danger">
                        <i class="fas fa-school"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Jumlah Kelas</h4>
                        </div>
                        <div class="card-body">
                            {{ $kelas->count() }} Kelas
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h4><i class="fa fa-info-circle"></i> Pengumuman</h4>
        </div>
        <div class="card-body">
            <div class="row">
                @if($pengumuman)
                <div class="ml-3">{!! htmlspecialchars_decode($pengumuman->isi) !!}</div>
                @else
                <div class="ml-3">Tidak ada pengumuman.</div>
                @endif
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-lg-8 col-md-12 col-12 col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h4><i class="fa fa-user-graduate"></i>  Jumlah Siswa: {{ $laki + $perempuan }}</h4>
                </div>
                <div class="card-body">
                    <canvas id="myChart"></canvas>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-12 col-12 col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h4>Recent Activities</h4>
                </div>
                <div class="card-body">
                    <ul class="list-unstyled list-unstyled-border">
                        <li class="media">
                            <img class="mr-3 rounded-circle" width="50" src="../assets/img/avatar/avatar-1.png" alt="avatar">
                            <div class="media-body">
                                <div class="float-right text-primary">Now</div>
                                <div class="media-title">Farhan A Mujib</div>
                                <span class="text-small text-muted">Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin.</span>
                            </div>
                        </li>
                        <li class="media">
                            <img class="mr-3 rounded-circle" width="50" src="../assets/img/avatar/avatar-2.png" alt="avatar">
                            <div class="media-body">
                                <div class="float-right">12m</div>
                                <div class="media-title">Ujang Maman</div>
                                <span class="text-small text-muted">Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin.</span>
                            </div>
                        </li>
                        <li class="media">
                            <img class="mr-3 rounded-circle" width="50" src="../assets/img/avatar/avatar-3.png" alt="avatar">
                            <div class="media-body">
                                <div class="float-right">17m</div>
                                <div class="media-title">Rizal Fakhri</div>
                                <span class="text-small text-muted">Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin.</span>
                            </div>
                        </li>
                        <li class="media">
                            <img class="mr-3 rounded-circle" width="50" src="../assets/img/avatar/avatar-4.png" alt="avatar">
                            <div class="media-body">
                                <div class="float-right">21m</div>
                                <div class="media-title">Alfa Zulkarnain</div>
                                <span class="text-small text-muted">Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin.</span>
                            </div>
                        </li>
                    </ul>
                    <div class="text-center pt-1 pb-1">
                        <a href="#" class="btn btn-primary btn-lg btn-round">
                            View All
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('block plugins_js')
<script src="../node_modules/chart.js/dist/Chart.min.js"></script>
<script src="../node_modules/summernote/dist/summernote-bs4.js"></script>
<script src="../node_modules/chocolat/dist/js/jquery.chocolat.min.js"></script>
@endsection

@section('page_js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js"></script>
<script>
    $(document).ready(function() {
        //doughnut
        var ctx = document.getElementById('myChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['Siswa Laki-laki', 'Siswa Perempuan'],
                datasets: [{
                    label: '# of Votes',
                    data: [@php echo $laki @endphp, @php echo $perempuan @endphp],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
    });
</script>
@endsection