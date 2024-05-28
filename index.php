<?php
session_start();
if (isset($_GET['aksi']) && $_GET['aksi'] == 'login') {
    include 'assets/conn/koneksi.php';

    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = mysqli_prepare($conn, "SELECT id_akun, level FROM tbl_akun WHERE username = ? AND password = ?");
    mysqli_stmt_bind_param($query, "ss", $username, $password);
    mysqli_stmt_execute($query);
    mysqli_stmt_store_result($query);

    if (mysqli_stmt_num_rows($query) > 0) {
        mysqli_stmt_bind_result($query, $id_akun, $level);
        mysqli_stmt_fetch($query);

        $_SESSION['id_akun'] = $id_akun;
        $_SESSION['level'] = $level;

        if ($level == 'admin1') {
            header("location: admin1/index.php");
        } elseif ($level == 'chif') {
            header("location: chif/index.php");
        } elseif ($level == 'hrd') {
            header("location: hrd/index.php");
        } elseif ($level == 'svp') {
            header("location: svp/index.php");
        }
    } else {
        $loginError = true;
    }

    mysqli_stmt_close($query);
    mysqli_close($conn);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Login Form</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    /* Tambahan style jika diperlukan */
    body {
      background-color: #f8f9fa;
    }
    .login-container {
      margin-top: 100px;
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="row justify-content-center login-container">
      <div class="col-md-6">
        <div class="card">
          <div class="card-header">
            <h3 class="text-center">Login</h3>
          </div>
          <div class="card-body">
          <form method="post" action="index.php?aksi=login" enctype="multipart/form-data">
              <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username" placeholder="Enter your username" required>
              </div>
              <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required>
              </div>
              <div class="d-grid">
                <button type="submit" class="btn btn-primary">Login</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
