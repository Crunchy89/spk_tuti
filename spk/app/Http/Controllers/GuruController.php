<?php

namespace App\Http\Controllers;

use App\Guru;
use App\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;

class GuruController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Guru::orderBy('nama_guru', 'ASC')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $enId = Crypt::encrypt($row->id);
                    $btn = "<button data-id='$enId' data-nama_guru='$row->nama_guru' class='m-1 btn btn-warning edit'><i class='cil-pencil'></i></button> ";
                    $btn .= "<button data-id='$enId' class='m-1 btn btn-danger hapus'><i class='cil-trash'></i></button>";
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        $data = [
            'url' => url('admin/data/aksi')
        ];
        return view('admin.guru', $data);
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
            'nama_guru' => 'required',
            'username' => 'required',
            'password' => 'required',
        ]);
        $check = false;
        try {
            DB::transaction(function () use ($request) {
                $user = User::create([
                    'username' => $request->username,
                    'password' => Hash::make($request->password),
                    'role_id' => 2
                ]);
                $tambah = Guru::create([
                    'nama_guru' => $request->nama_guru,
                    'user_id' => $user->id
                ]);
            });
            $check = true;
        } catch (Exception $e) {
            $check = false;
        }
        $data = [];
        if ($check) {
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
            'nama_guru' => 'required',
        ]);
        $id = Crypt::decrypt($request->id);
        $edit = Guru::whereId($id)->update([
            'nama_guru' => $request->nama_guru,
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
        $get = Guru::whereId($id)->first();
        try {
            DB::transaction(function () use ($get) {
                User::Where('id', $get->user_id)->delete();
                Guru::whereId($get->id)->delete();
            });
            $cek = true;
        } catch (Exception $e) {
            dd($e);
            $cek = false;
        }
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
