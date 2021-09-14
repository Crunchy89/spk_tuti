<?php

namespace App\Http\Controllers;

use App\Akses;
use App\Kelas;
use App\Submenu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $kelas = [];
        if (Auth::user()->role_id == 1) {
            $kelas = Kelas::selectRaw('kelas.id,kelas.nama_kelas,guru.nama_guru, ( SELECT COUNT(id) FROM data_kelas WHERE kelas_id = kelas.id) as jumlah')->join('guru', 'kelas.guru_id', '=', 'guru.id')->get();
        } else {
            $kelas = Kelas::selectRaw('kelas.id,kelas.nama_kelas,kelas.guru_id,guru.nama_guru, ( SELECT COUNT(id) FROM data_kelas WHERE kelas_id = kelas.id) as jumlah')
                ->join('guru', 'kelas.guru_id', '=', 'guru.id')
                ->join('user', 'guru.user_id', '=', 'user.id')
                ->where('user.id', Auth::user()->id)
                ->get();
        }
        $data = [
            'kelas' => $kelas
        ];
        return view('admin.dashboard', $data);
    }
}
