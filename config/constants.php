<?php
return [
    'payments' => [
        ['name' => 'DANA TRANSFER', 'account' => '082234407575', 'holder' => 'RESKI DINI NOVARIYANTI', 'is_manual' => true],
        ['name' => 'BRI TRANSFER', 'account' => '036001061800506', 'holder' => 'RESKI DINI NOVARIYANTI', 'is_manual' => true],
        ['name' => 'SHOPEEPAY TRANSFER', 'account' => '082234407575', 'holder' => 'RESKIDINIAR', 'is_manual' => true],
        ['name' => 'OVO TRANSFER', 'account' => '082234407575', 'holder' => 'RESKIDINI', 'is_manual' => true],
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
        ['key' => 'approved', 'name' => 'Pembayaran Diterima'],
    ],
    'attendances' => [
        'lists' => [
            '1' => 'Hadir',
            '2' => 'Tidak Hadir',
        ],
        'types' => [
            '1' => 'Offline',
            '2' => 'Online',
        ],
    ],
];
