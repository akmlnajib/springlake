<div class="card">

<div class="card">
<?php
    // Assuming $conn is your database connection
    if (isset($_SESSION['id_akun'])) {
        $id_akun = $_SESSION['id_akun'];

        $cek = "SELECT * FROM tbl_verif WHERE id_akun = $id_akun";
        $kl = mysqli_query($conn, $cek);

        if (mysqli_num_rows($kl) == 0) {
            ?>
            <h5 class="card-header">
                <?php
                $query = "SELECT MAX(id_verif) as idMaks FROM tbl_verif";
                $hasil = mysqli_query($conn, $query);
                $data = mysqli_fetch_array($hasil);
                $nim = $data['idMaks'];

                // Code to generate new ID
                $noUrut = $nim;
                $noUrut++;
                $IDbaru = $noUrut;
                ?>
                <form method="post" action="verifi.php">
                    <input type="hidden" name="id_verif" value="<?php echo $IDbaru; ?>">
                    <button type="submit" class="btn btn-secondary"
                        onclick="return confirm('Apakah Anda yakin ingin mengirim data ini?');">Kirim</button>
                        Rangking
                    </form>
            </h5>
            <?php
        } else {
            ?>
            <h5 class="card-header">
                Rangking
            </h5>
            <?php
        }
    } else {
        // Handle the case where the user is not logged in
        echo "User is not logged in.";
    }
?>
</div>
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead align="center">
                <tr class="table-active">
                    <th class="text-center">Nama Alternatif</th>
                    <th class="text-center">Nilai Topsis</th>
                    <th class="text-center">Rangking</th>
                    <th class="text-center">Status</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $nilai = 0.45;
                $data = mysqli_query($conn, "SELECT * FROM tbl_alternatif ORDER BY rangking");
                while ($a = mysqli_fetch_array($data)) { ?>
                    <tr>
                        </td>
                        <td class="text-center">
                            <?= $a['nama_alternatif'] ?>
                        </td>
                        <td class="text-center">
                            <?= number_format($a['nilai_topsis'], 4) ?>
                        </td>
                        <td class="text-center">
                            <?= $a['rangking'] ?>
                        </td>
                        <td>
                            <?php
                            if ($a['nilai_topsis'] > $nilai) {
                                echo "Rekomen";
                            } else {
                                echo "Tidak Rekomen";
                            }
                            ?>
                        </td>
                    </tr>
                    <?php
                } ?>
            </tbody>
        </table>
    </div>
</div>