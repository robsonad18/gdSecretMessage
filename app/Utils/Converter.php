<?php 

namespace App\Utils;

class Converter
{   
    /**
     * Converte numero decimal para binario
     *
     * @return void
     */
    static function getDecBin(int $decimal)
    {
        return str_pad(decbin($decimal), 8, "0", STR_PAD_LEFT);
    }
}