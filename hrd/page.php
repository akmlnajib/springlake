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
    default:
        include '404.php';
}