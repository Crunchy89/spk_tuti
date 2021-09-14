<?php

namespace App\Http\Controllers;

use App\Guru;
use App\Kriteria;
use App\Kuisioner;
use Exception;
use Illuminate\Http\Request;
use App\Helpers\Ahp;
use App\Kelas;
use App\Pelanggaran;
use App\User;
use Illuminate\Support\Facades\Auth;

class KuisionerController extends Controller
{
    public function index()
    {
        $data = [
            'kriteria' => Kriteria::all()
        ];
        return view('admin.kuisioner.index', $data);
    }
    public function simpan(Request $request)
    {
        $validated = $request->validate([
            'id_user' => 'required',
            'id_kriteria_1' => 'required',
            'id_kriteria_2' => 'required',
            'nilai' => 'required',
        ]);
        $id_user = $request->id_user;
        $id_kriteria_1 = $request->id_kriteria_1;
        $id_kriteria_2 = $request->id_kriteria_2;
        $nilai = $request->nilai;
        $data = [];

        try {
            $same = Kriteria::all();
            foreach ($same as $kuisioner1) {
                foreach ($same as $kuisioner2) {
                    if ($kuisioner1->id == $kuisioner2->id) {
                        $cek_data = Kuisioner::whereId_user($id_user)
                            ->whereId_kriteria_1($kuisioner1->id)
                            ->whereId_kriteria_2($kuisioner2->id)
                            ->first();
                        if (!$cek_data) {
                            Kuisioner::create([
                                'id_user' => $id_user,
                                'id_kriteria_1' => $kuisioner1->id,
                                'id_kriteria_2' => $kuisioner2->id,
                                'nilai' => 1
                            ]);
                        }
                    }
                }
            }
            for ($i = 0; $i < count($id_kriteria_1); $i++) {
                $cek = Kuisioner::whereId_user($id_user)
                    ->whereId_kriteria_1($id_kriteria_1[$i])
                    ->whereId_kriteria_2($id_kriteria_2[$i])
                    ->first();
                if (!$cek) {
                    $data = [
                        'id_user' => $id_user,
                        'id_kriteria_1' => $id_kriteria_1[$i],
                        'id_kriteria_2' => $id_kriteria_2[$i],
                        'nilai' => $nilai[$i]
                    ];
                    Kuisioner::create($data);
                } else {
                    $data = [
                        'nilai' => $nilai[$i]
                    ];
                    Kuisioner::whereId($cek->id)->update($data);
                }
            }
        } catch (Exception $e) {
            dd($e);
        }
        return redirect()->back();
    }

    public function geomean()
    {
        $ahp = new Ahp();
        $geomin = $ahp->getData();
        $jumlahGeomin = $ahp->jumlahGeomin($geomin);
        $matriksNilai = $ahp->getMatriksNilai($geomin, $jumlahGeomin);
        $jumlahMatriksBawah = $ahp->jumlahMatriksBawah($matriksNilai);
        $jumlahMatriksKanan = $ahp->jumlahMatriksKanan($matriksNilai);
        $prioritas = $ahp->prioritas($jumlahMatriksKanan);
        $lamda = $ahp->lamda($jumlahGeomin, $prioritas);
        $n = Kriteria::all()->count();
        $ir = $ahp->ir($n);
        $ci = $ahp->ci($lamda, $n);
        $data = [
            'user' => User::select('user.id', 'guru.nama_guru')
                ->join('guru', 'user.id', '=', 'guru.user_id')
                ->join('data_kuisioner', 'user.id', '=', 'data_kuisioner.id_user')
                ->whereRaw('user.role_id != 1')
                ->groupBy('user.id')
                ->groupBy('guru.nama_guru')
                ->get(),
            'kriteria' => Kriteria::all(),
            'geomean' => $geomin,
            'jumlahGeomin' => $jumlahGeomin,
            'matriksNilai' => $matriksNilai,
            'jumlahBawah' => $jumlahMatriksBawah,
            'jumlahKanan' => $jumlahMatriksKanan,
            'prioritas' => $prioritas,
            'lamda' => $lamda,
            'n' => $n,
            'ir' => $ir,
            'ci' => $ci


        ];
        return view('admin.kuisioner.geomean', $data);
    }

    public function saw()
    {
        $saw = new Ahp();
        $prioritas = $saw->getBobotPreferensiKriteria();
        $guru = Guru::select('guru_id', 'guru.nama_guru')
            ->join('kelas', 'kelas.guru_id', '=', 'guru.id')
            ->join('data_kelas', 'kelas.id', '=', 'data_kelas.kelas_id')
            ->join('siswa', 'data_kelas.siswa_id', '=', 'siswa.id')
            ->join('data_pelanggaran', 'siswa.id', '=', 'data_pelanggaran.siswa_id')
            ->whereRaw("MONTH(data_pelanggaran.created_at) = MONTH(NOW())")
            ->whereRaw("YEAR(data_pelanggaran.created_at) = YEAR(NOW())")
            ->groupBy('guru.id')
            ->get();
        $kelas = Kelas::all();
        $kriteria = Kriteria::all();
        $data = [
            'prioritas' => $prioritas,
            'kelas' => $kelas,
            'guru' => $guru,
            'kriteria' => $kriteria
        ];
        return view('admin.kuisioner.saw', $data);
    }
}
