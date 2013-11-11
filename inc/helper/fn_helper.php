<?php

/*
 *  @file: fn_helper.php
 *	@desc: Various user defined helper php function
 *
 **/

# Note:
# fungsi fnPasswordHash() dan fnPasswordCheck memerlukan phpass lib. (PasswordHash.php)
# include phpass lib. pada halaman sebelum menggunakan fungsi, ex: require_once('/inc/lib/PasswordHash.php')

// constants:
define('HCOST', 8);
define('HPORT', FALSE);


# @fndesc: fungsi untuk melakukan hash pada string (password) -- REQUIRED: PasswordHash.php
# @param:  string (password)
# @retval: [hash string jika sukses | FALSE jika gagal (hash < 20 karakter)]
function fnPasswordHash($str)
{
	$hasher = new PasswordHash(HCOST, HPORT);
	$hash = $hasher->HashPassword($str);

	unset($hasher);

	return (strlen($hash) < 20) ? FALSE : $hash;
}


# @fndesc: fungsi untuk melakukan kesamaan (match) antara string (password) dan hash -- REQUIRED: PasswordHash.php
# @param:  string (password), hash
# @retval: [TRUE jika match | FALSE jika tidak match]
function fnPasswordCheck($str, $hash)
{
	if (empty($hash))
		$hash = '*';

	$hasher = new PasswordHash(HCOST, HPORT);
	$match = $hasher->CheckPassword($str, $hash);

	unset($hasher);

	return $match;
}


# @fndesc: fungsi untuk mengambil script filename
# @param:  bool (dengan ext?)
# @retval: [TRUE jika match | FALSE jika tidak match]
function fnSelf($w_ext = FALSE)
{
	// return ($w_ext) ? basename(__FILE__) : basename(__FILE__, '.php');
	return ($w_ext) ? basename($_SERVER['PHP_SELF']) : basename($_SERVER['PHP_SELF'], '.php');
}


# @fndesc: fungsi untuk mengambil login credential (admin/member)
# @param:  none
# @retval: [TRUE jika match | FALSE jika tidak match]
function fnLoginCheck()
{
	return (isset($_SESSION['logged']) && !empty($_SESSION['logged_cred'])) ? $_SESSION['logged_cred'] : FALSE;
}


# @fndesc: fungsi untuk redirect page
# @param:  url
# @retval: FALSE
function fnRedirect($url = FALSE)
{
	if ($url) {
		header("Location: {$url}");
		die();
	}
	return FALSE;
}

# @fndesc: sanitize html string
# @param:  string
# @retval: string (sanitized string)
function fnEscape($str)
{
	return htmlspecialchars($str, ENT_QUOTES);
}
 ?>