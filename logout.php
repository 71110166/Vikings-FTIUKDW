<?php
	# logout script
	session_start();

	// delete logged session variabel
	if (isset($_SESSION['logged']))
		unset($_SESSION['logged']);

	// reset session
	session_destroy();

	// redirect
	header("Location: index.php");
	die();
 ?>