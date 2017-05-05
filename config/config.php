<?php
	session_start();

	if ($_SERVER['REQUEST_METHOD'] == 'GET') {
		if ($_GET['action'] == 'logout') {
			logout();
		}
	}
	else {
		$email = $_REQUEST['email'];
		$password = $_REQUEST['password'];
		login($email, $password);
	}

	function login($email, $password) {
		$realemail = "admin@admin.com";
		$realpass = "123456";

		$penjualemail = "penjual@penjual.com";
		$penjualpass = "123456";

		$pembeliemail = "pembeli@pembeli.com";
		$pembelipass = "123456";

		if ($email == $realemail && $password == $realpass) {
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
		}
	}

	function logout() {
		unset($_SESSION['logged']);
		header("Location: ../");
	}
?>