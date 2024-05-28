<?php
include("../assets/conn/koneksi.php");
$successAlert = '';
if (isset($_POST['simpan'])) {
    $nik = $_POST['nik'];
    $nama_alternatif = $_POST['nama_alternatif'];
    $department = $_POST['department'];

    // Validasi data
    if (empty($nama_alternatif)) {
        echo "<script>alert('Nama alternatif harus diisi. Silakan coba lagi.');</script>";
    } else {
        $query = "INSERT INTO tbl_alternatif (nik, nama_alternatif, department, dmax, dmin, nilai_topsis, rangking) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($conn, $query);

        if ($stmt) {

            $dmax = 0;
            $dmin = 0;
            $nilai_topsis = 0;
            $rangking = 0;

            mysqli_stmt_bind_param($stmt, "sssssss", $nik, $nama_alternatif, $department, $dmax, $dmin, $nilai_topsis, $rangking);
            $result = mysqli_stmt_execute($stmt);

            if ($result) {
                echo "<script>alert('Data berhasil disimpan.'); window.open('./?page=alternatif','_self');</script>";
            } else {
                echo "<script>alert('Gagal menyimpan data. Silakan coba lagi.');</script>";
            }
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }
}
?>
<div class="card">
    <div class="card-body">
    <h5 class="card-title"><b>Tambah Data</b></h5>
        <form action="" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="nik" class="form-label">NIK</label>
                <input type="text" class="form-control" id="nik" name="nik">
            </div>
            <div class="mb-3">
                <label for="nama_alternatif" class="form-label">Nama Alternatif</label>
                <input type="text" class="form-control" id="nama_alternatif" name="nama_alternatif">
            </div>
            <div class="mb-3">
                <label for="department" class="form-label">Department</label>
                <input type="text" class="form-control" id="department" name="department">
            </div>
            <div class="col-2 text-right">
                <input type="submit" name="simpan" value="Simpan" class="btn btn-success">
            </div>
        </form>
    </div>
</div>
