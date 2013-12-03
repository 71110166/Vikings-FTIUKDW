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
            <h3>Manajemen Pesanan</h3>
            <hr>

            <h4 style="margin-top:30px;margin-bottom:30px">Tabel Data Pesanan</h4>

             <table class="table table-striped">
                 <thead>
                     <tr>
                         <th>ID</th>
                         <th>No Transaksi</th>
                         <th>Nama</th>
                         <th>Email</th>
                         <th>Tanggal</th>
                         <th style="text-align:center">Daftar Barang</th>
                         <!-- <th>Kode Pos</th>
                         <th>No Telp.</th> -->
                     </tr>
                 </thead>
                 <tbody>

                     <?php
                        $dbc = NULL;
                        fnOpenDB($dbc);

                        if ($result = $dbc->query("SELECT pesanan.*, user.username, user.nama, user.email  FROM pesanan JOIN user ON pesanan.user_id=user.id")):
                            while ($row = $result->fetch_assoc()):
                                if ($row['username'] == 'admin') continue;

                     ?>
                    <tr>

                        <td><?php echo fnEscape($row['id']) ?></td>
                        <td><?php echo fnEscape($row['no_transaksi']) ?></td>

                        <td><?php echo fnEscape($row['nama']) ?></td>
                        <td><?php echo fnEscape($row['email']) ?></td>
                        <td><?php echo fnEscape($row['tanggal']) ?></td>
                        <td>
                        <table class="table table-inline">
                            <tr>
                                <th>ID</th>
                                <th>Nama Barang</th>
                                <th>Qty</th>
                                <th>Ukuran</th>
                                <th>Harga</th>
                            </tr>
                            <?php
                                $dbc2 = NULL;
                                fnOpenDB($dbc2);
                                $result2 = $dbc2->query("SELECT pesanan_detail.*, produk.nama, produk.id AS produkid FROM pesanan_detail JOIN produk ON pesanan_detail.produk_id=produk.id WHERE pesanan_detail.order_id=".$row['id']);
                                while ($row2 = $result2->fetch_assoc()) {
                            ?>
                            <tr>
                                <td><?php echo fnEscape($row2['produkid']) ?></td>
                                <td><?php echo fnEscape($row2['nama']) ?></td>
                                <td><?php echo fnEscape($row2['qty']) ?></td>
                                <td><?php echo fnEscape($row2['size']) ?></td>
                                <td><?php echo fnEscape($row2['harga']) ?></td>

                            </tr>
                            <?php
                                    }
                                    $result2->close();
                                fnCloseDB($dbc2);
                            ?>
                        </table>
                        </td>

                        <!-- <td><?php echo fnEscape($row['alamat']) ?></td>
                        <td><?php echo fnEscape($row['kodepos']) ?></td>
                        <td><?php echo fnEscape($row['notelp']) ?></td> -->
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