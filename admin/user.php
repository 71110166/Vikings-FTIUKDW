<?php
    session_start();

    # load helper fn. untuk fungsi bantuan
    require_once('../inc/helper/fn_helper.php');
    # load helper fn. untuk koneksi db
    require_once('../inc/helper/fn_dbc.php');

    # cek login
    fnLoginCheck() or fnRedirect('./');

    # page title
    define('PAGE_TITLE', 'Administrator Page - Produk');
 ?>

<!doctype html>
<html lang="id">
<head>
    <!-- head template -->
    <?php require('../inc/view/admin/head.inc.php'); ?>
</head>
<body>

    <!-- header body template -->
    <?php require('../inc/view/admin/header.inc.php'); ?>

        <div class="col-md-9 boxright">
            <h3>Manajemen User</h3>
            <hr>

            <h4 style="margin-top:30px;margin-bottom:30px">Tabel Data User</h4>

             <table class="table table-striped">
                 <thead>
                     <tr>
                         <th>ID</th>
                         <th>Nama</th>
                         <th>Email</th>
                         <th>Alamat</th>
                         <th>Kode Pos</th>
                         <th>No Telp.</th>
                     </tr>
                 </thead>
                 <tbody>

                     <?php
                        $dbc = NULL;
                        fnOpenDB($dbc);

                        if ($result = $dbc->query("SELECT * FROM user")):
                            while ($row = $result->fetch_assoc()):
                                if ($row['username'] == 'admin') continue;
                     ?>
                    <tr>
                        <td><?php echo fnEscape($row['id']) ?></td>
                        <td><?php echo fnEscape($row['nama']) ?></td>
                        <td><?php echo fnEscape($row['email']) ?></td>
                        <td><?php echo fnEscape($row['alamat']) ?></td>
                        <td><?php echo fnEscape($row['kodepos']) ?></td>
                        <td><?php echo fnEscape($row['notelp']) ?></td>
                    </tr>
                    <?php
                            endwhile;
                        endif;

                        // tutup koneksi db
                        $result->close();
                        fnCloseDB($dbc);
                     ?>

                 </tbody>
             </table>
        </div>

    <!-- footer body template -->
    <?php require('../inc/view/admin/footer.inc.php'); ?>

    <!-- custom page's script -->
    <script>
        $(document).ready(function() {

        });
    </script>
</body>
</html>