<?php
session_start();
require 'koneksi.php';

$profil_nama = "";
$profil = json_decode($_SESSION['Falgar']);
$profil_nama = $profil->nama;	
$lihat = mysqli_query($conn,"Select * From barang where id_barang=$_GET[id]");
$No = 1;

$id="";
$nama="";
$harga="";
$jumlah="";

while($row = mysqli_fetch_array($lihat))
{
	$id = $row['id_barang'];
	$nama = $row['nama'];
	$harga = $row['harga'];
	$jumlah = $row['jumlah'];

}
?>


<!DOCTYPE html>
<html>
<head>
	<title>Kasir</title>
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
					</button>
					</div>
				</div>

				<div class="row align-items-center mb-1">
				<div class="col">
					<h1>Kasir</h1>
				</div>
		</div>



<form class="mb-5" method="POST" action="kasir.php?id=<?php echo $id; ?>" id="formkasir">
  <div class="mb-3">
    <label for="nama" class="form-label">Barang Cucian <span class="fw-bold ms-5"><?php echo $nama?></span></label>
  	</div>
  <div class="mb-3">
    <label for="jumlah" class="form-label">Jumlah (kg) <span class="fw-bold ms-5"><?php echo $jumlah?></label>
  	</div>
  <div class="mb-3">
    <label for="harga" class="form-label">Harga <span class="fw-bold ms-5"><?php echo $harga?></span></label>
  	</div>
  <div class="mb-3">
    <label for="bayar" class="form-label">Bayar</label>
    <input type="number" class="form-control" id="bayarweb" name="total_bayar" onchange="hitungkembalian()">
  	</div>
  <div class="mb-3">
    <label for="kembalian" class="form-label">Kembalian <span id="kembalian"></span></label>
  	</div>

  <input type="hidden" id="harga" value=<?php echo $harga?>>

  <button type="submit" class="btn btn-primary" name="Bayar" onclick="submit()">Bayar</button>

</form>

<?php

function generateRandomString($length = 11) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    	for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    	return $randomString;
	}


	if (isset($_POST['Bayar'])) {
		$total_bayar = $_POST['total_bayar'];
		$kode_transaksi = generateRandomString();
		$tambah = mysqli_query($conn, "insert into transaksi(id_barang, total_bayar,kode_transaksi) values ('$id', '$total_bayar', '$kode_transaksi')");
		
	if (!$tambah){
		echo "<script>alert('Gagal Dibayar!');</script>";

	} else{

		echo "<script>alert('Berhasil Dibayar!');history.go(-1);</script>";
		header("Location:barang.php");		
			
		}

	}


?>

<!-- <div class="row align-items-center mb-3">
		<div class="col"><h1>List Barang Cucian</h1></div>
		</div>
<table class="table table-bordered">
		<tr>
			<td>No</td>
			<td>Id Barang</td>
			<td>Nama Barang</td>
			<td>Harga</td>
			<td>Jumlah (kg)</td>
			<td>Kode Transaksi</td>
		</tr>
<?php

while($row = mysqli_fetch_array($lihat)) {     

        echo "<tr>";
        echo "<td>".$No++."</td>";
        echo "<td>".$row['id_barang']."</td>";
        echo "<td>".$row['nama']."</td>";
        echo "<td>".$row['harga']."</td>";
        echo "<td>".$row['jumlah']."</td>";
        echo "<td>".$row['kode_transaksi']."</td>";
    }
    ?>
	</table> -->
<script type="text/javascript">
	
	function hitungkembalian(){
		let bayar=document.getElementById("bayarweb").value
		let kembalian=0
		let harga = document.getElementById("harga").value
		kembalian = bayar - harga
		document.getElementById("kembalian").innerHTML=kembalian

	}
	function submit(){
		document.getElementById("formkasir").reset();
	}	

</script>

<?php

   		 if (isset($_POST['keluar'])) {
  			session_destroy();
  			header("Location:login-kasir.php");
    		}

    ?>
</body>
</html>