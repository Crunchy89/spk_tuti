<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Print Surat Pemberitahuan</title>
    <link href="{{asset('assets/img/favicon.ico')}}" rel="icon">
    <link href="{{asset('assets/img/apple-touch-icon.png')}}" rel="apple-touch-icon">
    <link href="{{asset('assets/vendor/coreui/dist/css/coreui.min.css')}}" rel="stylesheet" />
    <link href="{{asset('assets/plugins/toastr/toastr.min.css')}}" rel="stylesheet" />
    <link href="{{asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet" />
    <link href="{{asset('assets')}}/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css" rel="stylesheet" />
    <link href="{{asset('assets/vendor/icons/css/all.min.css')}}" rel="stylesheet" />
    <link href="{{asset('assets')}}/plugins/datatables-bs4/css/dataTables.bootstrap4.css" rel="stylesheet" />
    <script src="{{asset('assets')}}/plugins/jquery/jquery.min.js"></script>


</head>

<body style="font-size: 12pt">
    <div style="display: flex;justify-content:space-around">
        <div style="display: flex;justify-content:center;align-items:center">
            <img src="{{ asset('assets/img/loteng.png') }}" alt="logo" width="150px">
        </div>
        <div>
            <h3 class="text-center">PEMERINTAH KABUPATEN LOMBOK BARAT</h3>
            <h3 class="text-center">DINAS PENDIDIKAN DAN KEBUDAYAAN</h3>
            <h2 class="text-center">SMK NEGERI 2 KURIPAN</h2>
            <p class="text-center"><b>Jl. TGH.Ibrahim Al Khalidy Kec.Kuripan Lombok Barat</b></p>
            <p class="text-center">Telp. (0370) 6606448 email: smk2kuripan_lobar@yahoo.com</p>
        </div>
        <div>

        </div>
    </div>


    <hr>
    <div>
        <table>
            <tr>
                <td>Nomor</td>
                <td>:</td>
            </tr>
            <tr>
                <td>Lampiran</td>
                <td>:</td>
            </tr>
            <tr>
                <td>Hal</td>
                <td>:&nbsp;<b>Panggilan Orang Tua/Wali</b></td>
            </tr>
        </table>
    </div>
    <br>
    <p>Yth. Bapak/Ibu Orang Tua/Wali dari Peserta Didik</p>
<br>
    <div>
        <table class="table table-borderless">
            <tr>
                <th>Nama</th>
                <td>:&nbsp;{{$detail->nama_siswa}}</td>
            </tr>
            <tr>
                <th>Nis</th>
                <td>:&nbsp;{{$detail->nisn}}</td>
            </tr>
            <tr>
                <th>Kelas</th>
                <td>:&nbsp;{{ $kelas->nama_kelas }}</td>
            </tr>
            <tr>
                <th>Pelanggaran</th>
                <td>
                        <ol>
                            @foreach ($pelanggaran as $row)
                                <li>{{ $row->pelanggaran }}</li>
                            @endforeach
                        </ol>
                </td>
            </tr>
        </table>
    </div>
    <br>
    <p>Di Tempat</p>
    <p align="justice">Kami mengharapkan kehadiran Bapak/Ibu Orang Tua/Wali Peserta didik untuk datang di Sekolah :</p>
    <br>
    <div>
        <table>
            <tr>
                <th>Hari/Tanggal</th>
                <td>:</td>
            </tr>
            <tr>
                <th>Jam</th>
                <td>:</td>
            </tr>
            <tr>
                <th>Tempat</th>
                <td>:</td>
            </tr>
            <tr>
                <th>Acara</th>
                <td>:</td>
            </tr>
        </table>
    </div>
    <br>
    <p align="justice">Mengingat pentingnya acara tersebut di atas, kehadiran Bapak/Ibu sangat kami harapkan Demikian atas perhatian serta kerjasamanya yang baik, kami haturkan terima kasih.</p>
<br>
    <div>
        <table width="100%">
            <tr>
                <td>
                    <br>
                    <p>a.n. Kepala Sekolah</p>
                    <p>Koordinator Guru BK</p>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <p>(...................................................)</p>
                    <p>NIP.</p>
                </td>
                <td width="60%">

                </td>
                <td>
                    <p>Kuripan, ........................... 20...</p>
                    <br>
                    <p >Guru BK/Guru Piket</p>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <p>(...................................................)</p>
                    <p>NIP.</p>

                </td>
            </tr>
        </table>
    </div>
<br>
<p>Tembusaan disampaikan kepata Yth.</p>
<b>
    <ol type="1">
        <li>Kepala Tata Usaha</li>
        <li>Kepala Paket Keahlian</li>
        <li>Wali Kelas</li>
        <li>Arsip</li>
    </ol>
</b>



    <script src="{{asset('assets')}}/plugins/datatables/jquery.dataTables.js"></script>
    <script src="{{asset('assets')}}/plugins/select2/js/select2.min.js"></script>
    <script src="{{asset('assets')}}/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="{{asset('assets/vendor/coreui/dist/js/coreui.bundle.min.js')}}"></script>
    <script src="{{ asset('assets') }}/plugins/toastr/toastr.min.js"></script>
    <script src="{{ asset('assets/js/axios.js') }}"></script>
    <script>
        window.print();
    </script>
</body>

</html>
