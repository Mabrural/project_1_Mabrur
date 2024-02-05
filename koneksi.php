<?php 

$host = "localhost";
$user = "root";
$pass = "78789898";
$db = "budget"; //nama database
//melakukan koneksi ke database
$koneksi = mysqli_connect($host, $user, $pass, $db);
if (!$koneksi) {
	echo "Gagal konek: " . die(mysqli_error($koneksi));
}


function query($query){
	global $koneksi;
	$result = mysqli_query($koneksi, $query);
	$rows = [];
	while ($row = mysqli_fetch_assoc($result) ) {
		$rows[] = $row;
	}

	return $rows;
}

function tambahAnggaran($data) {
	global $koneksi;
	$nama_anggaran = htmlspecialchars($data["nama_anggaran"]);
	$nominal = htmlspecialchars($data["nominal"]);
	$tgl_mulai = htmlspecialchars($data["tgl_mulai"]);
	$tgl_akhir = htmlspecialchars($data["tgl_akhir"]);
	$id_mhs = mysqli_real_escape_string($koneksi, $_SESSION["id_mhs"]);


	$query = "INSERT INTO anggaran VALUES
			('', '$nama_anggaran', '$nominal', '$tgl_mulai', '$tgl_akhir', '$id_mhs')";
	mysqli_query($koneksi, $query);

	return mysqli_affected_rows($koneksi);
}

function hapusAnggaran($id_anggaran) {
	global $koneksi;


	try{
		mysqli_query($koneksi, "DELETE FROM anggaran WHERE id_anggaran='$id_anggaran'");
	}catch(Exception $e){
		return false;
	}

	return mysqli_affected_rows($koneksi);

}

function ubahAnggaran($data) {
	global $koneksi;

	$id_anggaran = htmlspecialchars($data["id_anggaran"]);
	$nama_anggaran = htmlspecialchars($data["nama_anggaran"]);
	$nominal = htmlspecialchars($data["nominal"]);
	$tgl_mulai = htmlspecialchars($data["tgl_mulai"]);
	$tgl_akhir = htmlspecialchars($data["tgl_akhir"]);

	$query = "UPDATE anggaran SET
				nama_anggaran= '$nama_anggaran',
				nominal = '$nominal',
				tgl_mulai = '$tgl_mulai',
				tgl_akhir = '$tgl_akhir'
			  WHERE id_anggaran='$id_anggaran'
			";
			
	mysqli_query($koneksi, $query);

	return mysqli_affected_rows($koneksi);

}

function tambahTagihan($data) {
	global $koneksi;
	$nama_tagihan = htmlspecialchars($data["nama_tagihan"]);
	$nominal = htmlspecialchars($data["nominal"]);
	$tgl_due = htmlspecialchars($data["tgl_due"]);
	$id_mhs = mysqli_real_escape_string($koneksi, $_SESSION["id_mhs"]);


	$query = "INSERT INTO tagihan VALUES
			('', '$nama_tagihan', '$nominal', '$tgl_due', '$id_mhs')";
	mysqli_query($koneksi, $query);

	return mysqli_affected_rows($koneksi);
}

function hapusTagihan($id_tagihan) {
	global $koneksi;
	mysqli_query($koneksi, "DELETE FROM tagihan WHERE id_tagihan=$id_tagihan");

	return mysqli_affected_rows($koneksi);

}

function ubahTagihan($data) {
	global $koneksi;

	$id_tagihan = htmlspecialchars($data["id_tagihan"]);
	$nama_tagihan = htmlspecialchars($data["nama_tagihan"]);
	$nominal= htmlspecialchars($data["nominal"]);
	$tgl_due = htmlspecialchars($data["tgl_due"]);

	$query = "UPDATE tagihan SET
				nama_tagihan= '$nama_tagihan',
				nominal = '$nominal',
				tgl_due = '$tgl_due'
			  WHERE id_tagihan='$id_tagihan'
			";
			
	mysqli_query($koneksi, $query);

	return mysqli_affected_rows($koneksi);

}

function tambahCatatan($data) {
	global $koneksi;

	$tgl_catatan = mysqli_real_escape_string($koneksi, $data["tgl_catatan"]);
	$nominal = mysqli_real_escape_string($koneksi, $data["nominal"]);
	$id_anggaran = mysqli_real_escape_string($koneksi, $data["id_anggaran"]);
	$id_kategori = mysqli_real_escape_string($koneksi, $data["id_kategori"]);
	$keterangan = mysqli_real_escape_string($koneksi, $data["keterangan"]);
	$id_mhs = mysqli_real_escape_string($koneksi, $_SESSION["id_mhs"]);


	$query = "INSERT INTO catatan_pengeluaran VALUES
			('','$id_kategori', '$id_anggaran', '$tgl_catatan', '$nominal', '$keterangan', '$id_mhs')";
	mysqli_query($koneksi, $query);
	//  var_dump($query);
	//  die;
	return mysqli_affected_rows($koneksi);
}

function hapusCatatan($id_catatan) {
	global $koneksi;
	mysqli_query($koneksi, "DELETE FROM catatan_pengeluaran WHERE id_catatan=$id_catatan");

	return mysqli_affected_rows($koneksi);

}

function ubahCatatan($data) {
	global $koneksi;

	$id_catatan = mysqli_real_escape_string($koneksi, $data["id_catatan"]);
	$tgl_catatan = mysqli_real_escape_string($koneksi, $data["tgl_catatan"]);
	$nominal = mysqli_real_escape_string($koneksi, $data["nominal_catatan"]);
	$id_anggaran = mysqli_real_escape_string($koneksi, $data["id_anggaran"]);
	$id_kategori = mysqli_real_escape_string($koneksi, $data["id_kategori"]);
	$keterangan = mysqli_real_escape_string($koneksi, $data["keterangan"]);

	$query = "UPDATE catatan_pengeluaran SET
				id_kategori = '$id_kategori',
				id_anggaran= '$id_anggaran',
				tgl_catatan= '$tgl_catatan',
				nominal_catatan= '$nominal',
				keterangan = '$keterangan'
			  WHERE id_catatan='$id_catatan'
			";
			
	mysqli_query($koneksi, $query);

	return mysqli_affected_rows($koneksi);

}

function tambahJadwal($data) {
	global $koneksi;
	$matkul = htmlspecialchars($data["matkul"]);
	$hari = mysqli_real_escape_string($koneksi, $data["hari"]);
	$jam = htmlspecialchars($data["jam"]);


	$query = "INSERT INTO jadwal VALUES
			('', '$matkul', '$hari', '$jam')";
	mysqli_query($koneksi, $query);

	return mysqli_affected_rows($koneksi);
}

function hapusJadwal($id_matkul) {
	global $koneksi;
	mysqli_query($koneksi, "DELETE FROM jadwal WHERE id_matkul=$id_matkul");

	return mysqli_affected_rows($koneksi);

}

function ubahJadwal($data) {
	global $koneksi;

	$id_matkul = htmlspecialchars($data["id_matkul"]);
	// $id_lama = htmlspecialchars($data["id_lama"]);	
	$matkul = htmlspecialchars($data["matkul"]);
	$hari = mysqli_real_escape_string($koneksi, $data["hari"]);
	$jam = htmlspecialchars($data["jam"]);

	$query = "UPDATE jadwal SET
				matkul= '$matkul',
				hari = '$hari',
				jam = '$jam'
			  WHERE id_matkul='$id_matkul'
			";
			
	mysqli_query($koneksi, $query);

	return mysqli_affected_rows($koneksi);

}

function registrasi($data){
	global $koneksi;

    $nama = stripcslashes($data["nama_mhs"]);
	$username = strtolower(stripcslashes($data["username"]));
	$password = mysqli_real_escape_string($koneksi, $data["password"]);
    $password2 = mysqli_real_escape_string($koneksi, $data["password2"]);
    $no_hp = stripcslashes($data["no_hp"]);
    $alamat = stripcslashes($data["alamat"]);
    $email = stripcslashes($data["email"]);
	

	// cek username sudah ada atau belum
	$result = mysqli_query($koneksi, "SELECT username FROM mahasiswa WHERE username= '$username'");
	if (mysqli_fetch_assoc($result)) {
		echo '<link rel="stylesheet" href="./sweetalert2.min.css"></script>';
		echo '<script src="./sweetalert2.min.js"></script>';
		echo "<script>
		setTimeout(function () { 
			swal.fire({
				
				title               : 'Daftar Akun Gagal',
				text                :  'Username yang dipilih sudah terdaftar',
				//footer              :  '',
				icon                : 'error',
				timer               : 2000,
				showConfirmButton   : true
			});  
		},10);   setTimeout(function () {
			window.location.href = 'index.php'; //will redirect to your blog page (an ex: blog.html)
		}, 2000); //will call the function after 2 secs
		</script>";
		// echo "
		// 	<script>
		// 		alert('Username yang dipilih sudah terdaftar!');
		// 	</script>
		// ";
		return false;
	}

	// cek konfirmasi password
	if ($password !== $password2) {
		echo "
			<script>
				alert('konfirmasi password tidak sesuai!');
			</script>
		";
		return false;
	}

	// enkripsi password
	$password = password_hash($password, PASSWORD_DEFAULT);


	// tambahkan user baru ke database
	mysqli_query($koneksi, "INSERT INTO mahasiswa VALUES('','$nama', '$username', '$password', '$no_hp', '$alamat', '$email')");

	return mysqli_affected_rows($koneksi);
}

// function ubahProfil($data){
// 	global $koneksi;

//     $nama = stripcslashes($data["nama_mhs"]);
// 	$username = strtolower(stripcslashes($data["username"]));
// 	$password = mysqli_real_escape_string($koneksi, $data["password"]);
//     $password2 = mysqli_real_escape_string($koneksi, $data["password2"]);
//     $no_hp = stripcslashes($data["no_hp"]);
//     $alamat = stripcslashes($data["alamat"]);
//     $email = stripcslashes($data["email"]);
	

// 	// cek username sudah ada atau belum
// 	$result = mysqli_query($koneksi, "SELECT username FROM mahasiswa WHERE username= '$username'");
// 	if (mysqli_fetch_assoc($result)) {
// 		echo '<link rel="stylesheet" href="./sweetalert2.min.css"></script>';
// 		echo '<script src="./sweetalert2.min.js"></script>';
// 		echo "<script>
// 		setTimeout(function () { 
// 			swal.fire({
				
// 				title               : 'Daftar Akun Gagal',
// 				text                :  'Username yang dipilih sudah terdaftar',
// 				//footer              :  '',
// 				icon                : 'error',
// 				timer               : 2000,
// 				showConfirmButton   : true
// 			});  
// 		},10);   setTimeout(function () {
// 			window.location.href = 'index.php'; //will redirect to your blog page (an ex: blog.html)
// 		}, 2000); //will call the function after 2 secs
// 		</script>";
// 		// echo "
// 		// 	<script>
// 		// 		alert('Username yang dipilih sudah terdaftar!');
// 		// 	</script>
// 		// ";
// 		return false;
// 	}

// 	// cek konfirmasi password
// 	if ($password !== $password2) {
// 		echo "
// 			<script>
// 				alert('konfirmasi password tidak sesuai!');
// 			</script>
// 		";
// 		return false;
// 	}

// 	// enkripsi password
// 	$password = password_hash($password, PASSWORD_DEFAULT);


// 	// tambahkan user baru ke database
// 	mysqli_query($koneksi, "INSERT INTO mahasiswa VALUES('','$nama', '$username', '$password', '$no_hp', '$alamat', '$email')");

// 	return mysqli_affected_rows($koneksi);
// }

function ubahProfil($data){
	global $koneksi;
	$id_mhs = $data['id_mhs'];
    $nama = stripcslashes($data["nama_mhs"]);
	$username =stripcslashes($data["username"]);
	$password = mysqli_real_escape_string($koneksi, $data["password"]);
    $no_hp = stripcslashes($data["no_hp"]);
    $alamat = stripcslashes($data["alamat"]);
    $email = stripcslashes($data["email"]);

	
	$password2 = password_hash($password, PASSWORD_DEFAULT);

		// Update user data in the database
		$update_query = "UPDATE mahasiswa 
		SET nama_mhs = '$nama', 
			username = '$username',
			password = '$password2',
			no_hp = '$no_hp', 
			alamat = '$alamat', 
			email = '$email' 
		WHERE id_mhs='$id_mhs'";
	
	

	mysqli_query($koneksi, $update_query);

	return mysqli_affected_rows($koneksi);
}

// function cariCatatan($keyword){
// 	$query = "SELECT * FROM catatan_pengeluaran
// 				WHERE
// 			  tgl_catatan LIKE '%$keyword%' OR 
// 			  nominal_catatan LIKE '%$keyword%' OR 
// 			  id_anggaran LIKE '%$keyword%' OR
// 			  id_kategori LIKE '%$keyword%' OR
// 			  keterangan LIKE '%$keyword%'
// 			";

// 	return query($query);
// }

function cariAnggaran($keyword){
	$query = "SELECT * FROM anggaran
				WHERE
			  nama_anggaran LIKE '%$keyword%' OR 
			  nominal LIKE '%$keyword%' OR 
			  tgl_mulai LIKE '%$keyword%' OR
			  tgl_akhir LIKE '%$keyword%'
			";

	return query($query);
}


// function cariAnggaran($keyword, $koneksi) {
// 	// Buat kueri SQL dengan operator LIKE untuk pencarian wildcard
// 	$query = "SELECT * FROM anggaran WHERE nama_anggaran LIKE '%$keyword%' OR nominal LIKE '%$keyword%' OR tgl_mulai LIKE '%$keyword%' OR tgl_akhir LIKE '%$keyword%'";
  
// 	// Eksekusi kueri dan kembalikan hasil
// 	return mysqli_query($koneksi, $query);
//   }
 ?>