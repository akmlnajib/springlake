<?php
include "../assets/conn/koneksi.php";

if (isset($_GET['id'])) {
    $id_alternatif = $_GET['id'];

    // Create a DELETE query to remove records associated with the provided id_alternatif
    $queryDelete = "DELETE FROM tbl_nilai WHERE id_alternatif='$id_alternatif'";
    
    // Execute the DELETE query
    $resultDelete = mysqli_query($conn, $queryDelete);

    if ($resultDelete) {
        // Redirect back to the "nilai.php" page after successful deletion
        header("Location: ./?page=penilaian");
        exit();
    } else {
        echo "Gagal menghapus data nilai. Silakan coba lagi.";
    }
} else {
    echo "ID alternatif tidak ditemukan.";
}
?>
