<?php
	//Konneksi
	$koneksi  = mysqli_connect("localhost","root","","db_forum");
	if(!$koneksi)
		echo "Gagal Koneksi ".mysqli_connect_error();
?>