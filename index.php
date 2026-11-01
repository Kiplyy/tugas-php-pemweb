
<?php
// 1. Array multidimensi mata kuliah
$matkul = [
    [
        "nama" => "Algoritma dan Pemrograman",
        "sks" => 3,
        "nilai" => 85
    ],
    [
        "nama" => "Basis Data",
        "sks" => 3,
        "nilai" => 75
    ],
    [
        "nama" => "Sistem Operasi",
        "sks" => 3,
        "nilai" => 65
    ],
    [
        "nama" => "Jaringan Komputer",
        "sks" => 2,
        "nilai" => 55
    ],
    [
        "nama" => "Matematika Diskrit",
        "sks" => 3,
        "nilai" => 45
    ]
];

// 2. Fungsi helper untuk menghitung bobot
function hitungBobot($nilai) {
    if ($nilai >= 80) {
        return [
            "huruf" => "A",
            "bobot" => 4.0
        ];
    } elseif ($nilai >= 70) {
        return [
            "huruf" => "B",
            "bobot" => 3.0
        ];
    } elseif ($nilai >= 60) {
        return [
            "huruf" => "C",
            "bobot" => 2.0
        ];
    } elseif ($nilai >= 50) {
        return [
            "huruf" => "D",
            "bobot" => 1.0
        ];
    } else {
        return [
            "huruf" => "E",
            "bobot" => 0.0
        ];
    }
}

// 3. Variabel untuk menghitung IPS
$totalSKS = 0;
$totalBobot = 0;
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Latihan Individu - Nilai Mahasiswa</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f6f9;
            margin: 0;
            padding: 30px;
        }

        .container {
            max-width: 900px;
            margin: auto;
            background-color: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 3px 10px rgba(0,0,0,0.1);
        }

        h1 {
            text-align: center;
            color: #1e3a8a;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th {
            background-color: #2563eb;
            color: white;
            padding: 12px;
        }

        td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: center;
        }

        td:first-child {
            text-align: left;
        }

        tr:nth-child(even) {
            background-color: #f8fafc;
        }

        .mengulang {
            background-color: #fecaca !important;
            color: #991b1b;
            font-weight: bold;
        }

        .lulus {
            color: #15803d;
            font-weight: bold;
        }

        .ringkasan {
            margin-top: 25px;
            padding: 20px;
            background-color: #eff6ff;
            border-left: 5px solid #2563eb;
            border-radius: 5px;
        }

        .ringkasan h2 {
            margin-top: 0;
            color: #1e3a8a;
        }
    </style>
</head>

<body>

<div class="container">

    <h1>Daftar Nilai Mata Kuliah</h1>

    <table>
        <tr>
            <th>No</th>
            <th>Nama Mata Kuliah</th>
            <th>SKS</th>
            <th>Nilai Angka</th>
            <th>Nilai Huruf</th>
            <th>Status</th>
        </tr>

        <?php
        $no = 1;

        // 4. Menampilkan data mata kuliah
        foreach ($matkul as $data) {

            $hasil = hitungBobot($data["nilai"]);

            $huruf = $hasil["huruf"];
            $bobot = $hasil["bobot"];

            $status = ($bobot >= 2.0)
                ? "LULUS"
                : "MENGULANG";

            // Menghitung total SKS dan total bobot
            $totalSKS += $data["sks"];
            $totalBobot += $data["sks"] * $bobot;

            // Menentukan warna baris
            $class = ($status == "MENGULANG")
                ? "mengulang"
                : "lulus";
        ?>

        <tr class="<?= $class ?>">
            <td><?= $no++ ?></td>
            <td><?= $data["nama"] ?></td>
            <td><?= $data["sks"] ?></td>
            <td><?= $data["nilai"] ?></td>
            <td><?= $huruf ?></td>
            <td><?= $status ?></td>
        </tr>

        <?php } ?>

    </table>

    <?php
    // 5. Menghitung IPS
    $ips = ($totalSKS > 0)
        ? $totalBobot / $totalSKS
        : 0;

    // 6. Menentukan batas maksimal SKS semester depan
    $maksSKS = ($ips >= 3.00) ? 24 : 20;
    ?>

    <div class="ringkasan">

        <h2>Ringkasan IPS</h2>

        <p>Total SKS: <strong><?= $totalSKS ?> SKS</strong></p>

        <p>Total Bobot Nilai:
            <strong><?= number_format($totalBobot, 2) ?></strong>
        </p>

        <p>IPS:
            <strong><?= number_format($ips, 2) ?></strong>
        </p>

        <p>Maksimal SKS Semester Depan:
            <strong><?= $maksSKS ?> SKS</strong>
        </p>

    </div>

</div>

</body>
</html>
