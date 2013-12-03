<?php
    session_start();

    // load helper fn. untuk koneksi db
    require_once('inc/helper/fn_dbc.php');
    // load helper fn. untuk password hashing
    require_once('inc/helper/fn_helper.php');
    // load phpass lib
    require_once('inc/lib/PasswordHash.php');

    // cek jika admin telah berhasil login sebelumnya dan belum melakukan prosedur logout
    if (isset($_SESSION['logged'])) {
        header("Location: produk.php");
        die();
    }

    // cek apakah form login telah di submit
    if (isset($_POST['submitted'])) {

        // simpan username dann password ke variabel
        $user = $_POST['itxtUsername'];
        $pass = $_POST['itxtPassword'];

        # ambil data admin di db
        // buka koneksi ke db
        $dbc = NULL;
        fnOpenDB($dbc);

        // query data admin sesuai nama user
        $stmt = $dbc->prepare('SELECT * FROM user WHERE username = ? AND password = ? LIMIT 1');
        $stmt->bind_param('ss', $user, $pass);
        $stmt->execute();

        // cek jika username ada di db
        $result = $stmt->get_result();
        if ($result->num_rows == 1) {
            $row  = $result->fetch_assoc();
            $id   = $row['id'];
            $username = $row['username'];
            $role = $row['role'];

            // set session var
            $_SESSION['logged'] = TRUE;
            $_SESSION['logged_cred'] = $role;
            $_SESSION['logged_id'] = $id;
            $_SESSION['logged_user'] = $username;

            // redirect ke halaman admin
            if ($role=='admin') {
                header("Location: admin/produk.php");
                die();
            }
            header("Location: index.php");
            die();
        }

        # Login gagal, username atau password salah
        // tutup koneksi db
        $stmt->close();
        fnCloseDB($dbc);

        // Login GAGAL
        header("Location: login.php?err=1");
        die();
    }

?>

<!doctype html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrator Login</title>

    <link rel="stylesheet" href="../css/normalize.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css" media="screen">
    <link rel="stylesheet" href="../css/app/login.css">
</head>
<body>

    <div class="container">
        <div class="row">
            <div class="col-sm-6 col-md-4 col-md-offset-4">
                <h1 class="text-center login-title">Administrator Login</h1>
                <div class="account-wall">
                    <img class="profile-img" src="../images/assets/login.png" alt="">
                    <form action="index.php" method="post" class="form-signin">
                    <input type="text" class="form-control input-text" name="itxtUsername" placeholder="Username" required autofocus>
                    <input type="password" class="form-control input-text" name="itxtPassword" placeholder="Password" required>

                    <div class="alert alert-danger alert-dismissable boxalert" style="display:none">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <p><strong>Oops!</strong> Username dan atau Password salah. Silahkan ulangi kembali.</p>
                    </div>

                    <button class="btn btn-lg btn-primary btn-block" type="submit" name="submitted">LOGIN</button>
                    <label class="checkbox pull-left">
                        <input type="checkbox" value="remember-me"> Ingat saya
                    </label>
                    <a href="#" class="pull-right need-help">Butuh bantuan? </a><span class="clearfix"></span>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!-- script blocks -->
    <script src="../js/jquery.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/purl.js"></script>
    <script>

        $(document).ready(function() {

            // get status from url query string (submitted?) -- login error
            if ($.url().param('err'))
                $('.boxalert').fadeIn('slow');

        });

    </script>
</body>
</html>