@extends('template.core')

@section('title','Data Peserta Didik')

@section('content')

<div class="container">
    <div class="card">
        <div class="card-body">
            <h3>Data Peserta Didik</h3>
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
                            <th width="100px">Action</th>
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
@endsection

@section('script')
<script>
    var table;
    $(document).ready(function(){
        table = $('.data-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ url('admin/data/siswa') }}",
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
          $('#nama_siswa').val($(this).data('nama_siswa'));
          $('#jk').val($(this).data('jk'));
          $('#nisn').val($(this).data('nisn'));
          $('#modal').find('#aksi').val('edit')
          $('#modal').find('#btn').html('Edit')
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
