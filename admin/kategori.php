<?php
    session_start();

    # load helper fn. untuk fungsi bantuan
    require_once('../inc/helper/fn_helper.php');

    # cek login
    fnLoginCheck() or fnRedirect('./');

    # page title
    define('PAGE_TITLE', 'Administrator Page - Kategori');
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
                <li class="active"><a href="kategori.php"><span class="glyphicon glyphicon-plus"></span>Tambah Kategori</a></li>
                <li><a href="kategori-lihat.php"><span class="glyphicon glyphicon-list"></span>Lihat Kategori</a></li>
            </ul>

            <div class="boxtask">
                <form action="script/kategori-tambah_sc.php" method="post" class="form-horizontal" role="form" id="form_kategori">
                    <fieldset>
                        <legend>Form Kategori Baru</legend>

                        <div class="alert alert-dismissable center-block boxalert_kategori-add">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <p><strong>Alert!</strong> An Alert box</p>
                        </div>

                        <div class="form-group">
                            <label for="txtNama" class="col-sm-2 control-label">Nama</label>
                            <div class="col-sm-7">
                                <input type="text" class="form-control" name="itxtNamaKategori" id="txtNama" placeholder="Nama Kategori" required autofocus>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="txtaKeterangan" class="col-sm-2 control-label">Keterangan</label>
                            <div class="col-sm-7">
                                <textarea name="itxtaKeterangan" id="txtaKeterangan" cols="30" rows="10" class="form-control" placeholder="Keterangan Kategori"></textarea>
                            </div>
                        </div>


                        <div class="form-group">
                            <div class="col-sm-5 col-sm-offset-1 fbsubmit">
                                <button type="submit" class="btn btn-primary" name="submitted">Submit</button>
                                <button type="reset" class="btn btn-default">Reset</button>
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>

    <!-- footer body template -->
    <?php require('../inc/view/admin/footer.inc.php'); ?>

    <!-- custom page's script -->
    <script>
        $(document).ready(function() {
            // form kategori submit handler
            $('#form_kategori').submit(function(e) {
                // stop normal submit
                e.preventDefault();

                //get form values
                var $form = $(this),
                    url   = $form.attr('action'),
                    $kat_nama = $form.find('input[name="itxtNamaKategori"]');

                // send data dengan post
                $.post(url, $form.serialize(), function(retval) {
                    console.log(retval);
                    // check if success
                    if (parseInt(retval) === 1) {
                        $('.boxalert_kategori-add').removeClass('alert-danger').addClass('alert-success').children('p')
                            .html('<strong>Sukses!</strong> Data kategori <em>' + fn.htmlEscape($kat_nama.val()) + '</em> berhasil ditambahkan.').parent()
                            .fadeIn('slow');
                        $form.get(0).reset();
                        $kat_nama.focus();
                    } else {
                        $('.boxalert_kategori-add').removeClass('alert-success').addClass('alert-danger').children('p')
                            .html('<strong>Gagal!</strong> Data kategori <em>' + fn.htmlEscape($kat_nama.val()) + '</em> gagal ditambahkan.').parent()
                            .fadeIn('slow');
                        $form.get(0).reset();
                        $kat_nama.focus();
                    }
                });
            });
        });
    </script>
</body>
</html>