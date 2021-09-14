@extends('template.core')

@section('title','Data Pelanggaran')

@section('content')


@if ($message = Session::get('success'))
<div class="card">
    <div class="card-body">
        <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{{ $message }}</strong>
        </div>
    </div>
</div>
@endif

@if ($message = Session::get('error'))
<div class="card">
    <div class="card-body">
        <div class="alert alert-danger alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{{ $message }}</strong>
        </div>
    </div>
</div>
@endif

<div class="container">
    <div class="card">
        <div class="card-body">
            <h3>Data pelanggaran {{ $detail->nama_siswa }}</h3>
            @php
            $kelas_id=Crypt::encrypt($detail->kelas_id);
            @endphp
            <a href="{{ url('admin/siswa/kelas/'.$kelas_id) }}" class="btn btn-success"><i class="cil-arrow-left"></i> Kembali</a>
            <hr>
            <div class="table-responsive">
                <form action="{{ url('admin/siswa/kelas/data/simpan') }}" method="post">
                    @csrf
                    <input type="hidden" name="siswa_id" value="{{ $detail->siswa_id }}">
                    <table class="table table-bordered data-table w-100">
                        <thead>
                            <tr>
                                <th>Kriteria</th>
                                <th>Data Pelanggaran</th>
                                <th>Checklist</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($kriteria as $row)
                            @php
                            $pelanggaran=\App\Pelanggaran::whereKriteria_id($row->id)->orderBy('pelanggaran','ASC')->get();
                            @endphp

                            @php
                            $i=0
                            @endphp

                            @foreach ($pelanggaran as $pel)
                            <tr>

                                @if ($i==0)
                                <td rowspan="{{ count($pelanggaran) }}">{{ $row->nama_kriteria }}</td>
                                @endif

                                @php
                                $cek=\App\DataPelanggaran::whereSiswa_id($detail->siswa_id)->wherePelanggaran_id($pel->id)->whereRaw('DATE(created_at)=DATE(NOW())')->first();
                                @endphp

                                <td>{{ $pel->pelanggaran }}</td>
                                @if ($cek)
                                <td><input type="checkbox" name="pelanggaran_id[]" checked value="{{ $pel->id }}"></td>
                                @else
                                <td><input type="checkbox" name="pelanggaran_id[]" value="{{ $pel->id }}"></td>
                                @endif
                            </tr>

                            @php
                            $i++;
                            @endphp

                            @endforeach
                            @endforeach
                        </tbody>
                    </table>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary float-right">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
