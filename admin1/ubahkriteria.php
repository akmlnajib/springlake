<?php
include "../assets/conn/koneksi.php";
$id = htmlspecialchars(@$_GET['id']);
$query = "SELECT * FROM tbl_kriteria WHERE id_kriteria='$id'";
$sifat = array("Benefit", "Cost");
$execute = $conn->query($query);
if ($execute->num_rows > 0) {
    $data = $execute->fetch_array(MYSQLI_ASSOC);
} else {
    header('location:./?page=kriteria');
}

if (isset($_POST['ubah'])) {
    // Validasi input
    $id_kriteria = $_POST['id_kriteria'];
    $nama_kriteria = $_POST['nama_kriteria'];
    $bobot_kriteria = $_POST['bobot_kriteria'];
    $sifat = $_POST['sifat'];

    // Query untuk mengubah data
    $s = mysqli_query($conn, "UPDATE tbl_kriteria SET nama_kriteria='$nama_kriteria', bobot_kriteria='$bobot_kriteria', sifat='$sifat' WHERE id_kriteria='$id_kriteria'");

    if ($s) {
        echo "<script>alert('Data berhasil diubah'); window.open('./?page=kriteria','_self');</script>";
    } else {
        echo "<script>alert('Gagal mengubah data. Silakan coba lagi.');</script>";
    }
}
?>
<div class="card">
    <h5 class="card-header"><button class="btn btn-warning">Tambah Data</button></h5>
    <div class="card-body">
        <form class="row g-3" action="" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id_kriteria" value="<?php echo $data['id_kriteria']; ?>">    
        <div class="col-md-4">
                <label for="nik" class="form-label">Nama Kriteria</label>
                <input type="text" value="<?php echo $data['nama_kriteria']; ?>" class="form-control" required autocomplete="off" placeholder="Nama Kriteria" id="kriteria" name="nama_kriteria">
        </div>
            <div class="col-md-4">
                <label for="sifat" class="form-label">Bobot Kriteria</label>
                <select class="form-control" required id="bobot_kriteria" name="bobot_kriteria">
                <option value="<?= $data['bobot_kriteria'] ?>"><?= $data['bobot_kriteria'] ?></option>
                <option value="1">1 = Sangat Rendah</option>
                <option value="2">2 = Rendah</option>
                <option value="3">3 = Tengah</option>
                <option value="4">4 = Tinggi</option>
                <option value="5">5 = Sangat Tinggi</option>
            </select>
            </div>
            <div class="col-md-4">
                <label for="sifat" class="form-label">Sifat</label>
                <select class="form-control" required id="sifat" name="sifat">
                <?php
                foreach ($sifat as $datasifat) {
                    if ($datasifat == $data['sifat']) {
                        $selected = "selected";
                    } else {
                        $selected = null;
                    }
                    echo "<option $selected value=\"$datasifat\">$datasifat</option>";
                }
                ?>
            </select>
            </div>
            <div class="col-12 text-right">
                <input type="submit" name="ubah" value="Simpan" class="btn btn-success">
            </div>
        </form>
    </div>
</div>