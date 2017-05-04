<?php session_start();?>

<!DOCTYPE html>
<html>
	<head>
		<?php include("layout/head.php"); ?>
		<title>Register</title>
	</head>
	<body>
		<?php include("layout/navbar.php"); ?>
		<main>
			<div class="container">
				<div class="row">
					<div class="col m2 l2"></div>
					<div class="col s12 m8 l8">
						<h4>Register</h4>
						<p>Let's advance together with Tokokeren by filling all of the datas below.</p>
						<div class="card-panel yellow lighten-3">
							<form>
								<div class="input-field">
									<input id="email" type="email" name="email" class="validate">
									<label for="email">Email</label>
								</div>
								<div class="input-field">
									<input id="password" type="password" name="password" class="validate">
									<label for="password">Password</label>
								</div>
								<div class="input-field">
									<input id="rep-password" type="password" name="rep-password" class="validate">
									<label for="rep-password">Ulangi Password</label>
								</div>
								<div class="input-field">
									<input id="name" type="text" name="name" class="validate">
									<label for="name">Nama Lengkap</label>
								</div>
								<div class="input-field">
									<select id="gender" name="gender">
										<option value="" disabled selected>Pilih...</option>
									    <option value="L">Laki-Laki</option>
									    <option value="P">Perempuan</option>
								    </select>
								    <label for="gender">Jenis Kelamin</label>
								</div>
								<div class="input-field">
									<input id="phone" type="text" name="phone" class="validate">
									<label for="phone">Nomor Telepon</label>
								</div>
								<div class="input-field">
									<input id="address" type="text" name="address" class="validate">
									<label for="address">Alamat</label>
								</div>
								<input type="hidden" name="command" value="login">
							</form>
							<button class="waves-effect waves-light btn yellow darken-2 black-text">DAFTAR</button>
						</div>
					</div>
					<div class="col m2 l2"></div>
				</div>
			</div>
		</main>
		<?php include("layout/footer.php"); ?>
	</body>
	<script>
		$(".button-collapse").sideNav();
		$(".indicator").css("background-color: black;");
		$('select').material_select();
	</script>
</html>