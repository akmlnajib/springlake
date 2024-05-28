<?php
$page=htmlspecialchars(@$_GET['page']);
switch ($page){
    case null:
        include 'home.php';
        break;
    case 'beranda':
        include 'home.php';
        break;
    case 'hasil':
        include 'hasil.php';
        break;
    case 'analisa':
        include 'metode.php';
        break;
    default:
        include '404.php';
}