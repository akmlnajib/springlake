<?php
include "../assets/conn/koneksi.php";

if (isset($_GET['id'])) {
    $id_alternatif = $_GET['id'];

    // Hindari SQL Injection dengan menggunakan parameterized query
    $queryDelete = "DELETE FROM tbl_nilai WHERE id_alternatif = ?";
    $stmt = mysqli_prepare($conn, $queryDelete);

    if ($stmt) {
        // Bind parameter ke query
        mysqli_stmt_bind_param($stmt, "s", $id_alternatif);

        // Execute the DELETE query
        $resultDelete = mysqli_stmt_execute($stmt);

        if ($resultDelete) {
            // Redirect kembali ke halaman "penilaian.php" setelah penghapusan berhasil
            echo "<script>alert('Data berhasil dihapus.'); window.open('./?page=penilaian','_self');</script>";
            exit();
        } else {
            echo "Gagal menghapus data nilai. Silakan coba lagi.";
        }

        // Tutup statement setelah penggunaan
        mysqli_stmt_close($stmt);
    } else {
        echo "Gagal menyiapkan statement DELETE. Silakan coba lagi.";
    }
} else {
    echo "ID alternatif tidak ditemukan.";
}

// Tutup koneksi setelah selesai
mysqli_close($conn);
?>
