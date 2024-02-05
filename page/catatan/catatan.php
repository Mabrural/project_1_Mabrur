<?php
$id_mhs = $_SESSION["id_mhs"];
?>

<div class="col-md-12 col-lg-12">
    <div class="table table-responsive">
        <h2 class="text-right" style="float: right; font-size: 25px;">Data Catatan Pengeluaran</h2>
        <a href="?page=tambahCatatan" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#tambahCatatan"><i class="fas fa-plus fa-sm"></i> Tambah</a>
        <br><br>
        <!-- Form Filter -->
        <form class="d-flex col-lg-4 col-md-12 col-sm-12" role="search" action="" method="POST">
            <!-- <input class="form-control me-2" type="search" autofocus autocomplete="off" placeholder="Pencarian" aria-label="Search" name="cari" value="<?php if(isset($_POST['cari'])) { echo $_POST['cari']; }?>"> -->
            <select class="form-select mx-2" name="filter_anggaran">
                <option value="">--Pilih Anggaran--</option>
                <?php
                // Ambil data anggaran dari database
                $result = mysqli_query($koneksi, "SELECT * FROM anggaran WHERE id_mhs=$id_mhs");
				
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<option value='" . $row['id_anggaran'] . "'>" . $row['nama_anggaran'] . "</option>";
                }
                ?>
            </select>
            <button class="btn btn-outline-dark bg-dark" type="submit"><i class="fa-solid fa-filter bg-dark text-white fa-sm"></i></button>
        </form><br>
        <!-- Akhir Form Filter -->

        <!-- Tabel Data -->
        <table class="table table-striped table-bordered table-hover">
            <!-- Bagian Head Tabel -->
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Tanggal Catatan</th>
                    <th scope="col">Nominal</th>
                    <th scope="col">Anggaran</th>
                    <th scope="col">Kategori</th>
                    <th scope="col">Keterangan</th>
                    <th colspan="3" scope="col">Aksi</th>
                </tr>
            </thead>

            <!-- Bagian Body Tabel -->
            <tr>
                <?php
                // Query sesuai dengan filter anggaran
                $filter_anggaran = isset($_POST['filter_anggaran']) ? $_POST['filter_anggaran'] : '';
                if (isset($_POST['cari'])) {
                    $pencarian = $_POST['cari'];
                    $query = "SELECT * FROM catatan_pengeluaran JOIN anggaran ON catatan_pengeluaran.id_anggaran = anggaran.id_anggaran JOIN kategori ON catatan_pengeluaran.id_kategori=kategori.id_kategori WHERE catatan_pengeluaran.id_kategori = kategori.id_kategori AND catatan_pengeluaran.id_anggaran = anggaran.id_anggaran AND catatan_pengeluaran.id_catatan AND catatan_pengeluaran.id_mhs=$id_mhs AND keterangan LIKE '%" . $pencarian . "%";
                } else {
                    $query = "SELECT * FROM catatan_pengeluaran JOIN anggaran ON catatan_pengeluaran.id_anggaran = anggaran.id_anggaran JOIN kategori ON catatan_pengeluaran.id_kategori=kategori.id_kategori WHERE catatan_pengeluaran.id_kategori = kategori.id_kategori AND catatan_pengeluaran.id_anggaran = anggaran.id_anggaran AND catatan_pengeluaran.id_catatan AND catatan_pengeluaran.id_mhs=$id_mhs";
                    if (!empty($filter_anggaran)) {
                        $query .= " AND anggaran.id_anggaran = $filter_anggaran";
                    }
                }

                $no = 1;
                $total = 0;
                $tampil = mysqli_query($koneksi, $query);
                while ($data = mysqli_fetch_assoc($tampil)) {
                    $nominal = $data['nominal_catatan'];
                    $total += $nominal;
                ?>
            </tr>
            <!-- Bagian isi Tabel -->
            <td><?= $no++; ?></td>
            <td><?= date('d-m-Y', strtotime($data['tgl_catatan'])); ?></td>
            <td><?= "Rp. " . number_format("$nominal", 2, ",", ".") ?></td>
            <td><?= $data['nama_anggaran']; ?></td>
            <td><?= $data['nama_kategori']; ?></td>
            <td><?= $data['keterangan']; ?></td>
            <td>
                <i class="fas fa-edit bg-warning p-2 text-white rounded"></i>
                <a href="?page=ubahCatatan&id_catatan=<?= $data['id_catatan'];?>" data-bs-toggle="modal" data-bs-target="#ubahCatatan<?= $no; ?>">Ubah</a>
                <i class="fas fa-trash-alt bg-danger p-2 text-white rounded"></i>
                <a href="?form=hapusCatatan&id_catatan=<?= $data['id_catatan'];?>" data-bs-toggle="modal" data-bs-target="#hapusCatatan<?= $no; ?>">Hapus</a>
            </td>
<!-- Ubah dengan Modals -->
<form action="index.php?form=ubahCatatan" method="post">
	<div class="modal fade" id="ubahCatatan<?= $no; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h1 class="modal-title fs-5" id="exampleModalLabel">Ubah Data Catatan Pengeluaran</h1>
	        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
	      </div>
	      <div class="modal-body">
	        
			<div class="form-row">
				<input type="hidden" name="aksi" value="ubah">
				<input type="hidden" name="id_catatan" value="<?= $data["id_catatan"];?>">
				<div class="form-group col-md-12">
					<label >Tanggal Catatan</label>
					<input type="date" name="tgl_catatan" class="form-control" id="tgl_catatan" value="<?= $data["tgl_catatan"];?>">
				</div>
			</div>
			<div class="form-row">
				<div class="form-group col-md-12">
					<label >Nominal</label>
					<input type="text" name="nominal_catatan" class="form-control" id="nominal_catatan" value="<?= $data["nominal_catatan"];?>" required>
				</div>
			</div>
			<div class="form-row">
				<div class="form-group col-md-12">
					<label >Anggaran</label>
					<select class="form-select" aria-label="Default select example" name="id_anggaran" id="id_anggaran">
						<option value="">--Pilih--</option>
						<?php foreach($anggaran as $row) : ?>
                        <option value="<?= $row['id_anggaran'];?>" <?= ($row['id_anggaran'] == $data['id_anggaran'])?'selected': ''; ?>><?= $row['nama_anggaran']; ?></option>
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
                        	<option value="<?= $row['id_kategori'];?>" <?= ($row['id_kategori'] == $data['id_kategori'])?'selected': ''; ?>><?= $row['nama_kategori']; ?></option>
                        <?php endforeach;?>
					</select>
				</div>
			</div>
			<div class="form-row">
				<div class="form-group col-md-12">
					<label >Keterangan</label>
					<input type="text" name="keterangan" class="form-control" id="keterangan" value="<?= $data["keterangan"];?>" required>
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
<form action="index.php?form=hapusCatatan" method="post">
	 <div class="modal fade" id="hapusCatatan<?= $no; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog modal-dialog-centered">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h1 class="modal-title fs-5" id="exampleModalLabel">Konfirmasi Hapus Data</h1>
	        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
	      </div>
	      <div class="modal-body" align="center">

	        <h5 align="center">Apakah anda yakin ingin menghapus? </h5>
	        <input type="hidden" name="id_catatan" value="<?= $data['id_catatan'] ?>">
	        <span class="text-danger"><?= date('d-m-Y', strtotime($data['tgl_catatan']));?> - <?= "Rp. ".number_format("$nominal", 2, ",", ".")?> - <?= $data['keterangan']?></span><br><br>
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
            </tr>
        </table>

        <!-- Total Pengeluaran -->
        <h5 class="text-right" style="float: right; font-size: 18px; color: red;"> Total : <?= "Rp. " . number_format("$total", 2, ",", "."); ?></h5>
    </div>
</div>
