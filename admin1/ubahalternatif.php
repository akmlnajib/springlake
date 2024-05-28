<?php
$id = htmlspecialchars(@$_GET['id']);
$query = "SELECT * FROM tbl_alternatif WHERE id_alternatif='$id'";
$result = $conn->query($query);

if ($result && $result->num_rows > 0) {
    $data = $result->fetch_assoc();
} else {
    header('location: ./?page=alternatif');
    exit;
}
?>
<div class="card">
    <h5 class="card-header"><button class="btn btn-warning">Ubah Data</button></h5>
    <div class="card-body">
        <form class="row g-3" action="" method="post" enctype="multipart/form-data">
    <input type="hidden" name="op" value="alternatif">
    <input type="hidden" name="id_alternatif" value="<?php echo $data['id_alternatif']; ?>">    
        <div class="col-md-4">
                <label for="nik" class="form-label">NIK</label>
            <input type="text" value="<?php echo $data['nik']; ?>" class="form-control" required autocomplete="off" placeholder="NIK" id="alternatif" name="nik">
            </div>
            <div class="col-md-4">
                <label for="nama_karyawan" class="form-label">Nama Karyawan</label>
                <input type="text" value="<?php echo $data['nama_alternatif']; ?>" class="form-control" required autocomplete="off" placeholder="Nama Alternatif" id="alternatif" name="nama_alternatif">
            </div>
            <div class="col-md-4">
                <label for="department" class="form-label">Department</label>
            <input type="text" value="<?php echo $data['department']; ?>" class="form-control" required autocomplete="off" id="alternatif" name="department">
            </div>
            <div class="col-md-4">
                <label for="cl_disiplin" class="form-label">Jumlah Hari Tidak Masuk</label>
            <input type="text" value="<?php echo $data['cl_disiplin']; ?>" class="form-control" required autocomplete="off" id="alternatif" name="cl_disiplin">
            </div>
            <div class="col-md-4">
                <label for="cl_loyalitas" class="form-label">Masa Kerja</label>
            <input type="text" value="<?php echo $data['cl_loyalitas']; ?>" class="form-control" required autocomplete="off" id="alternatif" name="cl_loyalitas">
            </div>
            <div class="col-12 text-right">
            <button type="submit" name="ubah" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
            </div>
        </form>
    </div>
</div>
<?php

if (isset($_POST['ubah'])) {
    // Validasi input
    $id_alternatif = $_POST['id_alternatif'];
    $nik = $_POST['nik'];
    $nama_alternatif = $_POST['nama_alternatif'];
    $department = $_POST['department'];
    $cl_disiplin = $_POST['cl_disiplin'];
    $cl_loyalitas = $_POST['cl_loyalitas'];
    // Query untuk mengubah data
    $s = mysqli_query($conn, "UPDATE tbl_alternatif SET  nik='$nik', nama_alternatif='$nama_alternatif', department='$department', cl_disiplin='$cl_disiplin', cl_loyalitas='$cl_loyalitas' WHERE id_alternatif='$id_alternatif'");

    if ($s) {
        echo "<script>alert('Data berhasil diubah'); window.open('./?page=alternatif','_self');</script>";
    } else {
        echo "<script>alert('Gagal mengubah data. Silakan coba lagi.');</script>";
    }
}
?>