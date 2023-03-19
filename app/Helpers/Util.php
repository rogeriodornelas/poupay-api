<?php

namespace App\Helpers;

use Carbon\Carbon;

class Util
{
    public static function formatMoedaBD($valor)
    {
        $valor = str_replace(".", "", $valor);
        $valor = str_replace(",", ".", $valor);
        return $valor;
    }

    public static function formatDataBD($str, $formatoDe = 'd/m/Y', $formatoPara = "Y-m-d")
    {
        return Carbon::createFromFormat($formatoDe, $str)->format($formatoPara);
    }
}
