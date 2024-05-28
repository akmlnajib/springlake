<?php 
include "../assets/conn/koneksi.php";

// Mengambil id_alternatif dari $_GET
$id = htmlspecialchars(@$_GET['id']);

// Pernyataan SQL DELETE untuk menghapus dari tbl_alternatif
$query = "DELETE FROM tbl_alternatif WHERE id_alternatif='$id'";

// Menghapus data dari tbl_alternatif
if (mysqli_query($conn, $query)) { 
    echo "<script>alert('Data berhasil dihapus.'); window.open('./?page=alternatif','_self');</script>";
} else {
    echo "Error menghapus data dari tabel tbl_alternatif: " . mysqli_error($conn);
}

// Menutup koneksi database
mysqli_close($conn);
?>
