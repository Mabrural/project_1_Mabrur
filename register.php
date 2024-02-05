<?php 
require 'koneksi.php';

if (isset($_POST['register']) ) {
	
	if(registrasi($_POST) > 0 ){

        echo '<link rel="stylesheet" href="./sweetalert2.min.css"></script>';
        echo '<script src="./sweetalert2.min.js"></script>';
        echo "<script>
        setTimeout(function () { 
            swal.fire({
                
                title               : 'Daftar Akun Berhasil',
                text                :  'User baru berhasil ditambahkan',
                //footer              :  '',
                icon                : 'success',
                timer               : 2000,
                showConfirmButton   : true
            });  
        },10);   setTimeout(function () {
            window.location.href = 'index.php'; //will redirect to your blog page (an ex: blog.html)
        }, 2000); //will call the function after 2 secs
        </script>";
            
		// echo "
		// 	<script>
		// 		alert('User baru berhasil ditambahkan!');
        //         document.location.href = 'login.php';
		// 	</script>

		// ";  

	} else {
		echo mysqli_error($koneksi);
	}

}

 ?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Budget Buddy</title>
    <!-- bootstrap css repository offline-->
	<link rel="icon" type="image/png" href="img/LOGO_Prod_TRPL_Variant_09_Square Color.png">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="font-awesome/css/all.min.css">

    <!-- untuk repository online -->
	<!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous"> -->
    
</head>

<body class="register">
    <!-- bootstrap js repository offline -->
    <script src="js/bootstrap.bundle.min.js"></script>
    <br>
    <div class="global-container">
        <div class="card daftar-form">
            <div class="card-body">
                <h2><center>Budget Buddy</center></h2>
            </div>
            <form action="" method="post">
            <div class="card-text">
            <div class="form-floating mb-2">
                <input type="text" class="form-control" id="nama" name="nama_mhs" placeholder="" required>
                <label for="nama">Nama Lengkap</label>
            </div>
            <div class="form-floating mb-2">
                <input type="text" class="form-control" id="username" name="username" placeholder="" required>
                <label for="username">Username</label>
            </div>
            <div class="form-floating mb-2">
                <input type="password" class="form-control" id="password" name="password" placeholder="" required>
                <label for="password">Password</label>
            </div>
            <div class="form-floating mb-2">
                <input type="password" class="form-control" id="password2" name="password2" placeholder="" required>
                <label for="password2">Konfirmasi Password</label>
            </div>
            <div class="form-floating mb-2">
                <input type="text" class="form-control" id="no_hp" name="no_hp" placeholder="" required>
                <label for="no_hp">No. HP</label>
            </div>
            <div class="form-floating mb-2">
                <input type="text" class="form-control" id="alamat" name="alamat" placeholder="" required>
                <label for="alamat">Alamat</label>
            </div>
            <div class="form-floating mb-2">
                <input type="email" class="form-control" id="email" name="email" placeholder="" required>
                <label for="email">Email</label>
            </div>
            
            </div>
            
            <div class="d-grid gap-2">
                <button class="btn btn-primary" type="submit" name="register">Daftar</button>
                <p>Sudah punya akun? <a href="login.php" style=""> Masuk</a></p>
            </div>
            
            
            </form>

        </div>


    </div>


    <br><br>
    
</body>

</html>