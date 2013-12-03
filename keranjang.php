<?php
    session_start();

    # load helper fn. untuk fungsi bantuan
    require_once('inc/helper/fn_helper.php');

    include("inc/helper/db.php");
	include("inc/helper/functions.php");

    if (isset($_REQUEST['command'])) {

        if($_REQUEST['command']=='delete' && $_REQUEST['pid']>0){
            remove_product($_REQUEST['pid']);
        }
        else if($_REQUEST['command']=='clear'){
            unset($_SESSION['cart']);
        }
        else if($_REQUEST['command']=='update'){
            $max=count($_SESSION['cart']);
            for($i=0;$i<$max;$i++){
                $pid=$_SESSION['cart'][$i]['productid'];
                $q=intval($_REQUEST['product'.$pid]);
                if($q>0 && $q<=999){
                    $_SESSION['cart'][$i]['qty']=$q;
                }
                else{
                    $msg='Some proudcts not updated!, quantity must be a number between 1 and 999';
                }
            }
        }

    }
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

					<form name="form1" method="post">
					<input type="hidden" name="pid" />
					<input type="hidden" name="command" />
						<div style="margin:60px auto; width:600px;" >
					    <div style="padding-bottom:10px">
					    	<h2 align="center">Keranjang Belanja Anda</h2>
					    <input type="button" value="Lanjutkan berbelanja" onclick="window.location='index.php'" />
					    </div>
					    	<div style="color:#F00"><?php echo isset($msg) ? $msg : '' ?></div>
					    	<table border="0" cellpadding="5px" cellspacing="1px" style="font-family:Verdana, Geneva, sans-serif; font-size:11px; background-color:#E1E1E1" width="700">
					    	<?php
								if(isset($_SESSION['cart']) && is_array($_SESSION['cart'])){
					            	echo '<tr bgcolor="#FFFFFF" style="font-weight:bold;text-align:center"><td style="width:100px">No</td><td style="width:200px">Nama Barang</td><td>Size</td><td style="width:100px">Harga</td><td>Qty</td><td style="width:100px">Total</td><td>Options</td></tr>';
									$max=count($_SESSION['cart']);
									for($i=0;$i<$max;$i++){
										$pid=$_SESSION['cart'][$i]['productid'];
										$q=$_SESSION['cart'][$i]['qty'];
										$s=$_SESSION['cart'][$i]['size'];
										$pname=get_product_name($pid);
										if($q==0) continue;
								?>
					            		<tr bgcolor="#FFFFFF"><td style="text-align:center"><?php echo $i+1?></td><td><?php echo $pname?></td>
					            		<td><?php echo $s ?></td>
					                    <td>Rp. <?php echo get_price($pid)?></td>
					                    <td style="text-align:center"><input type="text" name="product<?php echo $pid?>" value="<?php echo $q?>" maxlength="3" size="3" style="text-align:center" /></td>
					                    <td>Rp. <?php echo get_price($pid)*$q?></td>
					                    <td><a href="javascript:del(<?php echo $pid?>)">Remove</a></td></tr>
					            <?php
									}
								?>
									<tr><td><b>Order Total: Rp. <?php echo get_order_total()?></b></td><td colspan="5" align="right"><input type="button" value="Kosongkan Keranjang" onclick="clear_cart()"><input type="button" value="Update Keranjang" onclick="update_cart()"><input type="button" value="Akhiri berbelanja" onclick="window.location='billing.php'"></td></tr>
								<?php
					            }
								else{
									echo "<tr bgColor='#FFFFFF'><td>Keranjang anda saat ini kosong! Ayo buruan beli dan isi keranjang anda.</td>";
								}
							?>
					        </table>
					    </div>
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