<?php
include("../assets/conn/koneksi.php");
$successAlert = "";
if (isset($_POST['simpan'])) {
    $nama_kriteria = $_POST['nama_kriteria'];
    $bobot_kriteria = $_POST['bobot_kriteria'];
    $sifat = $_POST['sifat'];

    // Validasi data
    if (empty($nama_kriteria)) {
        echo "<script>alert('Nama kriteria harus diisi. Silakan coba lagi.');</script>";
    } else {
        // Insert data into 'tbl_kriteria'
        $query = "INSERT INTO tbl_kriteria (nama_kriteria, bobot_kriteria, sifat, akar_kriteria) VALUES (?, ?, ?, 0)";
        $stmt = mysqli_prepare($conn, $query);

        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "sds", $nama_kriteria, $bobot_kriteria, $sifat);
            $result = mysqli_stmt_execute($stmt);

            if ($result) {
                // Insert data into 'tbl_subkriteria'
                $id_kriteria = mysqli_insert_id($conn); // Get the last inserted ID
                $query1 = "INSERT INTO tbl_subkriteria (id_kriteria, nama_subkriteria, nilai_subkriteria) VALUES ";
                $values = array(
                    "($id_kriteria, 'Sangat Bagus', 5)",
                    "($id_kriteria, 'Bagus', 4)",
                    "($id_kriteria, 'Cukup Bagus', 3)",
                    "($id_kriteria, 'Kurang Bagus', 2)",
                    "($id_kriteria, 'Tidak Bagus', 1)"
                );
                $query1 .= implode(", ", $values);
                $result1 = mysqli_query($conn, $query1);

                if ($result1) {
                    $successAlert = '<script>
                document.addEventListener("DOMContentLoaded", function() {
                    const successModal = new bootstrap.Modal(document.getElementById("exampleModal"), {
                        keyboard: false
                    });

                    successModal.show();

                    // Close the modal when the close button is clicked
                    const closeBtn = document.querySelector(".btn-close");
                    closeBtn.addEventListener("click", function() {
                        successModal.hide();
                        window.open("./?page=kriteria", "_self");
                    });

                    // Redirect after a certain time
                    setTimeout(function() {
                        successModal.hide();
                        window.open("./?page=kriteria", "_self");
                    }, 3000);
                });
            </script>';
                } else {
                    echo "<script>alert('Gagal menyimpan data subkriteria. Silakan coba lagi.');</script>";
                }
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
                <label for="nik" class="form-label">Nama Kriteria</label>
                <input type="text" class="form-control" required autocomplete="off" placeholder="Nama kriteria"
                    id="kriteria" name="nama_kriteria">
            </div>
            <div class="mb-3">
                <label for="sifat" class="form-label">Bobot Kriteria</label>
                <select class="form-control" required id="bobot_kriteria" name="bobot_kriteria">
                    <option selected disabled>-- Pilih Bobot --</option>
                    <option value="1">1 = Tidak Penting</option>
                    <option value="2">2 = Kurang Penting</option>
                    <option value="3">3 = Cukup Penting</option>
                    <option value="4">4 = Penting</option>
                    <option value="5">5 = Sangat Penting</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="sifat" class="form-label">Sifat</label>
                <select class="form-control" required id="sifat" name="sifat">
                    <option selected disabled>-- Pilih Sifat Kriteria --</option>
                    <option value="Benefit">Benefit</option>
                    <option value="Cost">Cost</option>
                </select>
            </div>
            <div class="col-2 text-right">
                <input type="submit" name="simpan" value="Simpan" class="btn btn-success">
            </div>
        </form>
    </div>
</div>