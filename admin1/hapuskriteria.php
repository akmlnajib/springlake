<?php 
include "../assets/conn/koneksi.php";

// Mengambil id_kriteria dari $_GET
$id = htmlspecialchars(@$_GET['id']);

// Pernyataan SQL DELETE untuk menghapus dari tbl_kriteria
$delete_kriteria_sql = "DELETE FROM tbl_kriteria WHERE id_kriteria='$id'";
$delete_subkriteria_sql = "DELETE FROM tbl_subkriteria WHERE id_kriteria='$id'";

// Menghapus data dari tbl_kriteria
if (mysqli_query($conn, $delete_kriteria_sql)) {
    // Menghapus data dari tbl_subkriteria
    if (mysqli_query($conn, $delete_subkriteria_sql)) {
        echo "<script>window.open('./?page=kriteria','_self');</script>";
    } else {
        echo "Error menghapus data dari tabel tbl_subkriteria: " . mysqli_error($conn);
    }
    echo "<script>window.open('./?page=kriteria','_self');</script>";
} else {
    echo "Error menghapus data dari tabel tbl_kriteria: " . mysqli_error($conn);
}

// Menutup koneksi database
mysqli_close($conn);
?>
