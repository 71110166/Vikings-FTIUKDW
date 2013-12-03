<?php
    session_start();

    # load helper fn. untuk fungsi bantuan
    require_once('../inc/helper/fn_helper.php');
    # load helper fn. untuk koneksi db
    require_once('../inc/helper/fn_dbc.php');

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
                <li><a href="kategori.php"><span class="glyphicon glyphicon-plus"></span>Tambah Kategori</a></li>
                <li class="active"><a href="kategori-lihat.php"><span class="glyphicon glyphicon-list"></span>Lihat Kategori</a></li>
            </ul>

            <div class="boxtask">
                <form action="<?php echo fnSelf(TRUE); ?>" method="post" class="form-inline" role="form">
                    <fieldset>
                        <legend>Data Kategori</legend>

                        <div class="boxCari_kategori">
                            <div class="form-group">
                                <label for="txtCari" class="sr-only">Cari Kategori</label>
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
                    $sql = "SELECT * FROM kategori";
                    if (isset($_POST['txtCari']))
                        $sql = "SELECT * FROM kategori WHERE nama LIKE '%" . $dbc->escape_string($_POST['txtCari']) . "%'";

                    // query
                    if ($result = $dbc->query($sql)):
                 ?>

                <div class="box_kaegori-list" style="margin-top:25px">
                    <?php if (isset($_POST['txtCari'])): ?>
                        <p class="label_kategori-cari">
                            Pencarian: <em><?php echo fnEscape($_POST['txtCari']); ?></em> (<?php echo $result->num_rows; ?> item)
                            <span style="margin-left:10px"><a href="<?php echo fnSelf(TRUE); ?>">&times; hapus pencarian</a></span>
                        </p>
                    <?php else: ?>
                        <p>Total kategori item: <em><?php echo $result->num_rows; ?></em></p>
                    <?php endif; ?>
                    <table class="table table-striped table-hover" id="tbl_kategori-data">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nama Kategori</th>
                                <th style="width: 400px">Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                // ambil masing-masing row result
                                while ($row = $result->fetch_assoc()):
                            ?>
                            <tr>
                                <td><?php echo fnEscape($row['id']); ?></td>
                                <td><?php echo fnEscape($row['nama']); ?></td>
                                <td><?php echo fnEscape($row['keterangan']); ?></td>
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

        <!-- modal kategori-edit -->
        <div class="modal fade" id="modal_kategori-edit">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">Form Edit Kategori</h4>
                    </div>
                    <form action="script/kategori-edit_sc.php" method="post" class="form-horizontal" role="form" id="form_kategori-edit">
                    <div class="modal-body">
                        <div class="row" style="padding-top: 15px;">
                            <input type="hidden" name="itxtID" id="txtID" value="">
                            <div class="form-group">
                                <label for="txtNama" class="col-sm-3 control-label">Nama</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="itxtNama" id="txtNama" placeholder="Nama Kategori">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="txtaKeterangan" class="col-sm-3 control-label">Keterangan</label>
                                <div class="col-sm-8">
                                    <textarea name="itxtaKeterangan" id="txtaKeterangan" cols="30" rows="10" class="form-control" placeholder="Keterangan Kategori"></textarea>
                                </div>
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

    <!-- custom page's script -->
    <script>
        $(document).ready(function() {
            /* event handler */

            // click event button delete
            $('button.btn_kategori-delete').on('click', function(e) {
                //get kategori id dan nama
                var id   = $(this).parent().siblings('td:first').text(),
                    nama = $(this).parent().siblings('td:first+td').text();

                //action
                if(confirm('Hapus kategori : \n' + '(' + id + ') ' + nama + ' ?')) {
                    $.post('script/kategori-hapus_sc.php', {'kategori_id' : id}, function(retval) {
                        console.log(retval);
                        if (parseInt(retval) === 1)
                            location.reload(true);
                        else
                            alert('Proses hapus GAGAL! (data id: '+ id +')');
                    });
                }
            });

            // click event button edit
            $('button.btn_kategori-edit').on('click', function(e) {
                //get kategori id, nama dan keterangan
                var id   = $(this).parent().siblings('td:first').text(),
                    nama = $(this).parent().siblings('td:first+td').text(),
                    ket  = $(this).parent().siblings('td:first+td+td').text();

                // siapkan modal edit kategori
                $('#form_kategori-edit').find('#txtID').val(id);
                $('#form_kategori-edit').find('#txtNama').val(nama);
                $('#form_kategori-edit').find('#txtaKeterangan').val(ket);
                // tampilkan modal
                $('#modal_kategori-edit').modal('show');
            });

            // event modal shown -- edit kategori
            $('#modal_kategori-edit').on('shown.bs.modal', function(e) {
                // focus on first input
                $(this).find('input#txtNama').focus();
            });

            // event submit form -- edit kategori
            $('#form_kategori-edit').submit(function(e) {
                // stop normal submit
                e.preventDefault();

                // get form values
                var $form  = $(this),
                    url    = $form.attr('action'),
                    kat_id = $form.find('#txtID').val();

                // send data to script
                $.post(url, $form.serialize(), function(retval) {
                    console.log(retval);
                    // check if success
                    if (parseInt(retval) === 1)
                        location.reload(true);
                    else
                        alert('Proses edit GAGAL! (data id: ' + kat_id + ')');
                });
            })
        });
    </script>

</body>
</html>