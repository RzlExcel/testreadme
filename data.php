<?php
header('Content-Type: application/json');

// Array multi-dimensi untuk menyimpan banyak data
$data_pengguna = [
    ['nama' => 'Avrizal', 'pekerjaan' => 'Web Developer', 'lokasi' => 'Purbalingga'],
    ['nama' => 'Setyo', 'pekerjaan' => 'UI/UX Designer', 'lokasi' => 'Magelang'],
    ['nama' => 'Aji', 'pekerjaan' => 'Data Scientist', 'lokasi' => 'Bekasi'],
    ['nama' => 'Nugroho', 'pekerjaan' => 'Cyber Security', 'lokasi' => 'Yogyakarta']
];

echo json_encode($data_pengguna);
