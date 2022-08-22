<?php

namespace App\Utils;

class Converter
{
    /**
     * Converte numero decimal para binario
     *
     * @return string
     */
    static function getDecBin(int $decimal): string
    {
        return str_pad(decbin($decimal), 8, "0", STR_PAD_LEFT);
    }

    /**
     * Metodo responsavel por converter um caractere para binario
     *
     * @param string $char
     * @return string
     */
    static function getCharBin(string $char): string
    {
        $asc = ord($char);
        return self::getDecBin($asc);
    }

    /**
     * Converte um numero binario para um decimal
     *
     * @param string $binario
     * @return integer
     */
    static function getBinDec(string $binary): int
    {
        return bindec($binary);
    }

    /**
     * Converte binario para caractere
     *
     * @param string $binary
     * @return string
     */
    static function getBinChar(string $binary):string
    {
        $asc = self::getBinDec($binary);
        return chr($asc);
    }
}
