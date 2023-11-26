<?php
return [
    'payments' => [
        ['name' => 'DANA TRANSFER', 'account' => '085335837454', 'holder' => 'DANANG SETIADI', 'is_manual' => true],
        ['name' => 'BRI TRANSFER', 'account' => '058501007589534', 'holder' => 'DANANG SETIADI', 'is_manual' => true],
        ['name' => 'SHOPEEPAY TRANSFER', 'account' => '087773201852', 'holder' => 'WAHYU FIKRI ZP', 'is_manual' => true],
    ],
    'users' => [
        'roles' => ['admin', 'member']
    ],
    'universities' => [
        ['id' => '071023', 'name' => '071023 - Universitas Darul Ulum Jombang'],
        // ['id' => '1', 'name' => '1 - Umum'],
        ['id' => '2', 'name' => '2 - Lainnya'],
    ],
    'statuses' => [
        ['key' => 'pending', 'name' => 'Menunggu Pembayaran'],
        ['key' => 'process', 'name' => 'Proses Validasi'],
        ['key' => 'failed', 'name' => 'Gagal'],
        ['key' => 'rejected', 'name' => 'Pembayaran Ditolak'],
        ['key' => 'success', 'name' => 'Sukses'],
        ['key' => 'aproved', 'name' => 'Pembayaran Diterima'],
    ],
];
