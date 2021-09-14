@extends('template.core')

@section('title','Geomean AHP')

@section('content')

<div class="container">
    <div class="card">
        <div class="card-body">
            <h3 class="text-center">Perhitungan AHP</h3>
            <hr>
            <h3 class="text-center">Tabel Perbandiangan</h3>
            <div class="table-responsive">
                <table class="table table-bordered data-table w-100">
                    <thead>
                        <tr>
                            <th>Kriteria</th>
                            <th>Responden</th>
                            @foreach ($kriteria as $row)
                            <th>{{ $row->label }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($kriteria as $row)
                        <?php $i = 0 ?>
                        @foreach ($user as $u)
                        <tr>
                            <?php if ($i == 0) : ?>
                                <td rowspan="{{ count($user) }}">{{ $row->label }}</td>
                            <?php endif; ?>
                            <td>{{ $u->nama_guru }}</td>
                            @foreach ($kriteria as $kriteria2)
                            @php
                            $cek=\App\Kuisioner::whereId_user($u->id)
                            ->whereId_kriteria_1($row->id)
                            ->whereId_kriteria_2($kriteria2->id)
                            ->first()
                            @endphp
                            <td>{{ $cek->nilai ?? 1 }}</td>
                            @endforeach
                        </tr>
                        <?php $i++ ?>
                        @endforeach
                        @endforeach
                    </tbody>

                </table>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="card">
        <div class="card-body">
            <h3 class="text-center">Geometriks Mean dari matriks penilaian responden</h3>
            <hr>
            <div class="table-responsive">
                <table class="table table-bordered data-table w-100">
                    <thead>
                        <tr>
                            <th>Kriteria</th>
                            @foreach ($kriteria as $row)
                            <th>{{ $row->label }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($kriteria as $row => $value)
                        <tr>
                            <td>{{ $value->label }}</td>
                            <?php for ($i = 0; $i < count($geomean[$row]); $i++) : ?>
                                <td>{{ $geomean[$row][$i] }}</td>
                            <?php endfor; ?>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Jumlah</th>
                            @foreach ($jumlahGeomin as $row)
                            <th>{{ $row }}</th>
                            @endforeach
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="card">
        <div class="card-body">
            <h3 class="text-center">Matriks Bobot Penilaian Perbandingan Berpasangan</h3>
            <hr>
            <div class="table-responsive">
                <table class="table table-bordered data-table w-100">
                    <thead>
                        <tr>
                            <th>Kriteria</th>
                            @foreach ($kriteria as $row)
                            <th>{{ $row->label }}</th>
                            @endforeach
                            <th>Jumlah</th>
                            <th>Prioritas</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($kriteria as $row => $value)
                        <tr>
                            <td>{{ $value->label }}</td>
                            <?php for ($i = 0; $i < count($matriksNilai[$row]); $i++) : ?>
                                <td>{{ $matriksNilai[$row][$i] }}</td>
                            <?php endfor; ?>
                            <td>{{ $jumlahKanan[$row] }}</td>
                            <th>{{ $prioritas[$row] }}</th>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Jumlah</th>
                            @foreach ($jumlahBawah as $row)
                            <th>{{ $row }}</th>
                            @endforeach
                            <th>{{ array_sum($jumlahKanan) }}</th>
                            <th></th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="card">
        <div class="card-body">
            <h3 class="text-center">Mengukur Konsistensi</h3>
            <hr>
            <div class="container">
                <div class="form-group row">
                    <label for="" class="sm-2">Maks Lamda</label>
                    <div class="col-8">
                        <label>: {{ $lamda }}</label>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="" class="sm-2">n</label>
                    <div class="col-8">
                        <label>: {{ $n }}</label>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="" class="sm-2">IR</label>
                    <div class="col-8">
                        <label>: {{ $ir }}</label>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="" class="sm-2">CI</label>
                    <div class="col-8">
                        <label>: {{ $ci }}</label>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="" class="sm-2">CR</label>
                    <div class="col-8">
                        <label>: {{ round(($ci/$ir),3) }}</label>
                    </div>
                </div>
                @if ((round(($ci/$ir),3))<0.1)
                <div class="alert alert-success text-center" role="alert">
                  <h3>Konsisten</h3>
                </div>
                @else
                <div class="alert alert-danger text-center" role="alert">
                  <h3>Tidak Konsisten</h3>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

@endsection
