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
    <div class="card-body">
    <h5 class="card-title"><b>Tambah Data</b></h5>
        <form action="" method="post" enctype="multipart/form-data">
    <input type="hidden" name="op" value="alternatif">
    <input type="hidden" name="id_alternatif" value="<?php echo $data['id_alternatif']; ?>">    
        <div class="mb-3">
                <label for="nik" class="form-label">NIK</label>
            <input type="text" value="<?php echo $data['nik']; ?>" class="form-control" required autocomplete="off" placeholder="NIK" id="alternatif" name="nik">
            </div>
            <div class="mb-3">
                <label for="nama_karyawan" class="form-label">Nama Alternatif</label>
                <input type="text" value="<?php echo $data['nama_alternatif']; ?>" class="form-control" required autocomplete="off" placeholder="Nama Alternatif" id="alternatif" name="nama_alternatif">
            </div>
            <div class="mb-3">
                <label for="department" class="form-label">Department</label>
            <input type="text" value="<?php echo $data['department']; ?>" class="form-control" required autocomplete="off" id="alternatif" name="department">
            </div>
            <div class="col-2 text-right">
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
    // Query untuk mengubah data
    $s = mysqli_query($conn, "UPDATE tbl_alternatif SET  nik='$nik', nama_alternatif='$nama_alternatif', department='$department' WHERE id_alternatif='$id_alternatif'");

    if ($s) {
        echo '<script>window.open("./?page=alternatif", "_self");</script>';
    } else {
        echo "<script>alert('Gagal mengubah data. Silakan coba lagi.');</script>";
    }
}
?>