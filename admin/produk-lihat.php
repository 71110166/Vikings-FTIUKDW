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
<html lang="en">
<head>
    <!-- head template -->
    <?php require('../inc/view/admin/head.inc.php'); ?>
</head>
<body>

    <!-- header body template -->
    <?php require('../inc/view/admin/header.inc.php'); ?>

        <div class="col-md-9 boxright">
            <ul class="nav nav-tabs">
                <li><a href="produk.php"><span class="glyphicon glyphicon-plus"></span>Tambah Produk</a></li>
                <li class="active"><a href="produk-lihat.php"><span class="glyphicon glyphicon-list"></span>Lihat Produk</a></li>
            </ul>

            <div class="boxtask">
                <form action="<?php echo fnSelf(TRUE); ?>" method="post" class="form-inline" role="form">
                    <fieldset>
                        <legend>Data Produk</legend>

                        <div class="boxCari_kategori">
                            <div class="form-group">
                                <label for="txtCari" class="sr-only">Cari Produk</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="txtCari" id="txtCari" placeholder="Cari Kategori (Nama)" autofocus>
                                    <span class="input-group-btn">
                                        <button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-search"></span></button>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                </form>

                <?php
                    # ambil data kategori

                    // buka koneksi db
                    $dbc = NULL;
                    fnOpenDB($dbc);

                    // cek apakah pencarian
                    $sql = "SELECT produk.*, kategori.nama AS kat_nama FROM produk INNER JOIN kategori ON produk.kategori_id = kategori.id";
                    if (isset($_POST['txtCari']))
                        $sql = "SELECT * FROM kategori WHERE nama LIKE '%" . $dbc->escape_string($_POST['txtCari']) . "%'";

                    // query
                    if ($result = $dbc->query($sql)):
                 ?>

                <div class="box_produk-list" style="margin-top:25px">
                    <?php if (isset($_POST['txtCari'])): ?>
                        <p class="label_kategori-cari">
                            Pencarian: <em><?php echo fnEscape($_POST['txtCari']); ?></em> (<?php echo $result->num_rows; ?> item)
                            <span style="margin-left:10px"><a href="<?php echo fnSelf(TRUE); ?>">&times; hapus pencarian</a></span>
                        </p>
                    <?php else: ?>
                        <p>Total produk item: <em><?php echo $result->num_rows; ?></em></p>
                    <?php endif; ?>
                    <table class="table table-striped table-hover" id="tbl_produk-data">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Kode</th>
                                <th>Kategori</th>
                                <th>Produk</th>
                                <th>Tgl Masuk</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                // ambil masing-masing row result
                                while ($row = $result->fetch_assoc()):
                            ?>
                            <tr>
                                <td><?php echo fnEscape($row['id']); ?></td>
                                <td><?php echo fnEscape($row['kode']); ?></td>
                                <td><?php echo fnEscape($row['kat_nama']) ?></td>
                                <td>
                                    <span><strong><?php echo fnEscape($row['nama']) ?></strong></span> <br>
                                    <span><em>Rp. <?php echo fnEscape($row['harga']) ?></em></span>
                                </td>
                                <td><?php echo fnEscape($row['tgl']); ?></td>
                                <td class="btnCmd_kategori-table">
                                    <button class="btn btn-xs btn-primary btn_kategori-edit"><span class="glyphicon glyphicon-edit"></span> Edit</button>
                                    <button class="btn btn-xs btn-danger btn_kategori-delete"><span class="glyphicon glyphicon-remove"></span> Hapus</button>
                                </td>
                            </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>

                <?php
                    // end query
                        // free result set
                        $result->close();
                    endif;

                    // tutup koneksi db
                    fnCloseDB($dbc);
                 ?>

            </div>
        </div>

    <!-- footer body template -->
    <?php require('../inc/view/admin/footer.inc.php'); ?>

</body>
</html>