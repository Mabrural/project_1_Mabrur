<?php

$id_mhs = $_SESSION["id_mhs"];

?>

<div class="col-md-12 col-lg-12 ">  
	<div class="table table-responsive">
		<h2 class="text-right" style="float: right; font-size: 25px;">Data Tagihan</h2>
		<a href="?page=tambahTagihan" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#tambahTagihan"><i class="fas fa-plus fa-sm"></i> Tambah</a> <br><br>
		<form class="d-flex col-lg-4 col-md-4 col-sm-12" role="search" action="?page=tagihan" method="POST">
			<input class="form-control me-2" type="search" autofocus placeholder="Pencarian" aria-label="Search" autocomplete="off" name="cari" value="<?php if(isset($_POST['cari'])) { echo $_POST['cari'];}?>">
			<button class="btn btn-outline-dark bg-dark" type="submit"><i class="fa-solid fa-magnifying-glass bg-dark text-white fa-sm"></i></button>
		</form>
      <br>
      <table class="table table-striped table-bordered table-hover">
				<thead>
					<tr>
						<th scope="col">No</th>
						<th scope="col">Nama Tagihan</th>
						<th scope="col">Nominal</th>
						<th scope="col">Tanggal Jatuh Tempo</th>
						<th colspan="3" scope="col">Aksi</th>
					</tr>
				</thead>
				
					<?php 

						if(isset($_POST['cari'])){
							$pencarian = $_POST['cari'];
							$query = "SELECT * FROM tagihan WHERE tagihan.id_mhs=$id_mhs AND nama_tagihan LIKE '%".$pencarian."%'";
						} else{
							$query = "SELECT * FROM tagihan WHERE tagihan.id_mhs=$id_mhs";
						}

						// $query = mysqli_query($koneksi, "SELECT * FROM tagihan WHERE tagihan.id_mhs=$id_mhs");
						$no = 1;
						$total = 0;
						$tampil = mysqli_query($koneksi, $query);
						while($data = mysqli_fetch_assoc($tampil)) {
						$nominal = $data['nominal'];
						$total += $nominal;
					?>
				<tr class="tagihan-row" data-nama-tagihan="<?= $data['nama_tagihan'] ?>" data-tgl-due="<?= $data['tgl_due'] ?>">
					<td><?= $no++; ?></td>
					<td><?= $data['nama_tagihan']; ?></td>
					<td><?= "Rp. ".number_format("$nominal", 2, ",", "."); ?></td>
					<td><?= date('d-m-Y', strtotime($data['tgl_due'])); ?></td>
					<td>
						<i class="fas fa-edit bg-warning p-2 text-white rounded"></i>
						<a href="?page=ubahTagihan&id_tagihan=<?= $data['id_tagihan'];?>" data-bs-toggle="modal" data-bs-target="#ubahTagihan<?= $no; ?>">Ubah</a>
						<i class="fas fa-trash-alt bg-danger p-2 text-white rounded"></i>
						<a href="?form=hapusTagihan&id_tagihan=<?= $data['id_tagihan'];?>" data-bs-toggle="modal" data-bs-target="#hapusTagihan<?= $no; ?>">Hapus</a>
					</td>
				</tr>

<!-- Ubah dengan Modals -->
<form action="index.php?form=ubahTagihan" method="post">
	<div class="modal fade" id="ubahTagihan<?= $no; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h1 class="modal-title fs-5" id="exampleModalLabel">Ubah Data Tagihan</h1>
	        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
	      </div>
	      <div class="modal-body">
	        
			<div class="form-row">
				<input type="hidden" name="aksi" value="ubah">
				<input type="hidden" name="id_tagihan" value="<?= $data["id_tagihan"];?>">
				<div class="form-group col-md-12">
					<label >Nama Anggaran</label>
					<input type="text" name="nama_tagihan" class="form-control" id="nama_tagihan" value="<?= $data["nama_tagihan"];?>">
				</div>
			</div>
			<div class="form-row">
				<div class="form-group col-md-12">
					<label >Nominal</label>
					<input type="text" name="nominal" class="form-control" id="nominal" value="<?= $data["nominal"];?>" required>
				</div>
			</div>
			<div class="form-row">
				<div class="form-group col-md-12">
					<label >Tanggal Jatuh Tempo</label>
					<input type="date" name="tgl_due" class="form-control" id="tgl_mulai" value="<?= $data["tgl_due"];?>" required>
				</div>
			</div>
			<br>
		
	      </div>
	      <div class="modal-footer">
	        <button type="submit" class="btn btn-primary" data-bs-dismiss="modal" name="submit">Ubah</button>
	        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
	      </div>
	    </div>
	</div>
	</div>
</form>
<!-- Ubah dengan Modals -->

<!-- hapus dengan modals -->
<form action="index.php?form=hapusTagihan" method="post">
	 <div class="modal fade" id="hapusTagihan<?= $no; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog modal-dialog-centered">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h1 class="modal-title fs-5" id="exampleModalLabel">Konfirmasi Hapus Data</h1>
	        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
	      </div>
	      <div class="modal-body" align="center">

	        <h5 align="center">Apakah anda yakin ingin menghapus? </h5>
	        <input type="hidden" name="id_tagihan" value="<?= $data['id_tagihan'] ?>">
	        <span class="text-danger"><?= $data['nama_tagihan']?> - <?= "Rp. ".number_format("$nominal", 2, ",", ".");?></span><br><br>
	        <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i class="fa-solid fa-xmark"></i> Tidak</button>
	        <button type="submit" class="btn btn-primary" data-bs-dismiss="modal" name="submit"><i class="fa-solid fa-check"></i> Yakin</button>
	        
	      </div>

	    </div>
	  </div>
	</div>
</form>
<!-- hapus dengan modlas -->

				<?php 
					}
				 ?>

			</table>
			<h5 class="text-right" style="float: right; font-size: 18px; color: red;"> Total : <?= "Rp. ".number_format("$total", 2, ",", ".");?></h5>

	</div>
</div>


<script>
document.addEventListener('DOMContentLoaded', function () {
    var tagihanRows = document.querySelectorAll('.tagihan-row');

    tagihanRows.forEach(function (row) {
        var tglJatuhTempo = new Date(row.getAttribute('data-tgl-due')).getTime();
        var now = new Date().getTime();
        var timeDiff = tglJatuhTempo - now;

        // Tentukan batas waktu notifikasi (misalnya, 3 hari sebelum jatuh tempo)
        var notifThreshold = 3 * 24 * 60 * 60 * 1000;

        if (timeDiff < notifThreshold) {
            // Tampilkan notifikasi
            showNotification(row.getAttribute('data-nama-tagihan'), tglJatuhTempo);
        }
    });

    function showNotification(namaTagihan, tglJatuhTempo) {
        // Sesuaikan pesan notifikasi sesuai kebutuhan Anda
        var message = 'Tagihan ' + namaTagihan + ' akan jatuh tempo pada ' + new Date(tglJatuhTempo).toLocaleDateString();

        // Gunakan API notifikasi web untuk menampilkan notifikasi
        if ('Notification' in window) {
            Notification.requestPermission().then(function (permission) {
                if (permission === 'granted') {
                    var notification = new Notification('Notifikasi Tagihan', {
                        body: message
                    });
                }
            });
        }
    }
});
</script>








