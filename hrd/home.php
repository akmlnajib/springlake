<div class="card">
        <div class="card-body d-flex align-items-center">
            <img src="../assets/image/beranda.svg" alt="Logo" width="60px" class="img-fluid me-3">
            <div>
                <h2>Beranda</h2>
                <p>Halaman Utama Beranda</p>
            </div>
        </div>
    </div>
<div class="card mt-3" style="opacity: 0.8;">
    <div class="card-body">
        <center>
    <h5 class="card-title border-1">Selamat Datang, <?php
        include "../assets/conn/koneksi.php";
        if (isset($_SESSION['id_akun'])) {
          $id_akun = $_SESSION['id_akun'];
    
          $cek = "SELECT * FROM tbl_akun WHERE id_akun = $id_akun";
          $result = mysqli_query($conn, $cek);
          
          if ($result) {
            $row = mysqli_fetch_assoc($result); // Use mysqli_fetch_assoc to fetch an associative array
            $nama_lengkap = $row['nama_lengkap'];
            echo $nama_lengkap;
          } else {
            echo "Gagal : " . mysqli_error($conn); // Use mysqli_error to get the error message
          }
        }
        ?></h5>
    <p class="card-text">Pada Sistem Pendukung Keputusan Pemilihan Karyawan Terbaik</p>
    </center>
    </div>
</div>