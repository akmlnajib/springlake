<?php
include "../assets/conn/koneksi.php";
$id = htmlspecialchars(@$_GET['id']);
$query = "SELECT * FROM tbl_alternatif WHERE id_alternatif='$id'";
$result = $conn->query($query);

if ($result && $result->num_rows > 0) {
    $data = $result->fetch_assoc();
    $id_alternatif = $data['id_alternatif']; // Definisikan $id_alternatif di sini
} else {
    header('location: ./?page=alternatif');
    exit;
}

if (isset($_POST['ubah'])) {
    $id_alternatif = isset($_POST['id_alternatif']) ? $_POST['id_alternatif'] : $id_alternatif;

    // Delete existing values associated with the alternative
    $queryDelete = "DELETE FROM tbl_nilai WHERE id_alternatif=?";
    $stmtDelete = $conn->prepare($queryDelete);
    $stmtDelete->bind_param('s', $id_alternatif);
    $resultDelete = $stmtDelete->execute();

    if (!$resultDelete) {
        echo "<script>alert('Gagal menghapus data nilai. Silakan coba lagi.');</script>";
    } else {
        // Fetch criteria to insert new values associated with the alternative
        $queryKriteria = "SELECT id_kriteria FROM tbl_kriteria ORDER BY id_kriteria";
        $resultKriteria = $conn->query($queryKriteria);

        while ($kriteria = $resultKriteria->fetch_assoc()) {
            $id_kriteria = $kriteria['id_kriteria'];

            if (isset($_POST[$id_kriteria])) {
                $id_subkriteria = mysqli_real_escape_string($conn, $_POST[$id_kriteria]);

                $queryInsert = "INSERT INTO tbl_nilai (id_alternatif, id_kriteria, id_subkriteria, normalisasi) VALUES (?, ?, ?, '0')";
                $stmtInsert = $conn->prepare($queryInsert);
                $stmtInsert->bind_param('sss', $id_alternatif, $id_kriteria, $id_subkriteria);
                $resultInsert = $stmtInsert->execute();

                if (!$resultInsert) {
                    echo "<script>alert('Gagal menambahkan data nilai. Silakan coba lagi.');</script>";
                    break;
                }
            }
        }
        echo "<script>alert('Data berhasil disimpan.'); window.open('./?page=kriteria','_self');</script>";
    }
}
?>

<div class="card">
    <div class="card-body">
        <h5 class="card-title"><b>Ubah Data</b></h5>
        <form action="" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id_alternatif" value="<?php echo $id_alternatif; ?>">
            <div class="mb-3">
                <label for="nik" class="form-label">Nama Karyawan</label>
                <?php
                $query3 = mysqli_query($conn, "SELECT * FROM tbl_alternatif WHERE id_alternatif ='" . $id_alternatif . "'");
                $result3 = mysqli_fetch_array($query3);
                ?>
                <input type="text" class="form-control" name="id_alternatif" value="<?= $result3['nama_alternatif'] ?>"
                    readonly>
            </div>
            <?php
            $query1 = mysqli_query($conn, "SELECT * FROM tbl_kriteria ORDER BY id_kriteria");
            while ($result1 = mysqli_fetch_array($query1)) {
                $id_kriteria = $result1['id_kriteria'];
                $nama_kriteria = $result1['nama_kriteria'];
                $query4 = mysqli_query($conn, "SELECT * FROM tbl_nilai WHERE id_kriteria='$id_kriteria' AND id_alternatif='$id_alternatif'");
                $result4 = mysqli_fetch_array($query4);

                // Check if result exists before trying to access its elements
                $id_sub = isset($result4['id_subkriteria']) ? $result4['id_subkriteria'] : null;

                ?>
                <div class="mb-3">
                    <label for="nama_karyawan" class="form-label">
                        <?= $nama_kriteria ?>
                    </label>
                    <select name="<?= $id_kriteria ?>" class="form-control">
                        <?php
                        $query2 = mysqli_query($conn, "SELECT * FROM tbl_subkriteria WHERE id_kriteria='$id_kriteria' ORDER BY nilai_subkriteria DESC");
                        while ($result2 = mysqli_fetch_array($query2)) {
                            if ($result2['id_subkriteria'] == $id_sub) { ?>
                                <option selected value="<?= $result2['id_subkriteria'] ?>">
                                    <?php echo $result2['nilai_subkriteria'] . " - " . $result2['nama_subkriteria'] ?>
                                </option>
                            <?php } else { ?>
                                <option value="<?= $result2['id_subkriteria'] ?>">
                                    <?php echo $result2['nilai_subkriteria'] . " - " . $result2['nama_subkriteria'] ?>
                                </option>
                                <?php
                            }
                        } ?>
                    </select>
                </div>
            <?php } ?>

            <div class="col-2 text-right mt-2">
                <input type="submit" name="ubah" value="Simpan" class="btn btn-success">
            </div>
        </form>
    </div>
</div>