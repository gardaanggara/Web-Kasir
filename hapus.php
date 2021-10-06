<?php

require 'koneksi.php';

		$id = $_GET['id'];
		$delete = mysqli_query($conn, "delete from barang where id_barang=$id");
		$deleteUser = mysqli_query($conn, "delete from user where id_user=$id");
		$tipe	= $_GET['tipe'];

if ($delete&&$tipe=='barang') {
	echo "<script>alert('Berhasil Dihapus');</script>";
	header("Location:barang.php");

	}else if ($deleteUser&&$tipe='user') {
		echo "<script>alert('Berhasil Dihapus');</script>";
		header("Location:pemilik-cucian.php");

		} else {
		echo "<script>alert('Gagal Dihapus');</script>";

	}



	?>