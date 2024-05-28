<?php
include("../assets/conn/koneksi.php");

// Check if the form is submitted
if (isset($_POST['simpan'])) {
    // Get id_akun from the session
    $id_akun = $_SESSION['id_akun'];

    // Sanitize inputs
    $id_alternatif = mysqli_real_escape_string($conn, $_POST['id_alternatif']);

    // Initialize the INSERT query
    $queryInsert = "INSERT INTO tbl_nilai (id_alternatif, id_kriteria, id_subkriteria, id_akun) VALUES ";

    $queryValues = array();

    // Loop through the criteria
    $query1 = mysqli_query($conn, "SELECT * FROM tbl_kriteria ORDER BY id_kriteria");
    while ($result1 = mysqli_fetch_array($query1)) {
        $id_kriteria = $result1['id_kriteria'];
        $selected_subkriteria = mysqli_real_escape_string($conn, $_POST[$id_kriteria]);

        // Check if the subkriteria is selected
        if (!empty($selected_subkriteria)) {
            $queryValues[] = "('$id_alternatif', '$id_kriteria', '$selected_subkriteria', '$id_akun')";
        }
    }

    // Append the values to the INSERT query
    $queryInsert .= implode(", ", $queryValues);

    // Check if there are values to insert
    if (!empty($queryValues)) {
        // Execute the INSERT query
        $result = mysqli_query($conn, $queryInsert);

        // Check for success or failure
        if ($result) {
            echo "<script>alert('Data berhasil disimpan'); window.location.href = '.?page=penilaian';</script>";
        } else {
            echo "<script>alert('Gagal menyimpan data. Silakan coba lagi.');</script>";
        }
    } else {
        echo "<script>alert('Pilih setidaknya satu bobot kriteria.'); window.location.reload();</script>";
    }
}
?>
<div class="card">
    <h5 class="card-header"><a class="btn btn-warning" href="./?page=penilaian">Kembali</a></h5>
    <div class="card-body">
        <form class="row g-3" action="" method="post" enctype="multipart/form-data">
            <div class="col-md-6">
                <label for="nik" class="form-label">Nama Karyawan</label>
                <select class="form-control" name="id_alternatif">
                    <option selected disable>-- Pilih Karyawan --</option>
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
                    ?>
                    <label for="nama_karyawan" class="form-label">
                        <?= $nama_kriteria ?>
                    </label>
                    <select name="<?= $id_kriteria ?>" class="form-control">
                        <option selected disabled>-- Pilih Bobot
                            <?= $result1['nama_kriteria'] ?> --
                        </option>
                        <?php
                        $query2 = mysqli_query($conn, "SELECT * FROM tbl_subkriteria WHERE id_kriteria='$id_kriteria' ORDER BY nilai_subkriteria DESC");
                        while ($result2 = mysqli_fetch_array($query2)) { ?>
                            <option value="<?= $result2['id_subkriteria'] ?>">
                                <?= $result2['nilai_subkriteria'] ?>
                            </option>
                        <?php } ?>
                    </select>
                <?php } ?>

                <div class="col-12 text-right mt-4">
                    <input type="submit" name="simpan" value="Simpan" class="btn btn-success">
                </div>
            </div>

            <div class="col-md-6">
                <?php 
                include "al.php";
                ?>
            </div>
        </form>
    </div>
</div>
</div>