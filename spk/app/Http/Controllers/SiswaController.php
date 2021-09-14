<?php

namespace App\Http\Controllers;

use App\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Yajra\DataTables\Facades\DataTables;

class SiswaController extends Controller
{
    //
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Siswa::orderBy('nama_siswa', 'ASC')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $enId = Crypt::encrypt($row->id);
                    $btn = "<button data-id='$enId' data-nama_siswa='$row->nama_siswa' data-jk='$row->jk' data-nisn='$row->nisn' class='m-1 btn btn-warning edit'><i class='cil-pencil'></i></button> ";
                    $btn .= "<button data-id='$enId' class='m-1 btn btn-danger hapus'><i class='cil-trash'></i></button>";
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        $data = [
            'url' => url('admin/data/siswa/aksi')
        ];
        return view('admin.siswa', $data);
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
            'nama_siswa' => 'required',
            'jk' => 'required',
            'nisn' => 'required',
        ]);

        $user = Siswa::create([
            'nama_siswa' => $request->nama_siswa,
            'jk' => $request->jk,
            'nisn' => $request->nisn,
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
            'nama_siswa' => 'required',
            'jk' => 'required',
            'nisn' => 'required',
        ]);
        $id = Crypt::decrypt($request->id);
        $edit = Siswa::whereId($id)->update([
            'nama_siswa' => $request->nama_siswa,
            'jk' => $request->jk,
            'nisn' => $request->nisn,
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
