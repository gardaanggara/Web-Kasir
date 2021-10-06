<?php 

session_start();
include 'koneksi.php';

$profil_nama = "";

if ($_SESSION['Falgar']!='null') {


	$profil = json_decode($_SESSION['Falgar']);
	$profil_nama = $profil->nama;					
}else{

	echo "<script>alert('Maaf kamu gabisa masuk^^');</script>";
	header("Location:login-kasir.php");
}


$lihat = mysqli_query($conn,"Select * From barang");
$No = 1;

?>

<!DOCTYPE html>
<html>
<head>
		<title>List Barang Cucian</title>
			<link rel="icon" type="image/png" href="img/mesincuci.png">
			<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
			<div class="container mt-3">
				<div class="row align-items-center mb-1">
					<div class="col-auto">
						<a href="index.php" type="button" class="btn btn-warning">Kembali</a>
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
					<button name="keluar" class="btn btn-danger">Keluar</button></form>
							
							</div>
				</div>


			<div class="row align-items-center mb-3">

			</div>

<div class="row align-items-center mb-3">
		<div class="col-auto">
			<a href="tambah-barang.php" class="btn btn-primary">Tambah Barang Cucian</a>
			<a href="list-transaksi.php" class="btn btn-secondary">List Transaksi</a>
		</div>		
			<div class="col"><h1>List Barang Cucian</h1>

			</div>
</div>

	<form method="POST">
		<table class="table table-bordered">
			<tr>
				<td>No</td>
				<td >Id Barang</td>
				<td>Nama Barang</td>
				<td>Harga</td>
				<td>Jumlah (kg)</td>
				<td>Aksi</td>
			</tr>

	<?php

		while($row = mysqli_fetch_array($lihat)) {     

        echo "<tr>";
        echo "<td>".$No++."</td>";
        echo "<td>".$row['id_barang']."</td>";

        		//Untuk Update Nama

        	if (isset($_GET['id'])&&isset($_GET['ubah'])) {
        		
        		if ($_GET['id']==$row['id_barang']&&$_GET['ubah']==true) {
        			echo "<td><input class=form-control type=text value=".$row['nama']." name=nama></td>";
		    		
		    		}else{
						echo "<td>".$row['nama']."</td>";			        		

				        }

		        	}else{
        				echo "<td>".$row['nama']."</td>";			        		
        				 }
        		
				//Untuk Update Harga

        		if (isset($_GET['id'])&&isset($_GET['ubah'])) {
        		
        			if ($_GET['id']==$row['id_barang']&&$_GET['ubah']==true) {
        				echo "<td><input class=form-control type=text value=".$row['harga']." name=harga></td>";
		    		
		    		}else{
						echo "<td>".$row['harga']."</td>";			        		

		        }
        			}else{
        				echo "<td>".$row['harga']."</td>";			        		
        	}

        		//Untuk Update Jumlah
				if (isset($_GET['id'])&&isset($_GET['ubah'])) {
        		
        			if ($_GET['id']==$row['id_barang']&&$_GET['ubah']==true) {
 		       			echo "<td><input class=form-control type=text value=".$row['jumlah']." name=jumlah></td>";
		    		
		    		}else{
						echo "<td>".$row['jumlah']."</td>";			        		
		        	}
        			}else{
		        		echo "<td>".$row['jumlah']."</td>";			        		
        	}        	

       			 if (isset($_GET['id'])&&isset($_GET['ubah'])) {
        		
        					if ($_GET['id']==$row['id_barang']&&$_GET['ubah']==true) {
        						echo "<td><button class='btn btn-primary' name=simpan>Simpan</button> || <a class='btn btn-danger' name='batal' href='barang.php'>Batal</a></td>";
		    		
		    				}else{
								echo "<td><a class='btn btn-warning' href='barang.php?id=$row[id_barang]&ubah=true'>Ubah</a> || <a class='btn btn-danger' name='delete' href='hapus.php?id=$row[id_barang]&tipe=barang'>Hapus</a> || <a class='btn btn-success' href='kasir.php?id=$row[id_barang]'>Bayar</a> </td></tr>";        

		        				}
				        	}else{
        						echo "<td><a class='btn btn-warning' href='barang.php?id=$row[id_barang]&ubah=true'>Ubah</a> || <a class='btn btn-danger' name='delete' href='hapus.php?id=$row[id_barang]&tipe=barang'>Hapus</a> || <a class='btn btn-success' href='kasir.php?id=$row[id_barang]'>Bayar</a> </td></tr>";        
        					}
    		}
    				if (isset($_POST['simpan'])) {
    					$nama = $_POST['nama'];
    					$harga = $_POST['harga'];
    					$jumlah = $_POST['jumlah'];
    					$query = mysqli_query($conn, "update barang set nama='$nama', harga='$harga', jumlah='$jumlah' where id_barang=$_GET[id]");

		    		if ($query) {
    					echo "<script>alert('Data berhasil diubah!');</script>";
    					header("Location:barang.php");
    				
    						}else{
    							echo "<script>alert('Data gagal diubah!');</script>";



    				}

    		}
    ?>

   <?php

   		 if (isset($_POST['keluar'])) {
  			session_destroy();
  			header("Location:login-kasir.php");
    		}

    ?>
 
	</table>
	</form>
</div>
</body>
</html>