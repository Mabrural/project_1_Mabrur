<?php 
session_start();

if (!isset($_SESSION["login"])) {
	header("Location: login.php");
	exit;
}
	
	include "koneksi.php";
	$id_mhs = $_SESSION["id_mhs"];
	$kategori = query("SELECT * FROM kategori");
	$anggaran = query("SELECT * FROM anggaran WHERE anggaran.id_mhs=$id_mhs");

	$nama = $_SESSION["username"];
	
 ?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Budget Buddy</title>
	<link rel="icon" type="image/png" href="img/LOGO_Prod_TRPL_Variant_09_Square Color.png">
	<link rel="stylesheet" href="css/bootstrap.min.css">
   	<link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="font-awesome/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.0/dist/sweetalert2.min.css">

	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

	<!-- datatables -->
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">

</head>
<body>
	<!-- dataTables -->
	<script type="text/javascript" src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>


	<!-- bootstrap js repository offline -->
    <script src="js/bootstrap.bundle.min.js"></script>

	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
	
<nav class="navbar navbar-expand-lg bg-primary navbar-dark fixed-top shadow-sm ">
  <div class="container col-md-12 ml-0 ">
    <a class="navbar-brand" href="#" style="font-family: cambria; font-size: 28px;">BUDGET BUDDY</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav navbar-text ms-auto">
			<p class="dropdown-item text-white pt-2">Halo, <?= $nama;?></p>
	  	<li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle"  href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="fas fa-regular fa-circle-user fa-lg"></i> Saya
          </a>
          <ul class="dropdown-menu bg-light">
            <li><a class="dropdown-item text-black" href="?page=profil"><i class="fas fa-user-pen fa-sm"></i> Profil</a></li>
            <li><a class="dropdown-item text-black" href="logout.php"><i class="fas fa-right-to-bracket"></i> Keluar</a></li>
          </ul>
        </li>
		<!-- <li class="nav-item">
          <a class="nav-link" style="color: white;" href="#" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="fas fa-bell fa-lg"></i></a>
        </li>	 -->
                
        <!-- <form class="d-flex" role="search">
	        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
	        <button class="btn btn-outline-dark" type="submit">Search</button>
	     </form> -->
        
      </ul>
    </div>
  </div>
</nav>

<!-- Modal Notifikasi -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header">
		<h1 class="modal-title fs-5" id="exampleModalLabel">Notifikasi</h1>
		<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
		</div>
		<div class="modal-body">
		
		</div>
		<div class="modal-footer">
		<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
		</div>
	</div>
	</div>
</div>


<div class="row no-gutters mt-5">
	<div class="col-md-2 bg-dark mt-2 pr-3 pt-4">
		<ul class="nav flex-column ml-3 mb-4">
			<li class="nav-item">
				<img class="img-fluid rounded mx-auto d-block" src="img/LOGO_Prod_TRPL_Variant_09_Square Color.png" width="240" height="240">
			</li>
			<li class="nav-item">
				<a class="nav-link active text-white mx-2" href="index.php"><i class="fas fa-tachometer-alt fa-lg"></i> Menu Utama</a><hr style="color: white;">
			</li>
			<li class="nav-item">
				<a class="nav-link text-white mx-2" href="index.php?page=anggaran"><i class="fas fa-sitemap fa-lg"></i> Anggaran</a><hr style="color: white;">
			</li>
			<li class="nav-item">
				<a class="nav-link text-white mx-2" href="index.php?page=tagihan" ><i class="fas fa-money-bill-wave fa-lg"></i> Tagihan</a><hr style="color: white;">
			</li>
			<li class="nav-item">
				<a class="nav-link text-white mx-2" href="index.php?page=catatan" ><i class="fas fa-pen fa-lg"></i> Pencatatan Pengeluaran</a><hr style="color: white;">
			</li>
			<li class="nav-item">
				<a class="nav-link text-white mx-2" style="" href="index.php?page=laporan" ><i class="fas fa-solid fa-chart-bar fa-lg"></i> Laporan Keuangan</a><hr style="color: white;">
			</li>
		</ul><br><br><br><br><br><br><br><br><br>
	</div>

	<div class="col-md-10 p-5 pt-2"><br><br>
				<?php
                    if(isset($_GET['page'])){
                        $page = $_GET['page'];
                        switch ($page) {
                            case 'anggaran':
                                include "page/anggaran/anggaran.php";
                                break;
                         
                            case 'catatan':
                                include "page/catatan/catatan.php";
                                break;

                            case 'laporan':
                                include "page/laporan/laporan.php";
                                break;

                            case 'tagihan':
                                include "page/tagihan/tagihan.php";
                                break;
							
							case 'profil':
								include "page/profil/profil.php";
								break;

                            default:
                                echo "<center><h3>Maaf. Halaman tidak di temukan!</h3></center>";
                                break;
                        }
                    } else if(isset($_GET['form'])){
                        $form = $_GET['form'];

                        switch ($form) {
                            

                            case 'ubahAnggaran':
                                include "page/anggaran/ubah.php";
                                break;

                            case 'tambahAnggaran':
                                include "page/anggaran/tambah.php";
                                break;

                            case 'hapusAnggaran':
                                include "page/anggaran/hapus.php";
                                break;
								
							case 'cariAnggaran':
								include "page/anggaran/cari.php";
								break;

                            case 'ubahCatatan':
                                include "page/catatan/ubah.php";
                                break;
                            case 'tambahCatatan':
                                include "page/catatan/tambah.php";
                                break;
                            case 'hapusCatatan':
                                include "page/catatan/hapus.php";
                                break;
							case 'cariCatatan':
                                include "page/catatan/cari.php";
                                break;

                            case 'ubahTagihan':
                                include "page/tagihan/ubah.php";
                                break;
                            case 'tambahTagihan':
                                include "page/tagihan/tambah.php";
                                break;
                            case 'hapusTagihan':
                                include "page/tagihan/hapus.php";
                                break;

                            case 'ubahProfil':
                                include "page/profil/ubah.php";
                                break;
                        

                            default:
                                echo "<center><h3>Maaf. Halaman tidak di temukan!</h3></center>";
                                break;
                        }
                    }

                    else{
                        include "dashboard.php";
                    }
                ?>
	</div>
</div>



<!--Tambah Anggaran dengan modals -->
<form action="?form=tambahAnggaran" method="post">
	 <div class="modal fade" id="tambahAnggaran" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Data Anggaran</h1>
	        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
	      </div>
	      <div class="modal-body">
	        
			<div class="form-row">
				<div class="form-group col-md-12">
					<label >Nama Anggaran</label>
					<input type="text" name="nama_anggaran" class="form-control" id="nama_anggaran" required>
				</div>
			</div>
			<div class="form-row">
				<div class="form-group col-md-12">
					<label >Nominal</label>
					<input type="text" name="nominal" class="form-control" id="nominal" required>
				</div>
			</div>
			<div class="form-row">
				<div class="form-group col-md-12">
					<label >Tanggal Mulai</label>
					<input type="date" name="tgl_mulai" class="form-control" id="tgl_mulai" required>
				</div>
			</div>
			<div class="form-row">
				<div class="form-group col-md-12">
					<label >Tanggal Selesai</label>
					<input type="date" name="tgl_akhir" class="form-control" id="tgl_akhir" required>
				</div>
			</div><br>
		
	      </div>
	      <div class="modal-footer">
	        <button type="submit" class="btn btn-primary" data-bs-dismiss="modal" name="submit">Simpan</button>
	        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
	      </div>
	    </div>
	  </div>
	</div>
</form>
<!--Tambah Anggaran dengan modals -->

<!--Tambah Tagihan dengan modals -->
<form action="?form=tambahTagihan" method="post">
	 <div class="modal fade" id="tambahTagihan" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Data Tagihan</h1>
	        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
	      </div>
	      <div class="modal-body">
	        
			<div class="form-row">
				<div class="form-group col-md-12">
					<label >Nama Tagihan</label>
					<input type="text" name="nama_tagihan" class="form-control" id="nama_tagihan" required>
				</div>
			</div>
			<div class="form-row">
				<div class="form-group col-md-12">
					<label >Nominal</label>
					<input type="text" name="nominal" class="form-control" id="nominal" required>
				</div>
			</div>
			<div class="form-row">
				<div class="form-group col-md-12">
					<label >Tanggal Jatuh Tempo</label>
					<input type="date" name="tgl_due" class="form-control" id="tgl_due" required>
				</div>
			</div>
			<br>
		
	      </div>
	      <div class="modal-footer">
	        <button type="submit" class="btn btn-primary" data-bs-dismiss="modal" name="submit">Simpan</button>
	        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
	      </div>
	    </div>
	  </div>
	</div>
</form>
<!--Tambah Tagihan dengan modals -->

<!--Tambah Pencatatan Pengeluaran dengan modals -->
<form action="?form=tambahCatatan" method="post">
	 <div class="modal fade" id="tambahCatatan" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Data Pencatatan Pengeluaran</h1>
	        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
	      </div>
	      <div class="modal-body">
	        
			<div class="form-row">
				<div class="form-group col-md-12">
					<label >Tanggal Catatan</label>
					<input type="date" name="tgl_catatan" class="form-control" id="tgl_catatan" required>
				</div>
			</div>
			<div class="form-row">
				<div class="form-group col-md-12">
					<label >Nominal</label>
					<input type="text" name="nominal" class="form-control" id="nominal" required>
				</div>
			</div>
			<div class="form-row">
				<div class="form-group col-md-12">
					<label >Anggaran</label>
					<!-- <input type="text" name="bagian" class="form-control" id="bagian" required> -->
					<select class="form-select" aria-label="Default select example" name="id_anggaran" id="id_anggaran">
						<option value="">--Pilih--</option>
						<?php foreach($anggaran as $row) : ?>
                        <option value="<?= $row['id_anggaran'];?>"><?= $row['nama_anggaran']; ?></option>
                        <?php endforeach;?>
					</select>
				</div>
			</div>
			<div class="form-row">
				<div class="form-group col-md-12">
					<label >Kategori</label>
					<select class="form-select" aria-label="Default select example" name="id_kategori" id="id_kategori">
						<option value="">--Pilih--</option>
						<?php foreach($kategori as $row) : ?>
                        <option value="<?= $row['id_kategori'];?>"><?= $row['nama_kategori']; ?></option>
                        <?php endforeach;?>
					</select>
				</div>
			</div>
			<div class="form-row">
				<div class="form-group col-md-12">
					<label >Keterangan</label>
					<input type="text" name="keterangan" class="form-control" id="keterangan" required>
				</div>
			</div>
			<br>
		
	      </div>
	      <div class="modal-footer">
	        <button type="submit" class="btn btn-primary" data-bs-dismiss="modal" name="submit">Simpan</button>
	        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
	      </div>
	    </div>
	  </div>
	</div>
</form>
<!--Tambah Pencatatan Pengeluaran dengan modals -->

<!--Tambah Jadwal dengan modals -->
<form action="?form=tambahJadwal" method="post">
	 <div class="modal fade" id="tambahJadwal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Data Jadwal Matakuliah</h1>
	        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
	      </div>
	      <div class="modal-body">
	        
			<div class="form-row">
				<div class="form-group col-md-12">
					<label >MATA KULIAH</label>
					<input type="text" name="matkul" class="form-control" id="matkul" required>
				</div>
			</div>
			<div class="form-row">
				<div class="form-group col-md-12">
					<label >HARI</label>
					<select class="form-select" name="hari">
						<option value="">--Pilih Hari--</option>
						<option>Senin</option>
						<option>Selasa</option>
						<option>Rabu</option>
						<option>Kamis</option>
						<option>Jum'at</option>
						<option>Sabtu</option>
						
					</select>
				</div>
			</div>
			<div class="form-row">
				<div class="form-group col-md-12">
					<label >JAM</label>
					<input type="time" name="jam" class="form-control" id="jam" required>
				</div>
			</div>
			<br>
		
	      </div>
	      <div class="modal-footer">
	        <button type="submit" class="btn btn-primary" data-bs-dismiss="modal" name="submit">Simpan</button>
	        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
	      </div>
	    </div>
	  </div>
	</div>
</form>
<!--Tambah Jadwal dengan modals -->



<footer class="py-3 my-0 pt-4 pb-2 fixed-bottom bg-dark">
    <p class="text-center" style="color: white; font-size: 9pt;">© 2023 Budget Buddy - Teknologi Rekayasa Perangkat Lunak</p>
</footer>

	<!-- <script type="text/javascript" src="https://code.jquery.com/jquery-3.7.0.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
	<script type="text/javascript">
		new DataTable('#example');
	</script> -->

</body>
</html>