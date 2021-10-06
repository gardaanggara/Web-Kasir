<?php 
session_start();
include 'koneksi.php';

$profil_nama = "";
$profil = json_decode($_SESSION['Falgar']);
$profil_nama = $profil->nama;	
$lihat = mysqli_query($conn,"Select * From transaksi");
$No = 1;
?>

<!DOCTYPE html>
<html>
<head>
	<title>List Transaksi</title>
	<link rel="icon" type="image/png" href="img/mesincuci.png">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
<div class="container mt-3">
				<div class="row align-items-center mb-1">
				<div class="col-auto">
					<a href="pemilik-cucian.php" type="button" class="btn btn-warning">Kembali</a>
				</div>
		
				<div class="col">
		
				</div>

					<div class="col-auto">
					<div class="text-center">
						<img src="img/admin.png" width="50px" height="50px">
			
						<div class="mt-1">
							<?php
								echo "Selamat Datang ".$profil_nama;
							?>
						</div>
					</div>
					<form method="POST">
					<button name="keluar" class="btn btn-danger">Keluar</button></div>
				</div>
				<div class="row align-items-center mb-3">
		</div>

<div class="row align-items-center mb-3">
		<div class="col-auto">
			<a href="pemilik-transaksi-cucian.php" class="btn btn-secondary">List Transaksi</a>
		</div>
		<div class="col"><h1>List Transaksi</h1></div>
		</div>
	<form method="POST">
	<table class="table table-bordered">
		<tr>
			<td>No</td>
			<td>Id Barang</td>
			<td>Kode Transaksi</td>
			<td>Total Bayar</td>
			<td>Tanggal Bayar</td>
			<td>Diubah Pada</td>
			<td>Aksi</td> 
		</tr>
<?php

while($row = mysqli_fetch_array($lihat)) {     

        echo "<tr>";
        echo "<td>".$No++."</td>";
        echo "<td>".$row['id_barang']."</td>";
        echo "<td>".$row['kode_transaksi']."</td>";

        //Untuk Update 
				if (isset($_GET['id'])&&isset($_GET['ubah'])) {
        		
        			if ($_GET['id']==$row['id_transaksi']&&$_GET['ubah']==true) {
        			echo "<td><input class=form-control type=text value=".$row['total_bayar']." name=total_bayar></td>";
		    		
		    		}else{
					echo "<td>".$row['total_bayar']."</td>";			        		

		        }
        	}else{
        		echo "<td>".$row['total_bayar']."</td>";			        		
        	}    
        echo "<td>".$row['tanggal']."</td>";
        echo "<td>".$row['updated_at']."</td>";

        //Untuk Button
       			  if (isset($_GET['id'])&&isset($_GET['ubah'])) {
        		
        					if ($_GET['id']==$row['id_transaksi']&&$_GET['ubah']==true) {
        					echo "<td><button class='btn btn-primary' name=simpan>Simpan</button> || <a class='btn btn-danger' name='batal' href='pemilik-transaksi-cucian.php'>Batal</a></td>";
		    		
		    				}else{
							echo "<td><a class='btn btn-warning' href='pemilik-transaksi-cucian.php?id=$row[id_transaksi]&ubah=true'>Ubah</a></td></tr>";        

		        		}
				        	}else{
        					echo "<td><a class='btn btn-warning' href='pemilik-transaksi-cucian.php?id=$row[id_transaksi]&ubah=true'>Ubah</a></td></tr>";        
        	}

    }

    	//Untuk Ubah Data
		    if (isset($_POST['simpan'])) {
    					$total_bayar = $_POST['total_bayar'];
    					$query = mysqli_query($conn, "update transaksi set total_bayar='$total_bayar' where id_transaksi=$_GET[id]");

		    		if ($query) {
    					echo "<script>alert('Data berhasil diubah!');</script>";
    					header("Location:pemilik-transaksi-cucian.php");
    				
    						}else{
    							echo "<script>alert('Data gagal diubah!');</script>";
    				}

    		}
    ?>
	</table>
	<?php

   		 if (isset($_POST['keluar'])) {
  			session_destroy();
  			header("Location:login-kasir.php");
    		}

    ?>

	</form>
</div>
</body>
</html>