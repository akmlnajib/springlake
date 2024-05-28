<?php
session_start();
if (!isset($_SESSION['id_akun']) || !isset($_SESSION['level'])) {
    header("Location: ./index.php");
    exit();
}

if ($_SESSION['level'] !== 'chif') {
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
    <link href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f8f9fa;
        }

        .logo {
            text-align: center;
            margin-top: 20px;
        }

        .menu {
            text-align: center;
            margin-top: 10px;
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
            include "navbar.php";
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
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
    $(document).ready(function() {
        $('#example').DataTable({
            dom: '<"row"<"col-md-6"l><"col-md-6"f>><"row"<"col-md-12"t>><"row"<"col-md-6"i><"col-md-6"p>>B',
            buttons: [
                {
                    extend: 'pdfHtml5',
                    text: 'Export PDF',
                    className: 'btn btn-primary',
                    exportOptions: {
                        columns: ':visible'
                    }
                }
            ]
        });
    });
</script>
</body>

</html>