<?php

namespace App\Http\Controllers;

use App\DataKelas;
use App\DataPelanggaran;
use App\Guru;
use App\Kelas;
use App\Kriteria;
use App\Pelanggaran;
use App\Siswa;
use Exception;
use App\Helpers\Ahp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Symfony\Component\VarDumper\Cloner\Data;
use Yajra\DataTables\Facades\DataTables;

class DataPelanggaranController extends Controller
{
    //
    public function index()
    {
        //
        $kelas = [];
        $guru = [];
        if (Auth::user()->role_id == 1) {
            $kelas = Kelas::selectRaw('kelas.id,kelas.nama_kelas,guru.nama_guru, ( SELECT COUNT(id) FROM data_kelas WHERE kelas_id = kelas.id) as jumlah')->join('guru', 'kelas.guru_id', '=', 'guru.id')->get();
            $guru = Guru::select('guru_id', 'guru.nama_guru')
                ->join('kelas', 'kelas.guru_id', '=', 'guru.id')
                ->join('data_kelas', 'kelas.id', '=', 'data_kelas.kelas_id')
                ->join('siswa', 'data_kelas.siswa_id', '=', 'siswa.id')
                ->join('data_pelanggaran', 'siswa.id', '=', 'data_pelanggaran.siswa_id')
                ->whereRaw("MONTH(data_pelanggaran.created_at) = MONTH(NOW())")
                ->whereRaw("YEAR(data_pelanggaran.created_at) = YEAR(NOW())")
                ->groupBy('guru.id')
                ->get();
        } else {
            $kelas = Kelas::selectRaw('kelas.id,kelas.nama_kelas,kelas.guru_id,guru.nama_guru, ( SELECT COUNT(id) FROM data_kelas WHERE kelas_id = kelas.id) as jumlah')
                ->join('guru', 'kelas.guru_id', '=', 'guru.id')
                ->join('user', 'guru.user_id', '=', 'user.id')
                ->where('user.id', Auth::user()->id)
                ->get();
            $guru = Guru::select('guru_id', 'guru.nama_guru')
                ->join('kelas', 'kelas.guru_id', '=', 'guru.id')
                ->join('user', 'guru.user_id', '=', 'user.id')
                ->join('data_kelas', 'kelas.id', '=', 'data_kelas.kelas_id')
                ->join('siswa', 'data_kelas.siswa_id', '=', 'siswa.id')
                ->join('data_pelanggaran', 'siswa.id', '=', 'data_pelanggaran.siswa_id')
                ->where('user.id', Auth::user()->id)
                ->whereRaw("MONTH(data_pelanggaran.created_at) = MONTH(NOW())")
                ->whereRaw("YEAR(data_pelanggaran.created_at) = YEAR(NOW())")
                ->groupBy('guru.id')
                ->get();
        }

        $data = [
            'kelas' => $kelas,
            'guru' => $guru
        ];
        return view('admin.pelanggaran.index', $data);
    }

    public function kelas(Request $request, $id)
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
                ->addColumn('pelanggaran', function ($row) {
                    $data = DataPelanggaran::whereSiswa_id($row->siswa_id)->get()->count();
                    return $data;
                })
                ->addColumn('bobot', function ($row) {
                    $data = Pelanggaran::selectRaw('SUM(pelanggaran.bobot) as total')
                        ->join('data_pelanggaran', 'pelanggaran.id', '=', 'data_pelanggaran.pelanggaran_id')
                        ->where('data_pelanggaran.siswa_id', $row->siswa_id)
                        ->groupBy('data_pelanggaran.siswa_id')
                        ->first();
                    return $data->total ?? 0;
                })
                ->addColumn('siswa', function ($row) {
                    $enId = Crypt::encrypt($row->siswa_id);
                    $btn = "<a href='" . url('admin/siswa/kelas/data/' . $enId) . "' class='btn btn-success'>Data Pelanggaran Peserta Didik</a>";
                    return $btn;
                })
                ->rawColumns(['bobot', 'pelanggaran', 'siswa'])
                ->make(true);
        }
        $data = [
            'detail' => Kelas::whereId($kelas_id)->first(),
            'kelas' => Kelas::orderBy('nama_kelas', 'ASC')->get(),
            'kelas_id' => $id,
        ];
        return view('admin.pelanggaran.kelas', $data);
    }

    public function siswa(Request $request, $id)
    {
        $siswa_id = Crypt::decrypt($id);

        $data = [
            'detail' => DataKelas::join('siswa', 'data_kelas.siswa_id', '=', 'siswa.id')->where('siswa.id', $siswa_id)->first(),
            'kriteria' => Kriteria::all()
        ];
        return view('admin.pelanggaran.siswa', $data);
    }

    public function simpan(Request $request)
    {
        $siswa_id = $request->siswa_id;
        $pelanggaran_id = $request->pelanggaran_id;
        try {
            DataPelanggaran::whereSiswa_id($siswa_id)->whereRaw('DATE(created_at) = DATE(NOW())')->delete();
            $data = [];
            foreach ($pelanggaran_id as $row) {
                $data[] = [
                    'siswa_id' => $siswa_id,
                    'pelanggaran_id' => $row
                ];
            }
            DataPelanggaran::insert($data);
            return redirect()->back()->with(['success' => 'Data berhasil disimpan']);
        } catch (Exception $e) {
            return redirect()->back()->with(['error' => 'Data gagal disimpan']);
        }
    }
    public function print($id, $point)
    {
        $saw = new Ahp();
        $siswa = Siswa::find($id);
        $pelanggaran = DataPelanggaran::join('pelanggaran', 'data_pelanggaran.pelanggaran_id', '=', 'pelanggaran.id')->where('data_pelanggaran.siswa_id', $id)->whereRaw('MONTH(data_pelanggaran.created_at) = MONTH(NOW())')->whereRaw('YEAR(data_pelanggaran.created_at)=YEAR(NOW())')->get();
        $data = [
            'detail' => $siswa,
            'kelas' => DataKelas::join('kelas', 'data_kelas.kelas_id', '=', 'kelas.id')->where('data_kelas.siswa_id', $siswa->id)->first(),
            'point' => $saw->tindakan($point),
            'pelanggaran' => $pelanggaran
        ];
        return view('admin.pelanggaran.print', $data);
    }
}
