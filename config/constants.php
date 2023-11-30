<?php
return [
    'payments' => [
        ['name' => 'DANA TRANSFER', 'account' => '082234407575', 'holder' => 'RESKI DINI NOVARIYANTI', 'is_manual' => true],
        ['name' => 'BRI TRANSFER', 'account' => '036001061800506', 'holder' => 'RESKI DINI NOVARIYANTI', 'is_manual' => true],
        ['name' => 'SHOPEEPAY TRANSFER', 'account' => '082234407575', 'holder' => 'RESKI DINI NOVARIYANTI', 'is_manual' => true],
        ['name' => 'OVO TRANSFER', 'account' => '082234407575', 'holder' => 'RESKI DINI NOVARIYANTI', 'is_manual' => true],
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
