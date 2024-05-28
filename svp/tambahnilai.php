<?php
include("../assets/conn/koneksi.php");
$successAlert = "";
// Periksa apakah formulir telah disubmit
if (isset($_POST['simpan'])) {

    // Bersihkan input
    $id_alternatif = mysqli_real_escape_string($conn, $_POST['id_alternatif']);

    // Inisialisasi query INSERT
    $queryInsert = "INSERT INTO tbl_nilai (id_alternatif, id_kriteria, id_subkriteria, normalisasi) VALUES ";

    $queryValues = array();

    // Loop melalui kriteria
    $query1 = mysqli_query($conn, "SELECT * FROM tbl_kriteria ORDER BY id_kriteria");
    while ($result1 = mysqli_fetch_array($query1)) {
        $id_kriteria = $result1['id_kriteria'];
        $selected_subkriteria = mysqli_real_escape_string($conn, $_POST[$id_kriteria]);

        // Periksa apakah subkriteria telah dipilih
        if (!empty($selected_subkriteria)) {
            // Ganti 'default_value_for_normalisasi' dengan nilai aktual yang ingin Anda masukkan
            $queryValues[] = "('$id_alternatif', '$id_kriteria', '$selected_subkriteria', '0')";
        }
    }

    // Gabungkan nilai ke dalam query INSERT
    $queryInsert .= implode(", ", $queryValues);

    // Periksa apakah ada nilai untuk dimasukkan
    if (!empty($queryValues)) {
        // Jalankan query INSERT
        $result = mysqli_query($conn, $queryInsert);

        // Periksa keberhasilan atau kegagalan
        if ($result) {
            echo "<script>alert('Data berhasil disimpan.'); window.open('./?page=penilaian','_self');</script>";
        } else {
            echo "<script>alert('Gagal menyimpan data. Silakan coba lagi.');</script>";
        }
    } else {
        echo "<script>alert('Pilih setidaknya satu bobot kriteria.'); window.location.reload();</script>";
    }
}
?>

<div class="card">
    <div class="card-body">
        <h5 class="card-title"><b>Penilaian</b></h5>
        <form action="" method="post" enctype="multipart/form-data">
            <input type="text"  name="id_alternatif" value="<?php echo $id_alternatif; ?>" hidden>
                <div class="mb-3">
                <label for="search_term" class="form-label">NIK</label>
                <input type="number" name="nik" id="search_term" class="form-control"
                    placeholder="NIK" autocomplete="off">
                <div id="autocomplete-options"></div>
            </div>
            <div class="mb-3">
                <label for="search_term" class="form-label">Nama Alternatif</label>
                <input type="text" name="nama_alternatif" id="namanama" class="form-control"
                    placeholder="Nama alternatif" autocomplete="off" readonly>
                <div id="autocomplete-nama"></div>
            </div>
            <?php
            $query1 = mysqli_query($conn, "SELECT * FROM tbl_kriteria ORDER BY id_kriteria");
            while ($result1 = mysqli_fetch_array($query1)) {
                $id_kriteria = $result1['id_kriteria'];
                $nama_kriteria = $result1['nama_kriteria'];
                ?>
                <div class="mb-3">
                    <label for="nama_karyawan" class="form-label">
                        <?= $nama_kriteria ?>
                    </label>
                    <select name="<?= $id_kriteria ?>" class="form-control">
                        <option selected disabled>-- Pilih Bobot
                            <?= $result1['nama_kriteria'] ?> --
                        </option>
                        <?php
                        $query2 = mysqli_query($conn, "SELECT * FROM tbl_subkriteria WHERE id_kriteria='$id_kriteria' ORDER BY nilai_subkriteria ASC");
                        while ($result2 = mysqli_fetch_array($query2)) { ?>
                            <option value="<?= $result2['id_subkriteria'] ?>">
                                <?php echo $result2['nilai_subkriteria'] ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>
            <?php } ?>

            <div class="col-2 text-right">
                <input type="submit" name="simpan" value="Simpan" class="btn btn-success">
            </div>
        </form>
    </div>
</div>