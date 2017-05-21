<?php
	require_once(__DIR__.'/config.php');
	try {
		session_start();

		$command = $_REQUEST['command'];
		if (!isset($command))
			throw new Exception('Command not given');

		$ret = null;

		if ($_SERVER['REQUEST_METHOD'] == 'GET') {
			if ($command == 'get_categories') {
				$ret = getCategories();
			}
			elseif ($command == 'get_subcategories') {
				$category = $_GET['category'];
				if (!isset($category))
					throw new Exception('get_subcategories arguments are missing');

				$ret = getSubcategoriesByCategory($category);
			}
			elseif ($command == 'get_toko') {
				$ret = getToko();
			}
			else {
				throw new Exception('Command does not exist');
			}
		}
		elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
			if ($command == 'create_jasa_kirim') {
				if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin')
					throw new Exception('Unauthorized access. Administrator only');

				$nama = $_POST['jasa-kirim-nama'];
				$lamaKirim = $_POST['jasa-kirim-lama-kirim'];
				$tarif = $_POST['jasa-kirim-tarif'];

				if (!isset($nama) || !isset($lamaKirim) || !isset($tarif))
					throw new Exception('create_jasa_kirim arguments are missing');

				$ret = createJasaKirim($nama, $lamaKirim, $tarif);
			}
			elseif ($command == 'create_promo') {
				if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin')
					throw new Exception('Unauthorized access. Administrator only');

				$deskripsi = $_POST['promo-deskripsi'];
				$periodeAwal = $_POST['promo-periode-awal'];
				$periodeAkhir = $_POST['promo-periode-akhir'];
				$kode = $_POST['promo-kode'];
				$subkategori = $_POST['promo-subkategori'];

				if (!isset($deskripsi) || !isset($periodeAwal) || !isset($periodeAkhir) || !isset($kode) || !isset($subkategori))
					throw new Exception('create_promo arguments are missing');

				$ret = createPromo($deskripsi, $periodeAwal, $periodeAkhir, $kode, $subkategori);
			}
			elseif ($command == 'create_review') {
				if (!isset($_SESSION['role']))
					throw new Exception('Unauthorized access. You must be logged in');

				$emailPembeli = $_SESSION['email'];
				$kodeProduk = $_POST['ulasan-kode-produk'];
				$rating = $_POST['ulasan-rating'];
				$komentar = $_POST['ulasan-komentar'];

				if (!isset($emailPembeli) || !isset($kodeProduk) || !isset($rating))
					throw new Exception('create_review arguments are missing');

				$ret = createReview($emailPembeli, $kodeProduk, $rating, $komentar);
			}
			else {
				throw new Exception('Command does not exist');
			}
		}

		if ($ret === null)
			throw new Exception('Command failed to execute');
		else {
			echo json_encode([
				'status' => 'success',
				'response' => $ret,
			]);
		}

		exit;

	} catch (Exception $e) {
		echo json_encode([
			'status' => 'failed',
			'response' => $e->getMessage(),
		]);
	}

	function connectDB() {
		$host = $GLOBALS['DB_HOST'];
		$dbname = $GLOBALS['DB_NAME'];
		$username = $GLOBALS['DB_USERNAME'];
		$password = $GLOBALS['DB_PASS'];

		$connect = pg_connect("host=".$host." dbname=".$dbname." user=".$username." password=".$password);
		return $connect;
	}


	function createJasaKirim($nama, $lamaKirim, $tarif) {
		$connectDB = connectDB();
		$sql = "INSERT INTO tokokeren.JASA_KIRIM (nama, lama_kirim, tarif) VALUES ('$nama', '$lamaKirim', $tarif)";

		$res = pg_query($connectDB, $sql);
		$err = pg_last_error();

		if ($err != "") {
			throw new Exception($err);
		}

		return true;
	}

	function getCategories() {
		$connectDB = connectDB();
		$sql = "SELECT * FROM tokokeren.KATEGORI_UTAMA";
		
		$res = pg_query($connectDB, $sql);
		$err = pg_last_error();

		if ($err != "") {
			throw new Exception($err);
		}
		
		$val = array();
		while ($row = pg_fetch_assoc($res)) {
			$val[] = ($row);
		}

		return $val;
	}

	function getToko()
	{
		$connectDB = connectDB();
		$sql = "SELECT T.nama FROM tokokeren.TOKO AS T";

		$res = pg_query($connectDB, $sql);
		$err = pg_last_error();

		if ($err != "") {
			throw new Exception($err);
		}
		
		$val = array();
		while ($row = pg_fetch_assoc($res)) {
			$val[] = ($row);
		}

		return $val;
	}

	function getSubcategoriesByCategory($category) {
		$connectDB = connectDB();
		$sql = "SELECT S.* FROM tokokeren.SUB_KATEGORI AS S WHERE S.kode_kategori = '$category'";
		
		$res = pg_query($connectDB, $sql);
		$err = pg_last_error();

		if ($err != "") {
			throw new Exception($err);
		}
		
		$val = array();
		while ($row = pg_fetch_assoc($res)) {
			$val[] = ($row);
		}

		return $val;
	}

	function getProductBySubcategory($subcategory) {
		$connectDB = connectDB();
		$sql = "SELECT P.* FROM tokokeren.SHIPPED_PRODUK AS P WHERE P.kategori = '$subcategory'";
		
		$res = pg_query($connectDB, $sql);
		$err = pg_last_error();

		if ($err != "") {
			throw new Exception($err);
		}
		
		$val = array();
		while ($row = pg_fetch_assoc($res)) {
			$val[] = ($row);
		}

		return $val;
	}

	function generatePromoId() {
		$connectDB = connectDB();
		$sql = "SELECT id FROM tokokeren.PROMO";
		
		$res = pg_query($connectDB, $sql);
		$err = pg_last_error();

		if ($err != "") {
			throw new Exception($err);
		}
		
		$val = array();
		while ($row = pg_fetch_assoc($res)) {
			$val[] = ($row['id']);
		}

		$kode = substr(md5(rand()), 0, 6);
		while (in_array($kode, $val))
			$kode = substr(md5(rand()), 0, 6);

		return strtoupper($kode);
	}

	function createPromo($deskripsi, $periodeAwal, $periodeAkhir, $kode, $subkategori) {
		$connectDB = connectDB();
		$id = generatePromoId();
		$sql = "INSERT INTO tokokeren.PROMO (id, deskripsi, periode_awal, periode_akhir, kode) VALUES ('$id', '$deskripsi', '$periodeAwal', '$periodeAkhir', '$kode');";

		$products = getProductBySubcategory($subkategori);
		foreach ($products as $product) {
			$kode_produk = $product['kode_produk'];
			$sql .= "INSERT INTO tokokeren.PROMO_PRODUK (id_promo, kode_produk) VALUES ('$id', '$kode_produk');";
		}

		$res = pg_query($connectDB, $sql);
		$err = pg_last_error();

		if ($err != "") {
			throw new Exception($err);
		}

		return true;
	}

	function createReview($emailPembeli, $kodeProduk, $rating, $komentar) {
		$connectDB = connectDB();
		$tanggal = date("Y-m-d H:i:s");

		if ($komentar != '')
			$sql = "INSERT INTO tokokeren.ULASAN (email_pembeli, kode_produk, tanggal, rating, komentar) VALUES ('$emailPembeli', '$kodeProduk', '$tanggal', $rating, '$komentar')";
		else
			$sql = "INSERT INTO tokokeren.ULASAN (email_pembeli, kode_produk, tanggal, rating) VALUES ('$emailPembeli', '$kodeProduk', '$tanggal', $rating)";

		$res = pg_query($connectDB, $sql);
		$err = pg_last_error();

		if ($err != "") {
			throw new Exception($err);
		}

		return true;
	}
?>