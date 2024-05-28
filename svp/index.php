<?php
session_start();
if (!isset($_SESSION['id_akun']) || !isset($_SESSION['level'])) {
    header("Location: ./index.php");
    exit();
}

if ($_SESSION['level'] !== 'svp') {
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
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
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
        .list-group-item {
    background-color: #f8f9fa;
    color: #495057;
    padding: 10px;
    margin-bottom: 8px;
    cursor: pointer;
    transition: background-color 0.3s ease, transform 0.3s ease;
}

.list-group-item:hover {
    background-color: #e9ecef;
}

#autocomplete-options {
    display: none;
    width: 100%;
    max-height: 200px;
    overflow-y: auto;
    border: 1px solid #ccc;
    background-color: #fff;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    border-radius: 5px;
}

#autocomplete-options a {
    display: block;
    padding: 15px;
    text-decoration: none;
    color: #333;
    transition: background-color 0.3s ease, transform 0.3s ease;
}

#autocomplete-options a:hover {
    background-color: #e9ecef;
    transform: scale(1.03);
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
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
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
    <script>
       $(document).ready(function () {
    var selectedNik = null;
    var selectedIdAlternatif = null;

    // Ketika nilai input NIK berubah
    $("#search_term").on("input", function () {
        var term = $(this).val();

        $.ajax({
            type: "GET",
            url: "autocomplete.php?term=" + term,
            success: function (response) {
                var suggestions = JSON.parse(response);

                if (suggestions.length > 0) {
                    // Jika terdapat hasil, ambil nama_alternatif dari hasil pertama
                    var firstSuggestion = suggestions[0];
                    selectedNik = firstSuggestion.nik;
                    selectedIdAlternatif = firstSuggestion.id_alternatif;

                    // Tampilkan nama_alternatif di input dengan ID 'namanama'
                    $("#namanama").val(firstSuggestion.nama_alternatif);
                    
                    // Set nilai input hidden dengan nik dan id_alternatif yang terpilih
                    $("input[name='id_alternatif']").val(selectedIdAlternatif);
                } else {
                    // Jika tidak ada hasil, reset nilai input dan input hidden
                    selectedNik = null;
                    selectedIdAlternatif = null;
                    $("#namanama").val('');
                    $("input[name='id_alternatif']").val('');
                }
            }
        });
    });
});


    </script>
</body>

</html>