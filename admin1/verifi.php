<?php
include "../assets/conn/koneksi.php";

session_start();

if (!isset($_SESSION['id_akun'])) {
    header("Location: ./index.php");
    exit();
}

$id_akun = $_SESSION['id_akun'];
$tanggal = date('Y-m-d');
$status  = 1;
$id_verif = $_POST['id_verif'];

$query = "INSERT INTO tbl_verif (id_akun, tanggal, status) VALUES ('$id_akun', '$tanggal', '$status')";
$result = $conn->query($query);

$query1 = "UPDATE tbl_nilai SET id_verif = ? WHERE id_akun = ?";
$stat = $conn->prepare($query1);
$stat->bind_param("ss", $id_verif, $id_akun);
$result1 = $stat->execute();

if ($result && $result1) {
    echo "Data berhasil disimpan dan diperbarui.";
} else {
    echo "Error: " . $conn->error;
}

?>
