<?php

namespace App\Helpers;

use App\DataPelanggaran;
use App\Kelas;
use App\Kriteria;
use App\Kuisioner;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Ahp
{
    public function getData()
    {
        $user = User::select('user.id', 'guru.nama_guru')
            ->join('guru', 'user.id', '=', 'guru.user_id')
            ->join('data_kuisioner', 'user.id', '=', 'data_kuisioner.id_user')
            ->whereRaw('user.role_id != 1')
            ->groupBy('user.id')
            ->groupBy('guru.nama_guru')
            ->get();
        $kriteria = Kriteria::all();
        $data = [];
        foreach ($kriteria as $c1) {
            $one = [];
            foreach ($kriteria as $c2) {
                $char = [];
                foreach ($user as $u) {
                    $val = 1;
                    $tes = Kuisioner::whereId_user($u->id)
                        ->whereId_kriteria_1($c1->id)
                        ->whereId_kriteria_2($c2->id)
                        ->first();
                    if ($tes) {
                        $val = $tes->nilai;
                    }
                    $char[] = $val;
                }
                $one[] = $this->geometricMean($char, count($char));
            }
            $data[] = $one;
        }

        return $data;
    }

    public function geometricMean($arr, $n)
    {
        $product = 1;

        for ($i = 0; $i < $n; $i++)
            $product = $product * $arr[$i];

        $gm = pow($product, (float)(1 / $n));
        return round($gm, 3);
    }

    public function jumlahGeomin($arr)
    {
        $data = [];
        for ($i = 0; $i < count($arr); $i++) {
            $tes = [];
            for ($j = 0; $j < count($arr[$i]); $j++) {
                $tes[] = $arr[$j][$i];
            }
            $data[] = round(array_sum($tes), 3);
        }
        return $data;
    }

    public function getMatriksNilai($dataGeomin, $jumlahGeomin)
    {
        $data = [];
        for ($i = 0; $i < count($dataGeomin); $i++) {
            $tes = [];
            for ($j = 0; $j < count($dataGeomin[$i]); $j++) {
                $res = $dataGeomin[$i][$j] / $jumlahGeomin[$j];
                $tes[] = round($res, 3);
            }
            $data[] = $tes;
        }
        return $data;
    }

    public function jumlahMatriksBawah($arr)
    {
        $data = [];
        for ($i = 0; $i < count($arr); $i++) {
            $tes = [];
            for ($j = 0; $j < count($arr[$i]); $j++) {
                $tes[] = $arr[$j][$i];
            }
            $data[] = round(array_sum($tes), 3);
        }
        return $data;
    }

    public function jumlahMatriksKanan($arr)
    {
        $data = [];
        for ($i = 0; $i < count($arr); $i++) {
            $tes = [];
            for ($j = 0; $j < count($arr[$i]); $j++) {
                $tes[] = $arr[$i][$j];
            }
            $data[] = round(array_sum($tes), 3);
        }
        return $data;
    }

    public function prioritas($arr)
    {
        $data = [];
        foreach ($arr as $row) {
            $tes = $row / array_sum($arr);
            $data[] = round($tes, 4);
        }
        return $data;
    }

    public function lamda($jumlahGeomin, $prioritas)
    {
        $tes = [];
        for ($i = 0; $i < count($jumlahGeomin); $i++) {
            $tes[] = $jumlahGeomin[$i] * $prioritas[$i];
        }
        return round(array_sum($tes), 3);
    }

    public function ci($lamda, $n)
    {
        $res = ($lamda - $n) / ($n - 1);
        return $res;
    }

    public function ir($n)
    {
        $res = 0;
        if ($n >= 15)
            $res = 1.59;
        else if ($n >= 14)
            $res = 1.57;
        else if ($n >= 13)
            $res = 1.56;
        else if ($n >= 12)
            $res = 1.48;
        else if ($n >= 11)
            $res = 1.51;
        else if ($n >= 10)
            $res = 1.49;
        else if ($n >= 9)
            $res = 1.45;
        else if ($n >= 8)
            $res = 1.41;
        else if ($n >= 7)
            $res = 1.32;
        else if ($n >= 6)
            $res = 1.24;
        else if ($n >= 5)
            $res = 1.12;
        else if ($n >= 4)
            $res = 0.90;
        else if ($n >= 3)
            $res = 0.58;
        else if ($n >= 2)
            $res = 0.00;

        return $res;
    }

    public function getBobotPreferensiKriteria()
    {
        $geomin = $this->getData();
        $jumlahGeomin = $this->jumlahGeomin($geomin);
        $matriksNilai = $this->getMatriksNilai($geomin, $jumlahGeomin);
        $jumlahMatriksKanan = $this->jumlahMatriksKanan($matriksNilai);
        $prioritas = $this->prioritas($jumlahMatriksKanan);
        $data = [];
        foreach ($prioritas as $row) {
            $data[] = round($row * 100, 4);
        }
        return $data;
    }

    public function getDataSaw($guru_id)
    {
        $kriteria = Kriteria::all();
        $siswa = Kelas::select('siswa.id', 'siswa.nama_siswa')
            ->join('data_kelas', 'kelas.id', '=', 'data_kelas.kelas_id')
            ->join('siswa', 'data_kelas.siswa_id', '=', 'siswa.id')
            ->join('data_pelanggaran', 'siswa.id', '=', 'data_pelanggaran.siswa_id')
            ->where('kelas.guru_id', $guru_id)
            ->whereRaw("MONTH(data_pelanggaran.created_at) = MONTH(NOW())")
            ->whereRaw("YEAR(data_pelanggaran.created_at) = YEAR(NOW())")
            ->groupBy('siswa.id')
            ->get();
        $data = [];
        foreach ($siswa as $s) {
            $tes = [];
            $tes[] = $s->nama_siswa;
            foreach ($kriteria as $k) {
                $cek = DataPelanggaran::selectRaw("SUM(pelanggaran.bobot) as jumlah")
                    ->join('pelanggaran', 'data_pelanggaran.pelanggaran_id', '=', 'pelanggaran.id')
                    ->where('data_pelanggaran.siswa_id', $s->id)
                    ->where('pelanggaran.kriteria_id', $k->id)
                    ->whereRaw("MONTH(data_pelanggaran.created_at) = MONTH(NOW())")
                    ->whereRaw("YEAR(data_pelanggaran.created_at) = YEAR(NOW())")
                    ->groupBy('pelanggaran.kriteria_id')
                    ->groupBy('data_pelanggaran.siswa_id')
                    ->first();
                $tes[] = $cek ?  $cek->jumlah : 0;
            }
            $data[] = $tes;
        }
        return $data;
    }

    public function getPointSaw($guru_id)
    {
        $kriteria = Kriteria::all();
        $siswa = Kelas::select('siswa.id', 'siswa.nama_siswa')
            ->join('data_kelas', 'kelas.id', '=', 'data_kelas.kelas_id')
            ->join('siswa', 'data_kelas.siswa_id', '=', 'siswa.id')
            ->join('data_pelanggaran', 'siswa.id', '=', 'data_pelanggaran.siswa_id')
            ->where('kelas.guru_id', $guru_id)
            ->whereRaw("MONTH(data_pelanggaran.created_at) = MONTH(NOW())")
            ->whereRaw("YEAR(data_pelanggaran.created_at) = YEAR(NOW())")
            ->groupBy('siswa.id')
            ->get();
        $data = [];
        foreach ($siswa as $s) {
            $tes = [];
            foreach ($kriteria as $k) {
                $cek = DataPelanggaran::selectRaw("SUM(pelanggaran.bobot) as jumlah")
                    ->join('pelanggaran', 'data_pelanggaran.pelanggaran_id', '=', 'pelanggaran.id')
                    ->where('data_pelanggaran.siswa_id', $s->id)
                    ->where('pelanggaran.kriteria_id', $k->id)
                    ->whereRaw("MONTH(data_pelanggaran.created_at) = MONTH(NOW())")
                    ->whereRaw("YEAR(data_pelanggaran.created_at) = YEAR(NOW())")
                    ->groupBy('pelanggaran.kriteria_id')
                    ->groupBy('data_pelanggaran.siswa_id')
                    ->first();
                $tes[] = $cek ? $cek->jumlah : 0;
            }
            $data[] = $tes;
        }
        return $data;
    }

    public function perhitunganSaw($guru_id)
    {
        $siswa = $this->getPointSaw($guru_id);
        $prioritas = $this->getBobotPreferensiKriteria();
        $max = DB::select("SELECT
            MAX(jumlah) as jumlah
         FROM
             (
             SELECT
                SUM(pelanggaran.bobot) as jumlah, kelas.guru_id,pelanggaran.kriteria_id,siswa.id
             FROM
                pelanggaran
              INNER JOIN
                         kriteria
                         ON pelanggaran.kriteria_id = kriteria.id
              INNER JOIN
                         data_pelanggaran
                         ON pelanggaran.id = data_pelanggaran.pelanggaran_id
                 INNER JOIN
                         siswa
                         ON data_pelanggaran.siswa_id = siswa.id
                 INNER JOIN
                         data_kelas
                         ON siswa.id = data_kelas.siswa_id
                 INNER JOIN
                         kelas
                         ON data_kelas.kelas_id = kelas.id
                 WHERE
                 kelas.guru_id = $guru_id
             GROUP BY
                kelas.guru_id, pelanggaran.kriteria_id, siswa.id
             ) tes
         GROUP BY
            guru_id, kriteria_id");
        // $max = DataPelanggaran::selectRaw("SUM(pelanggaran.bobot) as jumlah")
        //     ->join("pelanggaran", 'data_pelanggaran.pelanggaran_id', '=', 'pelanggaran.id')
        //     ->join("siswa", 'data_pelanggaran.siswa_id', '=', 'siswa.id')
        //     ->join("data_kelas", 'siswa.id', '=', 'data_kelas.siswa_id')
        //     ->join("kelas", 'data_kelas.kelas_id', '=', 'kelas.id')
        //     ->whereRaw("MONTH(data_pelanggaran.created_at) = MONTH(NOW())")
        //     ->whereRaw("YEAR(data_pelanggaran.created_at) = YEAR(NOW())")
        //     ->where('kelas.guru_id', $guru_id)
        //     ->groupBy('kelas.guru_id')
        //     ->groupBy('pelanggaran.kriteria_id')
        //     ->get();
        // dd($max);
        $res = [];
        foreach ($max as $row) {
            $res[] = $row->jumlah;
        }
        $data = [];
        for ($i = 0; $i < count($siswa); $i++) {
            $tes = [];
            for ($j = 0; $j < count($siswa[$i]); $j++) {
                if (isset($res[$j]) && isset($siswa[$i][$j])) {
                    if ($res[$j] == 0 || $siswa[$i][$j] == 0) {
                        $tes[] = 0;
                    } else {
                        $tes[] = round((($siswa[$i][$j] / $res[$j]) * $prioritas[$j]), 3);
                    }
                }
            }
            $data[] = array_sum($tes);
        }
        return $data;
    }

    public function tindakan($val)
    {
        $data = [];
        if ($val >= 81) {
            $data = [
                'tindakan' => "Berkomunikasi dengan orangtua/wali, memberikan dukungan dan perhatian.",
                'sanksi' => "Pemanggilan orang tua/wali, dikembalikan kepada orang tua selamanya",
                'jenis' => "Pelanggaran Berat 3"
            ];
        } else if ($val >= 51) {
            $data = [
                'tindakan' => "Berkomunikasi dengan orangtua/wali, memberikan dukungan dan perhatian.",
                'sanksi' => "Pemanggilan orang tua/wali, dikembalikan kepada orang tua pada waktu tertentu (skorsing 6-12 hari)",
                'jenis' => "Pelanggaran Berat 2"
            ];
        } else if ($val >= 31) {
            $data = [
                'tindakan' => "Berkomunikasi dengan orangtua/wali, memberikan dukungan dan perhatian.",
                'sanksi' => "Pemanggilan orang tua/wali, dikembalikan kepada orang tua pada waktu tertentu (skorsing 3-6 hari)",
                'jenis' => "Pelanggaran Berat 1"
            ];
        } else if ($val >= 11) {
            $data = [
                'tindakan' => "Diperhatikan dan berkomunikasi dengan orang tua/wali, memberikan bimbingan dan perhatian.",
                'sanksi' => "Membuat surat penyataan yang diketahui oleh wali kelas, pemanggilan orang tua/wali (teguran tertulis)",
                'jenis' => "Sedang"
            ];
        } else if ($val >= 1) {
            $data = [
                'tindakan' => "Diadakan pembinaan, bimbingan, dan perhatian oleh guru BP/BK, wali kelas dan guru kesiswaan.",
                'sanksi' => "Peringatan lisan",
                'jenis' => "Ringan"
            ];
        } else {
            $data = [
                'tindakan' => "",
                'sanksi' => "",
                'jenis' => "",
            ];
        }
        return $data;
    }

    public function getSiswa($guru_id)
    {
        $kriteria = Kriteria::all();
        $siswa = Kelas::select('siswa.id', 'siswa.nama_siswa')
            ->join('data_kelas', 'kelas.id', '=', 'data_kelas.kelas_id')
            ->join('siswa', 'data_kelas.siswa_id', '=', 'siswa.id')
            ->join('data_pelanggaran', 'siswa.id', '=', 'data_pelanggaran.siswa_id')
            ->where('kelas.guru_id', $guru_id)
            ->whereRaw("MONTH(data_pelanggaran.created_at) = MONTH(NOW())")
            ->whereRaw("YEAR(data_pelanggaran.created_at) = YEAR(NOW())")
            ->groupBy('siswa.id')
            ->get();
        return $siswa;
    }
}
