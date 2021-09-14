@extends('template.core')

@section('title','Data Kriteria')

@section('content')

<div class="container">
    <div class="card">
        <div class="card-body">
            <h3>Data Kriteria</h3>
            <button class="btn btn-primary" id="tambah"><i class="cil-plus"></i> Tambah</button>
            <hr>
            <div class="table-responsive">
                <table class="table table-bordered data-table w-100">
                    <thead>
                        <tr>
                            <th width="50px">No</th>
                            <th>Label</th>
                            <th>Nama Kriteria</th>
                            <th>Data Pelanggaran</th>
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
    <label for="nama_kriteria">Nama Kriteria</label>
    <input type="text" class="form-control" name="nama_kriteria" placeholder="Nama Kriteria" id="nama_kriteria" required>
</div>
@endsection

@section('script')
<script>
    var table;
    $(document).ready(function(){
        table = $('.data-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ url('admin/perhitungan') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex',orderable: false, searchable: false},
                {data: 'label', name: 'label'},
                {data: 'nama_kriteria', name: 'nama_kriteria'},
                {data: 'pelanggaran', name: 'pelanggaran', orderable: false, searchable: false},
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
          $('#nama_kriteria').val($(this).data('nama_kriteria'));
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
