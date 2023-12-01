<?php
if (!function_exists('badgeStatus')):
    function badgeStatus(String $status = '', Int $is_paid = 0){
        switch ($status) {
            case 'pending':
                return "<button class=\"btn btn-warning font-weight-bold text-white\">Menunggu Pembayaran</button>";
                break;
            case 'process':
                return "<button class=\"btn btn-info font-weight-bold text-white\">Proses Validasi</button>";
                break;
            case 'failed':
                return "<button class=\"btn btn-danger font-weight-bold text-white\">Gagal</button>";
                break;
            case 'rejected':
                return "<button class=\"btn btn-danger font-weight-bold text-white\">Pembayaran Ditolak</button>";
                break;
            case 'success':
                return "<button class=\"btn btn-success font-weight-bold text-white\">Sukses</button>";
                break;
            case 'approved':
                return "<button class=\"btn btn-success font-weight-bold text-white\">Pembayaran Diterima</button>";
                break;
            default:
                return "<button class=\"btn btn-secondary font-weight-bold text-white\">" . $status . "</button>";
                break;
        }
    }
endif;
