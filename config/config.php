<?php
	require( __DIR__.'/../config.php');
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
		else if (isset($_POST['type']) && $_POST['type'] == 'category') {
			$category = $_POST['typed'];
			checkCategory($category);
		}
		else if (isset($_POST['type']) && $_POST['type'] == 'subcat') {
			$sub = $_POST['typed'];
			checkSub($sub);
		}

		if (isset($_POST['submit']) && $_POST['submit'] == 'category1') {
			category1($_POST['categorycode'], $_POST['categoryname'], $_POST['subcat1'], $_POST['subcatname1']);
		}
		else if (isset($_POST['submit']) && $_POST['submit'] == 'category2') {
			category2($_POST['categorycode'], $_POST['categoryname'], $_POST['subcat1'], $_POST['subcatname1'], $_POST['subcat2'], $_POST['subcatname2']);
		}
		else if (isset($_POST['submit']) && $_POST['submit'] == 'category3') {
			category3($_POST['categorycode'], $_POST['categoryname'], $_POST['subcat1'], $_POST['subcatname1'], $_POST['subcat2'], $_POST['subcatname2'], $_POST['subcat3'], $_POST['subcatname3']);
		}
		else if (isset($_POST['submit']) && $_POST['submit'] == 'category4') {
			category4($_POST['categorycode'], $_POST['categoryname'], $_POST['subcat1'], $_POST['subcatname1'], $_POST['subcat2'], $_POST['subcatname2'], $_POST['subcat3'], $_POST['subcatname3'], $_POST['subcat4'], $_POST['subcatname4']);
		}

		if (isset($_POST['command']) && $_POST['command'] == 'login') {
			$email = $_POST['email'];
			$password = $_POST['password'];
			login($email, $password);
		}
		else if (isset($_POST['command']) && $_POST['command'] == 'register') {
			if (isset($_POST['isValid']) && $_POST['isValid'] == "benar") {
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

		if (isset($_POST['command']) && $_POST['command'] == 'addProdukPulsa'){
			if (isset($_SESSION['logged'])) {
				$username = $_SESSION['logged'];
			}
			$kode_produk = $_POST['kode-product-pulsa']; 
			$nama_produk = $_POST['nama-product-pulsa']; 
			$harga = $_POST['harga-product-pulsa']; 
			$deskripsi = $_POST['deskripsi-product-pulsa'];  
			$nominal = $_POST['nominal-product-pulsa'];
			addProdukPulsa($kode_produk, $nama_produk, $harga, $deskripsi, $nominal);
		}
		
		if (isset($_POST['command']) && $_POST['command'] == 'addProdukShipped') {
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
			addProdukShipped($kode_produk, $nama_produk, $harga, $deskripsi, $subKategori, $isAsuransi, $stok, $barangBaru, $minimalOrder, $minimalGrosir, $maksimalGrosir, $hargaGrosir, $uploadFoto, $username, $kategori, $email);
		}
		
		if (isset($_POST['command']) && $_POST['command'] == 'addToko'){
			if (isset($_SESSION['logged'])) {
				$username = $_SESSION['logged'];
			}
			$nama = $_POST['toko-nama']; 
			$deskripsi = $_POST['toko-deskripsi']; 
			$slogan = $_POST['toko-slogan']; 
			$lokasi = $_POST['toko-lokasi'];
			$email = '';
			$flag = addToko($nama, $deskripsi, $slogan, $lokasi, $username, $email);
			if (!$flag) {
				echo 'gagal';
				exit;
			}
			if(!empty($_POST['toko-jasa-kirim'])) {
			    foreach(explode(',', $_POST['toko-jasa-kirim']) as $check) {
			        $jasa_kirim = $check;
			        addJasaKirimToko($nama, $jasa_kirim);
			    }
			}
			echo 'berhasil';
			exit;
		}
		if (isset($_POST['command']) && $_POST['command'] == 'beli-produk-pulsa'){
			if (isset($_SESSION['logged'])) {
					$username = $_SESSION['email'];
			}

			$kode = $_POST['kode-produk-pulsa'];
			$nomor = $_POST['beli-nomor'];
			$harga = $_POST['harga-produk-pulsa'];
			$nominal = $_POST['nominal-produk-pulsa'];
			$no_invoice = generateRandomString();
			beliPulsa($username, $nomor, $kode, $nominal, $harga, $no_invoice);
			header("Location: ../index.php");
		}

		if (isset($_POST['command']) && $_POST['command'] == 'lihat-produk-toko') {
			echo "<script>console.log('masuk lihat produk toko')</script>";		
		}
	}

	function connectDB() {
		$host = $GLOBALS['DB_HOST'];
		$dbname = $GLOBALS['DB_NAME'];
		$username = $GLOBALS['DB_USERNAME'];
		$password = $GLOBALS['DB_PASS'];

		$connect = pg_connect("host=".$host." dbname=".$dbname." user=".$username." password=".$password);
		return $connect;
	}

	function login($email, $password) {
		$connectDB = connectDB();
		$sql1 = "SELECT P.email, P.nama, P.password, PE.is_penjual FROM tokokeren.PENGGUNA AS P, tokokeren.PELANGGAN AS PE WHERE P.email = PE.email";
		$sql2 = "SELECT P.email, P.nama, P.password FROM tokokeren.PENGGUNA AS P WHERE NOT EXISTS(SELECT * FROM tokokeren.PELANGGAN AS E WHERE P.email = E.email)";

		$query1 = pg_query($connectDB, $sql1);
		$query2 = pg_query($connectDB, $sql2);

		if (!$query1) {
			die("Error: ".$sql1);
		}
		if (!$query2) {
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
		$sql = "INSERT INTO tokokeren.PENGGUNA (email, password, nama, jenis_kelamin, tgl_lahir, no_telp, alamat) VALUES ('$email', '$password', '$name', '$gender', CURRENT_DATE, '$phone', '$address')";
		$query = pg_query($connectDB, $sql);
		if (!$query) {
			die("Error: $sql");
		}

		$sql = "INSERT INTO tokokeren.PELANGGAN (email, is_penjual, nilai_reputasi, poin) VALUES ('$email', 'f', 0, 0)";
		$query = pg_query($connectDB, $sql);
		if (!$query) {
			die("Error: $sql");
		}

		login($email, $password);
	}

	function checkEmail($email) {
		$connectDB = connectDB();
		$sql = "SELECT email FROM tokokeren.PENGGUNA WHERE email = '$email'";
		$query = pg_query($connectDB, $sql);
		if (pg_num_rows($query) > 0) {
			echo "ada";
		}
		else {
			echo "kosong";
		}
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
		if (!$query2) {
			return false;
		}

		$sql3 = "UPDATE tokokeren.PELANGGAN SET is_penjual = 't' WHERE email = '$email'";

		$query3 = pg_query($connectDB, $sql3);

		$_SESSION['role'] = 'penjual';
		return true;
	}

	function addJasaKirimToko($nama, $jasa_kirim){
		$connectDB = connectDB();

		$sql = "INSERT INTO tokokeren.TOKO_JASA_KIRIM(nama_toko, jasa_kirim) VALUES('$nama', '$jasa_kirim')";

		$query = pg_query($connectDB, $sql);
	}

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
				if($kode_produk == $row['kode_produk']){
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
				if($nama == $row["nama"]){
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
	
	function checkCategory($category) {
		$connectDB = connectDB();
		$sql = "SELECT kode FROM tokokeren.KATEGORI_UTAMA WHERE kode = '$category'";
		$query = pg_query($connectDB, $sql);
		if(pg_num_rows($query) > 0) {
			echo "salah";
		}
		else {
			echo "benar";
		}
	}

	function checkSub($sub) {
		$connectDB = connectDB();
		$sql = "SELECT kode FROM tokokeren.SUB_KATEGORI WHERE kode = '$sub'";
		$query = pg_query($connectDB, $sql);

		if (pg_num_rows($query) > 0) {
			echo "salah";
		}
		else {
			echo "benar";
		}
	}

	function category1($catcode, $catname, $sub1, $subname1) {
		$connectDB = connectDB();
		$sql = "INSERT INTO tokokeren.KATEGORI_UTAMA (kode, nama) VALUES ('$catcode', '$catname')";
		$sql1 = "INSERT INTO tokokeren.SUB_KATEGORI (kode, kode_kategori, nama) VALUES ('$sub1', '$catcode', '$subname1')";
		$query = pg_query($connectDB, $sql);
		$query1 = pg_query($connectDB, $sql1);

		if ($query && $query1) {
			echo "sukses";
		}
		else {
			echo "gagal";
		}
	}

	function category2($catcode, $catname, $sub1, $subname1, $sub2, $subname2) {
		$connectDB = connectDB();
		$sql = "INSERT INTO tokokeren.KATEGORI_UTAMA (kode, nama) VALUES ('$catcode', '$catname')";
		$sql1 = "INSERT INTO tokokeren.SUB_KATEGORI (kode, kode_kategori, nama) VALUES ('$sub1', '$catcode', '$subname1')";
		$sql2 = "INSERT INTO tokokeren.SUB_KATEGORI (kode, kode_kategori, nama) VALUES ('$sub2', '$catcode', '$subname2')";
		$query = pg_query($connectDB, $sql);
		$query1 = pg_query($connectDB, $sql1);
		$query2 = pg_query($connectDB, $sql2);

		if ($query && $query1 && $query2) {
			echo "sukses";
		}
		else {
			echo "gagal";
		}
	}

	function category3($catcode, $catname, $sub1, $subname1, $sub2, $subname2, $sub3, $subname3) {
		$connectDB = connectDB();
		$sql = "INSERT INTO tokokeren.KATEGORI_UTAMA (kode, nama) VALUES ('$catcode', '$catname')";
		$sql1 = "INSERT INTO tokokeren.SUB_KATEGORI (kode, kode_kategori, nama) VALUES ('$sub1', '$catcode', '$subname1')";
		$sql2 = "INSERT INTO tokokeren.SUB_KATEGORI (kode, kode_kategori, nama) VALUES ('$sub2', '$catcode', '$subname2')";
		$sql3 = "INSERT INTO tokokeren.SUB_KATEGORI (kode, kode_kategori, nama) VALUES ('$sub3', '$catcode', '$subname3')";
		$query = pg_query($connectDB, $sql);
		$query1 = pg_query($connectDB, $sql1);
		$query2 = pg_query($connectDB, $sql2);
		$query3 = pg_query($connectDB, $sql3);

		if ($query && $query1 && $query2 && $query3) {
			echo "sukses";
		}
		else {
			echo "gagal";
		}
	}

	function category4($catcode, $catname, $sub1, $subname1, $sub2, $subname2, $sub3, $subname3, $sub4, $subname4) {
		$connectDB = connectDB();
		$sql = "INSERT INTO tokokeren.KATEGORI_UTAMA (kode, nama) VALUES ('$catcode', '$catname')";
		$sql1 = "INSERT INTO tokokeren.SUB_KATEGORI (kode, kode_kategori, nama) VALUES ('$sub1', '$catcode', '$subname1')";
		$sql2 = "INSERT INTO tokokeren.SUB_KATEGORI (kode, kode_kategori, nama) VALUES ('$sub2', '$catcode', '$subname2')";
		$sql3 = "INSERT INTO tokokeren.SUB_KATEGORI (kode, kode_kategori, nama) VALUES ('$sub3', '$catcode', '$subname3')";
		$sql4 = "INSERT INTO tokokeren.SUB_KATEGORI (kode, kode_kategori, nama) VALUES ('$sub4', '$catcode', '$subname4')";
		$query = pg_query($connectDB, $sql);
		$query1 = pg_query($connectDB, $sql1);
		$query2 = pg_query($connectDB, $sql2);
		$query3 = pg_query($connectDB, $sql3);
		$query4 = pg_query($connectDB, $sql4);

		if ($query && $query1 && $query2 && $query3 && $query4) {
			echo "sukses";
		}
		else {
			echo "gagal";

		}
	}
?>