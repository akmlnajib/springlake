<?php
include "../assets/conn/koneksi.php";

$id_alternatif = htmlspecialchars(@$_GET['id_alternatif']);
$query = "SELECT * FROM tbl_alternatif WHERE id_alternatif=?";
$stmt = $conn->prepare($query);
$stmt->bind_param('s', $id_alternatif);
$stmt->execute();

$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $data_alternatif = $result->fetch_assoc();
} else {
    echo "ID alternatif tidak ditemukan.";
}

if (isset($_POST['ubah'])) {
    $id_alternatif = $_POST['id_alternatif'];

    $queryDelete = "DELETE FROM tbl_nilai WHERE id_alternatif=?";
    $stmtDelete = $conn->prepare($queryDelete);
    $stmtDelete->bind_param('s', $id_alternatif);
    $resultDelete = $stmtDelete->execute();

    if (!$resultDelete) {
        echo "<script>alert('Gagal menghapus data nilai. Silakan coba lagi.');</script>";
    } else {
        $queryKriteria = "SELECT id_kriteria, nama_kriteria FROM tbl_kriteria ORDER BY id_kriteria";
        $resultKriteria = $conn->query($queryKriteria);

        while ($kriteria = $resultKriteria->fetch_assoc()) {
            $id_kriteria = $kriteria['id_kriteria'];

            if (isset($_POST[$id_kriteria])) {
                $id_subkriteria = mysqli_real_escape_string($conn, $_POST[$id_kriteria]);

                $queryInsert = "INSERT INTO tbl_nilai (id_alternatif, id_kriteria, id_subkriteria) VALUES (?, ?, ?)";
                $stmtInsert = $conn->prepare($queryInsert);
                $stmtInsert->bind_param('sss', $id_alternatif, $id_kriteria, $id_subkriteria);
                $resultInsert = $stmtInsert->execute();

                if (!$resultInsert) {
                    echo "<script>alert('Gagal menambahkan data nilai. Silakan coba lagi.');</script>";
                    break;
                }
            }
        }

        echo "<script>alert('Data berhasil diubah'); window.open('./?page=penilaian','_self');</script>";
    }
}
?>

<!-- Your HTML Form -->

<div class="card">
    <h5 class="card-header"><a class="btn btn-warning" href="./?page=penilaian">Kembali</a></h5>
    <div class="card-body">
        <form class="row g-3" action="" method="post" enctype="multipart/form-data">
            <div class="col-md-9">
                <label for="nik" class="form-label">Nama Karyawan</label>
                <?php
                $query3 = mysqli_query($conn, "SELECT * FROM tbl_alternatif WHERE id_alternatif ='" . $id_alternatif . "'");
                $result3 = mysqli_fetch_array($query3);
                ?>
                <select class="form-control" name="id_alternatif">
                    <option selected value="<?= $result3['id_alternatif'] ?>">
                        <?= $result3['nama_alternatif'] ?>
                    </option>
                    <?php
                    $query = mysqli_query($conn, "SELECT * FROM tbl_alternatif ORDER BY id_alternatif");
                    while ($result = mysqli_fetch_array($query)) {
                        $id_alternatif = $result['id_alternatif'];
                        $nama_alternatif = $result['nama_alternatif'];
                        ?>
                        <option value="<?= $id_alternatif ?>">
                            <?= $nama_alternatif ?>
                        </option>
                    <?php } ?>
                </select>
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
                    <label for="nama_karyawan" class="form-label">
                        <?= $nama_kriteria ?>
                    </label>
                    <select name="<?= $id_kriteria ?>" class="form-control">
                        <?php
                        $query2 = mysqli_query($conn, "SELECT * FROM tbl_subkriteria WHERE id_kriteria='$id_kriteria' ORDER BY nilai_subkriteria DESC");
                        while ($result2 = mysqli_fetch_array($query2)) {
                            if ($result2['id_subkriteria'] == $id_sub) { ?>
                                <option selected value="<?= $result2['id_subkriteria'] ?>">
                                    <?= $result2['nama_subkriteria'] ?>
                                </option>
                            <?php } else { ?>
                                <option value="<?= $result2['id_subkriteria'] ?>">
                                    <?= $result2['nama_subkriteria'] ?>
                                </option>
                                <?php
                            }
                        } ?>
                    </select>
                    </select>
                <?php } ?>

                <div class="col-12 text-right mt-4">
                    <input type="submit" name="ubah" value="Simpan" class="btn btn-success">
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-bg-light mb-3" style="max-width: 18rem;">
                    <div class="card-header">Bobot</div>
                    <div class="card-body">
                        <h5 class="card-title">1 = Kurang Baik Sekali</h5>
                        <h5 class="card-title">2 = Kurang Baik</h5>
                        <h5 class="card-title">3 = Baik</h5>
                        <h5 class="card-title">4 = Baik Sekali</h5>
                        <h5 class="card-title">5 = Sangat Baik Sekali</h5>
                    </div>
                </div>
        </form>
    </div>
</div>
</div>