<?php
$jumlahDPH = 10;
$rslt = mysqli_query($conn, "SELECT * FROM tbl_verif");
$jd = mysqli_num_rows($rslt);
$jh = ceil($jd / $jumlahDPH);
$hAktif = (isset($_GET["verif"]) ? $_GET["verif"] : 1);
$awalData = ($jumlahDPH * $hAktif) - $jumlahDPH;

if (isset($_POST['bcari'])) {
    $pencarian = htmlspecialchars($_POST['cari']);
    $query = "SELECT v.*, u.nama_lengkap
          FROM tbl_verif v
          INNER JOIN tbl_akun u ON v.id_akun = u.id_akun
          WHERE u.nama_lengkap LIKE '%$pencarian%' OR v.status LIKE '%$pencarian%' OR v.tanggal LIKE '%$pencarian%'";
} else {
    $query = "SELECT v.*, u.nama_lengkap
            FROM tbl_verif v
            INNER JOIN tbl_akun u ON v.id_akun = u.id_akun
            LIMIT $awalData, $jumlahDPH";
}

$execute = mysqli_query($conn, $query);

if (!$execute) {
    die('Error in SQL query: ' . mysqli_error($conn));
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['setuju'])) {
        $id_verif = $_POST['id_verif'];
        $updateQuery = "UPDATE tbl_verif SET status = 1 WHERE id_verif = $id_verif";
        mysqli_query($conn, $updateQuery);
        echo "<script>alert('Data berhasil diubah'); window.open('./?page=konfirmasi','_self');</script>";
    } elseif (isset($_POST['batal'])) {
        $id_verif = $_POST['id_verif'];
        $updateQuery = "UPDATE tbl_verif SET status = 0 WHERE id_verif = $id_verif";
        mysqli_query($conn, $updateQuery);
        
        echo "<script>alert('Data berhasil diubah'); window.open('./?page=konfirmasi','_self');</script>";
    }
}
?>


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
                <th>Nama Pengirim</th>
                <th>Tanggal</th>
                <th>Status</th>
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
                        <?= $result['nama_lengkap'] ?>
                    </td>
                    <td>
                        <?= $result['tanggal'] ?>
                    </td>
                    <td>
                        <?php
                        if ($result['status'] == 1) {
                            ?>
                            <button class="btn btn-danger">Belum Disetujui</button>
                            <?php
                        } elseif ($result['status'] == 2) { ?>
                            <button class="btn btn-success">Sudah Disetujui</button>
                        <?php }
                        ?>
                    </td>
                    <td>
                        <?php if ($result['status'] == 1) { ?>
                            <form method="POST">
                                <input type="hidden" name="id_verif" value="<?= $result['id_verif']; ?>">
                                <button class="btn btn-success" name="setuju" onclick="return confirm('Setujui status?');">
                                    <img width="24" height="24" src="https://img.icons8.com/material-rounded/24/checked--v1.png"
                                        alt="checked--v1" />
                                </button>
                            </form>
                        <?php } elseif ($result['status'] == 2) { ?>
                            <form method="POST">
                                <input type="hidden" name="id_verif" value="<?= $result['id_verif']; ?>">
                                <button class="btn btn-danger" name="batal" onclick="return confirm('Batalkan status?');">
                                    <img width="24" height="24" src="https://img.icons8.com/ios-glyphs/30/cancel.png"
                                        alt="cancel" />
                                </button>
                            </form>
                        <?php } ?>
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
                    href="./?page=verif&verif=<?= ($hAktif - 1) . (isset($_POST['bcari']) ? '&bcari=Cari&cari=' . $pencarian : ''); ?>">Previous</a>
            </li>
            <?php for ($i = 1; $i <= $jh; $i++): ?>
                <li class="page-item <?= $hAktif == $i ? 'active' : ''; ?>">
                    <a class="page-link"
                        href="./?page=verif&verif=<?= $i . (isset($_POST['bcari']) ? '&bcari=Cari&cari=' . $pencarian : ''); ?>">
                        <?= $i; ?>
                    </a>
                </li>
            <?php endfor; ?>
            <li class="page-item <?= $hAktif == $jh ? 'disabled' : ''; ?>">
                <a class="page-link"
                    href="./?page=verif&verif=<?= ($hAktif + 1) . (isset($_POST['bcari']) ? '&bcari=Cari&cari=' . $pencarian : ''); ?>">Next</a>
            </li>
        </ul>
    </nav>
</div>