<div class="container">
    <div class="card">
        <div class="card-body d-flex align-items-center">
            <img src="../assets/image/barang.svg" alt="Logo" width="60px" class="img-fluid me-3">
            <div>
                <h2>Alternatif</h2>
                <p>Halaman Utama Alternatif</p>
            </div>
        </div>
    </div>

    <div class="row form-login">
        <div class="col-md-4">
            <?php
            if (@htmlspecialchars($_GET['aksi']) == 'ubah') {
                include 'ubahalternatif.php';
            } else {
                include 'tambahalternatif.php';
            }
            ?>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-4"><b>Data Alternatif</b></h5>
                    <table id="example" class="table table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th style="color:">No</th>
                                <th>NIK</th>
                                <th>Nama</th>
                                <th>Department</th>
                                <th>Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            $query = "SELECT * FROM tbl_alternatif";
                            $execute = mysqli_query($conn, $query);
                            while ($result = mysqli_fetch_array($execute)) { ?>
                                <tr id="data">
                                    <td>
                                        <?= $no ?>
                                    </td>
                                    <td>
                                        <?= $result['nik'] ?>
                                    </td>
                                    <td>
                                        <?= $result['nama_alternatif'] ?>
                                    </td>
                                    <td>
                                        <?= $result['department'] ?>
                                    </td>
                                    <td>
                                        <div class='norebuttom'>
                                            <a class="btn btn-success"
                                                href='?page=alternatif&aksi=ubah&id=<?= $result['id_alternatif'] ?>'>Ubah</a>
                                            <a href="hapusalternatif.php?id=<?= $result['id_alternatif']; ?>"
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