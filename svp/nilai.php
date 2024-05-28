<?php
include("../assets/conn/koneksi.php");

$h = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM tbl_kriteria"));
?>
<div class="container">
    <div class="card">
        <div class="card-body d-flex align-items-center">
            <img src="../assets/image/bobot.svg" alt="Logo" width="60px" class="img-fluid me-3">
            <div>
                <h2>Penilaian</h2>
                <p>Halaman Utama Penilaian</p>
            </div>
        </div>
    </div>
    <div class="card mt-3">
        <div class="card-header">
            <h4>Catatan</h4>
        </div>
        <div class="card-body d-flex align-items-center">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th class="text-center">Bobot</th>
                        <th class="text-center">Attitude</th>
                        <th class="text-center">Disiplin</th>
                        <th class="text-center">Kerapihan</th>
                        <th class="text-center">Team Work</th>
                        <th class="text-center">Kinerja</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="text-center"><b>1</b></td>
                        <td class="text-center">Sangat Tidak Sopan</td>
                        <td class="text-center">Sering melanggar aturan, atau tidak memenuhi tanggung jawab.</td>
                        <td class="text-center">Sering kali membiarkan keadaan tidak teratur atau kotor.</td>
                        <td class="text-center">Anggota tim tidak berpartisipasi.</td>
                        <td class="text-center">Kinerja tidak memenuhi standar yang diharapkan, banyak kekurangan, dan perlu perbaikan signifikan.</td>
                    </tr>
                    <tr>
                        <td class="text-center"><b>2</b></td>
                        <td class="text-center">Tidak Sopan</td>
                        <td class="text-center">Terlambat sesekali atau kurang mengikuti aturan dengan baik.</td>
                        <td class="text-center">Terkadang tidak memperhatikan kebersihan.</td>
                        <td class="text-center">Anggota tim memiliki kontribusi yang terbatas.</td>
                        <td class="text-center">Kinerja memiliki beberapa kelebihan, namun masih banyak aspek yang perlu diperbaiki untuk mencapai standar yang diharapkan.</td>
                    </tr>
                    <tr>
                        <td class="text-center"><b>3</b></td>
                        <td class="text-center">Sopan</td>
                        <td class="text-center">Mengikuti aturan dan tanggung jawab dengan cukup baik.</td>
                        <td class="text-center">Menjaga tata letak dan kebersihan dengan cukup baik.</td>
                        <td class="text-center">Anggota tim memberikan kontribusi yang cukup baik, namun mungkin hanya melakukan tugas-tugas yang diharapkan tanpa banyak inisiatif tambahan.</td>
                        <td class="text-center">Kinerja memenuhi standar yang diharapkan, melakukan tugas dengan baik, dan memenuhi tanggung jawabnya.</td>
                    </tr>
                    <tr>
                        <td class="text-center"><b>4</b></td>
                        <td class="text-center">Sangat Sopan</td>
                        <td class="text-center">Hadir tepat waktu, mengikuti aturan, dan menyelesaikan tugas sesuai dengan harapan.</td>
                        <td class="text-center">Menjaga kebersihan dan tata letak dengan baik.</td>
                        <td class="text-center">Anggota tim aktif berpartisipasi, memberikan kontribusi yang signifikan, dan bekerja sama secara efektif dengan anggota tim lainnya.</td>
                        <td class="text-center">Kinerja melebihi standar yang diharapkan, memberikan kontribusi positif, dan berhasil mencapai target kinerja.</td>
                    </tr>
                    <tr>
                        <td class="text-center"><b>5</b></td>
                        <td class="text-center">Sangat Sopan Sekali</td>
                        <td class="text-center">Selalu hadir tepat waktu, sangat mengikuti aturan, dan konsisten dalam kualitas pekerjaan.</td>
                        <td class="text-center">Selalu Menjaga kebersihan dan tata letak dengan baik.</td>
                        <td class="text-center">Anggota tim sangat aktif berkontribusi, mendukung rekan-rekannya, berbagi ide, dan berusaha untuk mencapai tujuan bersama tim.</td>
                        <td class="text-center">Kinerja sangat baik, memberikan kontribusi yang luar biasa, dan mencapai atau melampaui semua target kinerja.</td>
                    </tr>
                </tbody>
            </table>
        </div>
        </div>
    </div>

<div class="row form-login">
    <div class="col-md-4">
        <?php
        if (isset($_GET['aksi']) && htmlspecialchars($_GET['aksi']) == 'ubah') {
            // include 'ubahnilai.php';
        } else {
            include 'tambahnilai.php';
        }
        ?>
    </div>

    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title mb-4"><b>Data Penilaian</b></h5>
                <div class="table-responsive">
                <table id="example" class="table table-striped" style="width:100%" align="center">
                    <thead>
                        <tr class="table-active">
                            <th rowspan="2" class="text-center">No</th>
                            <th rowspan="2" class="text-center">Nama Alternatif</th>
                            <th class="text-center" colspan="<?= $h ?>">Kriteria</th>
                            <th rowspan="2" class="text-center">Opsi</th>
                        </tr>
                        <tr class="table-active">
                            <?php
                            for ($n = 1; $n <= $h; $n++) {
                                echo "<th class='text-center'>C{$n}</th>";
                            }
                            ?>
                        </tr>
                    </thead>
                    <tbody id="isiNilai">
                        <?php
                        $no = 1;
                        $query = "SELECT * FROM tbl_alternatif";
                        $execute = mysqli_query($conn, $query);
                        while ($data = mysqli_fetch_array($execute)) {
                            $nomor = $no++;
                            $id_alternatif = $data['id_alternatif'];
                            $nama_alternatif = $data['nama_alternatif'];
                            ?>
                            <tr>
                                <td class="text-center">
                                    <?= $nomor ?>
                                </td>
                                <td class="text-center">
                                    <?= $nama_alternatif ?>
                                </td>
                                <?php
                                $query1 = mysqli_query($conn, "SELECT a.nilai_subkriteria as nama_sub FROM tbl_subkriteria a, tbl_nilai b WHERE b.id_alternatif='$id_alternatif' AND a.id_subkriteria = b.id_subkriteria ORDER BY b.id_kriteria");
                                while ($result = mysqli_fetch_array($query1)) {
                                    echo "<td class='text-center'>{$result['nama_sub']}</td>";
                                }
                                ?>
                                <td class="text-center">
                                    <div class='norebuttom'>
                                        <!--------- 
                                            <a class="btn btn-success" href='?page=penilaian&aksi=ubah&id=<?= $data['id_alternatif'] ?>'>Ubah</a>
                                            ---->
                                        <a href="hapusnilai.php?id=<?= $data['id_alternatif']; ?>" class="btn btn-danger"
                                            onclick="return confirm('Apakah anda yakin untuk menghapus data ini ?');">Hapus</a>
                                    </div>
                                </td>
                            </tr>
                            <?php
                        }
                        ?>
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>
</div>