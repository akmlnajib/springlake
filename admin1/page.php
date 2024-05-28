<?php
$page=htmlspecialchars(@$_GET['page']);
switch ($page){
    case null:
        include 'home.php';
        break;
    case 'beranda':
        include 'home.php';
        break;
    case 'alternatif':
        include 'alternatif.php';
        break;
    case 'kriteria':
        include 'kriteria.php';
        break;
    case 'subkriteria':
        include 'subkriteria.php';
        break;
    case 'penilaian':
        include 'nilai.php';
        break;
    case 'tambahnilai':
        include 'tambahnilai.php';
        break;
    case 'ubahnilai':
        include 'ubahnilai.php';
        break;
    case 'hasil':
        include 'hasil.php';
        break;
    case 'analisa':
        include 'analisa.php';
        break;
    case 'verif':
        include 'verif.php';
        break;
    case 'konfirmasi':
        include 'konfirmasi.php';
        break;
    default:
        include '404.php';
}