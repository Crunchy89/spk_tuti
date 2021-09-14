<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kriteria;
use Exception;
use Illuminate\Support\Facades\Crypt;
use Yajra\DataTables\Facades\DataTables;

class KriteriaController extends Controller
{
    //
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Kriteria::all();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('pelanggaran', function ($row) {
                    $enId = Crypt::encrypt($row->id);
                    $btn = "<a href='" . url('admin/perhitungan/pelanggaran/' . $enId) . "'  class='btn btn-success' >Data Pelanggaran</a>";
                    return $btn;
                })
                ->addColumn('action', function ($row) {
                    $enId = Crypt::encrypt($row->id);
                    $btn = "<button data-id='$enId' data-nama_kriteria='$row->nama_kriteria' data-label='$row->label' class='m-1 btn btn-warning edit'><i class='cil-pencil'></i></button> ";
                    $btn .= "<button data-id='$enId' class='m-1 btn btn-danger hapus'><i class='cil-trash'></i></button>";
                    return $btn;
                })
                ->rawColumns(['pelanggaran', 'action'])
                ->make(true);
        }

        $data = [
            'url' => url('admin/perhitungan/aksi')
        ];
        return view('admin.kriteria', $data);
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
            'nama_kriteria' => 'required',
        ]);
        $jumlah = Kriteria::all()->count();
        $label = 'C' . ($jumlah + 1);
        $data = [];
        try {
            Kriteria::create([
                'nama_kriteria' => $request->nama_kriteria,
                'label' => $label,
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
            'nama_kriteria' => 'required',
        ]);
        $id = Crypt::decrypt($request->id);
        $data = [];
        try {
            Kriteria::whereId($id)->update([
                'nama_kriteria' => $request->nama_kriteria,
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
        $cek = Kriteria::whereId($id)->delete();
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
