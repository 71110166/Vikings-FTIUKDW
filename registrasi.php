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

			<div id="login">
				<?php 
					if (isset($_SESSION['logged'])):
			 	?>
			 	<p>Welcome, 
			 		<a href="admin/" style="color:#ccc;font-weight:bold;text-decoration:none"><?php echo $_SESSION['logged_cred']; ?></a>
			 		<a href="admin/script/logout_sc.php" style="border:solid 1px #ccc;padding:5px;color:#ccc;background-color:#333">Logout</a>
			 	</p>
			 	<?php else: ?>
				<form action="admin/index.php" method="post">
					<strong> Username</strong> <input type="text" size="20" name="itxtUsername">
					<strong> Password </strong>  <input type="password" size="20" name="itxtPassword">
					<input type="submit" name="submitted" value="Login">
				</form>
				<?php endif; ?>
			</div>
			<div class="clear"></div>
		</div> <!-- end header -->
		<div id="menu">
			<ul>
				<li><a href="index.php">Beranda</a></li><li>|</li>
				<li><A href="product.php">Produk</a></li><li>|</li>
				<li><a href="registrasi.php">Registrasi</a></li><li>|</li>
				<li><a href="help.php">Bantuan</a></li>

			</ul>
		</div> <!-- end menu --><div class="clear"></div>
		<div id="mainContainer">
			<div id="subcontainer">
				<div id="content">
					<h2> Registrasi</h2>
					<form>
						<table cellpadding="5" cellspacing="2" width="673">
							<tr>
								<td text align="right">Username *</td>
								<td text align="left"><input type="text" name="username" size="30"></td>
							</tr>
							<tr>
								<td text align="right">Password *</td>
								<td text align="left"><input type="password" name="pass" id="pass" size="30"></td>
							</tr>
							<tr>
								<td text align="right">re-Password *</td>
								<td text align="left"><input type="password" name="repass" id="repass" size="30"></td>
							</tr>
							<tr>
								<td text align="right">Alamat Email *</td>
								<td text align="left"><input type="text" name="email" size="30"></td>
							</tr>
							<tr>
								<td text align="right">Nama *</td>
								<td text align="left"><input type="text" name="name"  size="30"></td>
							</tr>
							<tr>
								<td text align="right">Alamat *</td>
								<td text align="left"><input type="text" name="address" size="30"></td>
							</tr>
							<tr>
								<td text align="right">Kota *</td>
								<td text align="left"><input type="text" name="city"  size="30"></td>
							</tr>
							<tr>
								<td text align="right">Negara *</td>
								<td text align="left"><input type="text" name="country"  size="30"></td>
							</tr>
							<tr>
								<td text align="right">Kodepos</td>
								<td text align="left"><input type="text" name="zip"  size="30"></td>
							</tr>
							<tr>
								<td text align="right">Nomer Telepon *</td>
								<td text align="left"><input type="text" name="mobile"  size="30"></td>
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