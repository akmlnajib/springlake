<?php
$jumlahDPH = 10;
$rslt = mysqli_query($conn, "SELECT * FROM tbl_alternatif");
$jd = mysqli_num_rows($rslt);
$jh = ceil($jd / $jumlahDPH);
$hAktif = (isset($_GET["alternatif"]) ? $_GET["alternatif"] : 1);
$awalData = ($jumlahDPH * $hAktif) - $jumlahDPH;

if (isset($_POST['bcari'])) {
    $pencarian = htmlspecialchars($_POST['cari']);
    $query = "SELECT * FROM tbl_alternatif WHERE nik LIKE '%$pencarian%' OR nama_alternatif LIKE '%$pencarian%' OR department LIKE '%$pencarian%'";
} else {
    $query = "SELECT * FROM tbl_alternatif LIMIT $awalData, $jumlahDPH";
}

$execute = mysqli_query($conn, $query);

if (!$execute) {
    die('Error in SQL query: ' . mysqli_error($conn));
}
?>

<div class="card">
    <?php
    if (@htmlspecialchars($_GET['aksi']) == 'ubah') {
        include 'ubahalternatif.php';
    } else {
        include 'tambahalternatif.php';
    }
    ?>
</div>

<div class="card-body mt-5">
    <div class="px-3 py-2 border-bottom mb-3"></div>
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
        <thead align="center">
            <tr class="table-active">
                <th>No</th>
                <th>NIK</th>
                <th>Nama</th>
                <th>Department</th>
                <th>Jumlah Hari Tidak Masuk Kerja</th>
                <th>Masa Kerja</th>
                <th>Opsi</th>
            </tr>
        </thead>
        <tbody align="center">
            <?php
            $no = $awalData + 1;
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
                        <?= $result['cl_disiplin'] ?> Hari
                    </td>
                    <td>
                        <?= $result['cl_loyalitas'] ?> Tahun
                    </td>
                    <td>
                        <div class='norebuttom'>
                            <a class="btn btn-success"
                                href='?page=alternatif&aksi=ubah&id=<?= $result['id_alternatif'] ?>'><i
                                    class='fa fa-pencil-alt'>Edit</i></a>
                            <a href="hapusalternatif.php?id=<?= $result['id_alternatif']; ?>" class="btn btn-warning"
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
    <nav aria-label="...">
        <ul class="pagination">
            <li class="page-item <?= $hAktif == 1 ? 'disabled' : ''; ?>">
                <a class="page-link"
                    href="./?page=alternatif&alternatif=<?= ($hAktif - 1) . (isset($_POST['bcari']) ? '&bcari=Cari&cari=' . $pencarian : ''); ?>">Previous</a>
            </li>
            <?php for ($i = 1; $i <= $jh; $i++): ?>
                <li class="page-item <?= $hAktif == $i ? 'active' : ''; ?>">
                    <a class="page-link"
                        href="./?page=alternatif&alternatif=<?= $i . (isset($_POST['bcari']) ? '&bcari=Cari&cari=' . $pencarian : ''); ?>">
                        <?= $i; ?>
                    </a>
                </li>
            <?php endfor; ?>
            <li class="page-item <?= $hAktif == $jh ? 'disabled' : ''; ?>">
                <a class="page-link"
                    href="./?page=alternatif&alternatif=<?= ($hAktif + 1) . (isset($_POST['bcari']) ? '&bcari=Cari&cari=' . $pencarian : ''); ?>">Next</a>
            </li>
        </ul>
    </nav>
</div>