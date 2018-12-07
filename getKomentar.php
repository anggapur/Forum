<?php
	require_once("koneksi.php");
	require_once("function.php");
	echo getAllComment($_GET['id_post'],"active");
?>	
