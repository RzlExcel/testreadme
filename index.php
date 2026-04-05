<?php

// Menghitung bobot: Tugas 30%, UTS 30%, UAS 40%
function hitungNilaiAkhir($tugas, $uts, $uas) {
    return ($tugas * 0.3) + ($uts * 0.3) + ($uas * 0.4);
}

// Menentukan Grade menggunakan If/Else
function tentukanGrade($nilai) {
    if ($nilai >= 85) {
        return "A";
    } elseif ($nilai >= 75) {
        return "B";
    } elseif ($nilai >= 60) {
        return "C";
    } elseif ($nilai >= 50) {
        return "D";
    } else {
        return "E";
    }
}

// Menentukan Status menggunakan operator perbandingan
function tentukanStatus($nilai) {
    return ($nilai >= 60) ? "Lulus" : "Tidak Lulus";
}

// --- DATA MAHASISWA (ARRAY ASOSIATIF) ---
$daftarMahasiswa = [
    [
        "nama"  => "Avrizal Setyo Aji Nugroho",
        "nim"   => "2311102145",
        "tugas" => 90,
        "uts"   => 85,
        "uas"   => 88
    ],
    [
        "nama"  => "Budi Setiawan",
        "nim"   => "2311102001",
        "tugas" => 75,
        "uts"   => 70,
        "uas"   => 65
    ],
    [
        "nama"  => "Excel",
        "nim"   => "2311102002",
        "tugas" => 55,
        "uts"   => 60,
        "uas"   => 50
    ],
    [
        "nama"  => "qiqi",
        "nim"   => "2311102002",
        "tugas" => 75,
        "uts"   => 55,
        "uas"   => 45
    ]
    
];

// Inisialisasi variabel untuk perhitungan statistik
$totalNilai = 0;
$nilaiTertinggi = 0;
$jumlahMahasiswa = count($daftarMahasiswa);

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Sistem Penilaian Mahasiswa</title>
    <style>
        body { 
            font-family: Arial, sans-serif; 
            margin: 30px; 
            background-color: #f8f9fa;
        }
        h2 { 
            text-align: center; 
            color: #333; 
        }
        .container { 
            background-color: #fff; 
            padding: 20px; 
            border-radius: 8px; 
            box-shadow: 0 2px 4px rgba(0,0,0,0.1); 
            max-width: 900px;
            margin: auto;
        }
        table { 
            border-collapse: collapse; 
            width: 100%; 
            margin-bottom: 20px; 
        }
        th, td { 
            border: 1px solid #dee2e6; 
            padding: 12px; 
            text-align: center; 
        }
        th { 
            background-color: #e9ecef; 
            color: #495057;
        }
        .lulus { 
            color: #198754; 
            font-weight: bold; 
        }
        .gagal { 
            color: #dc3545; 
            font-weight: bold; 
        }
        .statistik { 
            background-color: #e9ecef; 
            padding: 15px; 
            border-radius: 5px; 
            font-size: 16px;
        }
        .statistik p {
            margin: 5px 0;
        }
    </style>
</head>
<body>

    <div class="container">
        <h2>Daftar Nilai Mahasiswa - Avrizal Setyo A.N 2311102145</h2>

        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>NIM</th>
                    <th>Nilai Akhir</th>
                    <th>Grade</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $no = 1;
                // Loop untuk menampilkan seluruh data
                foreach ($daftarMahasiswa as $mhs): 
                    // Menghitung hasil menggunakan fungsi
                    $na = hitungNilaiAkhir($mhs['tugas'], $mhs['uts'], $mhs['uas']);
                    $grade = tentukanGrade($na);
                    $status = tentukanStatus($na);
                    
                    // Kalkulasi untuk nilai rata-rata dan nilai tertinggi
                    $totalNilai += $na;
                    if ($na > $nilaiTertinggi) {
                        $nilaiTertinggi = $na;
                    }
                ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $mhs['nama'] ?></td>
                    <td><?= $mhs['nim'] ?></td>
                    <td><?= number_format($na, 2) ?></td>
                    <td><?= $grade ?></td>
                    <td class="<?= ($status == 'Lulus') ? 'lulus' : 'gagal' ?>">
                        <?= $status ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <?php $rataRata = $totalNilai / $jumlahMahasiswa; ?>
        
        <div class="statistik">
            <p><strong>Rata-rata Kelas:</strong> <?= number_format($rataRata, 2) ?></p>
            <p><strong>Nilai Tertinggi:</strong> <?= number_format($nilaiTertinggi, 2) ?></p>
        </div>
    </div>

</body>
</html>