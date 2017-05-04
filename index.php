<?php session_start();?>

<!DOCTYPE html>
<html>
	<head>
		<?php include("layout/head.php"); ?>
		<title>Home | TOKOKEREN</title>
	</head>
	<body>
		<?php include("layout/navbar.php"); ?>
		<main>
			<div class="container">
				<div class="row">
					<div class="col m1 l2"></div>
					<div class="col s12 m10 l8">
						<div class="nav-content">
						    <ul class="tabs tabs-transparent">
							    <li class="tab"><a class="active black-text" href="#test1">Produk</a></li>
							    <li class="tab"><a class="black-text" href="#test2">Kategori</a></li>
							    <li class="tab"><a class="black-text" href="#test3">Toko</a></li>
							    <li class="tab"><a class="black-text" href="#test4">Ranks</a></li>
					    	</ul>
						</div>			
					</div>
					<div class="col m1 l2"></div>
				</div>
			</div>
			<div id="test1" class="col s12">
				<div class="container">
					<div class="row">
						<div class="col m4 s12 block">
							<div class="card-panel yellow lighten-3 ">
								<img class="product" src="src/resources/lamborghini.jpg">
								<h5>Lamborghini Aventador</h5>
								<p class="valign-wrapper">300 cc, bensin 60 L, max speed 300 km/jam, keluaran tahun 2009, masih mulus, bisa nego</p>
								<span class="price">Rp 13.500.000</span>
							</div>
						</div>
						<div class="col m4 s12 block">
							<div class="card-panel yellow lighten-3">
								<img class="product" src="src/resources/topeng-tobi.jpg">
								<h5>Tobi Mask Fiberglass</h5>
								<p class="valign-wrapper">topeng dijual murah. minat pc. jangan kelamaan, ntar kehabisan. kalo kehabisan, ditanggung sendiri</p>
								<span class="price">Rp 100.000</span>
							</div>
						</div>
						<div class="col m4 s12 block">
							<div class="card-panel yellow lighten-3 ">
								<img class="product" src="src/resources/mugiwara.jpg">
								<h5>Topi Jerami One Piece</h5>
								<p class="valign-wrapper">dijamin seger, enak dipandang</p>
								<span class="price">Rp 25.000</span>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div id="test2" class="col s12">
				<div class="container">
					<div class="row">
						<div class="col m4 s12 block">
							A
						</div>
						<div class="col m4 s12 block">
							B
						</div>
						<div class="col m4 s12 block">
							C
						</div>
					</div>
				</div>
			</div>
			<div id="test3" class="col s12">
				<div class="container">
					<div class="row">
						<div class="col m4 s12 block">
							D
						</div>
						<div class="col m4 s12 block">
							E
						</div>
						<div class="col m4 s12 block">
							F
						</div>
					</div>
				</div>
			</div>
			<div id="test4" class="col s12">
				<div class="container">
					<div class="row">
						<div class="col m4 s12 block">
							G
						</div>
						<div class="col m4 s12 block">
							H
						</div>
						<div class="col m4 s12 block">
							I
						</div>
					</div>
				</div>
			</div>
		</main>
		<?php include("layout/footer.php"); ?>
		<script>
			$(".button-collapse").sideNav();
			$(".indicator").css("background-color: black;");
		</script>
	</body>
</html>