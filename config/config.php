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
		if ($email == $realemail && $password == $realpass) {
			$_SESSION['logged'] = $email;
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