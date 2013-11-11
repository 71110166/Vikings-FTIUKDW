<?php

	/*
	 *	@file: kategori-edit_sc.php
	 *  @desc: Ajax request script untuk mengupdate data kategori dalam db
	 **/

	session_start();

	# load helper fn. untuk fungsi bantuan
	require_once('../../inc/helper/fn_helper.php');
	# load helper fn. untuk koneksi db
    require_once('../../inc/helper/fn_dbc.php');

	# cek login
	fnLoginCheck() or fnRedirect('../');


	# proses call request

	// cek request
	if (!isset($_POST['itxtID']))
		exit('No Submit Data');

	// ambil variabel POST
	$id   = $_POST['itxtID'];
	$nama = $_POST['itxtNama'];
	$ket  = $_POST['itxtaKeterangan'];

	// buka koneksi db
	$dbc = NULL;
	fnOpenDB($dbc);

	// hapus data kategori
	$stmt = $dbc->prepare("UPDATE kategori SET nama = ?, keterangan = ? WHERE kategori.id = ?");
	$stmt->bind_param('ssi', $nama, $ket, $id);
	$stmt->execute();

	// cek terhapus
	if ($dbc->affected_rows == 1)
		echo '1';
	else
		echo '0';

	// tutup koneksi db
	$stmt->close();
	fnCloseDB($dbc);


 ?>