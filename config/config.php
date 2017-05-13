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
				header("Location: register.php");
			}
		}
		else if ($_POST['command'] == 'addProdukPulsa'){
			$kode_produk = $_POST['kode-product-pulsa']; 
			$nama_produk = $_POST['nama-product-pulsa']; 
			$harga = $_POST['harga-product-pulsa']; 
			$deskripsi = $_POST['deskripsi-product-pulsa'];  
			$nominal = $_POST['nominal-product-pulsa'];
			addProdukPulsa($kode_produk, $nama_produk, $harga, $deskripsi, $nominal);
		}
		else if ($_POST['command'] == 'addProdukShipped'){
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
			addProdukShipped($kode_produk, $nama_produk, $harga, $deskripsi, $subKategori, $isAsuransi, $stok, $barangBaru, $minimalOrder, $minimalGrosir, $maksimalGrosir, $hargaGrosir, $uploadFoto);
		}
	}

	function connectDB() {
		$host = "localhost";
		$dbname = "postgres";
		$username = "postgres";
		$password = "";

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
				if ($row['is_penjual'] == true) {
					$_SESSION['logged'] = $row['nama'];
					$_SESSION['role'] = 'penjual';
					$_SESSION['email'] = $email;
					header("Location: ../");
				}
				else {
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

	function addProdukShipped($kode_produk, $nama_produk, $harga, $deskripsi, $subKategori, $isAsuransi, $stok, $barangBaru, $minimalOrder, $minimalGrosir, $maksimalGrosir, $hargaGrosir, $uploadFoto){
		
		$connectDB = connectDB();
		$sql = "INSERT INTO tokokeren.PRODUK(kode_produk, nama_produk, harga, deskripsi) VALUES($kode_produk, $nama_produk, $harga, $deskripsi)";

		$sql2 = "SELECT kode FROM SUB_KATEGORI WHERE $nama_produk IS EXISTS";

		$sql4 = "INSERT INTO tokokeren.SHIPPED_PRODUK(kode_produk, kategori, nama_toko, is_asuransi, stok, is_baru, min_order, min_grosir, max_grosir, harga_grosir, foto) VALUES($kode_produk, $sql2, $row['email'], $isAsuransi, $stok, $barangBaru, minimalOrder, $minimalGrosir,  $maksimalGrosir, $hargaGrosir, $uploadFoto)";
		
		$query1 = pg_query($connectDB, $sql);
		$query2 = pg_query($connectDB, $sql2);
		$query4 = pg_query($connectDB, $sql4);

		if ($query1 && $query2 && $query4){
			header("Location: ../index.php");
		}
		else{
			die("Error: $query1 or Error: $query2 or Error: $query3 or Error: $query4");
		}
		
	}

	function addProdukPulsa($kode_produk, $nama_produk, $harga, $deskripsi, $nominal){
		$connectDB = connectDB();
		$sql = "INSERT INTO tokokeren.PRODUK(kode_produk, nama_produk, harga, deskripsi) VALUES($kode_produk, $nama_produk, $harga, $deskripsi)";
		$sql2 = "INSERT INTO tokokeren.PRODUK_PULSA(kode_produk, nominal) VALUES($kode_produk, $nominal)";
		
		$query1 = pg_query($connectDB, $sql);
		$query2 = pg_query($connectDB, $sql2);

		if ($query1 && $query2) {
			header("Location: ../index.php");
		}
		else{
			die("Error: $query1 or $query2");
		}
	}
?>