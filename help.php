<?php
    session_start();

    # load helper fn. untuk fungsi bantuan
    require_once('inc/helper/fn_helper.php');
 ?>
<!doctype html>
<html>
<head>
<title>Bantuan</title>
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
					<h2> Cara order barang</h2>
					<p><h4>1. SMS ke 0877.8056.2533 / 0877.7500.7354 dengan format : (KODE barang, ukuran, nama, alamat)</p></h4>
					<p>Contoh sms pemesanan: Wisnu pradana/ 40, Nike Tiempo, Jl. Klitren Lor Jogja 55523</p><br>
					<p><h4>2. Transfer pembayaran</p></h4>
					<p>Agar pesanan Anda diproses lebih cepat, segera transfer pembayaran setelah Anda menerima balasan SMS dr kami berupa rincian total harga, ongkos kirim & rek bank</p>
					<p>Contoh balasan sms dari kami: Wisnu pradana 40 Nike tiempo ada stok, ongkir ke jogja 20rb, jadi total harga 210rb. Byr ke BCA 768-028-765-8  / Mandiri 133-001-764-9865 </p><br>
					<p><h4>3. konfirmasi pembayaran via SMS</p></h4>
					<p>Agar pesanan Anda bisa segera diproses untuk dikirim, segera konfirmasikan pembayaran Anda via SMS ke nomor yang sama waktu memesan: 0878.8056.2555 / 0877.7500.6500</p>
					<p>Contoh konfirmasi pembayaran:</p>
					<p>Sudah di bayar 190rb dr BRI ke Mandiri a.n Wisnu pradana</p>
					<p>Bila transfer memakai rekening orang lain, contoh konfirmasi: Sudah di bayar 190rb dr BRI ke Mandiri a.n David utk pesanan a.n Wisnu pradana</p>
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