<?php

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

if (!function_exists('getUser')) {
    /**
     * Get user or user's property
     *
     * @param string $key
     * @return \App\Models\User|mixed
     */
    function getUser($key = null)
    {
        $user = request()->user();

        if ($key) {
            return $user->{$key};
        }

        return $user;
    }
}

if (!function_exists('numbering')) {
    function numbering($table, $key, $format, $digit = 4)
    {
        $max = DB::table($table)
            ->select(DB::raw("MAX($key) as kode"))
            ->where("$key", "like", "$format%")
            ->first();

        $last_nomor = substr($max->kode, strlen($format), $digit);
        $next_nomor = $format . sprintf("%0{$digit}s", ((int)$last_nomor) + 1);
        return $next_nomor;
    }
}

if (!function_exists('responseSuccess')) {
    /**
     * Response success status 200
     *
     * @param string $message
     * @param mixed $data
     */
    function responseSuccess($message = 'Data berhasil disimpan', $data = null)
    {
        return response()->json([
            'status' => 'success',
            'message' => $message,
            'data' => $data
        ]);
    }
}

if (!function_exists('responseError')) {
    /**
     * Response error status 403
     *
     * @param \Throwable $throwable
     * @param mixed $data
     *
     */
    function responseError(Throwable $throwable, $data = null)
    {
        $message = 'Terjadi kesalahan, silahkan hubungi IT!';
        if (env('APP_DEBUG') == true or $throwable->getCode()) {
            $message = $throwable->getMessage();
            if (!$throwable->getCode()) {
                $message .= ' on ' . $throwable->getFile() . ' at line ' . $throwable->getLine();
                $data = $throwable->getTrace();
            }
        }

        return response()->json([
            'status' => 'error',
            'message' => $message,
            'data' => $data
        ], $throwable->getCode() ? 422 : 500);
    }

    if (!function_exists('responseValidationError')) {
        /**
         * Response error validation
         */
        function responseValidationError(array $errors)
        {
            return response()->json([
                'messages' => 'The given data was invalid',
                'errors' => $errors
            ], 422);
        }
    }
}

if (!function_exists('getMonth')) {
    function getMonth($index, $short = false)
    {
        $bulan = array(
            1 => 'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember'
        );

        if (isset($bulan[$index])) {
            return $short ? substr($bulan[$index], 0, 3) : $bulan[$index];
        }
    }
}

if (!function_exists('numberFormat')) {
    /**
     * @param int|double $number
     */
    function numberFormat($number, $prefix = null)
    {
        return $prefix . number_format($number, 0);
    }
}

if (!function_exists('removeNumberFormat')) {
    function removeNumberFormat($formatted_number, $separator = ',')
    {
        $replaced = str_replace($separator, '', $formatted_number);
        if ($separator == '.') $replaced = str_replace(',', '.', $replaced);

        return $replaced;
    }
}

if (!function_exists('dateFormat')) {
    function dateFormat($date, $format = 'H:i:s d-m-Y')
    {
        if ($date) {
            return date($format, strtotime($date));
        }
    }
}
