<?php

	/*
	 *	@file: produk-tambah_sc.php
	 *  @desc: Ajax request script untuk menambah data produk ke db
	 **/

	session_start();

	# load helper fn. untuk fungsi bantuan
	require_once('../../inc/helper/fn_helper.php');
	# load helper fn. untuk koneksi db
    require_once('../../inc/helper/fn_dbc.php');

	# cek login
	fnLoginCheck() or fnRedirect('../');


	# proses image upload

	if (!isset($_FILES['iflFoto']))
		exit('No Image Uploaded!');

	// file upload config
	$acc_exts = array('jpg', 'jpeg', 'bmp', 'gif', 'png');
	$acc_mime = array('image/jpeg', 'image/pjpeg', 'image/gif', 'image/png');
	$acc_size = 1000000;

	$fname_arr = explode('.', $_FILES['iflFoto']['name']);
	$fext = end($fname_arr);

	$upload_dir   = '../../images/uploads/';
	$upload_fname = $_POST['itxtNama'] . '_' . $_POST['iselKategori'] . '-' . $_POST['itxtKode'] . '.' . $fext;
	$upload_file  = $upload_dir . $upload_fname;

	// validasi upload
	if (($_FILES['iflFoto']['size'] < $acc_size) && (in_array($_FILES['iflFoto']['type'], $acc_mime)) && (in_array($fext, $acc_exts))) {
		// check if error occur
		if ($_FILES['iflFoto']['error'] > 0)
			exit("[ERROR] Uploading file: {$_FILES['iflFoto']['error']}");

		// file already exists check
		if (file_exists($upload_file))
			exit("[ERROR] Image file already exists ({$upload_fname}. [kode produk ganda])");

		// move uploaded file
		if (!move_uploaded_file($_FILES['iflFoto']['tmp_name'], $upload_file))
			exit("[ERROR] Can't move uploaded file to: {$upload_file}");
	}


	# proses tambah produk

	// ambil variabel post
	$id_kategori = $_POST['iselKategori'];
	$kode  = $_POST['itxtKode'];
	$nama  = $_POST['itxtNama'];
	$harga = $_POST['itxtHarga'];

	// buka koneksi db
	$dbc = NULL;
	fnOpenDB($dbc);

	// prepare insert
	$stmt = $dbc->prepare("INSERT INTO produk VALUES(NULL, ?, ?, ?, ?, ?, now(), NULL)");
	$stmt->bind_param('issds', $id_kategori, $kode, $nama, $harga, $upload_fname);
	$stmt->execute();

	// $result = $stmt->get_result();
	if ($dbc->affected_rows == 1)
		echo "1";
	else
		echo "0";

	// tutup koneksi db
	$stmt->close();
	fnCloseDB($dbc);

	// sukses -- redirect
	header("Location: ../produk.php?add=1");
	die();

 ?>