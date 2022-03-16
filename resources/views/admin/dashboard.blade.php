@extends('adminlte::page')

@section('plugins.Chartjs', true)

@section('content_header')
    <div class="row">
        <div class="col-md-6">
            <h1>Dashboard</h1>
        </div>
        <div class="col-md-6">
            <form method="GET">
                <select onChange="this.form.submit()" name="interval" class="form-control float-md-right"
                    style="width: 200px">
                    <option {{ $dateInterval == 30 ? "selected = 'selected'" : '' }} value="30">Últimos 30 dias</option>
                    <option {{ $dateInterval == 60 ? "selected = 'selected'" : '' }}value="60">Últimos 60 dias</option>
                    <option {{ $dateInterval == 90 ? "selected = 'selected'" : '' }}value="90">Últimos 90 dias</option>
                    <option {{ $dateInterval == 120 ? "selected = 'selected'" : '' }}value="120">Últimos 120 dias</option>
                </select>
            </form>
        </div>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-3 col-6">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{ $access }}</h3>
                    <p>Acessos</p>
                </div>
                <div class="icon">
                    <i class="far fa-fw fa-eye"></i>
                </div>
                {{-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> --}}
            </div>
        </div>

        <div class="col-md-3 col-6">
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{ $online }}</h3>
                    <p>Acessos Online</p>
                </div>
                <div class="icon">
                    <i class="far fa-fw fa-heart"></i>
                </div>
                {{-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> --}}
            </div>
        </div>

        <div class="col-md-3 col-6">
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{ $pages }}</h3>
                    <p>Páginas</p>
                </div>
                <div class="icon">
                    <i class="far fa-fw fa-sticky-note"></i>
                </div>
                {{-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> --}}
            </div>
        </div>

        <div class="col-md-3 col-6">
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>{{ $users }}</h3>
                    <p>Usuários</p>
                </div>
                <div class="icon">
                    <i class="far fa-fw fa-user"></i>
                </div>
                {{-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> --}}
            </div>
        </div>
    </div>


    {{-- Informações do gráfico --}}
    <div class="row">
        <div class="col-md-7">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Páginas mais visitadas</h3>
                </div>
                <div class="card-body table-responsive p-0" style="height: 290px;">
                    <table class="table table-hover table-stripped table-bordered text-nowrap">
                        <thead>
                            <tr>
                                <th class="col-1">#</th>
                                <th class="col-2">IP</th>
                                <th class="col-2">Data</th>
                                <th>Url</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($accessList as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->ip }}</td>
                                    <td>{{ $item->date }}</td>
                                    <td>{{ $item->url }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    {{ $accessList->links() }}
                </div>
            </div>
        </div>

        <div class="col-md-5">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Gráfico Pizza Páginas</h3>
                </div>
                <div class="card-body">
                    <canvas id="pagePie"></canvas>
                </div>
            </div>
        </div>
    </div>

    <script>
        window.onload = function() {
            let ctx = document.getElementById('pagePie').getContext('2d');
            window.pagePie = new Chart(ctx, {
                type: 'pie',
                data: {
                    datasets: [{
                        data: {{ $pagesValues }},
                        backgroundColor: {!! $pagePieColors !!}
                    }],
                    labels: {!! $pagesLabels !!}
                },
                options: {
                    responsive: true,
                    legend: {
                        display: true
                    }
                }
            });
        }
    </script>

@endsection
