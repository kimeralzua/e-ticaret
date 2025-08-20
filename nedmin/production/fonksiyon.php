<?php 
ob_start();
session_start();


function seo($string, $length = 10) {
    $find = array('Ç', 'Ş', 'Ğ', 'Ü', 'İ', 'Ö', 'ç', 'ş', 'ğ', 'ü', 'ö', 'ı', '+', '.', '#');
    $replace = array('c', 's', 'g', 'u', 'i', 'o', 'c', 's', 'g', 'u', 'o', 'i', 'plus', '-', 'sharp');
    $string = strtolower(str_replace($find, $replace, $string));
    $string = preg_replace("@[^A-Za-z0-9\-_\.\+]@i", ' ', $string);
    $string = trim(preg_replace('/\s+/', ' ', $string));
    $string = str_replace(' ', '-', $string);
    $words = explode("-",$string);
    if(count($words) > $length) {
    $string = "";
    for($i = 0; $i < $length; $i++) {
    $string .= "-".$words[$i];
    }
    $string = trim($string, '-');
    }
    return $string;
    }
?>