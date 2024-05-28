<?php
include "../assets/conn/koneksi.php";

if (isset($_GET['term'])) {
    $term = $_GET['term'];

    // Buat query untuk mencari id_alternatif, nama_alternatif, dan nik berdasarkan term
    $query = "SELECT id_alternatif, nama_alternatif, nik FROM tbl_alternatif
              WHERE nama_alternatif LIKE ? OR nik LIKE ? LIMIT 5";
    $stmt = mysqli_prepare($conn, $query);

    if ($stmt) {
        $term = '%' . $term . '%';
        mysqli_stmt_bind_param($stmt, "ss", $term, $term);
        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);

        $suggestions = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $suggestions[] = array(
                'id_alternatif' => $row['id_alternatif'],
                'nama_alternatif' => $row['nama_alternatif'],
                'nik' => $row['nik']
            );
        }

        // Convert hasil ke format JSON dan kirimkan
        echo json_encode($suggestions);

        // Tutup statement setelah penggunaan
        mysqli_stmt_close($stmt);
    } else {
        echo "Error: " . mysqli_error($conn);
    }
} else {
    echo "Parameter term tidak ditemukan.";
}

// Tutup koneksi setelah selesai
mysqli_close($conn);
?>
