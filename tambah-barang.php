<?php

session_start();
require 'koneksi.php';

$profil_nama = "";
$profil = json_decode($_SESSION['Falgar']);
$profil_nama = $profil->nama;	
$lihat = mysqli_query($conn,"Select * From barang");
$No = 1;
?>

<!DOCTYPE html>
<html>
<head>
	<title>Tambah Barang</title>
	<link rel="icon" type="image/png" href="img/mesincuci.png">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
	<div class="container mt-3">

		<div class="row align-items-center mb-3">
				<div class="col-auto">
					<a href="barang.php" type="button" class="btn btn-warning">Kembali</a>
				</div>
		
				<div class="col">
		
				</div>

					<div class="col-auto">
					<div class="text-center">
						<img src="img/admin.png" width="50px" height="50px">
			
						<div class="mt-1">
							<?php
								echo "Selamat Datang ".$profil_nama ;
						 	?>
						</div>
					</div>
					<form method="POST">
					<button name="keluar" class="btn btn-danger">Keluar</button>
				</form>
				</div>
				</div>

				<div class="row align-items-center mb-1">
				<div class="col">
					<h1>Tambah Cucian</h1>
				</div>
		</div>


<form class="mb-5" method="POST" action="tambah-barang.php" id="formtambah">
  <div class="mb-2">
    <label for="nama" class="form-label">Nama Barang</label>
    <input type="text" class="form-control" id="namaweb" name="nama">
  	</div>
  <div class="mb-2">
    <label for="jumlah" class="form-label">Jumlah (kg)</label>
    <input type="number" class="form-control" id="jumlahweb" name="jumlah">
  	</div>
  <div class="mb-2">
    <label for="harga" class="form-label">Harga</label>
    <input type="number" class="form-control" id="hargaweb" name="harga">
  	</div>
  <button type="submit" class="btn btn-primary" name="Tambah">Tambah</button>

</form>

<?php

	if (isset($_POST['Tambah'])) {
		$nama = $_POST['nama'];
		$harga = $_POST['harga'];
		$jumlah = $_POST['jumlah'];
		$tambah = mysqli_query($conn, "insert into barang(nama,harga,jumlah) values ('$nama', '$harga', '$jumlah')");
		
	if (!$tambah){
		echo "<script>alert('Gagal di tambahkan!');</script>";
	} else{

		echo "<script>alert('Data berhasil di tambahkan!');history.go(-1);</script>";
		header("Location:tambah-barang.php");		
			
		}

	}


?>

<div class="row align-items-center mb-3">
		<div class="col"><h1>List Barang</h1></div>
		</div>
<table class="table table-bordered">
		<tr>
			<td>No</td>
			<td>Id Barang</td>
			<td>Nama Barang</td>
			<td>Harga</td>
			<td>Jumlah (kg)</td>
		</tr>
<?php

while($row = mysqli_fetch_array($lihat)) {     

        echo "<tr>";
        echo "<td>".$No++."</td>";
        echo "<td>".$row['id_barang']."</td>";
        echo "<td>".$row['nama']."</td>";
        echo "<td>".$row['harga']."</td>";
        echo "<td>".$row['jumlah']."</td>";
    }
    ?>
	</table>

 <?php

   		 if (isset($_POST['keluar'])) {
  			session_destroy();
  			header("Location:login-kasir.php");
    		}

    ?>

</body>
</html>