<?php include("../assets/conn/koneksi.php"); ?>

<div class="container">
    <div class="row">
        <ol class="breadcrumb">
            <h2>Metode Topsis</h2>
        </ol>
    </div>

    <div class="panel panel-container">
        <div class="bootstrap-table">
            <hr>
            <h2 class="text-green" >Nilai Keputusan</h2>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead align="center">
                    <tr class="table-active">
                            <th class="text-center">No</th>
                            <th class="text-center">Nama Alternatif</th>
                            <?php
                            include '../assets/conn/koneksi.php'; // Sertakan file koneksi ke database (gantilah dengan nama file yang sesuai)
                            
                            $query = mysqli_query($conn, "SELECT * FROM tbl_kriteria");
                            while ($b = mysqli_fetch_array($query)) {
                                echo "<th class='text-center'>$b[nama_kriteria]</th>";
                            }
                            ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $data = mysqli_query($conn, "SELECT * FROM tbl_alternatif ORDER BY id_alternatif");
                        $no = 1;
                        while ($a = mysqli_fetch_array($data)) {
                            $nomor = $no++;
                            $id_alternatif = $a['id_alternatif'];
                            $nama_alternatif = $a['nama_alternatif'];
                            ?>
                            <tr>
                                <td class="text-center">
                                    <?= $nomor ?>
                                </td>
                                <td class="text-center">
                                    <?= $nama_alternatif ?>
                                </td>
                                <?php
                                $query1 = mysqli_query($conn, "SELECT a.nama_subkriteria as nama_sub FROM tbl_subkriteria a, tbl_nilai b WHERE b.id_alternatif='$id_alternatif' AND a.id_subkriteria = b.id_subkriteria ORDER BY b.id_kriteria");
                                while ($result = mysqli_fetch_array($query1)) {
                                    echo "<td class='text-center'>$result[nama_sub]</td>";
                                }
                                ?>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>



    <div class="panel panel-container">
        <div class="bootstrap-table">
            <hr>
            <h2 class="text-green">Konversi Nilai Keputusan</h2>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead align="center">
                    <tr class="table-active">
                            <th class="text-center">No</th>
                            <th class="text-center">Nama Alternatif</th>
                            <?php
                            include '../assets/conn/koneksi.php'; // Sertakan file koneksi ke database (gantilah dengan nama file yang sesuai)
                            
                            $query = mysqli_query($conn, "SELECT * FROM tbl_kriteria");
                            while ($b = mysqli_fetch_array($query)) {
                                echo "<th class='text-center'>$b[nama_kriteria]</th>";
                            }
                            ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $data = mysqli_query($conn, "SELECT * FROM tbl_alternatif ORDER BY id_alternatif");
                        $no = 1;
                        while ($a = mysqli_fetch_array($data)) {
                            $nomor = $no++;
                            $id_alternatif = $a['id_alternatif'];
                            $nama_alternatif = $a['nama_alternatif'];
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
                                    echo "<td class='text-center'>$result[nama_sub]</td>";
                                }
                                ?>
                            </tr>
                        <?php } ?>
                    </tbody>
                    <tr>
                        <td colspan="2">Hasil Pangkat</td>
                        <?php
                        $data = mysqli_query($conn, "SELECT * FROM tbl_kriteria ORDER BY id_kriteria");
                        if (!$data) {
                            die("Error in the query: " . mysqli_error($conn));
                        }

                        while ($a = mysqli_fetch_array($data)) {
                            $sum_pangkat = 0;
                            $id_kriteria = $a['id_kriteria'];
                            echo "<td class='text-center'><b>"; // Buka tag <td> di sini
                            $query = mysqli_query($conn, "SELECT s.nilai_subkriteria as nama_sub FROM tbl_subkriteria s, tbl_nilai kp, tbl_kriteria k WHERE kp.id_kriteria='" . $id_kriteria . "' AND s.id_subkriteria=kp.id_subkriteria AND k.id_kriteria=kp.id_kriteria ORDER BY kp.id_kriteria");

                            if (!$query) {
                                die("Error in the subquery: " . mysqli_error($conn));
                            }

                            while ($result = mysqli_fetch_array($query)) {
                                $hsl_pangkat = pow($result['nama_sub'], 2);
                                $sum_pangkat += $hsl_pangkat;
                            }
                            echo "$sum_pangkat</b></td>"; // Tutup tag <td> di sini
                        }
                        ?>
                    </tr>


                    <tr>
                        <td colspan="2">Hasil Akar</td>
                        <?php
                        $data = mysqli_query($conn, "SELECT * FROM tbl_kriteria ORDER BY id_kriteria");
                        if (!$data) {
                            die("Error in the query: " . mysqli_error($conn));
                        }

                        while ($a = mysqli_fetch_array($data)) {
                            $sum_pangkat = 0;
                            $id_kriteria = $a['id_kriteria'];
                            echo "<td class='text-center'><b>"; // Buka tag <td> di sini
                            $query = mysqli_query($conn, "SELECT s.nilai_subkriteria as nama_sub FROM tbl_subkriteria s, tbl_nilai kp, tbl_kriteria k WHERE kp.id_kriteria='" . $id_kriteria . "' AND s.id_subkriteria=kp.id_subkriteria AND k.id_kriteria=kp.id_kriteria ORDER BY kp.id_kriteria");

                            if (!$query) {
                                die("Error in the subquery: " . mysqli_error($conn));
                            }

                            while ($result = mysqli_fetch_array($query)) {
                                $hsl_pangkat = pow($result['nama_sub'], 2);
                                $sum_pangkat += $hsl_pangkat;
                                $hsl_akar = sqrt($sum_pangkat);
                                $round = number_format($hsl_akar, 4);
                            }
                            echo "$round</b></td>"; // Tutup tag <td> di sini
                        
                            mysqli_query($conn, "UPDATE tbl_kriteria set akar_kriteria='" . $hsl_akar . "' WHERE id_kriteria='" . $id_kriteria . "'");
                        }
                        ?>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    <div class="panel panel-container">
        <div class="bootstrap-table">
            <hr>
            <h2>Normalisasi Matriks</h2>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead align="center">
                    <tr class="table-active">
                            <th class="text-center">No</th>
                            <th class="text-center">Nama Alternatif</th>
                            <?php
                            include '../assets/conn/koneksi.php'; // Sertakan file koneksi ke database (gantilah dengan nama file yang sesuai)
                            
                            $query = mysqli_query($conn, "SELECT * FROM tbl_kriteria");
                            while ($b = mysqli_fetch_array($query)) {
                                echo "<th class='text-center'>$b[nama_kriteria]</th>";
                            }
                            ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $data = mysqli_query($conn, "SELECT * FROM tbl_alternatif ORDER BY id_alternatif");
                        $no = 1;
                        while ($a = mysqli_fetch_array($data)) {
                            $nomor = $no++;
                            $id_alternatif = $a['id_alternatif'];
                            $nama_alternatif = $a['nama_alternatif'];
                            ?>
                            <tr>
                                <td class="text-center">
                                    <?= $nomor ?>
                                </td>
                                <td class="text-center">
                                    <?= $nama_alternatif ?>
                                </td>
                                <?php
                                $query = mysqli_query($conn, "SELECT s.nilai_subkriteria as nama_sub, 
                                n.id_kriteria as id_kriteria FROM tbl_subkriteria s, tbl_nilai n, 
                                tbl_kriteria k WHERE n.id_alternatif='" . $id_alternatif . "' AND n.id_kriteria = k.id_kriteria AND n.id_subkriteria = s.id_subkriteria ORDER BY n.id_kriteria");

                                if ($query === false) {
                                    die("Error in the first query: " . mysqli_error($conn));
                                }

                                while ($result = mysqli_fetch_array($query)) {
                                    $query1 = mysqli_query($conn, "SELECT akar_kriteria as akar FROM tbl_kriteria WHERE id_kriteria='" . $result['id_kriteria'] . "' ORDER BY id_kriteria");

                                    if ($query1 === false) {
                                        die("Error in the second query: " . mysqli_error($conn));
                                    }

                                    $result1 = mysqli_fetch_array($query1);

                                    $nm_matriks = $result['nama_sub'] / $result1['akar'];
                                    $round = number_format($nm_matriks, 4);
                                    echo "<td class='text-center'>$round</td>";
                                }
                                ?>

                            </tr>
                        <?php } ?>
                    </tbody>
                    <tr>
                        <td colspan="2">Normalisai Bobot</td>
                        <?php
                        $data = mysqli_query($conn, "SELECT * FROM tbl_kriteria ORDER BY id_kriteria");
                        while ($a = mysqli_fetch_array($data)) {
                            $query = mysqli_query($conn, "SELECT sum(bobot_kriteria) as sum_bobot FROM tbl_kriteria");
                            $result = mysqli_fetch_array($query);
                            $nm_bobot = $a['bobot_kriteria'];
                            echo "<td class='text-center'><b>$nm_bobot</b></td>";
                        }
                        ?>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    <div class="panel panel-container">
        <div class="bootstrap-table">
            <hr>
            <h2 class="text-green">Normalisasi Bobot</h2>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead align="center">
                    <tr class="table-active">
                            <th class="text-center">No</th>
                            <th class="text-center">Nama Alternatif</th>
                            <?php
                            include '../assets/conn/koneksi.php'; // Sertakan file koneksi ke database (gantilah dengan nama file yang sesuai)
                            
                            $query = mysqli_query($conn, "SELECT * FROM tbl_kriteria");
                            while ($b = mysqli_fetch_array($query)) {
                                echo "<th class='text-center'>$b[nama_kriteria]</th>";
                            }
                            ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $data = mysqli_query($conn, "SELECT * FROM tbl_alternatif ORDER BY id_alternatif");
                        $no = 1;
                        while ($a = mysqli_fetch_array($data)) {
                            $nomor = $no++;
                            $id_alternatif = $a['id_alternatif'];
                            $nama_alternatif = $a['nama_alternatif'];
                            ?>
                            <tr>
                                <td class="text-center">
                                    <?= $nomor ?>
                                </td>
                                <td class="text-center">
                                    <?= $nama_alternatif ?>
                                </td>
                                <?php
                                $query = mysqli_query($conn, "SELECT s.nilai_subkriteria as nama_sub, 
                                n.id_kriteria as id_kriteria FROM tbl_subkriteria s, tbl_nilai n, 
                                tbl_kriteria k WHERE n.id_alternatif='" . $id_alternatif . "' AND n.id_kriteria = k.id_kriteria AND n.id_subkriteria = s.id_subkriteria ORDER BY n.id_kriteria");

                                if ($query === false) {
                                    die("Error in the first query: " . mysqli_error($conn));
                                }

                                while ($result = mysqli_fetch_array($query)) {
                                    $query1 = mysqli_query($conn, "SELECT akar_kriteria as akar FROM tbl_kriteria WHERE id_kriteria='" . $result['id_kriteria'] . "' ORDER BY id_kriteria");

                                    if ($query1 === false) {
                                        die("Error in the second query: " . mysqli_error($conn));
                                    }

                                    $result1 = mysqli_fetch_array($query1);

                                    $nm_matriks = $result['nama_sub'] / $result1['akar'];

                                    $query2 = mysqli_query($conn, "SELECT bobot_kriteria FROM tbl_kriteria WHERE id_kriteria='" . $result['id_kriteria'] . "' ORDER BY id_kriteria");

                                    if ($query2 === false) {
                                        die("Error in the second query: " . mysqli_error($conn));
                                    }

                                    $result2 = mysqli_fetch_array($query2);
                                    $query3 = mysqli_query($conn, "SELECT sum(bobot_kriteria) as sum_bobot FROM tbl_kriteria");
                                    $result3 = mysqli_fetch_array($query3);

                                    $nm_bobot = $result2['bobot_kriteria'];
                                    $valbobot = $nm_matriks * $nm_bobot;
                                    $round = number_format($valbobot, 4);
                                    echo "<td class='text-center'>$round</td>";

                                    mysqli_query($conn, "UPDATE tbl_nilai set normalisasi='" . $valbobot . "' WHERE id_kriteria='" . $result['id_kriteria'] . "' AND id_alternatif='" . $a['id_alternatif'] . "'");
                                }
                                ?>

                            </tr>
                        <?php } ?>
                    </tbody>
                    <tr>
                        <td colspan="2">y<sup>max</sup></td>
                        <?php
                        $data = mysqli_query($conn, "SELECT * FROM tbl_kriteria ORDER BY id_kriteria");
                        while ($a = mysqli_fetch_array($data)) {
                            $id_kriteria = $a['id_kriteria'];
                            $query = mysqli_query($conn, "SELECT max(normalisasi) as max_nm FROM tbl_nilai WHERE id_kriteria='" . $id_kriteria . "' ORDER BY id_kriteria");
                            $result = mysqli_fetch_array($query);
                            $max_bobot = number_format($result['max_nm'], 4);

                            echo "<td class='text-center'><b>$max_bobot</b></td>";
                        }
                        ?>
                    </tr>
                    <tr>
                        <td colspan="2">y<sup>Min</sup></td>
                        <?php
                        $data = mysqli_query($conn, "SELECT * FROM tbl_kriteria ORDER BY id_kriteria");
                        while ($a = mysqli_fetch_array($data)) {
                            $id_kriteria = $a['id_kriteria'];
                            $query = mysqli_query($conn, "SELECT min(normalisasi) as min_nm FROM tbl_nilai WHERE id_kriteria='" . $id_kriteria . "' ORDER BY id_kriteria");
                            $result = mysqli_fetch_array($query);
                            $min_bobot = number_format($result['min_nm'], 4);

                            echo "<td class='text-center'><b>$min_bobot</b></td>";
                        }
                        ?>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    <div class="panel panel-container">
        <div class="bootstrap-table">
            <hr>
            <h2 class="text-green">D<sup >+</sup></h2>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead align="center">
                    <tr class="table-active">
                            <th class="text-center">No</th>
                            <th class="text-center">Nama Alternatif</th>
                            <?php
                            include '../assets/conn/koneksi.php'; // Sertakan file koneksi ke database (gantilah dengan nama file yang sesuai)
                            
                            $query = mysqli_query($conn, "SELECT * FROM tbl_kriteria");
                            while ($b = mysqli_fetch_array($query)) {
                                echo "<th class='text-center'>$b[nama_kriteria]</th>";
                            }
                            ?>

                            <th class="text-center">D<sup>+</sup></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $data = mysqli_query($conn, "SELECT * FROM tbl_alternatif ORDER BY id_alternatif");
                        $no = 1;
                        while ($a = mysqli_fetch_array($data)) {
                            $nilai_d_plus = 0;
                            $nomor = $no++;
                            $id_alternatif = $a['id_alternatif'];
                            $nama_alternatif = $a['nama_alternatif'];
                            ?>
                            <tr>
                                <td class="text-center">
                                    <?= $nomor ?>
                                </td>
                                <td class="text-center">
                                    <?= $nama_alternatif ?>
                                </td>
                                <?php
                                $query = mysqli_query($conn, "SELECT s.nilai_subkriteria as nama_sub, 
                                n.id_kriteria as id_kriteria FROM tbl_subkriteria s, tbl_nilai n, 
                                tbl_kriteria k WHERE n.id_alternatif='" . $id_alternatif . "' AND n.id_kriteria = k.id_kriteria AND n.id_subkriteria = s.id_subkriteria ORDER BY n.id_kriteria");

                                if ($query === false) {
                                    die("Error in the first query: " . mysqli_error($conn));
                                }

                                while ($result = mysqli_fetch_array($query)) {
                                    $query1 = mysqli_query($conn, "SELECT akar_kriteria as akar FROM tbl_kriteria WHERE id_kriteria='" . $result['id_kriteria'] . "' ORDER BY id_kriteria");

                                    if ($query1 === false) {
                                        die("Error in the second query: " . mysqli_error($conn));
                                    }

                                    $result1 = mysqli_fetch_array($query1);

                                    $nm_matriks = $result['nama_sub'] / $result1['akar'];

                                    $query2 = mysqli_query($conn, "SELECT bobot_kriteria FROM tbl_kriteria WHERE id_kriteria='" . $result['id_kriteria'] . "' ORDER BY id_kriteria");

                                    if ($query2 === false) {
                                        die("Error in the third query: " . mysqli_error($conn));
                                    }

                                    $result2 = mysqli_fetch_array($query2);

                                    $query3 = mysqli_query($conn, "SELECT sum(bobot_kriteria) as sum_bobot FROM tbl_kriteria");

                                    $result3 = mysqli_fetch_array($query3);

                                    $nm_bobot = $result2['bobot_kriteria'];
                                    $valbobot = $nm_matriks * $nm_bobot;

                                    $query4 = mysqli_query($conn, "SELECT MAX(normalisasi) as max_nm FROM tbl_nilai
                                    WHERE id_kriteria='" . $result['id_kriteria'] . "' ORDER BY id_kriteria");
                                    $result4 = mysqli_fetch_array($query4);

                                    $max_bobot = $result4['max_nm'];
                                    $nn_d_plus = pow(($valbobot - $max_bobot), 2);
                                    $nilai_d_plus += $nn_d_plus;

                                    echo '<td class="text-center">' . number_format($nn_d_plus, 4) . '</td>';
                                }

                                $akar_d_plus = sqrt($nilai_d_plus);
                                echo '<td class="text-center">' . number_format($akar_d_plus, 4) . '</td>';

                                // Update nilai D+ pada tabel tbl_alternatif
                                mysqli_query($conn, "UPDATE tbl_alternatif SET dmax = $akar_d_plus WHERE id_alternatif = $id_alternatif") ?>

                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="panel panel-container">
        <div class="bootstrap-table">
            <hr>
            <h2 class="text-green">D<sup class="text-green">-</sup></h2>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead align="center">
                    <tr class="table-active">
                            <th class="text-center">No</th>
                            <th class="text-center">Nama Alternatif</th>
                            <?php
                            include '../assets/conn/koneksi.php'; // Sertakan file koneksi ke database (gantilah dengan nama file yang sesuai)
                            
                            $query = mysqli_query($conn, "SELECT * FROM tbl_kriteria");
                            while ($b = mysqli_fetch_array($query)) {
                                echo "<th class='text-center'>$b[nama_kriteria]</th>";
                            }
                            ?>

                            <th class="text-center">D<sup>-</sup></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $data = mysqli_query($conn, "SELECT * FROM tbl_alternatif ORDER BY id_alternatif");
                        $no = 1;
                        while ($a = mysqli_fetch_array($data)) {
                            $nilai_d_min = 0;
                            $nomor = $no++;
                            $id_alternatif = $a['id_alternatif'];
                            $nama_alternatif = $a['nama_alternatif'];
                            ?>
                            <tr>
                                <td class="text-center">
                                    <?= $nomor ?>
                                </td>
                                <td class="text-center">
                                    <?= $nama_alternatif ?>
                                </td>
                                <?php
                                $query = mysqli_query($conn, "SELECT s.nilai_subkriteria as nama_sub, 
                                n.id_kriteria as id_kriteria FROM tbl_subkriteria s, tbl_nilai n, 
                                tbl_kriteria k WHERE n.id_alternatif='" . $id_alternatif . "' AND n.id_kriteria = k.id_kriteria AND n.id_subkriteria = s.id_subkriteria ORDER BY n.id_kriteria");

                                if ($query === false) {
                                    die("Error in the first query: " . mysqli_error($conn));
                                }

                                while ($result = mysqli_fetch_array($query)) {
                                    $query1 = mysqli_query($conn, "SELECT akar_kriteria as akar FROM tbl_kriteria WHERE id_kriteria='" . $result['id_kriteria'] . "' ORDER BY id_kriteria");

                                    if ($query1 === false) {
                                        die("Error in the second query: " . mysqli_error($conn));
                                    }

                                    $result1 = mysqli_fetch_array($query1);

                                    $nm_matriks = $result['nama_sub'] / $result1['akar'];

                                    $query2 = mysqli_query($conn, "SELECT bobot_kriteria FROM tbl_kriteria WHERE id_kriteria='" . $result['id_kriteria'] . "' ORDER BY id_kriteria");

                                    if ($query2 === false) {
                                        die("Error in the second query: " . mysqli_error($conn));
                                    }

                                    $result2 = mysqli_fetch_array($query2);
                                    $query3 = mysqli_query($conn, "SELECT sum(bobot_kriteria) as sum_bobot FROM tbl_kriteria");
                                    $result3 = mysqli_fetch_array($query3);

                                    $nm_bobot = $result2['bobot_kriteria'];
                                    $valbobot = $nm_matriks * $nm_bobot;

                                    $query4 = mysqli_query($conn, "SELECT MIN(normalisasi) as min_nm FROM tbl_nilai
                                    WHERE id_kriteria='" . $result['id_kriteria'] . "' ORDER BY id_kriteria");
                                    $result4 = mysqli_fetch_array($query4);
                                    $min_bobot = $result4['min_nm'];
                                    $nn_d_min = pow(($valbobot - $min_bobot), 2);
                                    $round_min = number_format($nn_d_min, 4);
                                    $nilai_d_min += $nn_d_min;
                                    $akar_d_min = sqrt($nilai_d_min);
                                    $round_d_min = number_format($akar_d_min, 4);

                                    echo "<td class='text-center'>$round_min</td>";
                                }

                                echo "<td class='text-center'>$round_d_min</td>";
                                mysqli_query($conn, "UPDATE tbl_alternatif set dmin='" . $akar_d_min . "' 
                                WHERE id_alternatif ='" . $a['id_alternatif'] . "'");
                                ?>

                            </tr>
                        <?php } ?>
                    </tbody>
                </table>

                <?php
                $data = mysqli_query($conn, "SELECT * FROM tbl_alternatif ORDER BY id_alternatif");
                while ($a = mysqli_fetch_array($data)) {
                    $dmax = $a['dmax'];
                    $dmin = $a['dmin'];
                    $nilai_topsis = $dmin / ($dmin + $dmax);
                    mysqli_query($conn, "UPDATE tbl_alternatif set nilai_topsis='" . $nilai_topsis . "' 
                                WHERE id_alternatif ='" . $a['id_alternatif'] . "'");
                }

                $data1 = "SELECT id_alternatif, nilai_topsis FROM tbl_alternatif ORDER BY nilai_topsis DESC";
                $result = $conn->query($data1);
                $rangking = 1;
                while ($row = $result->fetch_assoc()) {
                    $id_alternatif = $row["id_alternatif"];

                    $update_sql = "UPDATE tbl_alternatif SET rangking = $rangking WHERE id_alternatif = $id_alternatif";
                    $conn->query($update_sql);

                    $rangking++;
                }
                ?>

                <h2 class="text-green">Perangkingan</h2>
                <div class="table-responsive">
                    <table class="table table-bordered">
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
                            $nilai = 0.45;
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
                                        if ($a['nilai_topsis'] > $nilai){
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
                </div>

            </div>
        </div>
    </div>
</div>