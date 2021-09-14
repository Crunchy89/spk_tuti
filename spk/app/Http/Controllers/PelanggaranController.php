<?php

namespace App\Http\Controllers;

use App\Kriteria;
use Illuminate\Http\Request;
use App\Pelanggaran;
use Exception;
use Illuminate\Support\Facades\Crypt;
use Yajra\DataTables\Facades\DataTables;

class PelanggaranController extends Controller
{
    public function index(Request $request, $id)
    {
        $decId = Crypt::decrypt($id);
        if ($request->ajax()) {
            $data = Pelanggaran::whereKriteria_id($decId)->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $enId = Crypt::encrypt($row->id);
                    $btn = "<button data-id='$enId' data-pelanggaran='$row->pelanggaran' data-bobot='$row->bobot' class='m-1 btn btn-warning edit'><i class='cil-pencil'></i></button> ";
                    $btn .= "<button data-id='$enId' class='m-1 btn btn-danger hapus'><i class='cil-trash'></i></button>";
                    return $btn;
                })
                ->rawColumns(['pelanggaran', 'action'])
                ->make(true);
        }

        $data = [
            'url' => url('admin/perhitungan/pelanggaran/aksi/' . $id),
            'kriteria_id' => $id,
            'detail' => Kriteria::whereId($decId)->first()
        ];
        return view('admin.pelanggaran', $data);
    }
    public function aksi(Request $request, $id)
    {
        $aksi = $request->post('aksi');
        $data = [];
        if ($aksi == 'tambah') {
            $data = $this->tambah($request, $id);
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
    private function tambah(Request $request, $id)
    {
        $validated = $request->validate([
            'pelanggaran' => 'required',
            'bobot' => 'required',
        ]);
        $id = Crypt::decrypt($id);
        $data = [];
        try {
            Pelanggaran::create([
                'kriteria_id' => $id,
                'pelanggaran' => $request->pelanggaran,
                'bobot' => $request->bobot,
            ]);
            $data = [
                'status' => true,
                'pesan' => 'Data berhasil ditambah'
            ];
        } catch (Exception $e) {
            $data = [
                'status' => false,
                'pesan' => $e
            ];
        }

        return $data;
    }
    private function edit(Request $request)
    {
        $validated = $request->validate([
            'id' => 'required',
            'pelanggaran' => 'required',
            'bobot' => 'required',
        ]);
        $id = Crypt::decrypt($request->id);
        $data = [];
        try {
            Pelanggaran::whereId($id)->update([
                'pelanggaran' => $request->pelanggaran,
                'bobot' => $request->bobot,
            ]);
            $data = [
                'status' => true,
                'pesan' => 'Data berhasil diubah'
            ];
        } catch (Exception $e) {
            $data = [
                'status' => false,
                'pesan' => $e
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
        $cek = Pelanggaran::whereId($id)->delete();
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
