<?php

$host="localhost";
$kullanici="root";
$parola="";
$vt="uyelik";

$baglanti= mysqli_connect($host,$kullanici,$parola,$vt);
if (!$baglanti) {
    die("Veritabanı bağlantısı başarısız: " . mysqli_connect_error());
}
mysqli_set_charset($baglanti, "UTF8");
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>