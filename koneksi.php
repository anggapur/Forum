<?php
	//Konneksi
	$koneksi  = mysqli_connect("localhost","root","","universitas");
	if(!$koneksi)
		echo "Gagal Koneksi ".mysqli_connect_error();
?>