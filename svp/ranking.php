<h5 class="card-header">
    Rangking
</h5>
<table>
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
        $nil = 0.45;
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
                    if ($a['nilai_topsis'] > $nil) {
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