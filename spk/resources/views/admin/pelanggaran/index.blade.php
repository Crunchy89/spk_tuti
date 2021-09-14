<?php
use \App\Helpers\Ahp;
$saw= new Ahp();
?>

@extends('template.core')
@section('title','Data siswa dan pelanggaran')
@section('content')


<div class="container">
    <div class="row">

        @foreach ($kelas as $row)
        @php
        $id=Crypt::encrypt($row->id);
        @endphp
        <div class="col-sm-6 col-lg-4">
            <a href="{{ url('admin/siswa/kelas/'.$id) }}" class="card text-dark" style="text-decoration:none">
                <div class="card-header bg-white content-center p-5 d-flex justify-content-center align-items-center">
                    <h3>{{ $row->nama_kelas }}</h3>
                </div>
                <div class="card-body row text-center">
                    <div class="col">
                        <div class="text-value-md">{{ $row->nama_guru }}</div>
                        <div class="text-uppercase text-muted small">Guru Pembimbing</div>
                    </div>
                    <div class="c-vr"></div>
                    <div class="col">
                        <div class="text-value-xl">{{ $row->jumlah }}</div>
                        <div class="text-uppercase text-muted small">Jumlah Peserta Didik</div>
                    </div>
                </div>
            </a>
        </div>
        @endforeach

    </div>
</div>

<div class="container">
    <div class="card">
        <div class="card-body">
            <h3 class="text-center">Data Pelanggaran Bulan ini</h3>
            <hr>
            @foreach ($guru as $g)
            @php
                $tes=$saw->perhitunganSaw($g->guru_id);
                $siswa=$saw->getSiswa($g->guru_id);
            @endphp
            <div class="table-responsive">
                <table class="table table-bordered data-table w-100">
                    <thead>
                        <tr>
                            <th>Nama Peserta Didik</th>
                            <th>Kelas</th>
                            <th>Jenis Pelanggaran</th>
                            <th>Jenis Tindakan</th>
                            <th>Jenis Sanksi</th>
                            <th>Tindakan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @for ($i=0;$i<count($siswa);$i++)
                        @php
                            $tindakan = $saw->tindakan($tes[$i]);
                        @endphp
                        <tr>
                            @php
                                $kel = \App\DataKelas::select('kelas.nama_kelas')
                            ->join('siswa','data_kelas.siswa_id','=','siswa.id')
                            ->join('kelas','data_kelas.kelas_id','=','kelas.id')
                            ->where('siswa.id',$siswa[$i]->id)
                            ->first();
                            @endphp
                            <td>{{ $siswa[$i]->nama_siswa }}</td>
                            <td>{{ $kel->nama_kelas }}</td>
                            <td>{{$tindakan['jenis']}}</td>
                            <td>{{$tindakan['tindakan']}}</td>
                            <td>{{$tindakan['sanksi']}}</td>
                            <td>
                                @if ($tes[$i]>=11)
                                    <a href="{{ url('admin/siswa/print/'.$siswa[$i]->id.'/'.$tes[$i]) }}" class="btn btn-primary">Buat Surat</a>
                                @endif
                            </td>
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
