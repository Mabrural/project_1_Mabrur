<?php

$id_mhs = $_SESSION['id_mhs'];
$nama = $_SESSION["username"];

?>
        
      <div class="col-md-12 col-lg-12">
        <!-- <br> -->
        <div class="card-container mt-2 p-5 bg-body rounded">
          <center><img src="img/user.png" width="150px" height="150px"></center><br>
        <h4 class="text-center"><strong><?= $nama;?> </strong></h4>
       <center> 
       <!-- <a href="" data-bs-toggle="modal" data-bs-target="#exampleModal2" class="btn btn-primary"><i class="fas fa-edit"></i> Ubah Profil</a> -->
       </center>

       <!-- Modal -->
        
        <hr>
				
        <br>
      <?php
         $no=1;
         $profil = "SELECT * FROM mahasiswa WHERE id_mhs=$id_mhs";
         $tampil = mysqli_query($koneksi, $profil);
         while($data = mysqli_fetch_assoc($tampil)){

         
      ?>
				<div class="card-body tab table-responsive" style="height: 370px;">
					<h5>Informasi Pribadi</h5><hr>
          <h6>Nama Lengkap:</h6>
          <p><?= $data['nama_mhs'] ?></p>

          <h6>Nama Pengguna:</h6>
          <p><?= $data['username'] ?></p>

          <h6>Email:</h6>
          <p><?= $data['email'] ?></p>

          <h6>Alamat</h6>
          <p><?= $data['alamat'] ?></p>

       <a href="?page=ubahProfil&id_mhs=<?= $data['id_mhs'];?>" data-bs-toggle="modal" data-bs-target="#ubahProfil<?= $no; ?>" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i> Ubah Profil</a>
      <form action="index.php?form=ubahProfil" method="post">
       <div class="modal fade" id="ubahProfil<?= $no; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
              <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Ubah Profil</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                
                  <div class="card-body">  
                  <input type="hidden" name="aksi" value="ubah">
				          <input type="hidden" name="id_mhs" value="<?= $data["id_mhs"];?>">
                      <div class="mb-3 card-title">
                          <label>Nama Lengkap</label>
                          <input type="text" class="form-control" id="nama_mhs" name="nama_mhs" value="<?= $data["nama_mhs"];?>" required>
                      </div>
                      <div class="mb-3 card-title">
                          <label>Nama Pengguna</label>
                          <input type="text" class="form-control" id="username" name="username" value="<?= $data["username"];?>" required>
                      </div>
                      
                      <div class="mb-3 card-title">
                          <label>Kata Sandi Baru</label>
                          <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan Kata Sandi Baru" required>
                      </div>
                      <div class="mb-3 card-title">
                          <label>No. HP</label>
                          <input type="text" class="form-control" id="no_hp" name="no_hp" value="<?= $data["no_hp"];?>" required>
                      </div>
                      <div class="mb-3 card-title">
                          <label>Alamat</label>
                          <input type="text" class="form-control" id="alamat" name="alamat" value="<?= $data["alamat"];?>" required>
                      </div>
                      <div class="mb-3 card-title">
                          <label>Email</label>
                          <input type="email" class="form-control" id="email" name="email" value="<?= $data["email"];?>" required>
                      </div>
                   
                  
                  </div>
                
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary" data-bs-dismiss="modal" name="submit">Ubah</button>
              </div>
            </div>
          </div>
        </div>
        </form>     
				</div>
        <br><br>
        <?php } ?>
      </div><br><br>
      

      

