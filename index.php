<?php
	session_start();
	require 'koneksi.php';

	$profil_nama = "";
	$profil = json_decode($_SESSION['Falgar']);
	$profil_nama = $profil->nama;	

?>

<!DOCTYPE html>
<html>
<head>
	<title>Home Kasir</title>
	<link rel="icon" type="image/png" href="img/mesincuci.png">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>


	<body class="container">
				<div class="row align-items-center mb-3">
				
				<div class="col">		
				</div>

					<div class="col-auto">
						<div class="text-center">
						<img class="mt-2" src="img/admin.png" width="50px" height="50px">
							<div class="text-center">
							<?php
								echo "Selamat Datang ".$profil_nama ;
						 	?>
						 	</div>
					</div>		
				</div>

				

		<div class="text-center mt-5">
			<img src="img/kasir.png" width="250px" height="250px" border="4px">
			<h1 class="mt-3">Selamat Datang Kasir</h1>
			<div class="row justify-content-center" >
					
					<div class="col-auto">
					<a href="barang.php" class="btn btn-success">Mulai</a>
					</div>
					
						<div class="col-auto">
						<!-- Button trigger modal -->
						<a href="#" type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#exampleModal">
 						 Bantuan
						</a>

						<!-- Modal -->
					<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
					 	 <div class="modal-dialog">
 						   <div class="modal-content">
						      <div class="modal-header">
						      <h5 class="modal-title" id="exampleModalLabel">Informasi</h5>
     						   <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			      </div>
			      <div class="modal-body">
			        Kasir ini dapat digunakan dengan beberapa fitur:
			        <ol class="text-start">
				        <li>Mengelelola Pesanan</li>
				        <li>Mengelola Transaksi</li>
			    	</ol>
			      </div>

			      <div class="modal-footer">
			        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
			      </div>
    </div>
  </div>
</div>
						</div>
								<div class="col-auto">
									<form method="POST">
										<button name="keluar" class="btn btn-danger">Keluar
										</button>
									</form>
									</div>
			<p class= "mt-3"><i>"Kenyamanan anda adalah prioritas kami."</i></p>

			</div>		
		</div>

		<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>	

	<?php

    	if (isset($_POST['keluar'])) {
  			session_destroy();
  			header("Location:login-kasir.php");
    		}

    ?>

	</body>


</html>