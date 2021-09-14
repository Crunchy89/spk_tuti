<?php

namespace App\Http\Controllers;

use App\Guru;
use App\Jurusan;
use App\Kelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Yajra\DataTables\Facades\DataTables;

class KelasController extends Controller
{
    //
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Kelas::select('kelas.id', 'kelas.nama_kelas', 'guru.nama_guru', 'guru.id as guru_id', 'jurusan.nama_jurusan', 'jurusan.id as jurusan_id')
                ->join('guru', 'kelas.guru_id', '=', 'guru.id', 'inner')
                ->join('jurusan', 'kelas.jurusan_id', '=', 'jurusan.id', 'inner')
                ->orderBy('kelas.nama_kelas', 'ASC')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('data_kelas', function ($row) {
                    $id = Crypt::encrypt($row->id);
                    $btn = '<a href=' . url("admin/data/kelas/datakelas/" . $id) . ' class="btn btn-primary">Data Peserta Didik</a>';
                    return $btn;
                })
                ->addColumn('action', function ($row) {
                    $enId = Crypt::encrypt($row->id);
                    $btn = "<button data-id='$enId' data-nama_kelas='$row->nama_kelas' data-guru_id='$row->guru_id' data-jurusan_id='$row->jurusan_id' class='m-1 btn btn-warning edit'><i class='cil-pencil'></i></button> ";
                    $btn .= "<button data-id='$enId' class='m-1 btn btn-danger hapus'><i class='cil-trash'></i></button>";
                    return $btn;
                })
                ->rawColumns(['data_kelas', 'action'])
                ->make(true);
        }

        $data = [
            'guru' => Guru::all(),
            'jurusan' => Jurusan::all(),
            'url' => url('admin/data/kelas/aksi')
        ];
        return view('admin.kelas', $data);
    }
    public function aksi(Request $request)
    {
        $aksi = $request->post('aksi');
        $data = [];
        if ($aksi == 'tambah') {
            $data = $this->tambah($request);
        } elseif ($aksi == 'edit') {
            $data = $this->edit($request);
        } elseif ($aksi == 'hapus') {
            $data = $this->hapus($request);
        } else {
            $data = [
                'status' => false,
                'pesan' => 'Tidak ada pilihan aksi'
            ];
        }
        return response()->json($data);
    }
    private function tambah(Request $request)
    {
        $validated = $request->validate([
            'nama_kelas' => 'required',
            'guru_id' => 'required',
            'jurusan_id' => 'required',
        ]);

        $user = Kelas::create([
            'nama_kelas' => $request->nama_kelas,
            'guru_id' => $request->guru_id,
            'jurusan_id' => $request->jurusan_id,
        ]);
        $data = [];

        if ($user) {
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
            'id' => 'required',
            'nama_kelas' => 'required',
            'guru_id' => 'required',
            'jurusan_id' => 'required',
        ]);
        $id = Crypt::decrypt($request->id);
        $edit = Kelas::whereId($id)->update([
            'nama_kelas' => $request->nama_kelas,
            'guru_id' => $request->guru_id,
            'jurusan_id' => $request->jurusan_id,
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
        $cek = Kelas::whereId($id)->delete();
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
