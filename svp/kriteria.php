<div class="container">
    <div class="card">
        <div class="card-body d-flex align-items-center">
            <img src="../assets/image/kriteria.svg" alt="Logo" width="60px" class="img-fluid me-3">
            <div>
                <h2>Kriteria</h2>
                <p>Halaman Utama Kriteria</p>
            </div>
        </div>
    </div>

    <div class="row form-login">
        <div class="col-md-4">
            <?php
            if (@htmlspecialchars($_GET['aksi']) == 'ubah') {
                include 'ubahkriteria.php';
            } else {
                include 'tambahkriteria.php';
            }
            ?>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-4"><b>Data Kriteria</b></h5>
                    <table id="example" class="table table-striped" style="width:100%">
                        <thead align="center">
                            <tr class="table-active">
                                <th>No</th>
                                <th>Nama Kriteria</th>
                                <th>Bobot</th>
                                <th>Sifat</th>
                                <th>Opsi</th>
                            </tr>
                        </thead>
                        <tbody align="center">
                            <?php
                            $no = 1;
                            $query = "SELECT * FROM tbl_kriteria";
                            $execute = mysqli_query($conn, $query);
                            while ($data = mysqli_fetch_array($execute)) {
                                ?>
                                <tr id="data">
                                    <td>
                                        <?= $no ?>
                                    </td>
                                    <td>
                                        <?= $data['nama_kriteria'] ?>
                                    </td>
                                    <td>
                                        <?= $data['bobot_kriteria'] ?>
                                    </td>
                                    <td>
                                        <?= $data['sifat'] ?>
                                    </td>
                                    <td>
                                        <div class="norebuttom">
                                            <a class="btn btn-success"
                                                href='./?page=kriteria&aksi=ubah&id=<?= $data['id_kriteria'] ?>'><i
                                                    class='fa fa-pencil-alt'></i> Ubah</a>
                                            <a href="hapuskriteria.php?id=<?= $data['id_kriteria']; ?>"
                                                class="btn btn-danger"
                                                onclick="return confirm('Apakah anda yaking untuk menghapus data ini ?');">
                                                Hapus
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                <?php
                                $no++;
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>