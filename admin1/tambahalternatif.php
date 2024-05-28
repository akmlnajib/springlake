<?php
include("../assets/conn/koneksi.php");

if (isset($_POST['simpan'])) {
    $nik = $_POST['nik'];
    $nama_alternatif = $_POST['nama_alternatif'];
    $department = $_POST['department'];
    $cl_disiplin = $_POST['cl_disiplin'];
    $cl_loyalitas = $_POST['cl_loyalitas'];

    // Validasi data
    if (empty($nama_alternatif)) {
        echo "<script>alert('Nama alternatif harus diisi. Silakan coba lagi.');</script>";
    } else {
        $query = "INSERT INTO tbl_alternatif (nik, nama_alternatif, department, cl_disiplin, cl_loyalitas) VALUES (?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($conn, $query);

        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "sssss", $nik, $nama_alternatif, $department, $cl_disiplin, $cl_loyalitas);
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
    <h5 class="card-header"><button class="btn btn-warning">Tambah Data</button></h5>
    <div class="card-body">
        <form class="row g-3" action="" method="post" enctype="multipart/form-data">
            <div class="col-md-4">
                <label for="nik" class="form-label">NIK</label>
                <input type="text" class="form-control" id="nik" name="nik">
            </div>
            <div class="col-md-4">
                <label for="nama_alternatif" class="form-label">Nama Karyawan</label>
                <input type="text" class="form-control" id="nama_alternatif" name="nama_alternatif">
            </div>
            <div class="col-md-4">
                <label for="department" class="form-label">Department</label>
                <input type="text" class="form-control" id="department" name="department">
            </div>
            <div class="col-md-2">
                <label for="cl_disiplin" class="form-label">Jumlah Hari Tidak Masuk</label>
                <input type="number" class="form-control" id="cl_disiplin" name="cl_disiplin">
            </div>
            <div class="col-md-2">
                <label for="cl_loyalitas" class="form-label">Masa Kerja</label>
                <input type="number" class="form-control" id="cl_loyalitas" name="cl_loyalitas">
            </div>
            <div class="col-12 text-right">
                <input type="submit" name="simpan" value="Simpan" class="btn btn-success">
            </div>
        </form>
    </div>
</div>
