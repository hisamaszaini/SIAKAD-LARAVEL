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
        <div class="col-lg-6 col-md-12 col-12 col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h4><i class="fa fa-user-graduate"></i> Jumlah Siswa: {{ $laki + $perempuan }}</h4>
                </div>
                <div class="card-body">
                    <canvas id="myChart"></canvas>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-12 col-12 col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h4><i class="fa fa-user-graduate"></i> Distribusi Siswa </h4>
                </div>
                <div class="card-body">
                    <canvas id="kelasChart"></canvas>
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
    document.addEventListener('DOMContentLoaded', function() {
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
<script>
document.addEventListener('DOMContentLoaded', function() {
    const ctx = document.getElementById('kelasChart').getContext('2d');

    fetch('/admin/chart-data')
        .then(response => response.json())
        .then(data => {
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: data.labels,
                    datasets: [{
                        label: 'Jumlah Siswa',
                        data: data.data,
                        borderWidth: 2,
                        backgroundColor: '#6777ef',
                        borderColor: '#6777ef',
                        borderWidth: 2.5,
                        pointBackgroundColor: '#ffffff',
                        pointRadius: 4
                    }]
                },
                options: {
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    scales: {
                        y: {
                            type: 'linear',
                            position: 'left',
                            min: 0,
                            max: Math.ceil(Math.max(...data.data)),
                            grid: {
                                drawBorder: false,
                                color: '#f2f2f2',
                            },
                            ticks: {
                                stepSize: 1
                            }
                        },
                        x: {
                            ticks: {
                                display: false
                            },
                            grid: {
                                display: false
                            }
                        }
                    }
                }
            });
        });
});
</script>
@endsection