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
                                    <input type="text" class="form-control" name="txtCari" id="txtCari" placeholder="Cari Produk" autofocus>
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
                    $sql = "SELECT produk.*, kategori.nama AS kat_nama, kategori.id AS kat_id FROM produk INNER JOIN kategori ON produk.kategori_id = kategori.id";
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
                                <th>Produk (Harga)</th>
                                <th>Tgl Masuk</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                // ambil masing-masing row result
                                while ($row = $result->fetch_assoc()):
                            ?>
                            <tr>
                                <td class="tbldata_produk-id"><?php echo fnEscape($row['id']); ?></td>
                                <td class="tbldata_produk-kode"><?php echo fnEscape($row['kode']); ?></td>
                                <td class="tbldata_produk-katnama"><?php echo fnEscape($row['kat_nama']) ?></td>
                                <td>
                                    <span class="tbldata_produk_nama"><strong><?php echo fnEscape($row['nama']) ?></strong></span> <br>
                                    <span class="tbldata_produk_harga">Rp. <?php echo fnEscape($row['harga']) ?></span>
                                </td>
                                <td><?php echo fnEscape($row['tgl']); ?></td>
                                <td class="btnCmd_produk-table">
                                    <button class="btn btn-xs btn-primary btn_produk-edit"><span class="glyphicon glyphicon-edit"></span> Edit</button>
                                    <button class="btn btn-xs btn-danger btn_produk-delete"><span class="glyphicon glyphicon-remove"></span> Hapus</button>
                                </td>
                                <!-- form hidden data -->
                                <span class="tbldata_produk-katid tbldata-hidden"><?php echo $row['kat_id'] ?></span>
                                <span class="tbldata_produk-gambar tbldata-hidden"><?php echo $row['gambar'] ?></span>
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

        <!-- modal produk-edit -->
        <div class="modal fade" id="modal_produk-edit">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">Form Edit Produk</h4>
                    </div>
                    <form enctype="multipart/form-data" action="script/produk-tambah_sc.php" method="post" class="form-horizontal" role="form" id="form_produk-edit">
                    <div class="modal-body">
                        <!-- form edit produk -->
                        <input type="hidden" name="txtIdProduk" val="0">
                        <div class="form-group">
                            <label for="selKategori" class="col-sm-2 control-label">Kategori</label>
                            <div class="col-sm-4">
                                <select name="iselKategori" id="selKategori" class="form-control" autofocus>
                                    <?php
                                        # ambil data kategori
                                        // buka koneksi db
                                        $dbc = NULL;
                                        fnOpenDB($dbc);

                                        if ($result = $dbc->query("SELECT id, nama FROM kategori")):
                                            while ($row = $result->fetch_assoc()):
                                     ?>
                                    <option value="<?php echo fnEscape($row['id']) ?>"><?php echo fnEscape($row['nama']) ?></option>
                                    <?php
                                            endwhile;
                                        endif;

                                        // tutup koneksi db
                                        $result->close();
                                        fnCloseDB($dbc);
                                     ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="txtKode" class="col-sm-2 control-label">Kode</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="itxtKode" id="txtKode" placeholder="Kode Produk" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="txtNama" class="col-sm-2 control-label">Nama</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="itxtNama" id="txtNama" placeholder="Nama Produk" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="txtPrice" class="col-sm-2 control-label">Harga</label>
                            <div class="col-sm-7">
                                <div class="input-group">
                                    <span class="input-group-addon">Rp</span>
                                    <input type="text" class="form-control" name="itxtHarga" id="txtHarga" placeholder="Harga Produk" required>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="flFoto" class="col-sm-2 control-label">Foto</label>
                            <div class="col-sm-5">
                                <input type="hidden" name="MAX_FILE_SIZE" value="1000000">
                                <input type="file" id="flFoto" name="iflFoto" required>
                                <p class="help-block">Upload Foto Produk</p>
                                <img src="" alt="" class="img-thumbnail" id="img_produk-foto" style="wdith:200px;height:200px;display:none;">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary" name="submitted">Simpan perubahan</button>
                    </div>
                </form>
                </div> <!-- /.modal-content -->
            </div> <!-- /.modal-dialog -->
        </div> <!-- /.modal -->

    <!-- footer body template -->
    <?php require('../inc/view/admin/footer.inc.php'); ?>


    <script>
        $(document).ready(function() {

            // click event button edit
            $('button.btn_produk-edit').on('click', function(e)  {
                // ambil data produk dari tabel
                var id      = $(this).parent().find('.tbldata_produk-id').text(),
                    kode    = $(this).parent().find('.tbldata_produk-kode').text(),
                    nama    = $(this).parent().find('.tbldata_produk_nama').text(),
                    harga   = $(this).parent().find('.tbldata_produk_harga').text(),
                    katid   = $(this).parent().find('.tbldata_produk-katid').text(),
                    katnama = $(this).parent().find('.tbldata_produk-katnama').text();

                alert(id);
                // isi data produk pada modal form modal edit
                $('#form_produk-edit').find('#txtKode').val(id);
                $('#form_produk-edit').find('#txtNama').val(nama);

                // tampilkan modal edit produk
                $('#modal_produk-edit').modal('show');
            });


        });
    </script>

</body>
</html>