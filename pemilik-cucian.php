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


$lihat = mysqli_query($conn,"Select * From user where id_role=2");
$No = 1;

?>

<!DOCTYPE html>
<html>
<head>
		<title>List Data Kasir</title>
			<link rel="icon" type="image/png" href="img/mesincuci.png">
			<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
			<div class="container mt-3">
				<div class="row align-items-center mb-1">
					<div class="col-auto">
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
			<a href="pemilik-transaksi-cucian.php" class="btn btn-secondary">List Transaksi</a>
		</div>		
			<div class="col"><h1>Daftar Data Kasir</h1>
			</div>
</div>

	<form method="POST">
		<table class="table table-bordered">
			<tr>
				<td>No</td>
				<td>Id User</td>
				<td>Nama</td>
				<td>Username</td>
				<td>Password</td>
				<td>Aksi</td>
			</tr>

	<?php

		while($row = mysqli_fetch_array($lihat)) {     

        echo "<tr>";
        echo "<td>".$No++."</td>";
        echo "<td>".$row['id_user']."</td>";

        		//Untuk Update Nama

        	if (isset($_GET['id'])&&isset($_GET['ubah'])) {
        		
        		if ($_GET['id']==$row['id_user']&&$_GET['ubah']==true) {
        			echo "<td><input class=form-control type=text value=".$row['nama']." name=nama></td>";
		    		
		    		}else{
						echo "<td>".$row['nama']."</td>";			        		

				        }

		        	}else{
        				echo "<td>".$row['nama']."</td>";			        		
        				 }
        		
				//Untuk Update Username

        		if (isset($_GET['id'])&&isset($_GET['ubah'])) {
        		
        			if ($_GET['id']==$row['id_user']&&$_GET['ubah']==true) {
        				echo "<td><input class=form-control type=text value=".$row['username']." name=username></td>";
		    		
		    		}else{
						echo "<td>".$row['username']."</td>";			        		

		        }
        			}else{
        				echo "<td>".$row['username']."</td>";			        		
        	}

        		//Untuk Update Password
				if (isset($_GET['id'])&&isset($_GET['ubah'])) {
        		
        			if ($_GET['id']==$row['id_user']&&$_GET['ubah']==true) {
 		       			echo "<td><input class=form-control type=text value=".$row['password']." name=password></td>";
		    		
		    		}else{
						echo "<td>".$row['password']."</td>";			        		
		        	}
        			}else{
		        		echo "<td>".$row['password']."</td>";			        		
        	}        	

       			 if (isset($_GET['id'])&&isset($_GET['ubah'])) {
        		
	        				if ($_GET['id']==$row['id_user']&&$_GET['ubah']==true) {
	        					echo "<td><button class='btn btn-primary' name=simpan>Simpan</button> || <a class='btn btn-danger' name='batal' href='pemilik-cucian.php'>Batal</a></td>";
			    		
			    				}else{
									echo "<td><a class='btn btn-warning' href='pemilik-cucian.php?id=$row[id_user]&ubah=true'>Ubah</a> || <a class='btn btn-danger' name='delete' href='hapus.php?id=$row[id_user]&tipe=barang&tipe=user'>Hapus</a></td></tr>";      
			        				}
					        	}else{
        						echo "<td><a class='btn btn-warning' href='pemilik-cucian.php?id=$row[id_user]&ubah=true'>Ubah</a> || <a class='btn btn-danger' name='delete' href='hapus.php?id=$row[id_user]&tipe=barang&tipe=user'>Hapus</a></td></tr>";        
        					}
    		}
    			if (isset($_POST['simpan'])) {
    					$nama = $_POST['nama'];
    					$username = $_POST['username'];
    					$password = $_POST['password'];
    					$query = mysqli_query($conn, "update user set nama='$nama', username='$username', password='$password' where id_user=$_GET[id]");

		    		if ($query) {
    					echo "<script>alert('Data berhasil diubah!');</script>";
    					header("Location:pemilik-cucian.php");
    				
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