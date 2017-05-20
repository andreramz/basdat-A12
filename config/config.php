<?php
	session_start();

	if ($_SERVER['REQUEST_METHOD'] == 'GET') {
		if ($_GET['action'] == 'logout') {
			logout();
		}
	}
	else {
		if ($_POST['type'] == 'checkEmail') {
			$typed = $_POST['typed'];
			checkEmail($typed);
		}
		else if ($_POST['type'] == 'category') {
			$category = $_POST['typed'];
			checkCategory($category);
		}
		else if ($_POST['type'] == 'subcat') {
			$sub = $_POST['typed'];
			checkSub($sub);
		}

		if ($_POST['submit'] == 'category1') {
			category1($_POST['categorycode'], $_POST['categoryname'], $_POST['subcat1'], $_POST['subcatname1']);
		}
		else if ($_POST['submit'] == 'category2') {
			category2($_POST['categorycode'], $_POST['categoryname'], $_POST['subcat1'], $_POST['subcatname1'], $_POST['subcat2'], $_POST['subcatname2']);
		}
		else if ($_POST['submit'] == 'category3') {
			category3($_POST['categorycode'], $_POST['categoryname'], $_POST['subcat1'], $_POST['subcatname1'], $_POST['subcat2'], $_POST['subcatname2'], $_POST['subcat3'], $_POST['subcatname3']);
		}
		else if ($_POST['submit'] == 'category4') {
			category4($_POST['categorycode'], $_POST['categoryname'], $_POST['subcat1'], $_POST['subcatname1'], $_POST['subcat2'], $_POST['subcatname2'], $_POST['subcat3'], $_POST['subcatname3'], $_POST['subcat4'], $_POST['subcatname4']);
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
				$datebirth = $_POST['datebirth'];
				$gender = $_POST['gender'];
				$phone = $_POST['phone'];
				$address = $_POST['address'];
				register($email, $password, $name, $gender, $datebirth, $phone, $address);
			}
			else {
				$_SESSION['regStatus'] = 'gagal';
				header("Location: ../register.php");
			}
		}
	}

	function connectDB() {
		$host = "localhost";
		$dbname = "andreramadhani";
		$username = "andreramadhani";
		$password = "copoajaloe28";

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
				if ($row['is_penjual'] == 't') {
					$_SESSION['logged'] = $row['nama'];
					$_SESSION['role'] = 'penjual';
					header("Location: ../");
				}
				else {
					$_SESSION['logged'] = $row['nama'];
					$_SESSION['role'] = 'pembeli';
					header("Location: ../");
				}
			}
		}

		while ($row2 = pg_fetch_assoc($query2)) {
			if ($email === $row2['email'] && $password == $row2['password']) {
				$_SESSION['logged'] = $row2['nama'];
				$_SESSION['role'] = 'admin';
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
		header("Location: ../login.php");
	}

	function register($email, $password, $name, $gender, $datebirth, $phone, $address) {
		$connectDB = connectDB();
		$sql1 = "INSERT INTO tokokeren.PENGGUNA (email, password, nama, jenis_kelamin, tgl_lahir, no_telp, alamat) VALUES ('$email', '$password', '$name', '$gender', '$datebirth', '$phone', '$address')";
		$sql2 = "INSERT INTO tokokeren.PELANGGAN (email, is_penjual, nilai_reputasi, poin) VALUES ('$email', FALSE, NULL, 0)";

		$query1 = pg_query($connectDB, $sql1);
		$query2 = pg_query($connectDB, $sql2);
		
		if ($query1 && $query2) {
			$_SESSION['regStatus'] = 'success';
			$_SESSION['logged'] = $name;
			$_SESSION['role'] = 'pembeli';
			header("Location: ../index.php");
		}
		else {
			die("Error: $query1 or Error: $query2");
		}
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