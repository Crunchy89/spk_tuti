@extends('template.core')

@section('title','Kuisioner AHP')

@section('content')

<div class="container">
    <div class="card">
        <div class="card-body">
            <h3 class="text-center">Kuisioner AHP</h3>
            <hr>
            <h3 class="text-center">Tingkat Kepentingan</h3>
            <form action="{{ url('admin/kuisioner/simpan') }}" method="post">
                <input type="hidden" name="id_user" value="{{ Auth::user()->id }}">
                @csrf
                @php
                    $id=0;
                @endphp
                @foreach ($kriteria as $kriteria1)
                    @foreach ($kriteria as $kriteria2 )
                    @if ($kriteria1->id != $kriteria2->id)
                    <input type="hidden" name="id_kriteria_1[]" value="{{ $kriteria1->id }}">
                    <input type="hidden" name="id_kriteria_2[]" value="{{ $kriteria2->id }}">
                    @php
                        $cek=\App\Kuisioner::whereId_user(Auth::user()->id)
                        ->whereId_kriteria_1($kriteria1->id)
                        ->whereId_kriteria_2($kriteria2->id)
                        ->first()
                    @endphp

                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-2">
                            {{$kriteria1->nama_kriteria}}
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-8">
                            <div id="pilihan" class="d-flex flex-row justify-content-center">
                                @for ($i=9;$i>=1;$i--)
                                <div class="d-flex flex-column align-items-center m-1 ml-2 mr-2">
                                    @if ($cek)
                                    <input class="pilih" data-loop="{{$i}}" id="{{ '_'.$i.'_'.$kriteria1->label.'_'.$kriteria2->label }}" data-kriteria1="{{ $kriteria1->label }}" data-kriteria2="{{ $kriteria2->label }}" data-position='left' type="radio" value="{{ $i/1 }}" name="nilai[{{$id}}]" {{ $cek->nilai == $i ? 'checked' : '' }} name=""> {{$i}}
                                    @else
                                    <input class="pilih" data-loop="{{$i}}" id="{{ '_'.$i.'_'.$kriteria1->label.'_'.$kriteria2->label }}" data-kriteria1="{{ $kriteria1->label }}" data-kriteria2="{{ $kriteria2->label }}" data-position='left' type="radio" value="{{ $i/1 }}" name="nilai[{{$id}}]" {{ $i==1 ? 'checked' : '' }} name=""> {{$i}}
                                    @endif
                                </div>
                                @endfor
                                @for ($i=2;$i<=9;$i++)
                                <div class="d-flex flex-column align-items-center m-1 ml-2 mr-2">
                                    @if ($cek)
                                    <input class="pilih" data-loop="{{$i}}" id="{{ $i.'_'.$kriteria1->label.'_'.$kriteria2->label }}" data-kriteria1="{{ $kriteria1->label }}" data-kriteria2="{{ $kriteria2->label }}" data-position='right' type="radio" value="{{ round((1/$i),3) }}" name="nilai[{{$id}}]" {{ $cek->nilai == round((1/$i),3) ? 'checked' : '' }} name=""> {{$i}}
                                    @else
                                    <input class="pilih" data-loop="{{$i}}" id="{{ $i.'_'.$kriteria1->label.'_'.$kriteria2->label }}" data-kriteria1="{{ $kriteria1->label }}" data-kriteria2="{{ $kriteria2->label }}" data-position='right' type="radio" value="{{ round((1/$i),3) }}" name="nilai[{{$id}}]" {{ $i==1 ? 'checked' : '' }} name=""> {{$i}}
                                    @endif
                                </div>
                                @endfor
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-2">
                            {{$kriteria2->nama_kriteria}}
                        </div>
                    </div>
                    @php
                        $id++;
                    @endphp
                    @endif
                    @endforeach
                @endforeach
            <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){
        $('.pilih').each(function(){
            $(this).click(function(){
                let c1=$(this).data('kriteria1')
            let c2=$(this).data('kriteria2')
            let pos=$(this).data('position')
            let loop = $(this).data('loop')
            if(pos=='right'){
                $(`#_${loop}_${c2}_${c1}`).prop('checked',true)
            }else{
                if(loop == 1){
                    $(`#_${loop}_${c2}_${c1}`).prop('checked',true)
                }else{
                    $(`#${loop}_${c2}_${c1}`).prop('checked',true)
                }
            }
            })
        })
    })
</script>

@endsection
