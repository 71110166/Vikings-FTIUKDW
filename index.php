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
				<!-- <div class="produklaris">
					<h2>Produk Terlaris</h2>
					<div class="imgproduk">
					<img src="images/adidas.png" width="100" height="100" title="Adidas" alt="Adidas"/>
					<p>Adidas predator</p>
					</div>
					<div class="imgproduk">
					<img src="images/nike.png" width="100" height="100" title="Nike" alt="Nike"/>
					<p>Nike T70</p>
					</div>
					<div class ="imgproduk">
					<img src="images/umbro.png" width="100" height="100" title="Umbro" alt="Umbro"/>
					<p>Umbro</p>
					</div>
					<div class="imgproduk">
					<img src="images/puma.png" width="100" height="100" title="Puma" alt="Puma"/>
					<p>Puma</p>
					</div>
					<div class="imgproduk">
					<img src="images/specs.png" width="100" height="100" title="Specs" alt="Specs"/>
					<p>Specs</p>
					</div>
				</div> -->
				<div class="clear"></div>
				<div id ="produkbaru">
					<h2>Produk Terbaru</h2>

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
						<p><?php echo fnEscape($row['kat_nama']) . ' ' . fnEscape($row['nama']) ?></p>
					</div>

					<?php
							endwhile;
						endif;

						// tutup koneksi db
						$result->close();
						fnCloseDB($dbc);
					?>

					<!-- <div class="imgproduk">
					<img src="images/adidas.png" width="100" height="100" title="Adidas" alt="Adidas"/>
					<p>Adidas predator</p>
					</div>
					<div class="imgproduk">
					<img src="images/nike.png" width="100" height="100" title="Nike" alt="Nike"/>
					<p>Nike T70</p>
					</div>
					<div class ="imgproduk">
					<img src="images/umbro.png" width="100" height="100" title="Umbro" alt="Umbro"/>
					<p>Umbro</p>
					</div>
					<div class="imgproduk">
					<img src="images/puma.png" width="100" height="100" title="Puma" alt="Puma"/>
					<p>Puma</p>
					</div>
					<div class="imgproduk">
					<img src="images/specs.png" width="100" height="100" title="Specs" alt="Specs"/>
					<p>Specs</p>
					</div> -->
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
			    <form id="submitCart" action="#">
                    <select name="size" id="">
                        <option value="1">38</option>
                        <option value="2">39</option>
                        <option value="3">40</option>
                        <option value="3">41</option>
                        <option value="3">42</option>
                    </select>
                </form>

                <h4>Kuantitas : </h4>
                <form id="submitCart" action="#">
                    <select name="kuantitas" id="">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                    </select>
                    <p><input type="submit" value="Add to Cart"></p>
                </form>
            </div>
			<span class="button b-close"><span>X</span></span>
		</div>
	</div> <!-- end container -->
</body>
</html>