<?php
    session_start();
    # load helper fn. untuk koneksi db
    require_once('inc/helper/fn_dbc.php');
    # load helper fn. untuk fungsi bantuan
    require_once('inc/helper/fn_helper.php');
 ?>
<!doctype html>
<html>
<head>
<title>Beranda</title>
<link rel="stylesheet" type="text/css" href="css/app/style.css">
<link rel="stylesheet" type="text/css" href="css/bpopup.style.min.css">
<script src="js/jquery.min.js"></script>
<script src="js/jquery.bpopup.min.js"></script>
<script src="js/app/produkpopup.js"></script>
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
				<div class="clear"></div>
				<div id ="produkbaru">
					<h2 style="text-align:left">Daftar Produk</h2>

					<?php
						# ambil data produk di db

						// buka koneksi db
						$dbc = NULL;
						fnOpenDB($dbc);

						//$sql = "SELECT * FROM produk ORDER BY tgl DESC LIMIT 6";
						$sql = "SELECT produk.*, kategori.nama AS kat_nama FROM produk INNER JOIN kategori ON produk.kategori_id = kategori.id ORDER BY tgl DESC";
						if ($result = $dbc->query($sql)):
							while ($row = $result->fetch_assoc()):
					 ?>

					<div class="imgproduk">
						<img src="images/uploads/<?php echo $row['gambar']; ?>" class="img-thumbnail" alt="<?php echo fnEscape($rowp['nama']) ?>">
						<p style="font-style:normal;font-size: 16px;"><?php echo fnEscape($row['kat_nama']) . ' ' . fnEscape($row['nama']) . '<br>Rp. ' . fnEscape($row['harga']) ?></p>
						<p style="visibility:hidden"><?php echo fnEscape($row['id']) ?></p>
					</div>

					<?php
							endwhile;
						endif;

						// tutup koneksi db
						$result->close();
						fnCloseDB($dbc);
					?>

				</div>
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
		<div id="popup">
			<h2>Detail Produk</h2>
			<div class="left">
                <img src="" alt="" class="img-thumbnail produkImg">
            </div>
            <div class="right">
                <h4>Nama Produk : </h4>
			    <p class="nama-produk"></p>

               <h4>Size : </h4>
			    <form id="submitCart" action="addtocart.php" method="post">
                    <select name="size" id="">
                        <option value="38">38</option>
                        <option value="39">39</option>
                        <option value="40">40</option>
                        <option value="41">41</option>
                        <option value="42">42</option>
                    </select>

                <!-- <h4>Kuantitas : </h4>
                    <select name="kuantitas" id="">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                    </select> -->
                    <input type="hidden" name="id-produk" id="id-produk">
                    <p><input type="submit" value="Beli Produk" style="float:right"></p>
                </form>
            </div>
			<span class="button b-close"><span>X</span></span>
		</div>
	</div> <!-- end container -->
</body>
</html>