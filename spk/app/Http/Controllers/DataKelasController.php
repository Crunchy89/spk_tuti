<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DataKelas;
use App\Kelas;
use App\Siswa;
use Exception;
use Illuminate\Support\Facades\Crypt;
use Yajra\DataTables\Facades\DataTables;

class DataKelasController extends Controller
{
    //
    public function index(Request $request, $id)
    {
        $kelas_id = Crypt::decrypt($id);
        if ($request->ajax()) {
            $data = DataKelas::select('data_kelas.*', 'siswa.nama_siswa', 'siswa.nisn', 'siswa.jk')
                ->join('siswa', 'data_kelas.siswa_id', '=', 'siswa.id')
                ->join('kelas', 'data_kelas.kelas_id', '=', 'kelas.id')
                ->where('kelas.id', $kelas_id)
                ->orderBy('kelas.nama_kelas', 'ASC')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $enId = Crypt::encrypt($row->id);
                    $siswaId = Crypt::encrypt($row->siswa_id);
                    $btn = "<button data-id='$enId' class='m-1 btn btn-info pindah'><i class='cil-move'></i></button>";
                    $btn .= "<button data-id='$siswaId' data-kelas_id='$row->kelas_id' data-nama_siswa='$row->nama_siswa' data-jk='$row->jk' data-nisn='$row->nisn' class='m-1 btn btn-warning edit'><i class='cil-pencil'></i></button> ";
                    $btn .= "<button data-id='$siswaId' class='m-1 btn btn-danger hapus'><i class='cil-trash'></i></button>";
                    return $btn;
                })
                ->rawColumns(['data_kelas', 'action'])
                ->make(true);
        }
        $data = [
            'detail' => Kelas::whereId($kelas_id)->first(),
            'kelas' => Kelas::orderBy('nama_kelas', 'ASC')->get(),
            'kelas_id' => $id,
            'url' => url('admin/data/kelas/datakelas/aksi/' . $id)
        ];
        return view('admin.datakelas', $data);
    }
    public function aksi(Request $request, $kelas_id)
    {
        $kelas_id = Crypt::decrypt($kelas_id);
        $aksi = $request->post('aksi');
        $data = [];
        if ($aksi == 'tambah') {
            $data = $this->tambah($request, $kelas_id);
        } elseif ($aksi == 'edit') {
            $data = $this->edit($request, $kelas_id);
        } elseif ($aksi == 'hapus') {
            $data = $this->hapus($request);
        } elseif ($aksi == 'pindah') {
            $data = $this->pindah($request);
        } else {
            $data = [
                'status' => false,
                'pesan' => 'Tidak ada pilihan aksi'
            ];
        }
        return response()->json($data);
    }
    private function tambah(Request $request, $kelas_id)
    {
        $validated = $request->validate([
            'nama_siswa' => 'required',
            'jk' => 'required',
            'nisn' => 'required',
        ]);
        $cek = false;
        try {
            $siswa = Siswa::create([
                'nama_siswa' => $request->nama_siswa,
                'jk' => $request->jk,
                'nisn' => $request->nisn
            ]);
            DataKelas::create([
                'siswa_id' => $siswa->id,
                'kelas_id' => $kelas_id
            ]);
            $cek = true;
        } catch (Exception $e) {
            dd($e);
            $cek = false;
        }
        $data = [];
        if ($cek) {
            $data = [
                'status' => true,
                'pesan' => 'Data berhasil ditambah'
            ];
        } else {
            $data = [
                'status' => false,
                'pesan' => 'Data gagal ditambah'
            ];
        }
        return $data;
    }
    private function edit(Request $request)
    {
        $validated = $request->validate([
            'nama_siswa' => 'required',
            'jk' => 'required',
            'nisn' => 'required',
        ]);
        $id = crypt::decrypt($request->id);
        $cek = Siswa::whereId($id)->update([
            'nama_siswa' => $request->nama_siswa,
            'jk' => $request->jk,
            'nisn' => $request->nisn
        ]);
        $data = [];
        if ($cek) {
            $data = [
                'status' => true,
                'pesan' => "Data berhasil diubah"
            ];
        } else {
            $data = [
                'status' => false,
                'pesan' => "Data gagal diubah"
            ];
        }
        return $data;
    }
    private function pindah(Request $request)
    {
        $validated = $request->validate([
            'id' => 'required',
            'kelas_id' => 'required',
        ]);
        $id = Crypt::decrypt($request->id);
        $edit = DataKelas::whereId($id)->update([
            'kelas_id' => $request->kelas_id,
        ]);
        $data = [];
        if ($edit) {
            $data = [
                'status' => true,
                'pesan' => 'Data berhasil diubah'
            ];
        } else {
            $data = [
                'status' => false,
                'pesan' => 'Data gagal diubah'
            ];
        }
        return $data;
    }
    private function hapus(Request $request)
    {
        $validated = $request->validate([
            'id' => 'required',
        ]);
        $cek = false;
        $id = Crypt::decrypt($request->id);
        $cek = Siswa::whereId($id)->delete();
        $data = [];
        if ($cek) {
            $data = [
                'status' => true,
                'pesan' => 'Data berhasil dihapus'
            ];
        } else {
            $data = [
                'status' => false,
                'pesan' => 'Data gagal dihapus'
            ];
        }
        return $data;
    }
}
