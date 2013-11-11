<?php
    session_start();

    # load helper fn. untuk fungsi bantuan
    require_once('inc/helper/fn_helper.php');
 ?>
<!doctype html>
<html>
<head>
<title>Kategori</title>
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
		</div> <!-- end menu -->
		<div class="clear"></div>
		<div id="mainContainer">
		<div id="subcontainer">
			<div id="content">
				<div class="produklogo">
					<h2>Produk</h2>
					<div class="imgproduk">
					<a href="#"><img src="images/assets/lnike.jpg" width="100" height="100" title="Nike" alt="Nike"/></a>
					<p>Nike</p>
					</div>
					<div class="imgproduk">
					<a href="#"><img src="images/assets/ladidas.jpg" width="100" height="100" title="Adidas" alt="Adidas"/></a>
					<p>Adidas</p>
					</div>
					<div class ="imgproduk">
					<a href="#"><img src="images/assets/lumbro.jpg" width="100" height="100" title="Umbro" alt="Umbro"/></a>
					<p>Umbro</p>
					</div>
					<div class="imgproduk">
					<a href="#"><img src="images/assets/lpuma.jpg" width="100" height="100" title="Puma" alt="Puma"/></a>
					<p>Puma</p>
					</div>
					<div class="imgproduk">
					<a href="#"><img src="images/assets/lspecs.jpg" width="100" height="100" title="Specs" alt="Specs"/></a>
					<p>Specs</p>
					</div>
				</div>
				<div class="clear"></div>
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
		</div>
		</div> <!-- end mainContainer -->
	</div> <!-- end container -->
</body>
</html>