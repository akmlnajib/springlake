<?php
include("../assets/conn/koneksi.php");

$h = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM tbl_kriteria"));
$jumlahDPH = 10;
$rslt = mysqli_query($conn, "SELECT * FROM tbl_alternatif");
$jd = mysqli_num_rows($rslt);
$jh = ceil($jd / $jumlahDPH);
$hAktif = (isset($_GET["nilai"]) ? $_GET["nilai"] : 1);
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
<div class="card-body">
    <div class="px-3 py-2 border-bottom mb-3"></div>
    <div class="container">
    <div class="row mt-2">
        <div class="col">
        </div>
        <div class="col-md-auto">
        </div>
        <div class="col col-lg-5">
            <form class="row g-2 align-items-center" method="POST">
                <div class="col-auto">
                <a class="btn btn-success" href='./?page=tambahnilai'><img width="20" height="20" src="https://img.icons8.com/material-rounded/24/plus--v1.png" alt="plus--v1"/> Tambah</a>
                </div>
                <div class="col-auto">
                    <input type="search" class="form-control" placeholder="Search..." aria-label="Search" name="cari">
                </div>
                <div class="col-auto">
                    <button type="submit" class="btn btn-primary" name="bcari"><img width="20" height="20" src="https://img.icons8.com/material-outlined/24/search--v1.png" alt="search--v1"/></button>
                </div>
            </form>
        </div>
    </div>
    </div>
    <table class="table mt-3">
        <thead align="center">
            <tr class="table-active">
                <th rowspan="2">No</th>
                <th rowspan="2">Nama</th>
                <th colspan="<?php echo $h; ?>">Kriteria</th>
                <th rowspan="2">Opsi</th>
            </tr>
            <tr class="table-active">
                <?php
                for ($n = 1; $n <= $h; $n++) {
                    echo "<th>C{$n}</th>";
                }
                ?>
            </tr>
        </thead>
        <tbody id="isiNilai" align="center">
            <?php
            $no = $awalData + 1;
            while ($data = mysqli_fetch_array($execute)) {
                $nomor = $no++;
                $id_alternatif = $data['id_alternatif'];
                $nama_alternatif = $data['nama_alternatif'];
                ?>
                <tr>
                    <td>
                        <?= $nomor ?>
                    </td>
                    <td>
                        <?= $nama_alternatif ?>
                    </td>
                    <?php
                    $query1 = mysqli_query($conn, "SELECT a.nilai_subkriteria as nama_sub FROM tbl_subkriteria a, tbl_nilai b WHERE b.id_alternatif='$id_alternatif' AND a.id_subkriteria = b.id_subkriteria ORDER BY b.id_kriteria");
                    while ($result = mysqli_fetch_array($query1)) {
                        echo "<td>{$result['nama_sub']}</td>";
                    }
                    ?>
                    <td>
                        <div class='norebuttom'>
                            <a class="btn btn-success"
                                href='./?page=ubahnilai&id_alternatif=<?= $id_alternatif; ?>'><i
                                    class='fa fa-pencil-alt'>Edit</i></a>
                            <a href="hapusnilai.php?id=<?= $id_alternatif; ?>" class="btn btn-warning"
                                onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?');">Hapus</a>
                        </div>
                    </td>
                </tr>
                <?php
            }
            ?>
        </tbody>
    </table>
    <nav aria-label="...">
        <ul class="pagination">
            <li class="page-item <?= $hAktif == 1 ? 'disabled' : ''; ?>">
                <a class="page-link"
                    href="./?page=penilaian&nilai=<?= ($hAktif - 1) . (isset($_POST['bcari']) ? '&bcari=Cari&cari=' . $pencarian : ''); ?>">Previous</a>
            </li>
            <?php for ($i = 1; $i <= $jh; $i++): ?>
                <li class="page-item <?= $hAktif == $i ? 'active' : ''; ?>">
                    <a class="page-link"
                        href="./?page=penilaian&nilai=<?= $i . (isset($_POST['bcari']) ? '&bcari=Cari&cari=' . $pencarian : ''); ?>">
                        <?= $i; ?>
                    </a>
                </li>
            <?php endfor; ?>
            <li class="page-item <?= $hAktif == $jh ? 'disabled' : ''; ?>">
                <a class="page-link"
                    href="./?page=penilaian&nilai=<?= ($hAktif + 1) . (isset($_POST['bcari']) ? '&bcari=Cari&cari=' . $pencarian : ''); ?>">Next</a>
            </li>
        </ul>
    </nav>
</div>