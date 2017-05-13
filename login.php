<?php session_start();

	if (isset($_SESSION['logged'])) {
		header("Location: ./");
	}
?>

<!DOCTYPE html>
<html>
	<head>
		<?php include("layout/head.php"); ?>
		<title>Login</title>
	</head>
	<body>
		<?php include("layout/navbar.php"); ?>
		<main>
			<div class="container">
				<div class="row">
					<div class="col m3 l3"></div>
					<div class="col s12 m6 l6">
						<h4>Log In</h4>
						<p>Sign in to join up and enjoy more features in Tokokeren.</p>
						<div class="card-panel yellow lighten-3">
							<span class="red-text text-darken-3"><?php
								if (isset($_SESSION['status']) && $_SESSION['status'] == 'gagal') {
									echo "Email atau password salah.";
									unset($_SESSION['status']);
								}
							?></span>
							<form action="./config/config.php" method="post">
								<div class="input-field">
									<input id="email" type="email" name="email" class="validate">
									<label for="email">Email</label>
								</div>
								<div class="input-field">
									<input id="password" type="password" name="password" class="validate">
									<label for="password">Password</label>
								</div>
								<input type="hidden" name="command" value="login">
								<button class="waves-effect waves-light btn yellow darken-2 black-text">LOG IN</button>
							</form>
						</div>
						<span>Don't have an account? <a class="yellow-text text-darken-3" style="font-weight: 450;" href="./register.php">Register Now for Free!</a></span>
					</div>
					<div class="col m3 l3"></div>
				</div>
			</div>
		</main>
		<?php include("layout/footer.php"); ?>
	</body>
	<script>
		$(".button-collapse").sideNav();
		$(".indicator").css("background-color: black;");
	</script>
</html>