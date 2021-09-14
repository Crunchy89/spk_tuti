@extends('template.core')

@section('title','Data peserta didik kelas '.$detail->nama_kelas)

@section('content')

<div class="container">
    <div class="card">
        <div class="card-body">
            <h3>Data peserta didik kelas {{ $detail->nama_kelas }}</h3>
            <a href="{{url('admin/siswa')}}" class="btn btn-success"><i class="cil-arrow-left"></i> Kembali</a>
            <hr>
            <div class="table-responsive">
                <table class="table table-bordered data-table w-100">
                    <thead>
                        <tr>
                            <th width="50px">No</th>
                            <th>NISN</th>
                            <th>Nama Peserta Didik</th>
                            <th>Jenis Kelamin</th>
                            <th>Banyak Pelanggaran</th>
                            <th>Total Bobot</th>
                            <th>Data Pelanggaran</th>
                        </tr>
                    </thead>
                    <tbody id="data">
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')
<script>
    var table;
    $(document).ready(function(){
        table = $('.data-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ url('admin/siswa/kelas/'.$kelas_id) }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex',orderable: false, searchable: false},
                {data: 'nisn', name: 'nisn'},
                {data: 'nama_siswa', name: 'nama_siswa'},
                {data: 'jk', name: 'jk'},
                {data: 'pelanggaran', name: 'pelanggaran',orderable: false, searchable: false},
                {data: 'bobot', name: 'bobot',orderable: false, searchable: false},
                {data: 'siswa', name: 'siswa',orderable: false, searchable: false},
            ]
        });
    })
</script>
@endsection
