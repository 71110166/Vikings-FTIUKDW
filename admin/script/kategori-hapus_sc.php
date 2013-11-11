<?php

	/*
	 *	@file: kategori-hapus_sc.php
	 *  @desc: Ajax request script untuk menghapus data kategori dalam db
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
	if (!isset($_POST['kategori_id']))
		exit('No Submit Data');

	// ambil variabel POST
	$id_kategori = $_POST['kategori_id'];

	// buka koneksi db
	$dbc = NULL;
	fnOpenDB($dbc);

	// hapus data kategori
	$stmt = $dbc->prepare("DELETE FROM kategori WHERE kategori.id = ?");
	$stmt->bind_param('i', $id_kategori);
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