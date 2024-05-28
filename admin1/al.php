<?php
$jumlahDPH = 5;
$rslt = mysqli_query($conn, "SELECT * FROM tbl_alternatif");
$jd = mysqli_num_rows($rslt);
$jh = ceil($jd / $jumlahDPH);
$hAktif = (isset($_GET["alternatif"]) ? $_GET["alternatif"] : 1);
$awalData = ($jumlahDPH * $hAktif) - $jumlahDPH;

if (isset($_POST['bcari'])) {
    $pencarian = htmlspecialchars($_POST['cari']);
    $query = "SELECT * FROM tbl_alternatif WHERE nik LIKE '%$pencarian%' OR nama_alternatif LIKE '%$pencarian%' OR cl_disiplin LIKE '%$pencarian%' OR cl_loyalitas LIKE '%$pencarian%' OR department LIKE '%$pencarian%'";
} else {
    $query = "SELECT * FROM tbl_alternatif LIMIT $awalData, $jumlahDPH";
}

$execute = mysqli_query($conn, $query);

if (!$execute) {
    die('Error in SQL query: ' . mysqli_error($conn));
}
?>
<div class="card-body">
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

    <table class="table mt-2">
        <thead align="center">
            <tr class="table-active">
                <th>No</th>
                <th>Nama</th>
                <th>Bobot Displin</th>
                <th>Bobot Masa Kerja</th>
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
                        <?= $result['nama_alternatif'] ?>
                    </td>
                    <td>
                        <?php
                        if ($result['cl_disiplin'] >= 10) {
                            echo "1";
                        } elseif ($result['cl_disiplin'] >= 7) {
                            echo "2";
                        } elseif ($result['cl_disiplin'] >= 4) {
                            echo "3";
                        } elseif ($result['cl_disiplin'] == 3) {
                            echo "4";
                        } elseif ($result['cl_disiplin'] == 2) {
                            echo "4";
                        } elseif ($result['cl_disiplin'] == 1) {
                            echo "4";
                        } elseif ($result['cl_disiplin'] == 0) {
                            echo "5";
                        } else {
                            echo "Kedisplinan tidak ada";
                        }
                        ?>
                    </td>

                    <td>
                        <?php
                        if ($result['cl_loyalitas'] == 10) {
                            echo "5";
                        } elseif ($result['cl_loyalitas'] == 9) {
                            echo "4";
                        } elseif ($result['cl_loyalitas'] == 8) {
                            echo "4";
                        } elseif ($result['cl_loyalitas'] == 7) {
                            echo "4";
                        } elseif ($result['cl_loyalitas'] == 6) {
                            echo "3";
                        } elseif ($result['cl_loyalitas'] == 5) {
                            echo "3";
                        } elseif ($result['cl_loyalitas'] == 4) {
                            echo "2";
                        } elseif ($result['cl_loyalitas'] == 3) {
                            echo "2";
                        } elseif ($result['cl_loyalitas'] == 2) {
                            echo "1";
                        } elseif ($result['cl_loyalitas'] == 1) {
                            echo "1";
                        } else {
                            echo "Loyalitas tidak ada";
                        }
                        ?>
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
                    href="./?page=penilaian&alternatif=<?= ($hAktif - 1) . (isset($_POST['bcari']) ? '&bcari=Cari&cari=' . $pencarian : ''); ?>">Previous</a>
            </li>
            <?php for ($i = 1; $i <= $jh; $i++): ?>
                <li class="page-item <?= $hAktif == $i ? 'active' : ''; ?>">
                    <a class="page-link"
                        href="./?page=penilaian&alternatif=<?= $i . (isset($_POST['bcari']) ? '&bcari=Cari&cari=' . $pencarian : ''); ?>">
                        <?= $i; ?>
                    </a>
                </li>
            <?php endfor; ?>
            <li class="page-item <?= $hAktif == $jh ? 'disabled' : ''; ?>">
                <a class="page-link"
                    href="./?page=penilaian&alternatif=<?= ($hAktif + 1) . (isset($_POST['bcari']) ? '&bcari=Cari&cari=' . $pencarian : ''); ?>">Next</a>
            </li>
        </ul>
    </nav>
</div>