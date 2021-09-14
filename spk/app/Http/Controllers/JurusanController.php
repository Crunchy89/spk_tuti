<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jurusan;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class JurusanController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Jurusan::orderBy('nama_jurusan', 'ASC')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $enId = Crypt::encrypt($row->id);
                    $btn = "<button data-id='$enId' data-nama_jurusan='$row->nama_jurusan' class='m-1 btn btn-warning edit'><i class='cil-pencil'></i></button> ";
                    $btn .= "<button data-id='$enId' class='m-1 btn btn-danger hapus'><i class='cil-trash'></i></button>";
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        $data = [
            'url' => url('admin/data/jurusan/aksi')
        ];
        return view('admin.jurusan', $data);
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
            'nama_jurusan' => 'required',
        ]);
        $user = Jurusan::create([
            'nama_jurusan' => $request->nama_jurusan,
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
            'nama_jurusan' => 'required',
        ]);
        $id = Crypt::decrypt($request->id);
        $edit = Jurusan::whereId($id)->update([
            'nama_jurusan' => $request->nama_jurusan,
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
        $id = Crypt::decrypt($request->id);
        $cek = Jurusan::Where('id', $id)->delete();
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
