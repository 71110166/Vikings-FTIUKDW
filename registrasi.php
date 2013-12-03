<?php
    session_start();

    # load helper fn. untuk fungsi bantuan
    require_once('inc/helper/fn_helper.php');
 ?>
<!doctype html>
<html>
<head>
<title>Registrasi</title>
<link rel="stylesheet" type="text/css" href="css/app/style.css">
</head>
<body>
	<div id= "container">

		<div id="header">
			<h1>Football And Futsall Shop</h1>


			<div class="clear"></div>
		</div> <!-- end header -->

		<div id="menu">
			<ul>
				<li><a href="index.php">Beranda</a></li><li>|</li>
				<li><A href="product.php">Produk</a></li><li>|</li>
				<li><a href="registrasi.php">Registrasi</a></li><li>|</li>
				<li><a href="help.php">Bantuan</a></li>

				<ul style="float:right">
					<li>
						<?php
							$item = 0;
							if (isset($_SESSION['cart'])) {
								$item = count($_SESSION['cart']);
								if (!$item)	$item = 0;
							}
						 ?>
						<a href="keranjang.php">(<?php echo $item ?>) Keranjang</a>
					</li>
					<li>
						<div id="login" style="padding-right:10px;">
				<?php
					if (isset($_SESSION['logged'])):
			 	?>
			 	<p style="margin-top:0;">Selamat Datang,
			 		<?php if (fnLoginCheck() == 'admin'): ?>
			 		<a href="admin/" style="color:#ccc;font-weight:bold;text-decoration:none"><?php echo $_SESSION['logged_user']; ?></a>
			 		<?php else: ?>
			 		<a href="index.php" style="color:#ccc;font-weight:bold;text-decoration:none"><?php echo $_SESSION['logged_user'] ?></a>
			 		<?php endif; ?>
			 		<a href="logout.php" style="border:solid 1px #ccc;padding:5px;color:#ccc;background-color:#555">Keluar</a>
			 	</p>
			 	<?php else: ?>
				<form action="login.php" method="post" style="margin-top:-2px;">
					Username <input type="text" size="20" name="itxtUsername">
					Password  <input type="password" size="20" name="itxtPassword">
					<input type="submit" name="submitted" value="Masuk">
				</form>
				<?php endif; ?>
			</div>
					</li>
				</ul>
			</ul>
		</div> <!-- end menu -->
		<div class="clear"></div>
		<div id="mainContainer">
			<div id="subcontainer">
				<div id="content">
					<h2> Registrasi</h2>
					<form action="regisuser.php" method="post">
						<table cellpadding="5" cellspacing="2" width="673">
							<tr>
								<td text align="right">Username *</td>
								<td text align="left"><input type="text" name="username" size="30" required></td>
							</tr>
							<tr>
								<td text align="right">Password *</td>
								<td text align="left"><input type="password" name="password" id="pass" size="30" required></td>
							</tr>
							<tr>
								<td text align="right">Alamat Email *</td>
								<td text align="left"><input type="text" name="email" size="30" required></td>
							</tr>
							<tr>
								<td text align="right">Nama *</td>
								<td text align="left"><input type="text" name="nama"  size="30" required></td>
							</tr>
							<tr>
								<td text align="right">Alamat *</td>
								<td text align="left"><input type="text" name="alamat" size="30" required></td>
							</tr>
							<tr>
								<td text align="right">Kota *</td>
								<td text align="left"><input type="text" name="kota"  size="30" required></td>
							</tr>
							<tr>
								<td text align="right">Kodepos</td>
								<td text align="left"><input type="text" name="kodepos"  size="30"></td>
							</tr>
							<tr>
								<td text align="right">Nomer Telepon *</td>
								<td text align="left"><input type="text" name="notelp"  size="30" required></td>
							</tr>
							<tr>
								<td text align="right">* Wajib diisi</td>
							</tr>
							<tr>
								<td text align="center" colspan="2">
									<input class="button" type="reset" value="Hapus" />
									<input class="button" type="submit" name="customer" value="Daftar" />
								</td>
							</tr>
						</table>
					</form>
				</div> <!-- end content -->
			<div id="sidebar">
				<h3>Pembayaran</h3>
					<img src="images/assets/bca.gif"/><br>
					Bank BCA<br>
					Nomor rekening<br>
					768-028-765-8
					<br><br><br>
					<img src="images/assets/mandiri.gif"><br>
					Bank Mandiri<br>
					133-001-764-9865<br><br><br>
					Atas Nama : <br>
					Krisantus Dappa

			</div> <!-- end sidebar -->
			<div class="clear"></div>
			</div>


		<div id="footer">
			<p>Copyright (c) 2013 Krisantus Dappa</p>
		</div> <!-- end footer -->
		</div> <!-- end mainContainer -->
	</div> <!-- end container -->
</body>
</html>