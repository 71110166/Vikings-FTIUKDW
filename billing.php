<?php
    session_start();

    # load helper fn. untuk fungsi bantuan
    require_once('inc/helper/fn_helper.php');
    # load helper fn. untuk koneksi db
    require_once('inc/helper/fn_dbc.php');

    include("inc/helper/db.php");
	include("inc/helper/functions.php");

 ?>
<!doctype html>
<html>
<head>
<title>Registrasi</title>
<link rel="stylesheet" type="text/css" href="css/app/style.css">
<script language="javascript">
	function del(pid){
		if(confirm('Do you really mean to delete this item')){
			document.form1.pid.value=pid;
			document.form1.command.value='delete';
			document.form1.submit();
		}
	}
	function clear_cart(){
		if(confirm('This will empty your shopping cart, continue?')){
			document.form1.command.value='clear';
			document.form1.submit();
		}
	}
	function update_cart(){
		document.form1.command.value='update';
		document.form1.submit();
	}
</script>
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

					<h2>Informasi Transaksi</h2>

					<?php
						if (fnLoginCheck()) {
							$notrx = time();

						if (isset($_SESSION['cart'])) {
						// masukan data transaksi ke database
						// buka koneksi db
						$dbc = NULL;
						fnOpenDB($dbc);
						$stmt = $dbc->prepare("INSERT INTO pesanan VALUES(NULL, ?, ?, NOW())");
						$stmt->bind_param('ii', $_SESSION['logged_id'], $notrx);
						$stmt->execute() || exit("Failed to execute: {$stmt->error}");
						$orderid=$dbc->insert_id;

						// tutup koneksi db
						$stmt->close();
						fnCloseDB($dbc);

						$max=count($_SESSION['cart']);
						for($i=0;$i<$max;$i++){
							$pid=$_SESSION['cart'][$i]['productid'];
							$q=$_SESSION['cart'][$i]['qty'];
							$s=$_SESSION['cart'][$i]['size'];
							$price=get_price($pid);
							mysql_query("insert into pesanan_detail values ($orderid,$pid,$q,$s,$price)");
						}

						// kosongkan keranjang belanja
						unset($_SESSION['cart']);
						header("Location: billing.php");
						}

					?>

					<h3>Selamat transaksi belanja anda telah dicatat.</h3>
					<p>Nomor Transaksi Belanja anda: <strong><?php echo $notrx ?></strong></p>

					<h3>Informasi Pembayaran</h3>

					<p>
						<strong>Transfer pembayaran</strong>

Agar pesanan Anda diproses lebih cepat, segera transfer pembayaran setelah Anda menerima balasan SMS dr kami berupa rincian total harga, ongkos kirim & rek bank

Contoh balasan sms dari kami: Wisnu pradana 40 Nike tiempo ada stok, ongkir ke jogja 20rb, jadi total harga 210rb. Byr ke BCA 768-028-765-8 / Mandiri 133-001-764-9865

<br><br>
<strong>Konfirmasi pembayaran via SMS</strong>

Agar pesanan Anda bisa segera diproses untuk dikirim, segera konfirmasikan pembayaran Anda via SMS ke nomor yang sama waktu memesan: 0878.8056.2555 / 0877.7500.6500

Contoh konfirmasi pembayaran:
<br>
<em>Sudah di bayar 190rb dr BRI ke Mandiri a.n Wisnu pradana dengan no transaksi: 1234567</em>
<br>

Bila transfer memakai rekening orang lain, contoh konfirmasi: Sudah di bayar 190rb dr BRI ke Mandiri a.n David utk pesanan a.n Wisnu pradana
					</p>

					<?php } else { ?>

						<!-- user belum login -->
						<p>Mohon maaf anda harus <strong>login</strong> terlebih dahulu untuk dapat melanjutkan.</p>
						<p>Silahkan Login terlebih dahulu atau <strong>Register</strong> jika anda belum terdaftar sebagai member disitus ini.</p>

					<?php } ?>

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