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
							    <?php if (isset($_SESSION['logged']) && $_SESSION['role'] == 'admin') { ?>
							    <li class="tab"><a class="black-text" href="#create-jasa-kirim"><strong>Buat Jasa Kirim</strong></a></li>
							    <li class="tab"><a class="black-text" href="#create-promo"><strong>Buat Promo</strong></a></li>
							    <?php } ?>
							    <?php if (isset($_SESSION['logged']) && $_SESSION['role'] == 'pembeli') { ?>
							    <li class="tab"><a class="black-text" href="#create-toko"><strong>Buat Toko</strong></a></li>
							    <?php } ?>
							    <?php if (isset($_SESSION['logged']) && ($_SESSION['role'] == 'pembeli' || $_SESSION['role'] == 'penjual')) { ?>
							    <li class="tab"><a class="black-text" href="#buy-product"><strong>Beli Produk</strong></a></li>
							    <?php } ?>
							    <?php if (isset($_SESSION['logged']) && ($_SESSION['role'] == 'pembeli' || $_SESSION['role'] == 'penjual')) { ?>
							    <li class="tab"><a class="black-text" href="#keranjang-belanja"><strong>Lihat Keranjang</strong></a></li>
							    <?php } ?>
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
						<?php if (isset($_SESSION['logged']) && $_SESSION['role'] == 'admin') { ?>
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
			<?php if (isset($_SESSION['logged']) && $_SESSION['role'] == 'admin') { ?>
			<div id="create-jasa-kirim" class="col s12">
				<div class="container">
					<div class="row">
						<div class="col m2 s12 block"></div>
						<div class="col m8 s12 block">
							<div class="card-panel yellow lighten-3 black-text">
								<form onsubmit="Materialize.toast('Pembuatan Jasa Kirim berhasil!', 4000); $('ul.tabs').tabs('select_tab', 'test1'); return false;">
								<div class="input-field">
									<input id="jasa-kirim-nama" type="text" name="jasa-kirim-nama" class="validate" required>
									<label for="jasa-kirim-nama">Nama</label>
								</div>
								<div class="input-field">
									<input id="jasa-kirim-lama-kirim" type="number" name="jasa-kirim-lama-kirim" class="validate" required>
									<label for="jasa-kirim-lama-kirim">Lama Kirim (dalam satuan hari)</label>
								</div>
								<div class="input-field">
									<input id="jasa-kirim-tarif" type="number" name="jasa-kirim-tarif" class="validate" required>
									<label for="jasa-kirim-tarif">Tarif (dalam rupiah)</label>
								</div>
								<button class="yellow darken-2 black-text waves-effect waves-light btn" id="submit-button" style="margin-top: 10px;">Submit</button>
								</form>
							</div>
						</div>
						<div class="col m2 s12 block"></div>
					</div>
				</div>
			</div>
			<div id="create-promo" class="col s12">
				<div class="container">
					<div class="row">
						<div class="col m2 s12 block"></div>
						<div class="col m8 s12 block">
							<div class="card-panel yellow lighten-3 black-text">
								<form onsubmit="Materialize.toast('Pembuatan Promo berhasil!', 4000); $('ul.tabs').tabs('select_tab', 'test1'); return false;">
								<div class="input-field">
									<input id="promo-deskripsi" type="text" name="promo-deskripsi" class="validate" required>
									<label for="promo-deskripsi">Deskripsi</label>
								</div>
								<div class="input-field">
									<input id="promo-periode-awal" type="date" name="promo-periode-awal" class="datepicker validate" required>
									<label for="promo-periode-awal">Periode Awal</label>
								</div>
								<div class="input-field">
									<input id="promo-periode-akhir" type="date" name="promo-periode-akhir" class="datepicker validate" required>
									<label for="promo-periode-akhir">Periode Akhir</label>
								</div>
								<div class="input-field">
									<input id="promo-kode" type="text" name="promo-kode" class="validate" required>
									<label for="promo-kode">Kode Promo</label>
								</div>
								<div class="input-field">
									<select id="promo-kategori" name="promo-kategori" class="validate" required>
										<option>Pakaian</option>
									</select>
									<label for="promo-kategori">Kategori</label>
								</div>
								<div class="input-field">
									<select id="promo-subkategori" name="promo-subkategori" class="validate" required>
										<option>Baju</option>
										<option>Celana</option>
									</select>
									<label for="promo-subkategori">Sub Kategori</label>
								</div>
								<button class="yellow darken-2 black-text waves-effect waves-light btn" id="submit-button" style="margin-top: 10px;">Submit</button>
								</form>
							</div>
						</div>
						<div class="col m2 s12 block"></div>
					</div>
				</div>
			</div>
			<?php } ?>
			<?php if (isset($_SESSION['logged']) && $_SESSION['role'] == 'pembeli') { ?>
			<div id="create-toko" class="col s12">
				<div class="container">
					<div class="row">
						<div class="col m2 s12 block"></div>
						<div class="col m8 s12 block">
							<div class="card-panel yellow lighten-3 black-text">
								<form onsubmit="Materialize.toast('Pembuatan Toko berhasil!', 4000); $('ul.tabs').tabs('select_tab', 'test1'); return false;">
								<!-- TODO -->
								</form>
							</div>
						</div>
						<div class="col m2 s12 block"></div>
					</div>
				</div>
			</div>
			<div id="buy-product" class="col s12">
				<div class="container">
				<table class="striped">
					<thead>
						<tr>
				            <th>Kode Produk</th>
				            <th>Nama Produk</th>
				            <th>Harga</th>
				            <th>Deskripsi</th>
				            <th>Nominal</th>
				            <th>Beli</th>
		          		</tr>
					</thead>
					<tbody>
						<tr>
							<td>P0000001</td>
							<td>Pulsa IM3</td>
							<td>12000</td>
							<td></td>
							<td>10</td>
							<td>
								<a class="waves-effect waves-light btn" href="#modal1">Beli</a>
							 	<div id="modal1" class="modal">
							    <div class="modal-content">
							      <h4>FORM MEMBELI PRODUK PULSA</h4>
							      <div class="row">
							      	<p>Kode Produk: P0000001</p>
							      	<form class="col s12">
							      		<div class="input-field col s6">
						          			No Telepon: <input placeholder="Masukkan nomor" id="no_telepon" type="tel" class="validate">
						          		</div>
						          	</form>
							      </div>
							    </div>
							    <div class="modal-footer">
							    	<a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Submit</a>
							    </div>
			 					</div>
							</td>
						</tr>
						<tr>
							<td>P0000002</td>
							<td>Pulsa XL</td>
							<td>12000</td>
							<td></td>
							<td>10</td>
							<td>
								<a class="waves-effect waves-light btn" href="#modal2">Beli</a>
							 	<div id="modal2" class="modal">
							    <div class="modal-content">
							      <h4>FORM MEMBELI PRODUK PULSA</h4>
							      <div class="row">
							      	<p>Kode Produk: P0000002</p>
							      	<form class="col s12">
							      		<div class="input-field col s6">
						          			No Telepon: <input placeholder="Masukkan nomor" id="no_telepon" type="tel" class="validate">
						          		</div>
						          	</form>
							      </div>
							    </div>
							    <div class="modal-footer">
							    	<a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Submit</a>
							    </div>
			 					</div>
							</td>
						</tr>
					</tbody>
				</table>
				</div>
				<div class="container">
					<h4>FORM PILIH TOKO</h4>
					<span>Nama Toko:
					<!-- Dropdown Trigger -->
					  <a class='dropdown-button btn' href='#' data-activates='dropdown1'>Pilih Toko</a>

					  <!-- Dropdown Structure -->
					  <ul id='dropdown1' class='dropdown-content'>
					    <li><a href="#modal3">Kelontong</a></li>
					    <li><a href="#modal3">Indodesember</a></li>
					  </ul>
					</span>
					<div id="modal3" class="modal">
				    <div class="modal-content">
				      <h4>DAFTAR SHIPPED PRODUK</h4>
				      <span>
				      	<a class="dropdown-button btn" href="#" data-activates="dropdown2">Kategori</a>
				      	<ul id='dropdown2' class='dropdown-content'>
						    <li><a href="#!">Celana</a></li>
						    <li><a href="#!">Baju</a></li>
						</ul>
					   </span>
					   <span>
				      	<a class="dropdown-button btn" href="#" data-activates="dropdown2">Sub Kategori</a>
				      	<ul id='dropdown2' class='dropdown-content'>
						    <li><a href="#!">Nylon</a></li>
						    <li><a href="#!">Jeans</a></li>
						</ul>
					    </span>
					    <table class="striped">
					        <thead>
					          <tr>
					              <th>Kode Produk</th>
					              <th>Nama Produk</th>
					              <th>Harga</th>
					              <th>Deskripsi</th>
					              <th>Is_asuransi</th>
					              <th>Stok</th>
					              <th>Is Baru</th>
					              <th>Harga Grosir</th>
					              <th>Beli</th>
					          </tr>
					        </thead>
					        <tbody>
					          <tr>
					            <td>P0000001</td>
					            <td>Tas Fower 1</td>
					            <td>75000</td>
					            <td>KOSONG</td>
					            <td>TRUE</td>
					            <td>30</td>
					            <td>TRUE</td>
					            <td>60000</td>
					            <td>
				    				<a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Beli</a>
					            </td>
					          </tr>
					          <tr>
					          	<td>P0000002</td>
					            <td>Tas Fower 2</td>
					            <td>75000</td>
					            <td>KOSONG</td>
					            <td>TRUE</td>
					            <td>140</td>
					            <td>TRUE</td>
					            <td>70000</td>
					            <td>
				    				<a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Beli</a>
					            </td>
					          </tr>
					        </tbody>
					      </table>
				    </div>
 					</div>
				</div>
			</div>
			<div id="keranjang-belanja" class="col s12">
				<div class="container">
					<h4>DAFTAR SHIPPED PRODUK</h4>
					<table class="striped">
					        <thead>
					          <tr>
					              <th>Kode Produk</th>
					              <th>Nama Produk</th>
					              <th>Berat</th>
					              <th>Kuantitas</th>
					              <th>Harga</th>
					              <th>Sub Total</th>
					          </tr>
					        </thead>
					        <tbody>
					          <tr>
					            <td>P0000001</td>
					            <td>Tas Fower 1</td>
					            <td>4</td>
					            <td>4</td>
					            <td>75000</td>
					            <td>300000</td>
					          </tr>
					          <tr>
					          	<td>P0000002</td>
					            <td>Tas Fower 2</td>
					            <td>3</td>
					            <td>4</td>
					            <td>80000</td>
					            <td>240000</td>
					          </tr>
					        </tbody>
					</table>
					<span>Alamat Kirim:   
						<div class="row">
						    <form class="col s6">
						      <div class="row">
						        <div class="input-field col s6">
						          <input id="email" type="text" class="validate">
						          <label for="email" data-error="wrong" data-success="right">Alamat</label>
						        </div>
						      </div>
						    </form>
						</div>
					</span>
					<span>Jasa Kirim:
						<a class='dropdown-button btn' href='#' data-activates='dropdown5'>Pilih Jasa Kirim</a>

					  <!-- Dropdown Structure -->
					  <ul id='dropdown5' class='dropdown-content'>
					    <li><a href="index.php">Bojek</a></li>
					    <li><a href="index.php">Go-Blay</a></li>
					  </ul>
					</span>
					<a class="waves-effect waves-light btn" href="index.php">CHECKOUT</a>
				</div>
			</div>
			<?php } ?>
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
		<script src="src/js/jquery-3.1.1.min.js"></script>
		<script src="materialize/js/materialize.js"></script>
		<script>
			$('#modal1').modal();
			$('#modal2').modal();
			$('#modal3').modal();
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
			$('.datepicker').pickadate({
				selectMonths: true, // Creates a dropdown to control month
				selectYears: 15 // Creates a dropdown of 15 years to control year
			});
			$(document).ready(function() {
				$('select').material_select();
			});
		</script>

	</body>
</html>