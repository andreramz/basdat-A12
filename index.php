<?php session_start();?>

<!DOCTYPE html>
<html>
	<head>
		<?php include("layout/head.php"); ?>
 		<?php include("config/function.php"); ?>
 		<title>Home | TOKOKEREN</title>
	</head>
	<body>
		<?php include("layout/navbar.php"); ?>
		<main>
			<!--<div class="container"> -->
				<div class="row">
					<div class="col s12 m12 l12">
						<div class="nav-content">
						    <ul class="tabs tabs-transparent">
							    <li class="tab"><a class="active black-text" href="#test1">Produk</a></li>
							    <li class="tab"><a class="black-text" href="#test2">Kategori</a></li>
							    <li class="tab"><a class="black-text" href="#test3">Toko</a></li>
							    <li class="tab"><a class="black-text" href="#test4">Ranks</a></li>
							    <?php if (isset($_SESSION['logged']) && $_SESSION['role'] == 'admin') { ?>
							    <li class="tab"><a class="black-text" href="#create-jasa-kirim"><strong>Buat Jasa Kirim</strong></a></li>
							    <li class="tab"><a class="black-text" href="#create-promo"><strong>Buat Promo</strong></a></li>
							    <li class="tab"><a class="black-text" href="#create-product-pulsa"><strong>Buat Produk Pulsa</strong></a></li>
							    <?php } ?>
							    <?php if (isset($_SESSION['logged']) && $_SESSION['role'] == 'pembeli') { ?>
							    <li class="tab"><a class="black-text" href="#create-toko"><strong>Buat Toko</strong></a></li>
							    <?php } ?>

							    <?php if (isset($_SESSION['logged']) && ($_SESSION['role'] == 'penjual' || $_SESSION['role'] == 'pembeli')) { ?>
								<li class="tab"><a class="black-text" href="#see-transaksi"><strong>Lihat Transaksi</strong></a></li>
								<?php } ?>

							    <?php if (isset($_SESSION['logged']) && $_SESSION['role'] == 'penjual') { ?>
							    <li class="tab"><a class="black-text" href="#create-product-shipped"><strong>Tambah Produk</strong></a></li>

							    <?php } ?>
					    	</ul>
						</div>			
					</div>
				</div>
			<!-- </div> -->
			<?php if (isset($_SESSION['regStatus']) && $_SESSION['regStatus'] == 'success') { ?>
			<div>
				<p class="green-text center-align" style="font-size: 17pt;">Account registration success! Now, you can enjoy shopping at Tokokeren.</p>
			</div>
			<?php }
			unset($_SESSION['regStatus']);
			 ?>
			<?php if (isset($_SESSION['logged']) && ($_SESSION['role'] == 'penjual' || $_SESSION['role'] == 'pembeli')) { ?>
			<div id="see-transaksi" class="col s12">
				<div class="container">
					<div class="row">
						<div class="col m2 s12 block"></div>
						<div class="col m12 s12 block">
							<button class="yellow darken-2 black-text waves-effect waves-light btn" id="transaksi-pulsa-button">Produk Pulsa</button>
							<button class="yellow darken-2 black-text waves-effect waves-light btn" id="transaksi-shipped-button">Produk Barang</button>
							<div id="transaksi-pulsa" class="card-panel yellow lighten-3 black-text">
								<table class="striped">
									<thead>
										<tr>
											<th>No Invoice</th>
											<th>Nama Produk</th>
											<th>Tanggal</th>
											<th>Status</th>
											<th>Total Bayar</th>
											<th>Nominal</th>
											<th>Nomor</th>
										</tr>
									</thead>
									<tbody>
										<?php
										$result = lihat_transaksi_pulsa($_SESSION['email']);
										while($row = pg_fetch_assoc($result)) {
											echo 
											"<tr>
												<td>".$row['no_invoice']."</td>
												<td>".$row['nama']."</td>
												<td>".$row['tanggal']."</td>
												<td>".$row['status']."</td>
												<td>".$row['total_bayar']."</td>
												<td>".$row['nominal']."</td>
												<td>".$row['nomor']."</td>
											</tr>";
										}

										?>
									</tbody>
								</table>
							</div>
							<div id="transaksi-shipped" class="card-panel yellow lighten-3 black-text">
								<table class="striped">
									<thead>
										<tr>
											<th>No Invoice</th>
											<th>Nama Toko</th>
											<th>Tanggal</th>
											<th>Status</th>
											<th>Total Bayar</th>
											<th>Alamat Kirim</th>
											<th>Biaya Kirim</th>
											<th>Nomor Resi</th>
											<th>Jasa Kirim</th>
											<th>Ulasan</th>
										</tr>
									</thead>
									<tbody>
										<?php
										$result = lihat_transaksi_shipped($_SESSION['email']);
										while($row = pg_fetch_assoc($result)) {
											echo 
											"<tr>
												<td>".$row['no_invoice']."</td>
												<td>".$row['nama_toko']."</td>
												<td>".$row['tanggal']."</td>
												<td>".$row['status']."</td>
												<td>".$row['total_bayar']."</td>
												<td>".$row['alamat_kirim']."</td>
												<td>".$row['biaya_kirim']."</td>
												<td>".$row['no_resi']."</td>
												<td>".$row['nama_jasa_kirim']."</td>
												<td><a class='waves-effect waves-light btn' href='#daftar-produk-".$row['no_invoice']."'>DAFTAR PRODUK</a></td>
											</tr>";
										}

										?>
									</tbody>
								</table>
							</div>
							<?php
							$result = lihat_transaksi_shipped($_SESSION['email']);
							while($row = pg_fetch_assoc($result)) {
								echo 
								"<div id='daftar-produk-".$row['no_invoice']."' class='modal'>
									<table class='striped'>
									<thead>
										<tr>
											<th>Nama Produk</th>
											<th>Berat</th>
											<th>Kuantitas</th>
											<th>Harga</th>
											<th>Sub Total</th>
											<th>Ulasan</th>
										</tr>
									</thead>
									<tbody>";
									$daftar = lihat_daftar_produk($row['no_invoice']);
									while($baris = pg_fetch_assoc($daftar)) {
										echo 
											"<tr>
												<td>".$baris['nama']."</td>
												<td>".$baris['berat']."</td>
												<td>".$baris['kuantitas']."</td>
												<td>".$baris['harga']."</td>
												<td>".$baris['sub_total']."</td>
												<td><a class='waves-effect waves-light btn review-btn' data-kode-produk='".$baris['kode_produk']."'>ULAS</a></td>
											</tr>";
									}
								echo
									"</tbody>
									</table>
								</div>";
							}
							?>
							<div id="modal-review" class="modal">
								<form id="review-form">
							  	<div class="modal-content">
									<div class="input-field">
										<input id="ulasan-kode-produk" type="text" name="ulasan-kode-produk" class="validate" value="S0000001" readonly required>
										<label for="ulasan-kode-produk">Kode Produk</label>
									</div>
									<div class="input-field">
										<input id="ulasan-rating" type="number" min="1" max="5" name="ulasan-rating" class="validate" required>
										<label for="ulasan-rating">Rating</label>
									</div>
									<div class="input-field">
										<input id="ulasan-komentar" type="text" name="ulasan-komentar" class="validate" required>
										<label for="ulasan-komentar">Komentar</label>
									</div>
								</div>
							    <div class="modal-footer">
									<button class="yellow darken-2 black-text waves-effect waves-light btn" id="submit-button" style="margin-top: 10px;">Submit</button>
							    </div>
								</form>
							</div>
						</div>
						<div class="col m2 s12 block"></div>
					</div>
				</div>
			</div>
			<?php } ?>
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
								<span id="catcode-alert" class="red-text"></span>
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
								<form id="create-jasa-kirim-form">
								<div class="input-field">
									<input id="jasa-kirim-nama" type="text" name="jasa-kirim-nama" class="validate" required>
									<label for="jasa-kirim-nama">Nama</label>
								</div>
								<div class="input-field">
									<input id="jasa-kirim-lama-kirim" type="text" name="jasa-kirim-lama-kirim" class="validate" required>
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
								<form id="create-promo-form">
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
									</select>
									<label for="promo-kategori">Kategori</label>
								</div>
								<div class="input-field">
									<select id="promo-subkategori" name="promo-subkategori" class="validate" required>
										<option selected disabled>Pilih kategori terlebih dahulu!</option>
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
			<div id="create-product-pulsa" class="col s12">
				<div class="container">
					<div class="row">
						<div class="col m2 s12 block"></div>
						<div class="col m8 s12 block">
							<div class="card-panel yellow lighten-3 black-text">
								<form action="./config/config.php" method="post">
								<!--<form onsubmit="Materialize.toast('Pembuatan Produk Pulsa berhasil!', 4000); $('ul.tabs').tabs('select_tab', 'test1'); return false;">-->
								<div class="input-field">
									<input id="kode-product-pulsa" type="text" name="kode-product-pulsa" class="validate" required>
									<label for="kode-product-pulsa">Kode Produk</label>
								</div>
								<div class="input-field">
									<input id="nama-product-pulsa" type="text" name="nama-product-pulsa" class="validate" required>
									<label for="nama-product-pulsa">Nama Produk</label>
								</div>
								<div class="input-field">
									<input id="harga-product-pulsa" type="text" name="harga-product-pulsa" class="validate" required>
									<label for="harga-product-pulsa">Harga</label>
								</div>
								<div class="input-field">
									<input id="deskripsi-product-pulsa" type="text" name="deskripsi-product-pulsa" class="validate" required>
									<label for="deskripsi-product-pulsa">Deskripsi</label>
								</div>
								<div class="input-field">
									<input id="nominal-product-pulsa" type="text" name="nominal-product-pulsa" class="validate" required>
									<label for="nominal-product-pulsa">Nominal</label>
								</div>
								<input type="hidden" name="command" value="addProdukPulsa">
								<button type="submit" class="yellow darken-2 black-text waves-effect waves-light btn" id="submit-button" style="margin-top: 10px;">Submit</button>
								<!--<button class="yellow darken-2 black-text waves-effect waves-light btn" id="submit-button" style="margin-top: 10px;">Submit</button>-->
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
								<form action="./config/config.php" method="post">
									<div class="input-field">
									    <input id="toko-nama" type="text" name="toko-nama" class="validate" required>
									    <label for="toko-nama" data-error="wrong" data-success="right">Nama</label>
									</div>
									<div class="input-field">
									    <input id="toko-deskripsi" type="text" name="toko-deskripsi" class="validate" required>
									    <label for="toko-deskripsi" data-error="wrong" data-success="right">Deskripsi</label>
									</div>
									<div class="input-field">
									    <input id="toko-slogan" type="text" name="toko-slogan" class="validate" required>
									    <label for="toko-slogan" data-error="wrong" data-success="right">Slogan</label>
									</div>
									<div class="input-field">
									    <input id="toko-lokasi" type="text" name="toko-lokasi" class="validate" required>
									    <label for="toko-lokasi" data-error="wrong" data-success="right">Lokasi</label>
									</div>
									<div class="input-field">
										<select multiple id="toko-jasa-kirim"  name="toko-jasa-kirim[]">
											<option value="" disabled selected>Pilih...</option>
											<?php
												$host = "localhost";
												$dbname = "valianfil";
												$username = "valianfil";
												$password = "1234abcd";

												$connect = pg_connect("host=".$host." dbname=".$dbname." user=".$username." password=".$password);
												$sql = "SELECT nama FROM tokokeren.JASA_KIRIM";
												$sql_res = pg_query($sql);
												
												while ($row = pg_fetch_assoc($sql_res)){
													echo '<option name="option[]" value="'.$row['nama'].'">'.$row['nama'].'</option>';
												} 

											?>
									    </select>
									    <label for="toko-jasa-kirim">Jasa Kirim</label>
									</div>
									<input type="hidden" name="command" value="addToko">
									<button class="yellow darken-2 black-text waves-effect waves-light btn" type="submit" id="submit-button" style="margin-top: 10px;">Submit</button>
								</form>
							</div>
						</div>
						<div class="col m2 s12 block"></div>
					</div>
				</div>
			</div>
			<?php } ?>
			<?php if (isset($_SESSION['logged']) && $_SESSION['role'] == 'penjual') { ?>
			<div id="create-product-shipped" class="col s12">
				<div class="container">
					<div class="row">
						<div class="col m2 s12 block"></div>
						<div class="col m8 s12 block">
							<div class="card-panel yellow lighten-3 black-text">
								<form action="./config/config.php" method="post">
									<div class="input-field">
										<input id="kode-product-shipped" type="text" name="kode-product-shipped" class="validate" required>
										<label for="kode-product-shipped">Kode Produk</label>
									</div>
									<div class="input-field">
										<input id="nama-product-shipped" type="text" name="nama-product-shipped" class="validate" required>
										<label for="nama-product-shipped">Nama Produk</label>
									</div>
									<div class="input-field">
										<input id="harga-product-shipped" type="date" name="harga-product-shipped" class="datepicker validate" required>
										<label for="harga-product-shipped">Harga</label>
									</div>
									<div class="input-field">
										<input id="deskripsi-product-shipped" type="text" name="deskripsi-product-shipped" class="validate" required>
										<label for="deskripsi-product-shipped">Deskripsi</label>
									</div>
									<div class="input-field">
										<select id="subkategori-product-shipped" name="subkategori-product-shipped">
											<option value="" disabled selected>Pilih...</option>
											<?php
												$host = "localhost";
												$dbname = "valianfil";
												$username = "valianfil";
												$password = "1234abcd";

												$connect = pg_connect("host=".$host." dbname=".$dbname." user=".$username." password=".$password);
												$sql = "SELECT nama FROM tokokeren.SUB_KATEGORI";
												$sql_res = pg_query($sql);
												
												while ($row = pg_fetch_assoc($sql_res)){
													echo '<option value="'.$row['nama'].'">'.$row['nama'].'</option>';
												} 
											?>
										<!--<a class='dropdown-button yellow darken-2 black-text waves-effect waves-light btn' href='#' data-activates='dropdown1'>Sub Kategori</a>
										<ul id='dropdown1' class='dropdown-content'>
											<li><a href="#!">one</a></li>
											<li><a href="#!">two</a></li>
											<li><a href="#!">three</a></li>
											<li><a href="#!">view_module</a></li>
											<li><a href="#!">cloud</a></li>
										</ul>-->
									</div>
									<div class="input-field">
										<p>Barang Asuransi</p>
										<input name="barang-asuransi" type="radio" id="test3" />
										<label for="test3">Ya</label>
										<input name="barang-asuransi" type="radio" id="test4" />
										<label for="test4">Tidak</label>
									</div>
									<div class="input-field">
										<input id="stok-product-shipped" type="text" name="stok-product-shipped" class="validate" required>
										<label for="stok-product-shipped">Stok</label>
									</div>
									<div class="input-field">
										<p>Barang Baru</p>
										<input name="barang-baru" type="radio" id="test5" />
										<label for="test5">Ya</label>
										<input name="barang-baru" type="radio" id="test6" />
										<label for="test6">Tidak</label>
									</div>
									<div class="input-field">
										<input id="minimal-order-product-shipped" type="text" name="minimal-order-product-shipped" class="validate" required>
										<label for="minimal-order-product-shipped">Minimal Order</label>
									</div>
									<div class="input-field">
										<input id="minimal-grosir-product-shipped" type="text" name="minimal-grosir-product-shipped" class="validate" required>
										<label for="minimal-grosir-product-shipped">Minimal Grosir</label>
									</div>
									<div class="input-field">
										<input id="maksimal-grosir-product-shipped" type="text" name="maksimal-grosir-product-shipped" class="validate" required>
										<label for="maksimal-grosir-product-shipped">Maksimal Grosir</label>
									</div>
									<div class="input-field">
										<input id="harga-grosir-product-shipped" type="text" name="harga-grosir-product-shipped" class="validate" required>
										<label for="harga-grosir-product-shipped">Harga Grosir</label>
									</div>
									<div class="input-field">
										<p>Foto</p>
								        <input type="file" name="upload-foto">
									</div>
									<input type="hidden" name="command" value="addProdukShipped">
									<button class="yellow darken-2 black-text waves-effect waves-light btn" type="submit" id="submit-button" style="margin-top: 10px;">Submit</button>
										<!--<div class="btn">
								        	<span>File</span>
								        </div>
								        <input type="file">
									</div>
									<button class="yellow darken-2 black-text waves-effect waves-light btn" id="submit-button" style="margin-top: 10px;">Submit</button>-->
								</form>
							</div>
						</div>
						<div class="col m2 s12 block"></div>
					</div>
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
		<script>
			$(document).ready(function() {
				$(".button-collapse").sideNav();
				$(".indicator").css("background-color: black;");
				$("#category").hide();
				<?php 
				try {
					$result = lihat_transaksi_shipped($_SESSION['email']);
					$rees = "";
					while($row = pg_fetch_assoc($result)) {
						$rees .= "$('#daftar-produk-".$row['no_invoice']."').modal();";
					}
					echo $rees;
				} catch (Exception $e) {
					echo 'console.log('. $e->getMessage() .');';
				}
				?>

				$("#transaksi-pulsa").hide();
				$("#transaksi-shipped").hide();
				$("#daftar-produk-1").hide();
				var forms = 1;
				$("#category-button").click(function() {
					$("#category").show();
					$("#category-button").hide();
				});
				$("#transaksi-pulsa-button").click(function() {
					$("#transaksi-pulsa").show();
					$("#transaksi-pulsa-button").hide();
					$("#transaksi-shipped-button").hide();
				});
				$("#transaksi-shipped-button").click(function() {
					$("#transaksi-shipped").show();
					$("#transaksi-pulsa-button").hide();
					$("#transaksi-shipped-button").hide();
				});
				$("#daftar-produk-1-button").click(function() {
					$("#daftar-produk-1").show();
				});
				$("#subcategory-button").click(function() {
					$("#category-forms").append("<div><h5>Subkategori "+ forms +"</h5><div class='input-field'><input id='sub-categorycode-"+forms+"' type='email' name='sub-categorycode-"+forms+"' class='validate sub-category'><label for='sub-categorycode-"+forms+"'>Kode subkategori</label><div class='input-field'><input id='sub-categoryname-"+forms+"' type='email' name='sub-categoryname-"+forms+"' class='validate'><label for='sub-categoryname-"+forms+"'>Nama subkategori</label>");
					forms++;
				});

				$('#category-code').on("input propertychange", function() {
					var catcode = $("#category-code").val();
					$.post("config/config.php", {type: "category", typed: catcode}, function(response) {
						if (response == "benar") {
							$("#catcode-alert").html("");
						}
						else {
							$("#catcode-alert").html("Kategori tidak unik atau sudah ada");
						}
					});
				});

				$('select').material_select();
				$('.modal').modal();
				$('.datepicker').pickadate({
					selectMonths: true, // Creates a dropdown to control month
					selectYears: 15 // Creates a dropdown of 15 years to control year
				});

				$.ajax({
		           type: "GET",
		           url: "api.php?command=get_categories",
		           success: function(data)
		           {
		           		var res = JSON.parse(data);
		           		if (res.status == 'success') {
		           			$("#promo-kategori").empty();
		           			var options = '';
		           			options += '<option selected disabled>Pilih Kategori</option>';
							$.each(res.response, function() {
								options += '<option value="' + this.kode + '">' + this.nama + '</option>';
							});
							$("#promo-kategori").html(options);
							$("#promo-kategori").material_select();
		           		}
		           		else if (res.status == 'failed') {
			           		console.error('Error using API, response: ' + JSON.stringify(res.response));
		           			Materialize.toast('Error terjadi!', 4000); 
		           		}
		           }
		       	});
				$('#promo-kategori').change(function() {
					$.ajax({
			           type: "GET",
			           url: "api.php?command=get_subcategories&category=" + $('#promo-kategori').val(),
			           success: function(data)
			           {
			           		var res = JSON.parse(data);
			           		if (res.status == 'success') {
			           			var options = $("#promo-subkategori");
			           			options.empty();
			           			options.append('<option selected disabled>Pilih Subkategori</option>');
								$.each(res.response, function() {
								    options.append($("<option />").val(this.kode).text(this.nama));
								});
								$("#promo-subkategori").material_select();
			           		}
			           		else if (res.status == 'failed') {
			           			console.error('Error using API, response: ' + JSON.stringify(res.response));
			           			Materialize.toast('Error terjadi!', 4000); 
			           		}
			           }
			       });
				});
				$("#create-jasa-kirim-form").submit(function(e) {
				    var url = "api.php?command=create_jasa_kirim"; // the script where you handle the form input.
				    $.ajax({
			           type: "POST",
			           url: url,
			           data: $("#create-jasa-kirim-form").serialize(), // serializes the form's elements.
			           success: function(data)
			           {
			           		var res = JSON.parse(data);
			           		if (res.status == 'success') {
			           			Materialize.toast('Pembuatan Jasa Kirim berhasil!', 4000); 
								$('ul.tabs').tabs('select_tab', 'test1');
			           		}
			           		else if (res.status == 'failed') {
			           			console.error('Error using API, response: ' + JSON.stringify(res.response));
			           			Materialize.toast('Pembuatan Jasa Kirim gagal!', 4000); 
			           		}
			           }
			      	});
				    e.preventDefault(); // avoid to execute the actual submit of the form.
				});
				$("#create-promo-form").submit(function(e) {
				    var url = "api.php?command=create_promo"; // the script where you handle the form input
				    $.ajax({
			           type: "POST",
			           url: url,
			           data: $("#create-promo-form").serialize(), // serializes the form's elements.
			           success: function(data)
			           {
			           		var res = JSON.parse(data);
			           		if (res.status == 'success') {
			           			Materialize.toast('Pembuatan Promo berhasil!', 4000); 
								$('ul.tabs').tabs('select_tab', 'test1');
			           		}
			           		else if (res.status == 'failed') {
			           			console.error('Error using API, response: ' + JSON.stringify(res.response));
			           			Materialize.toast('Pembuatan Promo gagal!', 4000); 
			           		}
			           }
			      	});
				    e.preventDefault(); // avoid to execute the actual submit of the form.
				});
				$('.review-btn').click(function() {
					$('#modal-review #ulasan-kode-produk').val($(this).attr('data-kode-produk'));
					$('#modal-review').modal('open');
				});
				$("#review-form").submit(function(e) {
				    var url = "api.php?command=create_review"; // the script where you handle the form input
				    $.ajax({
			           type: "POST",
			           url: url,
			           data: $("#review-form").serialize(), // serializes the form's elements.
			           success: function(data)
			           {
			           		var res = JSON.parse(data);
			           		if (res.status == 'success') {
			           			Materialize.toast('Pembuatan Review berhasil!', 4000); 
								$('ul.tabs').tabs('select_tab', 'test1');
			           		}
			           		else if (res.status == 'failed') {
			           			console.error('Error using API, response: ' + JSON.stringify(res.response));
			           			Materialize.toast('Pembuatan Review gagal!', 4000); 
			           		}
			           }
			      	});
				    e.preventDefault(); // avoid to execute the actual submit of the form.
				});
				$('#promo-periode-awal').change(function() {
					$('#promo-periode-akhir').pickadate('picker').set('min', new Date($('#promo-periode-awal').val()));
				});
			});
		</script>

	</body>
</html>