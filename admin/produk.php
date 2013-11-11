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
            <ul class="nav nav-tabs">
                <li class="active"><a href="produk.php"><span class="glyphicon glyphicon-plus"></span>Tambah Produk</a></li>
                <li><a href="produk-lihat.php"><span class="glyphicon glyphicon-list"></span>Lihat Produk</a></li>
            </ul>

            <div class="boxtask">
                <!-- <div class="panel panel-default"> -->
                <!-- <div class="panel-body"> -->
                <form enctype="multipart/form-data" action="script/produk-tambah_sc.php" method="post" class="form-horizontal" role="form">
                    <fieldset>
                        <legend>Form Produk Baru</legend>

                        <div class="alert alert-success alert-dismissable center-block boxalert_produk-add">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <p><strong>Sukses!</strong> Produk berhasil ditambahkan.</p>
                        </div>

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
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="itxtNama" id="txtNama" placeholder="Nama Produk" required>
                            </div>
                        </div>

                        <!-- <div class="form-group">
                            <label for="#" class="col-sm-2 control-label">Ukuran</label>
                            <div class="col-sm-8">
                                <label class="checkbox-inline"><input type="checkbox" name="ichkUkuran" value="38" disabled> 38</label>
                                <label class="checkbox-inline"><input type="checkbox" name="ichkUkuran" value="39" disabled> 39</label>
                                <label class="checkbox-inline"><input type="checkbox" name="ichkUkuran" value="40" disabled> 40</label>
                                <label class="checkbox-inline"><input type="checkbox" name="ichkUkuran" value="41" disabled> 41</label>
                                <label class="checkbox-inline"><input type="checkbox" name="ichkUkuran" value="42" disabled> 42</label>
                                <label class="checkbox-inline"><input type="checkbox" name="ichkUkuran" value="43" disabled> 43</label>
                            </div>
                        </div> -->

                        <div class="form-group">
                            <label for="txtPrice" class="col-sm-2 control-label">Harga</label>
                            <div class="col-sm-5">
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

                        <div class="form-group">
                            <div class="col-sm-5 col-sm-offset-1 fbsubmit">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <button type="reset" class="btn btn-default">Reset</button>
                            </div>
                        </div>


                    </fieldset>
                </form>
                <!-- </div> -->
                <!-- </div> -->

            </div>
        </div>

    <!-- footer body template -->
    <?php require('../inc/view/admin/footer.inc.php'); ?>

    <!-- custom page's script -->
    <script>
        $(document).ready(function() {
            /* cek jika submit form tambah produk sukses */
            if (parseInt($.url().param('add')) === 1)
                $('.boxalert_produk-add').fadeIn('slow');

            /* event listener -- image thumbnail */
            $('#flFoto').on('change', function(e) {
                // get file
                var imgf = $(this).get(0);
                if (imgf.files && imgf.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function(ev) {
                        $('#img_produk-foto').attr('src', ev.target.result).fadeIn('slow');
                    }

                    reader.readAsDataURL(imgf.files[0]);
                }
            });
        });
    </script>
</body>
</html>