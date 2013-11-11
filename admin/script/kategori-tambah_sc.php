<?php

	/*
	 *	@file: kategori-tambah_sc.php
	 *  @desc: Ajax request script untuk menambah data kategori ke db
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
	if (!isset($_POST['itxtNamaKategori']))
		exit('No Submit Data');

	// ambil variabel POST
	$kategori_nama = $_POST['itxtNamaKategori'];
	$kategori_keterangan = $_POST['itxtaKeterangan'];

	// buka koneksi db
	$dbc = NULL;
	fnOpenDB($dbc);

	// insert data kategori
	($stmt = $dbc->prepare("INSERT INTO kategori VALUES(NULL, ?, ?)")) || exit("Failed to prepare statement: {$dbc->error}");
	$stmt->bind_param('ss', $kategori_nama, $kategori_keterangan) || exit("Failed to bind paramaters: {$stmt->error}");
	$stmt->execute() || exit("Failed to execute: {$stmt->error}");

	// $result = $stmt->get_result();
	if ($dbc->affected_rows == 1)
		echo "1";
	else
		echo "0";

	// tutup koneksi db
	$stmt->close();
	fnCloseDB($dbc);

	# cek jika bukan ajax call
	if (isset($_POST['submitted'])) {
		header("Location: ../kategori.php");
		die();
	}
 ?>