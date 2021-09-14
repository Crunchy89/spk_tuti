@extends('template.core')
@section('title','Dashboard')
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


@endsection

@section('script')
@if(Session::has('message'))
<script>
    $(document).ready(function() {
        toastr.success(`{{ Session()->get('message') }}`)
    })
</script>
@endif
@endsection
