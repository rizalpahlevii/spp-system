<?php

if (!function_exists('set_active')) {
    function set_active($uri, $output = 'active')
    {
        if (is_array($uri)) {
            foreach ($uri as $u) {
                if (Route::is($u)) {
                    return $output;
                }
            }
        } else {
            if (Route::is($uri)) {
                return $output;
            }
        }
    }
}
if (!function_exists('get_guard')) {
    function get_guard()
    {
        if (Auth::guard('web')->check()) {
            return "admin";
        } else {
            return "siswa";
        }
    }
}
if (!function_exists('convert_bulan')) {
    function convert_bulan($params)
    {
        switch ($params) {
            case 1:
                $status = "Januari";
                break;
            case 2:
                $status = "Februari";
                break;
            case 3:
                $status = "Maret";
                break;
            case 4:
                $status = "April";
                break;
            case 5:
                $status = "Mei";
                break;
            case 6:
                $status = "Juni";
                break;
            case 7:
                $status = "Juli";
                break;
            case 8:
                $status = "Agustus";
                break;
            case 9:
                $status = "September";
                break;
            case 10:
                $status = "Oktober";
                break;
            case 11:
                $status = "November";
                break;
            case 12:
                $status = "Desember";
                break;
            default:
                $status = "Tidak tersedia";
        }
        return $status;
    }
}
if (!function_exists('rupiah')) {
    function rupiah($param)
    {
        $result = "Rp " . number_format($param, 2, ',', '.');
        return $result;
    }
}
if (!function_exists('getBulan')) {
    function getBulan()
    {
        $bulan = [
            [
                'id' => 1,
                'name' => 'Januar1'
            ],
            [
                'id' => 2,
                'name' => 'Februari'
            ],
            [
                'id' => 3,
                'name' => 'Maret'
            ],
            [
                'id' => 4,
                'name' => 'April'
            ],
            [
                'id' => 5,
                'name' => 'Mei'
            ],
            [
                'id' => 6,
                'name' => 'Juni'
            ],
            [
                'id' => 7,
                'name' => 'Juli'
            ],
            [
                'id' => 8,
                'name' => 'Agustus'
            ],
            [
                'id' => 9,
                'name' => 'September'
            ],
            [
                'id' => 10,
                'name' => 'Oktober'
            ],
            [
                'id' => 11,
                'name' => 'November'
            ],
            [
                'id' => 12,
                'name' => 'Desember'
            ]
        ];
        return $bulan;
    }
}
if (!function_exists('set_selected_option_kelas')) {
    function set_selected_option_kelas($param)
    {
        if (isset($_GET['kelas'])) {
            if ($_GET['kelas'] == $param) {
                $status = "selected";
            } else {
                $status = " ";
            }
        } else {
            $status = " ";
        }
        return $status;
    }
}
if (!function_exists('set_selected_option_ta')) {
    function set_selected_option_ta($param)
    {
        if (isset($_GET['ta'])) {
            if ($_GET['ta'] == $param) {
                $status = "selected";
            } else {
                $status = " ";
            }
        } else {
            $status = " ";
        }
        return $status;
    }
}
