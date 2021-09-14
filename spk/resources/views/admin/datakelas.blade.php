@extends('template.core')

@section('title','Data Peserta Kelas '.$detail->nama_kelas)

@section('content')

<div class="container">
    <div class="card">
        <div class="card-body">
            <h3>Data Peserta Didik Kelas {{ $detail->nama_kelas }}</h3>
            <a href="{{url('admin/data/kelas')}}" class="btn btn-success"><i class="cil-arrow-left"></i> Kembali</a>
            <button class="btn btn-primary" id="tambah"><i class="cil-plus"></i> Tambah</button>
            <hr>
            <div class="table-responsive">
                <table class="table table-bordered data-table w-100">
                    <thead>
                        <tr>
                            <th width="50px">No</th>
                            <th>NISN</th>
                            <th>Nama Peserta Didik</th>
                            <th>Jenis Kelamin</th>
                            <th>Action</th>
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

@section('form-modal')
<input type="hidden" name="aksi" id="aksi">
<input type="hidden" name="id" id="id">
<div id="datakelas">
    <div class="form-group">
        <label for="nisn">NISN</label>
        <input type="text" class="form-control" name="nisn" placeholder="NISN" id="nisn" required>
    </div>
    <div class="form-group">
        <label for="nama_siswa">Nama Peserta Didik</label>
        <input type="text" class="form-control" name="nama_siswa" placeholder="Nama Siswa" id="nama_siswa" required>
    </div>
    <div class="form-group">
        <label for="jk">Jenis Kelamin</label>
        <select name="jk" id="jk" class="form-control" required>
            <option value="">Pilih Jenis Kelamin</option>
            <option value="L">Laki - laki</option>
            <option value="P">Perempuan</option>
        </select>
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
            ajax: "{{ url('admin/data/kelas/datakelas/'.$kelas_id) }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex',orderable: false, searchable: false},
                {data: 'nisn', name: 'nisn'},
                {data: 'nama_siswa', name: 'nama_siswa'},
                {data: 'jk', name: 'jk'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });
        const form=$('.modal-body').html();
        $('#tambah').click(function(){
          $('.modal-body').html(form);
          $('#modal').find('h5').html('Tambah Data')
          $('#modal').find('#aksi').val('tambah')
          $('#modal').find('#btn').html('Tambah')
          $('#modal').modal('show');
        })
        $('#data').on('click','.edit',function(){
          $('.modal-body').html(form);
          $('#modal').find('h5').html('Edit Data')
          $('#id').val($(this).data('id'));
          $('#nisn').val($(this).data('nisn'));
          $('#jk').val($(this).data('jk'));
          $('#nama_siswa').val($(this).data('nama_siswa'));
          $('#modal').find('#aksi').val('edit')
          $('#modal').find('#btn').html('Edit')
          $('#modal').modal('show');
        })
        $('#data').on('click','.pindah',function(){
          $('.modal-body').html(form);
          $('#datakelas').html(`
            <div class="form-group">
                <label for="kelas_id">Pindah Kelas</label>
                <select name="kelas_id" id="kelas_id" required class="form-control">
                    <option value="">Pilih Kelas</option>
                    @foreach ($kelas as $row)
                    <option value="{{ $row->id }}">{{ $row->nama_kelas }}</option>
                    @endforeach
                </select>
            </div>
          `)
          $('#modal').find('h5').html('Pindah Kelas')
          $('#id').val($(this).data('id'));
          $('#kelas_id').val($(this).data('kelas_id'));
          $('#modal').find('#aksi').val('pindah')
          $('#modal').find('#btn').html('Pindah')
          $('#modal').modal('show');
        })
        $('#data').on('click','.hapus',function(){
          $('.modal-body').html(`
          <input type="hidden" name="aksi" id="aksi" value="hapus">
          <input type="hidden" id="id" name="id">
          <h3>Apakah Anda Yakin ?</h3>
          `);
          $('#modal').find('h5').html('Hapus Data')
          $('#id').val($(this).data('id'));
          $('#modal').find('#aksi').val('hapus')
          $('#modal').find('#btn').html('Hapus')
          $('#modal').modal('show');
        })
    })
</script>
@endsection
