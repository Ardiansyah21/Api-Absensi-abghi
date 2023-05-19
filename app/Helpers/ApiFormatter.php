<?php
//Fungsi file ini untuk mengatur hasil API uamh akan di tampilkan
// untuk Apmengatur posisi file ada di folder mana
namespace App\Helpers;
class ApiFormatter {
    // variabel yang akan dihasilakn ketika  api digunakan
    protected static $response = [
        'code' => NULL,
        'massage' => NULL,
        'data' => NULL,
    ];

    public static function createApi($code = NULL, $massage = NULL, $data = NULL)
    // mengisi data ke variabel $response yang diatas
    {
        self::$response['code'] = $code;
        self::$response['massage'] = $massage;
        self::$response['data'] = $data;
        return response()->json(self::$response, self::$response['code']);



    }
}

?>