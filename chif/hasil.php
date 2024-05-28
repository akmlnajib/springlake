<div class="card">
    <div class="card-body d-flex align-items-center">
        <img src="../assets/image/rank.svg" alt="Logo" width="60px" class="img-fluid me-3">
        <div>
            <h2>Hasil</h2>
            <p>Halaman Utama Hasil</p>
        </div>
    </div>
</div>

<div class="container mt-4">
    <div class="card">
        <div class="card-body">
            <div class="row justify-content-between mb-3">
                <div class="col-4">
                    <h5 class="card-header">Rangking</h5>
                </div>
                <div class="col-2 text-center">
                    <a class="btn btn-success" href='./?page=analisa'><i class='fa fa-pencil-alt'></i>Lihat Analisa</a>
                </div>
            </div>
            </h5>
            <table id="example" class="table table-striped" style="width:100%">
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
                    // Ambil 3 nilai tertinggi
                    $top3_query = mysqli_query($conn, "SELECT * FROM tbl_alternatif ORDER BY nilai_topsis DESC LIMIT 3");

                    // Simpan id dari 3 nilai tertinggi
                    $top3_ids = [];
                    while ($top = mysqli_fetch_array($top3_query)) {
                        $top3_ids[] = $top['id_alternatif'];
                    }

                    // Tampilkan semua data
                    $data = mysqli_query($conn, "SELECT * FROM tbl_alternatif");
                    while ($a = mysqli_fetch_array($data)) { ?>
                        <tr>
                            <td class="text-center">
                                <?= $a['nama_alternatif'] ?>
                            </td>
                            <td class="text-center">
                                <?= number_format($a['nilai_topsis'], 2) ?>
                            </td>
                            <td class="text-center">
                                <?= $a['rangking'] ?>
                            </td>
                            <td class="text-center">
                                <?php
                                // Tandai 3 nilai tertinggi sebagai Rekomendasi, sisanya sebagai Tidak Rekomendasi
                                if (in_array($a['id_alternatif'], $top3_ids)) {
                                    echo "Rekomendasi";
                                } else {
                                    echo "Tidak Rekomendasi";
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
</div>