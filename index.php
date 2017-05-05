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
						<div class="col m2 s12 block"></div>
						<div class="col m8 s12 block">
						<?php if (isset($_SESSION['logged'])) { ?>
							<button class="yellow darken-2 black-text waves-effect waves-light btn" id="category-button">Create Category</button>
							<div id="category" class="card-panel yellow lighten-3 black-text">
								<div class="input-field">
									<input id="category-code" type="text" name="category-code" class="validate">
									<label for="category-code">Kode Kategori</label>
								</div>
								<div class="input-field">
									<input id="category-name" type="text" name="category-name" class="validate">
									<label for="category-name">Nama Kategori</label>
								</div>
								<div id="category-forms"></div>
								<button class="yellow darken-2 black-text waves-effect waves-light btn" id="subcategory-button" style="margin-top: 10px;">Create Sub-category</button>
								<button class="yellow darken-2 black-text waves-effect waves-light btn" id="submit-button" style="margin-top: 10px;">Submit</button>
							</div>
						<?php }
						else {
						?>
							<div class="black-text">No category provided.</div>
						<?php } ?>
						</div>
						<div class="col m2 s12 block"></div>
					</div>
				</div>
			</div>
			<div id="test3" class="col s12">
				<div class="container">
					<div class="row">
						<div class="col m2 s12 block"></div>
						<div class="col m8 s12 block">
							<p class="black-text">Coming soon :)</p>
						</div>
						<div class="col m2 s12 block"></div>
					</div>
				</div>
			</div>
			<div id="test4" class="col s12">
				<div class="container">
					<div class="row">
						<div class="col m2 s12 block"></div>
						<div class="col m8 s12 block">
							<p class="black-text">Coming soon :)</p>
						</div>
						<div class="col m2 s12 block"></div>
					</div>
				</div>
			</div>
		</main>
		<?php include("layout/footer.php"); ?>
		<script>
			$(".button-collapse").sideNav();
			$(".indicator").css("background-color: black;");
			$("#category").hide();
			var forms = 1;
			$("#category-button").click(function() {
				$("#category").show();
				$("#category-button").hide();
			});
			$("#subcategory-button").click(function() {
				$("#category-forms").append("<div><h5>Subkategori "+ forms +"</h5><div class='input-field'><input id='sub-categorycode-"+forms+"' type='email' name='sub-categorycode-"+forms+"' class='validate'><label for='sub-categorycode-"+forms+"'>Kode subkategori</label><div class='input-field'><input id='sub-categoryname-"+forms+"' type='email' name='sub-categoryname-"+forms+"' class='validate'><label for='sub-categoryname-"+forms+"'>Nama subkategori</label>");
				forms++;
			});
		</script>
	</body>
</html>