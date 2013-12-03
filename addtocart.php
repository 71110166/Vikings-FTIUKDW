<?php

	session_start();

	# load helper fn. untuk fungsi bantuan
    require_once('inc/helper/fn_helper.php');
    require_once('inc/helper/functions.php');

	# add to cart

	// ambil variabel
	$id = $_POST['id-produk'];
	$size = $_POST['size'];

	// isi session keranjang
	addtocart($id, 1, $size);

	// redirect
	fnRedirect('index.php');

 ?>