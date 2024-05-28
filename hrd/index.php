<?php
session_start();
if (!isset($_SESSION['id_akun']) || !isset($_SESSION['level'])) {
    header("Location: ./index.php");
    exit();
}

if ($_SESSION['level'] !== 'hrd') {
    header("Location: ./index.php");
    exit();
}

include("../assets/conn/koneksi.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SPK Topsis</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">

    <style>
        body {
            background-color: #f8f9fa;
        }

        .logo {
            text-align: center;
            margin-top: 50px;
        }

        .menu {
            text-align: center;
            margin-top: 20px;
        }

        .form-login {
            margin-top: 50px;
        }
    </style>
</head>

<body>
    <!-- Logo -->
    <div class="container">
        <div class="row">
            <div class="col-12 logo">
                <img src="../assets/image/logo.png" alt="Logo">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 menu">
            <?php
            include "header.php";
            ?>
        </div>
    </div>
    <main>
        <div class="container mt-2">
            <?php
            include "page.php";
            ?>
        </div>
    </main>
    <div class="container">
        <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
            <p class="col-md-4 mb-0 text-muted">&copy; 2022 Springlake</p>
        </footer>
    </div>
        <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
        <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        <script>
            // Ensure the document is ready before initializing DataTables
            $(document).ready(function () {
                $('#example').DataTable();
            });
        </script>
</body>

</html>