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
							<form action="config/config.php" method="post">
								<div class="input-field">
									<input id="email" type="email" name="email" class="validate">
									<label for="email">Email</label>
								</div>
								<div class="input-field">
									<input id="password" type="password" name="password" class="validate">
									<label for="password">Password</label>
								</div>
								<span id="pass-alert" class="red-text" onkeypress="passAlert(); repPassAlert(); isValid();" onfocus="passAlert(); repPassAlert(); isValid();" onchange="passAlert(); repPassAlert(); isValid();"></span>
								<div class="input-field">
									<input id="rep-password" type="password" name="rep-password" class="validate">
									<label for="rep-password">Ulangi Password</label>
								</div>
								<span id="rep-pass-alert" class="red-text" onkeyup="repPassAlert(); isValid();" onfocus="repPassAlert(); isValid();" onchange="repPassAlert(); isValid();"></span>
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
									<input id="datebirth" type="date" class="datepicker validate">
								    <label for="datebirth">Tanggal Lahir</label>
								</div>
								<div class="input-field">
									<input id="phone" type="text" name="phone" class="validate">
									<label for="phone">Nomor Telepon</label>
								</div>
								<span id="phone-alert" class="red-text" onkeypress="phoneAlert(); isValid();" onfocus="phoneAlert(); isValid();" onchange="phoneAlert(); isValid();"></span>
								<div class="input-field">
									<input id="address" type="text" name="address" class="validate">
									<label for="address">Alamat</label>
								</div>
								<input id="validator" type="hidden" name="isValid" value="salah">
								<input type="hidden" name="command" value="register">
								<button type="submit" class="waves-effect waves-light btn yellow darken-2 black-text">DAFTAR</button>
							</form>
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
		$('.datepicker').pickadate({
			format: "mm/dd/yyyy",
			selectMonths: true, // Creates a dropdown to control month
			selectYears: 100 // Creates a dropdown of 15 years to control year
		});

		function passAlert() {
			var value = $("#password").val();
			if (value.length < 6) {
				$("#pass-alert").html("Password setidaknya memiliki 6 karakter");
			}
			else {
				$("#pass-alert").html("");
			}
		}

		function repPassAlert() {
			var rep = $("#rep-password").val();
			var pass = $("#password").val();
			if (rep != pass) {
				$("#rep-pass-alert").html("Password tidak sama");
			}
			else {
				$("#rep-pass-alert").html("");
			}
		}

		function phoneAlert() {
			var phone = $("#phone").val();
			var phoneRegex = /^08[1235789][1-9][0-9]{6,8}$/;
			if (!phoneRegex.test(phone)) {
				$("#phone-alert").html("Nomor telepon tidak sesuai format");
			}
			else {
				$("#phone-alert").html("");
			}
		}

		function isValid() {
			var rep = $("#rep-password").val();
			var pass = $("#password").val();
			var phone = $("#phone").val();
			var phoneRegex = /^08[1235789][1-9][0-9]{6,8}$/;
			if (value.length < 6 || rep != pass || !phoneRegex.test(phone)) {
				$("#validator").val("salah");
			}
			else {
				$("#validator").val("benar");
			}
		}
	</script>
</html>