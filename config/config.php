<?php
	if (!isset($_SESSION)) {
		session_start();
	}

	if ($_SERVER['REQUEST_METHOD'] == 'GET') {
		if ($_GET['action'] == 'logout') {
			logout();
		}
	}
	else {
		if (isset($_POST['type']) && $_POST['type'] == 'checkEmail') {
			$typed = $_POST['typed'];
			checkEmail($typed);
		}
		if ($_POST['command'] == 'login') {
			$email = $_POST['email'];
			$password = $_POST['password'];
			login($email, $password);
		}
		else if ($_POST['command'] == 'register') {
			if ($_POST['isValid'] == "benar") {
				$email = $_POST['email'];
				$password = $_POST['password'];
				$name = $_POST['name'];
				$gender = $_POST['gender'];
				$phone = $_POST['phone'];
				$address = $_POST['address'];
				register($email, $password, $name, $gender, $phone, $address);
			}
			else {
				$_SESSION['regStatus'] = 'gagal';
				header("Location: ../register.php");
			}
		}

		if ($_POST['command'] == 'addProdukPulsa'){
			if (isset($_SESSION['logged'])) {
				$username = $_SESSION['logged'];
			}
			$kode_produk = $_POST['kode-product-pulsa']; 
			$nama_produk = $_POST['nama-product-pulsa']; 
			$harga = $_POST['harga-product-pulsa']; 
			$deskripsi = $_POST['deskripsi-product-pulsa'];  
			$nominal = $_POST['nominal-product-pulsa'];
			$error = 't';
			if(strlen($kode_produk) == 0){
				echo "kode produk kosong";
				echo"";
				$error = 'f';
			}
			if (strlen($kode_produk) != 8){
				echo "Kode produk harus di isi dengan tepat 8 karakter";
				echo"";
				$error = 'f';
			}
			checkProduk($kode_produk, $error);
			if(strlen($nama_produk) == 0){
					echo "nama produk kosong";
					echo"";
					$error = 'f';
			}
			if (strlen($nama_produk) < 1 || strlen($nama_produk) > 100){
				echo "nama produk tidak valid";
				echo"";
				$error = 'f';
			}
			if(strlen($harga) == 0){
					echo "harga kosong";
					echo"";
					$error = 'f';
			}
			if (is_numeric($harga)){
				if ($harga > 9999999999 || $harga < 0.01){
					echo "harga tidak valid";
					echo"";
					$error = 'f';
				}
			}
			else{
				echo "harga tidak valid";
				echo"";
				$error = 'f';
			}
			if(strlen($nominal) == 0){
					echo "nominal kosong";
					echo"";
					$error = 'f';
			}
			if (is_numeric($nominal)){
				if($nominal < 1){
					echo "nominal tidak valid";
					echo"";
					$error = 'f';
				}
			}
			else{
				echo "nominal tidak valid";
				echo "";
				$error = 'f';
			}
			if($error == 'f'){
				header("refresh:5; url=../index.php");
				die();
			}
			addProdukPulsa($kode_produk, $nama_produk, $harga, $deskripsi, $nominal);
		}
		
		if ($_POST['command'] == 'addProdukShipped'){
			if (isset($_SESSION['logged'])) {
				$username = $_SESSION['logged'];
			}
			$kode_produk = $_POST['kode-product-shipped']; 
			$nama_produk = $_POST['nama-product-shipped']; 
			$harga = $_POST['harga-product-shipped']; 
			$deskripsi = $_POST['deskripsi-product-shipped'];
			$subKategori = $_POST['subkategori-product-shipped'];
			$isAsuransi = $_POST['barang-asuransi'];
			$stok = $_POST['stok-product-shipped'];
			$barangBaru = $_POST['barang-baru'];
			$minimalOrder = $_POST['minimal-order-product-shipped'];
			$minimalGrosir = $_POST['minimal-grosir-product-shipped'];
			$maksimalGrosir = $_POST['maksimal-grosir-product-shipped'];
			$hargaGrosir = $_POST['harga-grosir-product-shipped'];
			$uploadFoto = $_POST['upload-foto'];
			$kategori = '';
			$email = '';
			$error = 't';
			if(strlen($kode_produk) == 0){
				echo "kode produk kosong";
				echo"";
				$error = 'f';
			}
			if (strlen($kode_produk) != 8){
				echo "Kode produk harus di isi dengan tepat 8 karakter";
				echo"";
				$error = 'f';
			}
			checkProduk($kode_produk, $error);
			if(strlen($nama_produk) == 0){
					echo "nama produk kosong";
					echo"";
					$error = 'f';
			}
			if (strlen($nama_produk) < 1 || strlen($nama_produk) > 100){
				echo "nama produk tidak valid";
				echo"";
				$error = 'f';
			}
			if(strlen($harga) == 0){
					echo "harga kosong";
					echo"";
					$error = 'f';
			}
			if (is_numeric($harga)){
				if ($harga > 9999999999 || $harga < 0.01){
					echo "harga tidak valid";
					echo"";
					$error = 'f';
				}
			}
			else{
				echo "harga tidak valid";
				echo"";
				$error = 'f';
			}
			if(strlen($subKategori) == 0){
					echo "Sub kategori kosong";
					echo"";
					$error = 'f';
			}
			if(strlen($is_asuransi) == 0){
					echo "asuransi kosong";
					echo"";
					$error = 'f';
			}
			if(strlen($stok) == 0){
					echo "input stok kosong";
					echo"";
					$error = 'f';
			}
			if (is_numeric($stok)){
				if($stok < 1){
					echo "stok tidak valid";
					echo"";
					$error = 'f';
				}
			}
			else{
				echo "stok tidak valid";
				echo"";
				$error = 'f';
			}
			if(strlen($is_baru) == 0){
					echo "kondisi barang kosong";
					echo"";
					$error = 'f';
			}
			if(strlen($min_order) == 0){
					echo "minimal order kosong";
					echo"";
					$error = 'f';
			}
			if (is_numeric($min_order)){
				if($min_order < 1){
					echo "minimal order tidak valid";
					echo"";
					$error = 'f';
				}
			}
			else{
				echo "minimal order tidak valid";
				echo"";
				$error = 'f';
			}
			if(strlen($min_grosir) == 0){
					echo "minimal grosir kosong";
					echo"";
					$error = 'f';
			}
			if (is_numeric($min_grosir)){
				if($min_grosir < 1){
					echo "minimal grosir tidak valid";
					echo"";
					$error = 'f';
				}
			}
			else{
				echo "minimal grosir tidak valid";
				echo"";
				$error = 'f';
			}
			if(strlen($max_grosir) == 0){
					echo "maksimal grosir kosong";
					echo"";
					$error = 'f';
			}
			if (is_numeric($max_grosir)){
				if($max_grosir < 1){
					echo"maksimal grosir tidak valid";
					echo"";
					$error = 'f';
				}
				if($min_grosir > $max_grosir){
					echo "maksimal grosir harus lebih besar dibandingkan minimal grosir";
					echo"";
					$error = 'f';
				}
			}
			else{
				echo "maksimal grosir tidak valid";
				echo"";
				$error = 'f';
			}
			if(strlen($harga_grosir) == 0){
					echo "harga grosir kosong";
					echo"";
					$error = 'f';
			}
			if (is_numeric($harga_grosir)){
				if ($harga_grosir > 9999999999 || $harga_grosir < 0.01){
					echo "harga grosir tidak valid";
					echo"";
					$error = 'f';
				}
			}
			else{
				echo "harga grosir tidak valid";
				echo"";
				$error = 'f';
			}
			if(strlen($foto) == 0){
					echo"nama foto kosong";
					echo"";
					$error = 'f';
			}
			if (strlen($foto) < 1 || strlen($foto) > 100){
				echo "nama foto tidak valid";
				echo"";
				$error = 'f';
			}
			if($error == 'f'){
				header("refresh:5; url=../index.php");
			}
			addProdukShipped($kode_produk, $nama_produk, $harga, $deskripsi, $subKategori, $isAsuransi, $stok, $barangBaru, $minimalOrder, $minimalGrosir, $maksimalGrosir, $hargaGrosir, $uploadFoto, $username, $kategori, $email);
		}
		if ($_POST['command'] == 'addToko'){
			if (isset($_SESSION['logged'])) {
				$username = $_SESSION['logged'];
			}
			$nama = $_POST['toko-nama']; 
			$deskripsi = $_POST['toko-deskripsi']; 
			$slogan = $_POST['toko-slogan']; 
			$lokasi = $_POST['toko-lokasi'];
			$email = '';
			$error = 't';
			if(strlen($nama) == 0){
					echo "nama toko kosong";
					echo"";
					$error = 'f';
			}
			if (strlen($nama) < 1 || strlen($nama) > 100){
				echo "nama toko tidak valid";
				echo"";
				$error = 'f';
			}
			checkToko($nama, $error);
			if (strlen($slogan) > 100){
				echo "slogan tidak valid";
				echo"";
				$error = 'f';
			}
			if(strlen($lokasi) == 0){
				echo "lokasi kosong";
				echo"";
				$error = 'f';
			}
			if($error == 'f'){
				header("refresh:5; url=../index.php");
			}
			addToko($nama, $deskripsi, $slogan, $lokasi, $username, $email);
			if(!empty($_POST['toko-jasa-kirim'])) {
			    foreach($_POST['toko-jasa-kirim'] as $check) {
			        $jasa_kirim = $check;
			        addJasaKirimToko($nama, $jasa_kirim);
			    }
			}
			header("Location: ../index.php");
		}
		if ($_POST['command'] == 'beli-produk-pulsa'){
			if (isset($_SESSION['logged'])) {
					$username = $_SESSION['email'];
			}
			$kode = $_POST['kode-produk-pulsa'];
			$nomor = $_POST['beli-nomor'];
			$harga = $_POST['harga-produk-pulsa'];
			$nominal = $_POST['nominal-produk-pulsa'];
		}
		$no_invoice = generateRandomString();
		beliPulsa($username, $nomor, $kode, $nominal, $harga, $no_invoice);
		header("Location: ../index.php");
	}

	function connectDB() {
		$host = "localhost";
		$dbname = "postgres";
		$username = "postgres";
		$password = "marjuan2005";

		$connect = pg_connect("host=".$host." dbname=".$dbname." user=".$username." password=".$password);
		return $connect;
	}

	function login($email, $password) {
		/*$realemail = "admin@admin.com";
		$realpass = "123456";

		$penjualemail = "penjual@penjual.com";
		$penjualpass = "123456";

		$pembeliemail = "pembeli@pembeli.com";
		$pembelipass = "123456";*/

		$connectDB = connectDB();
		$sql1 = "SELECT P.email, P.nama, P.password, PE.is_penjual FROM tokokeren.PENGGUNA AS P, tokokeren.PELANGGAN AS PE WHERE P.email = PE.email";
		$sql2 = "SELECT P.email, P.nama, P.password FROM tokokeren.PENGGUNA AS P WHERE NOT EXISTS(SELECT * FROM tokokeren.PELANGGAN AS E WHERE P.email = E.email)";

		$query1 = pg_query($connectDB, $sql1);
		$query2 = pg_query($connectDB, $sql2);

		if (!$sql1) {
			die("Error: ".$sql1);
		}
		if (!$sql2) {
			die("Error: ".$sql2);
		}
		
		while ($row = pg_fetch_assoc($query1)) {
			if ($email === $row['email'] && $password == $row['password']) {
				if ($row['is_penjual'] == t) {
					$_SESSION['logged'] = $row['nama'];
					$_SESSION['role'] = 'penjual';
					$_SESSION['email'] = $email;
					header("Location: ../");
				}
				else{
					$_SESSION['logged'] = $row['nama'];
					$_SESSION['role'] = 'pembeli';
					$_SESSION['email'] = $email;
					header("Location: ../");
				}
			}
		}

		while ($row2 = pg_fetch_assoc($query2)) {
			if ($email === $row2['email'] && $password == $row2['password']) {
				$_SESSION['logged'] = $row2['nama'];
				$_SESSION['role'] = 'admin';
				$_SESSION['email'] = $email;
				header("Location: ../");
			}
		}

		$_SESSION['status'] = 'gagal';
		header("Location: ../login.php");

		/*if ($email == $realemail && $password == $realpass) {
			$_SESSION['logged'] = $email;
			$_SESSION['role'] = 'admin';
			header("Location: ../");
		}
		elseif ($email == $penjualemail && $password == $penjualpass) {
			$_SESSION['logged'] = $email;
			$_SESSION['role'] = 'penjual';
			header("Location: ../");
		}
		elseif ($email == $pembeliemail && $password == $pembelipass) {
			$_SESSION['logged'] = $email;
			$_SESSION['role'] = 'pembeli';
			header("Location: ../");
		}
		else {
			$_SESSION['status'] = 'gagal';
			header("Location: ../login.php");
		}*/
	}

	function logout() {
		unset($_SESSION['logged']);
		unset($_SESSION['role']);
		header("Location: ../");
	}

	function register($email, $password, $name, $gender, $phone, $address) {
		$connectDB = connectDB();
		$sql = "INSERT INTO tokokeren.PENGGUNA (email, password, nama, jenis_kelamin, tgl_lahir, no_telp, alamat) VALUES ($email, $password, $name, $gender, CURRENT_DATE, $phone, $address)";
		if (!$sql) {
			die("Error: $sql");
		}
		$query = pg_query($connectDB, $sql);
	}

	function lihat_transaksi_pulsa($email) {
		$connectDB = connectDB();
		$sql = "SELECT L.no_invoice, P.nama, T.tanggal, T.status, T.total_bayar, T.nominal, T.nomor FROM tokokeren.LIST_ITEM AS L, tokokeren.PRODUK AS P, tokokeren.TRANSAKSI_PULSA AS T WHERE T.email_pembeli = '".$email."' AND L.no_invoice = T.no_invoice AND L.kode_produk = P.kode_produk";

		return pg_query($connectDB, $sql);
	}
	
	function lihat_transaksi_shipped($email) {
		$connectDB = connectDB();
		$sql = "SELECT T.no_invoice, T.nama_toko, T.tanggal, T.status, T.total_bayar, T.alamat_kirim, T.biaya_kirim, T.no_resi, T.nama_jasa_kirim FROM tokokeren.TRANSAKSI_SHIPPED AS T WHERE T.email_pembeli = '".$email."'";

		return pg_query($connectDB, $sql);
	}

	function addProdukShipped($kode_produk, $nama_produk, $harga, $deskripsi, $subKategori, $isAsuransi, $stok, $barangBaru, $minimalOrder, $minimalGrosir, $maksimalGrosir, $hargaGrosir, $uploadFoto, $username, $kategori, $email){
		
		$connectDB = connectDB();
		$sql = "INSERT INTO tokokeren.PRODUK(kode_produk, nama, harga, deskripsi) VALUES( '$kode_produk', '$nama_produk', '$harga', '$deskripsi')";

		$sql2 = "SELECT SK.kode FROM tokokeren.SUB_KATEGORI AS SK WHERE SK.nama = '$subKategori'";

		$sql3 = "SELECT T.email_penjual, T.nama FROM tokokeren.TOKO T, tokokeren.PELANGGAN PE NATURAL JOIN tokokeren.PENGGUNA P WHERE PE.email = T.email_penjual AND P.nama = '$username'";

		$query1 = pg_query($connectDB, $sql);
		$query2 = pg_query($connectDB, $sql2);
		$query3 = pg_query($connectDB, $sql3);

		while ($row = pg_fetch_assoc($query2)) {
				$kategori = $row['kode'];
		}

		while ($row2 = pg_fetch_assoc($query3)) {
				$email = $row2['email_penjual'];
		}

		$sql4 = "SELECT T.nama FROM tokokeren.TOKO AS T WHERE T.email_penjual LIKE '$email'";

		$query4 = pg_query($connectDB, $sql4);

		while ($row3 = pg_fetch_assoc($query4)) {
				$nama_toko = $row3['nama'];
		}

		if ($query1 && $query2 && $query3 && $query4){
			$sql5 = "INSERT INTO tokokeren.SHIPPED_PRODUK(kode_produk, kategori, nama_toko, is_asuransi, stok, is_baru, min_order, min_grosir, max_grosir, harga_grosir, foto) VALUES('$kode_produk', '$kategori', '$nama_toko', '$isAsuransi', '$stok', '$barangBaru', '$minimalOrder', '$minimalGrosir', '$maksimalGrosir', '$hargaGrosir', '$uploadFoto')";

			$query5 = pg_query($connectDB, $sql5);
			header("Location: ../index.php");
		}
		else{
			die("Error: $query1 or Error: $query2 or Error: $query3");
		}
		
	}

	function addToko($nama, $deskripsi, $slogan, $lokasi, $username, $email){
		$connectDB = connectDB();

		$sql = "SELECT PE.email FROM tokokeren.PELANGGAN PE NATURAL JOIN tokokeren.PENGGUNA P WHERE P.nama = '$username'";

		$query1 = pg_query($connectDB, $sql);

		while ($row1 = pg_fetch_assoc($query1)) {
				$email = $row1['email'];
		}

		$sql2 = "INSERT INTO tokokeren.TOKO(nama, deskripsi, slogan, lokasi, email_penjual) VALUES ('$nama', '$deskripsi', '$slogan', '$lokasi', '$email')";

		$query2 = pg_query($connectDB, $sql2);

		$sql3 = "UPDATE tokokeren.PELANGGAN SET is_penjual = 't' WHERE email = '$email'";

		$query3 = pg_query($connectDB, $sql3);

		$_SESSION['role'] = 'penjual';
	};

	function addJasaKirimToko($nama, $jasa_kirim){
		$connectDB = connectDB();

		$sql = "INSERT INTO tokokeren.TOKO_JASA_KIRIM(nama_toko, jasa_kirim) VALUES('$nama', '$jasa_kirim')";

		$query = pg_query($connectDB, $sql);
	};

	function addProdukPulsa($kode_produk, $nama_produk, $harga, $deskripsi, $nominal){
		$connectDB = connectDB();
		$sql = "INSERT INTO tokokeren.PRODUK(kode_produk, nama, harga, deskripsi) VALUES( '$kode_produk', '$nama_produk', '$harga', '$deskripsi')";
		$sql2 = "INSERT INTO tokokeren.PRODUK_PULSA(kode_produk, nominal) VALUES('$kode_produk', '$nominal')";
		
		$query1 = pg_query($connectDB, $sql);
		$query2 = pg_query($connectDB, $sql2);

		if ($query1 && $query2) {
			header("Location: ../index.php");
		}
		else{
			die("Error: $query1 or $query2");
		}
	}
	function checkProduk($kode_produk, $error){
			$sqlProduk ="SELECT kode_produk FROM tokokeren.produk";
			$connectProduk = connectDB();
			$queryProduk = pg_query($connectProduk, $sqlProduk);
			while ($row = pg_fetch_assoc($queryProduk)) {
				if($kode_produk = $row['kode_produk']){
					echo "kode produk sudah ada";
					echo "";
					$error ='f';
				}
			}
	}
	function checkToko($nama, $error){
			$sqlToko ="SELECT nama FROM tokokeren.toko";
			$connectToko = connectDB();
			$queryToko = pg_query($connectToko, $sqlToko);
			while ($row = pg_fetch_assoc($queryToko)) {
				if($nama = $row[$queryToko]){
					echo "nama toko sudah ada";
					echo "";
					$error ='f';
					die();
				}
			}
	}

	function generateRandomString($length = 10) {
	    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	    $charactersLength = strlen($characters);
	    $randomString = '';
	    for ($i = 0; $i < $length; $i++) {
	        $randomString .= $characters[rand(0, $charactersLength - 1)];
	    }
	    return $randomString;
	}

	function beliPulsa($username, $nomor, $kode, $nominal, $harga, $no_invoice)
	{

		$connectDB = connectDB();

		$date = date("Y/m/d");
		$timestamp = date("Y/m/d H:i:s");

		$sql = "INSERT INTO tokokeren.TRANSAKSI_PULSA (no_invoice, tanggal, waktu_bayar, status, total_bayar, email_pembeli, nominal, nomor, kode_produk) VALUES ('$no_invoice', CURRENT_DATE, '$timestamp', '2', '$harga', '$username', '$nominal', '$nomor', '$kode')";

		$query = pg_query($connectDB, $sql);

		if ($query) {
			header("Location: ../index.php");
		}
		else{
			die("Error: $query");
		}
	}
?>