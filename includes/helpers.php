<?php

// TODO: BORRAR ESTO O PASARLO A UNA CLASE

function recortar_parrafo_x_caracteres(string $texto, int $cantidad = 10): string {

    $recortado = trim($texto);

    if (str_word_count($recortado) <= $cantidad) return $recortado;
    //tambien puedo hacer explode(" ", $recortado); para obtener un array con cada elemento siendo una palabra

    $recortado = substr($recortado, 0, $cantidad);
    $recortado .= " (...)";


    return $recortado;
}

function recortar_parrafo_x_palabras(string $texto, int $cantidad = 10): string {

    $palabras = explode(" ", trim($texto));

    if (count($palabras) <= $cantidad) return $texto;

    $palabras = array_slice($palabras,0, $cantidad);

    $recortado = implode(" ", $palabras) . " (...)";


    return $recortado;
}