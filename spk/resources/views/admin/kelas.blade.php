@extends('template.core')

@section('title','Data Kelas')

@section('content')

<div class="container">
    <div class="card">
        <div class="card-body">
            <h3>Data Kelas</h3>
            <button class="btn btn-primary" id="tambah"><i class="cil-plus"></i> Tambah</button>
            <hr>
            <div class="table-responsive">
                <table class="table table-bordered data-table w-100">
                    <thead>
                        <tr>
                            <th width="50px">No</th>
                            <th>Nama Kelas</th>
                            <th>Nama Jurusan</th>
                            <th>Guru BK</th>
                            <th>Data Peserta Didik</th>
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
    <label for="nama_kelas">Nama Kelas</label>
    <input type="text" class="form-control" name="nama_kelas" placeholder="Nama Kelas" id="nama_kelas" required>
</div>
<div class="form-group">
    <label for="guru_id">Guru BK</label>
    <select name="guru_id" id="guru_id" class="form-control">
        <option value="">Pilih Guru</option>
        @foreach ($guru as $row)
            <option value="{{ $row->id }}">{{ $row->nama_guru }}</option>
        @endforeach
    </select>
</div>
<div class="form-group">
    <label for="jurusan_id">Jurusan</label>
    <select name="jurusan_id" id="jurusan_id" class="form-control">
        <option value="">Pilih Jurusan</option>
        @foreach ($jurusan as $row)
            <option value="{{ $row->id }}">{{ $row->nama_jurusan }}</option>
        @endforeach
    </select>
</div>
<div id="user"></div>
@endsection

@section('script')
<script>
    var table;
    $(document).ready(function(){
        table = $('.data-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ url('admin/data/kelas') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex',orderable: false, searchable: false},
                {data: 'nama_kelas', name: 'nama_kelas'},
                {data: 'nama_jurusan', name: 'nama_jurusan'},
                {data: 'nama_guru', name: 'nama_guru'},
                {data: 'data_kelas', name: 'data_kelas', orderable: false, searchable: false},
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
          $('#nama_kelas').val($(this).data('nama_kelas'));
          $('#guru_id').val($(this).data('guru_id'));
          $('#jurusan_id').val($(this).data('jurusan_id'));
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
