<?php
$conn = mysqli_connect("localhost", "root", "78789898", "budget");
$id_mhs = $_SESSION["id_mhs"];
?>

<div class="col-md-12 col-lg-12 ">
<!-- <h4 class="text-center">Laporan Keuangan</h4>
				<hr> -->
			  <h2 class="text-right" style="float: right; font-size: 25px;">Laporan Keuangan </h2>
        <br><br>
       
        <center><div id="piechart" style="width: 100%; max-width:700px; height: 500px; min-width: 100%; margin: auto;" class="col-lg-12 col-md-12 col-sm-12"></div></center>
        <!-- <center><canvas id="myChart" style="width:100%; max-width:700px min-width: 100px;" class="row-md-12"></canvas></center>  -->
       
       <br>
			<div class="row">    
        <form class="d-flex col-lg-4 col-md-12 col-sm-12" role="search" action="index.php" method="GET"><input type="hidden" name="page" value="laporan">
            
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
        </form>
          <div class="mx-2 mt-2">
            <a href="laporan/laporan_keuangan.php"><button class="btn btn-success btn-sm"><i class="fas fa-download fa-sm"></i> Ekspor ke PDF</button></a>
          </div>
       
				<div class="card-body tab table-responsive" style="height: 500px;">

					<table class="table table-hover table-responsive overflow-scroll">
					  <thead>
						<tr>
              <th scope="col">No</th>
              <th scope="col">Nama Kategori</th>
              <th scope="col">Jumlah Pengeluaran</th>
              <!-- <th scope="col">Aksi</th> -->
            </tr>
					  </thead>
            
            <?php
              // Tambahkan kondisi filter anggaran ke dalam query
              $filter_anggaran = isset($_GET['filter_anggaran']) ? $_GET['filter_anggaran'] : '';
              $query = "SELECT SUM(catatan_pengeluaran.nominal_catatan) as nominal_catatan, kategori.* FROM catatan_pengeluaran, kategori WHERE catatan_pengeluaran.id_mhs = $id_mhs AND catatan_pengeluaran.id_kategori=kategori.id_kategori 
              ";
              if (!empty($filter_anggaran)) {
                  // $query .= " AND catatan_pengeluaran.id_anggaran = $filter_anggaran";
                  $query = "SELECT SUM(catatan_pengeluaran.nominal_catatan) as nominal_catatan, kategori.* FROM catatan_pengeluaran, kategori WHERE catatan_pengeluaran.id_mhs = $id_mhs AND catatan_pengeluaran.id_kategori=kategori.id_kategori 
                  AND catatan_pengeluaran.id_anggaran=$filter_anggaran";
                  
              }
              $query .= " GROUP BY catatan_pengeluaran.id_kategori";

              
            

						  // $laporan = mysqli_query($koneksi, "SELECT * FROM catatan_pengeluaran JOIN anggaran ON catatan_pengeluaran.id_anggaran = anggaran.id_anggaran JOIN kategori ON catatan_pengeluaran.id_kategori=kategori.id_kategori WHERE catatan_pengeluaran.id_kategori = kategori.id_kategori AND catatan_pengeluaran.id_anggaran = anggaran.id_anggaran AND catatan_pengeluaran.id_catatan AND catatan_pengeluaran.id_mhs=$id_mhs GROUP BY catatan_pengeluaran.id_kategori");
              // $laporan = mysqli_query($koneksi, "SELECT SUM(catatan_pengeluaran.nominal_catatan) as nominal_catatan, kategori.* FROM catatan_pengeluaran, kategori WHERE catatan_pengeluaran.id_mhs = $id_mhs AND catatan_pengeluaran.id_kategori=kategori.id_kategori 
              // AND catatan_pengeluaran.id_anggaran=50 GROUP BY catatan_pengeluaran.id_kategori");
              $laporan = mysqli_query($koneksi, $query);
              

              $no = 1;
              $total = 0;
              while($data = mysqli_fetch_assoc($laporan)) {
                $nominal = $data['nominal_catatan'];
                // $nominal_anggaran = $data['nominal'];
                $total += $nominal;

            ?>

					  <tbody>
						<tr>
              <td><?= $no++;?></td>
              <td><?= $data['nama_kategori']?></td>
              <td><?= "Rp. ".number_format("$nominal", 2, ",", ".")?></td>
              <!-- <td>
                <a href="?page=laporan&id_kategori=<?= $data['id_kategori'];?>" data-bs-toggle="modal" data-bs-target="#detail">Detail</a>
              </td> -->
            </tr>

					  </tbody>
              <?php
                  }
                ?>
            <div class="row">
              <a style="text-align: right; float: right; color: red;"><strong>Total Pengeluaran : <?= "Rp. ".number_format("$total", 2, ",", ".")?></strong></a>        
              <!-- <a style="text-align: right; float: right; color: green; margin-right:15px;"><strong>Total Anggaran : <?= "Rp. ".number_format("$total", 2, ",", ".")?></strong></a>   -->
            </div>
					</table>
          <!-- <nav aria-label="Page navigation example" style="margin-left: 170px;">
            <ul class="pagination">
              <li class="page-item">
                <a class="page-link" href="#" aria-label="Previous">
                  <span aria-hidden="true">&laquo;</span>
                </a>
              </li>
              <li class="page-item"><a class="page-link" href="#">1</a></li>
              <li class="page-item"><a class="page-link" href="#">2</a></li>
              <li class="page-item"><a class="page-link" href="#">3</a></li>
              <li class="page-item">
                <a class="page-link" href="#" aria-label="Next">
                  <span aria-hidden="true">&raquo;</span>
                </a>
              </li>
            </ul>
          </nav> -->
				</div>
        
</div>

<!-- Modal Detail -->
<div class="modal fade" id="detail" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Detail <?= $data['nama_kategori'];?></h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <div class="card-body tab table-responsive">
          <table class="table table-hover bordered bordered-1">
            <thead>
              
            </thead>
            <tbody>
              <tr>
                <th>No</th>
                <th>Tanggal Catatan</th>
                <th>Keterangan</th>
                <th>Nominal</th>
              </tr>

              <?php

                // $rincian = mysqli_query($koneksi, "SELECT * FROM catatan_pengeluaran JOIN anggaran ON catatan_pengeluaran.id_anggaran = anggaran.id_anggaran JOIN kategori ON catatan_pengeluaran.id_kategori=kategori.id_kategori WHERE catatan_pengeluaran.id_kategori = kategori.id_kategori AND catatan_pengeluaran.id_anggaran = anggaran.id_anggaran AND catatan_pengeluaran.id_catatan AND   $id_mhs GROUP BY catatan_pengeluaran.id_kategori=kategori.id_kategori");  
                $rincian = mysqli_query($koneksi, "SELECT tgl_catatan, keterangan, nominal_catatan FROM catatan_pengeluaran JOIN anggaran ON catatan_pengeluaran.id_anggaran = anggaran.id_anggaran JOIN kategori ON catatan_pengeluaran.id_kategori=kategori.id_kategori WHERE catatan_pengeluaran.id_kategori = kategori.id_kategori AND catatan_pengeluaran.id_anggaran = anggaran.id_anggaran AND catatan_pengeluaran.id_catatan AND catatan_pengeluaran.id_mhs=$id_mhs ORDER BY catatan_pengeluaran.id_kategori"); 
                $no2 = 1;
                while($data = mysqli_fetch_assoc($rincian)) {
                $nominal2 = $data['nominal_catatan'];

              ?>
              <tr>
                <td><?= $no2++?></td>
                <td><?= date('d-m-Y', strtotime($data['tgl_catatan']));?></td>
                <td><?= $data['keterangan'];?></td>
                <td><?= "Rp. ".number_format("$nominal2", 2, ",", ".");?></td>
              </tr>
      
             
 
            </tbody>
                <?php
                }
                ?>
               <tr>
                <td></td>
                <td></td>
                <td rowspan="3"><b>Jumlah Pengeluaran</b></td>
                
                <td> <b><?= "Rp. ".number_format("$total", 2, ",", ".")?></b></td>
              </tr>
          </table>
      </div>  
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
        
      </div>
    </div>
  </div>
</div>

             <?php
                  // }
                ?>

<?php
// Ambil data filter dari GET
$filter_anggaran = isset($_GET['filter_anggaran']) ? $_GET['filter_anggaran'] : '';
?>

<script type="text/javascript">
  google.charts.load('current', {'packages':['corechart']});
  google.charts.setOnLoadCallback(drawChart);

  function drawChart() {
    var data = google.visualization.arrayToDataTable([
      ['Kategori', 'Nominal'],
      <?php 
      // Gunakan variabel $_GET untuk filter
      $filter_anggaran = isset($_GET['filter_anggaran']) ? $_GET['filter_anggaran'] : '';

      $sql = "SELECT SUM(cp.nominal_catatan) as nominal_catatan, k.nama_kategori FROM catatan_pengeluaran cp JOIN kategori k ON cp.id_kategori = k.id_kategori WHERE cp.id_mhs = $id_mhs";

      // Tambahkan kondisi filter jika ada
      if (!empty($filter_anggaran)) {
          $sql .= " AND cp.id_anggaran = $filter_anggaran";
      }

      $sql .= " GROUP BY cp.id_kategori";

      $fire = mysqli_query($conn, $sql);
      while($result = mysqli_fetch_assoc($fire)){
          echo "['".addslashes($result['nama_kategori'])."', ".$result['nominal_catatan']."],";
      }
      ?>
    ]);

    var options = {
      title: 'Budget Buddy'
    };

    var chart = new google.visualization.PieChart(document.getElementById('piechart'));
    chart.draw(data, options);
  }
</script>


