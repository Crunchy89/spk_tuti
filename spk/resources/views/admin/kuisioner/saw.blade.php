<?php
use \App\Helpers\Ahp;
$saw= new Ahp();
?>
@extends('template.core')

@section('title','Perhitungan SAW')

@section('content')

<div class="container">
    <div class="card">
        <div class="card-body">
            <h3 class="text-center">Perhitungan SAW</h3>
            <hr>
            <h3 class="text-center">Data Pelanggaran Bulan ini</h3>
            <br>
            @foreach ($guru as $g)
            <h3>Guru Pembimbing : {{ $g->nama_guru }}</h3>
            <div class="table-responsive">
                <table class="table table-bordered data-table w-100">
                    <thead>
                        <tr>
                            <th>Alternatif</th>
                            @foreach ($kriteria as $row)
                                <th>{{ $row->nama_kriteria }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $siswa=$saw->getDataSaw($g->guru_id);
                        @endphp
                        @foreach ($siswa as $sis)
                        <tr>
                            @foreach ($sis as $s)
                                <td>{{$s}}</td>
                            @endforeach
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            @php
                $tes=$saw->perhitunganSaw($g->guru_id);
                $siswa=$saw->getDataSaw($g->guru_id);
            @endphp
            <div class="table-responsive">
                <table class="table table-bordered data-table w-100">
                    <thead>
                        <tr>
                            <th>Nama Peserta Didik</th>
                            <th>Total Point</th>
                            <th>Jenis Pelanggaran</th>
                            <th>Tindakan</th>
                            <th>Jenis Sanksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @for ($i=0;$i<count($siswa);$i++)
                        @php
                            $tindakan = $saw->tindakan($tes[$i]);
                        @endphp
                        <tr>
                            <td>{{ $siswa[$i][0] }}</td>
                            <td>{{ $tes[$i] }}</td>
                            <td>{{$tindakan['jenis']}}</td>
                            <td>{{$tindakan['tindakan']}}</td>
                            <td>{{$tindakan['sanksi']}}</td>
                        </tr>
                        @endfor
                    </tbody>
                </table>
            </div>
            @endforeach
        </div>
    </div>
</div>



@endsection
