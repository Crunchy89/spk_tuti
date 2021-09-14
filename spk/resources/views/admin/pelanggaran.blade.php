@extends('template.core')

@section('title','Data Pelanggaran')

@section('content')

<div class="container">
    <div class="card">
        <div class="card-body">
            <h3>Data Pelanggaran Kriteria {{$detail->nama_kriteria}}</h3>
            <a href="{{ url('admin/perhitungan') }}" class="btn btn-success"><i class="cil-arrow-left"></i> Kembali</a>
            <button class="btn btn-primary" id="tambah"><i class="cil-plus"></i> Tambah</button>
            <hr>
            <div class="table-responsive">
                <table class="table table-bordered data-table w-100">
                    <thead>
                        <tr>
                            <th width="50px">No</th>
                            <th>Pelanggaran</th>
                            <th>Bobot</th>
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
    <label for="pelanggaran">Nama Pelanggaran</label>
    <textarea name="pelanggaran" id="pelanggaran" placeholder="Nama Pelanggaran" required id="" cols="30" rows="5" class="form-control"></textarea>
</div>
<div class="form-group">
    <label for="bobot">Bobot</label>
    <input type="number" class="form-control" name="bobot" id="bobot" placeholder="Bobot" required>
</div>
@endsection

@section('script')
<script>
    var table;
    $(document).ready(function(){
        table = $('.data-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ url('admin/perhitungan/pelanggaran/'.$kriteria_id) }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex',orderable: false, searchable: false},
                {data: 'pelanggaran', name: 'pelanggaran'},
                {data: 'bobot', name: 'bobot'},
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
          $('#pelanggaran').val($(this).data('pelanggaran'));
          $('#bobot').val($(this).data('bobot'));
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
