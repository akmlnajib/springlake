<?php
//Syntax penghubung ke database
$server = "localhost";
$user = "root";
$password = "";
$nama_database = "bangun";

$conn = mysqli_connect($server, $user, $password, $nama_database);
if (!$conn) {
    die("Tidak bisa menghubungkan kedatabase : " . mysqli_connect_error());
}