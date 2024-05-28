<?php
$page=htmlspecialchars(@$_GET['page']);
switch ($page){
    case null:
        include 'home.php';
        break;
    case 'beranda':
        include 'home.php';
        break;
    case 'kriteria':
        include 'kriteria.php';
        break;
    case 'penilaian':
        include 'nilai.php';
        break;
    default:
        include '404.php';
}