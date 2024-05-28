<div class="card">
    <?php
    if (isset($_GET['aksi']) && htmlspecialchars($_GET['aksi']) == 'ubah') {
        include 'ubahkriteria.php';
    } else {
        include 'tambahkriteria.php';
    }
    ?>
</div>
<div class="card-body mt-5">
    <div class="px-3 py-2 border-bottom mb-3">
    </div>
    <div class="container d-flex flex-wrap justify-content-center">
        <form class="row g-2 align-items-center" method="POST">
            <div class="col-auto">
                <input type="search" class="form-control" placeholder="Search..." aria-label="Search" name="cari">
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-primary" name="bcari">Cari</button>
            </div>
        </form>
    </div>
    <table class="table mt-3">
        <thead>
            <tr class="table-active">
                <th>No</th>
                <th>Nama Kriteria</th>
                <th>Bobot</th>
                <th>Sifat</th>
                <th>Opsi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1; // Initialize $no here
            if (isset($_POST['bcari'])) {
                $pencarian = htmlspecialchars($_POST['cari']);
                $query = "SELECT * FROM tbl_kriteria WHERE nama_kriteria LIKE '%$pencarian%' OR bobot_kriteria LIKE '%$pencarian%' OR sifat LIKE '%$pencarian%'";
            } else {
                $query = "SELECT * FROM tbl_kriteria";
            }
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
                                    class='fa fa-pencil-alt'></i> Edit</a>
                            <a href="hapuskriteria.php?id=<?= $data['id_kriteria']; ?>" class="btn btn-warning"
                                onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?');">Hapus</a>
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