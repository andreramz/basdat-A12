<?php session_start(); require_once(__DIR__.'/config.php'); ?>

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
							    <li class="tab"><a class="active black-text" href="#lihat-produk">Produk</a></li>
							    <li class="tab"><a class="black-text" href="#test2">Kategori</a></li>
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
							<button class="yellow darken-2 black-text waves-effect waves-light btn" id="kembali-transaksi-button">Kembali</button>
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
										<input id="ulasan-komentar" type="text" name="ulasan-komentar" class="validate">
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
			<div id="lihat-produk" class="col s12">
				<div class="container">
					<div class="row">
						<div class="col m12 s12 block">
							<button class="yellow darken-2 black-text waves-effect waves-light btn" id="lihat-pulsa-button">Produk Pulsa</button>
							<button class="yellow darken-2 black-text waves-effect waves-light btn" id="lihat-shipped-button">Produk Barang</button>
							<div id="lihat-pulsa" class="card-panel yellow lighten-3 black-text">
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
										<?php
										$result = lihat_produk_pulsa();
										while($row = pg_fetch_assoc($result)) {
											echo 
											"<tr>
												<td>".$row['kode_produk']."</td>
												<td>".$row['nama']."</td>
												<td>".$row['harga']."</td>
												<td>".$row['deskripsi']."</td>
												<td>".$row['nominal']."</td>
												<td><a class='waves-effect waves-light btn' href='#beli-produk-".$row['kode_produk']."'>BELI</a></td>
											</tr>";
										}
										$result = lihat_produk_pulsa();
										while($row = pg_fetch_assoc($result)) {
											echo 
											'<div id="beli-produk-'.$row['kode_produk'].'" class="modal">
												<p>Kode Produk: '.$row['kode_produk'].'</p>
												<form action="./config/config.php" method="post">
													<div class="row">
												        <div class="col s12">
												          Nomor  HP / Token Listrik:
												          <div class="input-field inline">
												            <input id="beli-nomor" name="beli-nomor" type="number" class="validate" required>
												            <label for="beli-nomor" data-error="wrong" data-success="right">Nomor</label>
												          </div>
												        </div>
												    </div>
												    <input type="hidden" name="kode-produk-pulsa" value="'.$row['kode_produk'].'">
												    <input type="hidden" name="nominal-produk-pulsa" value="'.$row['nominal'].'">
												    <input type="hidden" name="harga-produk-pulsa" value="'.$row['harga'].'">
												    <input type="hidden" name="command" value="beli-produk-pulsa">
				    								<button class="yellow darken-2 black-text waves-effect waves-light btn" id="submit-beli" style="margin-top: 10px;">Submit</button>
												</form>
											</div>';
										}
										?>
									</tbody>
								</table>
							</div>
							<div id='lihat-shipped'>
									<select id="pilih-toko"  name="toko-shipped">
										<option value="" disabled selected>Pilih Toko...</option>
									</select>
									<input type="hidden" name="command" value="lihat-produk-toko">
									<button id="lihat-produk-button" class="yellow darken-2 black-text waves-effect waves-light btn" style="margin-top: 10px;">Lihat Produk</button>
							</div>
							<div id='lihat-shipped-toko'>
								<select id="pilih-kategori">
									<option value="" disabled selected>Pilih Kategori...</option>
								</select>
								<select id="pilih-sub-kategori">
									<option value="" disabled selected>Pilih Subkategori...</option>
								</select>
								<div id="daftar-produk-shipped"></div>
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
							<span id="alert-category1" class="green-text"></span>
							<span id="alert-category2" class="red-text"></span>
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
								<div id="category-forms">
									<div id="sub-category-1" style="display: none;">
										<h5>Subkategori 1</h5>
										<div class="input-field">
											<input type="text" id="sub1" class="validate subcode">
											<label for="sub1">Kode Subkategori</label>
										</div>
										<span class="red-text" id="sub-alert-1"></span>
										<div class="input-field">
											<input type="text" id="subname1" class="validate">
											<label for="subname1">Nama Subkategori</label>
										</div>
									</div>
									<div id="sub-category-2" style="display: none;">
										<h5>Subkategori 2</h5>
										<div class="input-field">
											<input type="text" id="sub2" class="validate subcode">
											<label for="sub2">Kode Subkategori</label>
										</div>
										<span class="red-text" id="sub-alert-2"></span>
										<div class="input-field">
											<input type="text" id="subname2" class="validate">
											<label for="subname2">Nama Subkategori</label>
										</div>
									</div>
									<div id="sub-category-3" style="display: none;">
										<h5>Subkategori 3</h5>
										<div class="input-field">
											<input type="text" id="sub3" class="validate subcode">
											<label for="sub3">Kode Subkategori</label>
										</div>
										<span class="red-text" id="sub-alert-3"></span>
										<div class="input-field">
											<input type="text" id="subname3" class="validate">
											<label for="subname3">Nama Subkategori</label>
										</div>
									</div>
									<div id="sub-category-4" style="display: none;">
										<h5>Subkategori 4</h5>
										<div class="input-field">
											<input type="text" id="sub4" class="validate subcode">
											<label for="sub4">Kode Subkategori</label>
										</div>
										<span class="red-text" id="sub-alert-4"></span>
										<div class="input-field">
											<input type="text" id="subname4" class="validate">
											<label for="subname4">Nama Subkategori</label>
										</div>
									</div>
								</div>
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
								<div class="input-field">
									<input id="kode-product-pulsa" pattern=".{8,8}" type="text" name="kode-product-pulsa" class="validate" required>
									<label for="kode-product-pulsa">Kode Produk</label>
								</div>
								<div class="input-field">
									<input id="nama-product-pulsa" pattern=".{1,100}" type="text" name="nama-product-pulsa" class="validate" required>
									<label for="nama-product-pulsa">Nama Produk</label>
								</div>
								<div class="input-field">
									<input id="harga-product-pulsa" pattern="^\d{1,8}(\.\d{0,2})?$" type="text" name="harga-product-pulsa" class="validate" required>
									<label for="harga-product-pulsa">Harga</label>
								</div>
								<div class="input-field">
									<input id="deskripsi-product-pulsa" type="text" name="deskripsi-product-pulsa" class="validate" required>
									<label for="deskripsi-product-pulsa">Deskripsi</label>
								</div>
								<div class="input-field">
									<input id="nominal-product-pulsa" pattern=".{1,10}" type="text" name="nominal-product-pulsa" class="validate" required>
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
									    <input id="toko-nama" type="text"  pattern=".{1,100}" name="toko-nama" class="validate" required>
									    <label for="toko-nama">Nama</label>
									</div>
									<div class="input-field">
									    <input id="toko-deskripsi" type="text" name="toko-deskripsi">
									    <label for="toko-deskripsi">Deskripsi</label>
									</div>
									<div class="input-field">
									    <input id="toko-slogan" type="text" pattern=".{0,100}" name="toko-slogan" class="validate" required>
									    <label for="toko-slogan">Slogan</label>
									</div>
									<div class="input-field">
									    <input id="toko-lokasi" type="text" pattern=".{1,}" name="toko-lokasi" class="validate" required>
									    <label for="toko-lokasi">Lokasi</label>
									</div>
									<div class="input-field">
										<select multiple id="toko-jasa-kirim"  name="toko-jasa-kirim">
											<option  disabled selected value="">Pilih...</option>
											<?php
												$host = $GLOBALS['DB_HOST'];
												$dbname = $GLOBALS['DB_NAME'];
												$username = $GLOBALS['DB_USERNAME'];
												$password = $GLOBALS['DB_PASS'];

												$connect = pg_connect("host=".$host." dbname=".$dbname." user=".$username." password=".$password);
												$sql = "SELECT nama FROM tokokeren.JASA_KIRIM";
												$sql_res = pg_query($sql);
												
												while ($row = pg_fetch_assoc($sql_res)){
													echo '<option value="'.$row['nama'].'">'.$row['nama'].'</option>';
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
										<input id="kode-product-shipped" pattern=".{8,8}" type="text" name="kode-product-shipped" class="validate" required>
										<label for="kode-product-shipped">Kode Produk</label>
									</div>
									<div class="input-field">
										<input id="nama-product-shipped" pattern=".{1,100}" type="text" name="nama-product-shipped" class="validate" required>
										<label for="nama-product-shipped">Nama Produk</label>
									</div>
									<div class="input-field">
										<input id="harga-product-shipped" pattern="^\d{1,8}(\.\d{0,2})?$" type="text" name="harga-product-shipped" class="validate" required>
										<label for="harga-product-shipped">Harga</label>
									</div>
									<div class="input-field">
										<input id="deskripsi-product-shipped" type="text" name="deskripsi-product-shipped">
										<label for="deskripsi-product-shipped">Deskripsi</label>
									</div>
									<div class="input-field">
										<select id="subkategori-product-shipped" name="subkategori-product-shipped" required>
											<option disabled selected value="">Pilih...</option>
											<?php
												$host = $GLOBALS['DB_HOST'];
												$dbname = $GLOBALS['DB_NAME'];
												$username = $GLOBALS['DB_USERNAME'];
												$password = $GLOBALS['DB_PASS'];

												$connect = pg_connect("host=".$host." dbname=".$dbname." user=".$username." password=".$password);
												$sql = "SELECT nama FROM tokokeren.SUB_KATEGORI";
												$sql_res = pg_query($sql);
												
												while ($row = pg_fetch_assoc($sql_res)){
													echo "<option value=".$row['nama'].">".$row['nama']."</option>";
												} 
											?>
									    </select>
									    <label for="subkategori-product-shipped">Sub Kategori</label>
									</div>
									<div class="input-field">
										<p>Barang Asuransi</p>
										<input type="radio" name="barang-asuransi" value="true" id="barang-asuransi-ya" required/>
					       				<label for="barang-asuransi-ya">Ya</label>
					       				<input type="radio" name="barang-asuransi" value="false" id="barang-asuransi-tidak"/>
					       				<label for="barang-asuransi-tidak">Tidak</label>
									</div>
									<div class="input-field">
										<input id="stok-product-shipped" type="text" pattern=".{0,10}" name="stok-product-shipped" class="validate" required>
										<label for="stok-product-shipped">Stok</label>
									</div>
									<div class="input-field">
										<p>Barang Baru</p>
										<input name="barang-baru" type="radio" value="true" id="barang-baru-ya" required/>
					       				<label for="barang-baru-ya">Ya</label>
					       				<input name="barang-baru" type="radio" value="false" id="barang-baru-tidak"/>
					       				<label for="barang-baru-tidak">Tidak</label>
									</div>
									<div class="input-field">
										<input id="minimal-order-product-shipped" type="text" pattern=".{0,10}" name="minimal-order-product-shipped" class="validate" required>
										<label for="minimal-order-product-shipped">Minimal Order</label>
									</div>
									<div class="input-field">
										<input id="minimal-grosir-product-shipped" type="text" pattern=".{0,10}" name="minimal-grosir-product-shipped" class="validate" required>
										<label for="minimal-grosir-product-shipped">Minimal Grosir</label>
									</div>
									<div class="input-field">
										<input id="maksimal-grosir-product-shipped" type="text" pattern=".{0,10}" name="maksimal-grosir-product-shipped" class="validate" required>
										<label for="maksimal-grosir-product-shipped">Maksimal Grosir</label>
									</div>
									<div class="input-field">
										<input id="harga-grosir-product-shipped" type="text" pattern="^\d{1,8}(\.\d{0,2})?$" name="harga-grosir-product-shipped" class="validate" required>
										<label for="harga-grosir-product-shipped">Harga Grosir</label>
									</div>
									<div class="input-field">
										<p>Foto</p>
								        <input type="file" name="upload-foto" required>
									</div>
									<input type="hidden" name="command" value="addProdukShipped">
									<button class="yellow darken-2 black-text waves-effect waves-light btn" id="submit-button" style="margin-top: 10px;">Submit</button>
								</form>
							</div>
						</div>
						<div class="col m2 s12 block"></div>
					</div>
				</div>
			</div>
			<?php } ?>
		</main>
		<?php include("layout/footer.php"); ?>
		<script>
			$(".button-collapse").sideNav();
			$(".indicator").css("background-color: black;");
			$("#category").hide();

			$('#modal-transaksi-pulsa-1').modal();
			$('#modal-transaksi-pulsa-2').modal();
			$('#modal-transaksi-shipped-1').modal();
			$('#modal-transaksi-shipped-2').modal();

			$("#transaksi-pulsa").hide();
			$("#transaksi-shipped").hide();
			$("#daftar-produk-1").hide();
			var forms = 0;
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
				forms++;
				if (forms < 4) {
					var subs = "#sub-category-"+forms;
					$(subs).show();
				}
				if (forms >= 4) {
					$("#subcategory-button").hide();
				}
			});
			$('.datepicker').pickadate({
				selectMonths: true, // Creates a dropdown to control month
				selectYears: 15 // Creates a dropdown of 15 years to control year
			});

			$(document).ready(function() {
				$(".button-collapse").sideNav();
				$(".indicator").css("background-color: black;");
				$("#category").hide();				

				$("#transaksi-pulsa").hide();
				$("#transaksi-shipped").hide();
				$("#daftar-produk-1").hide();
				$("#kembali-transaksi-button").hide();
				$("#lihat-pulsa").hide();
				$("#lihat-shipped").hide();
				$("#lihat-shipped-toko").hide();

				var forms = 0;
				$("#category-button").click(function() {
					$("#category").show();
					$("#category-button").hide();
				});
				$("#transaksi-pulsa-button").click(function() {
					$("#transaksi-pulsa").show();
					$("#transaksi-pulsa-button").hide();
					$("#transaksi-shipped-button").hide();
					$("#kembali-transaksi-button").show();
				});
				$("#transaksi-shipped-button").click(function() {
					$("#transaksi-shipped").show();
					$("#transaksi-pulsa-button").hide();
					$("#transaksi-shipped-button").hide();
					$("#kembali-transaksi-button").show();
				});
				$("#kembali-transaksi-button").click(function() {
					$("#transaksi-pulsa").hide();
					$("#transaksi-shipped").hide();
					$("#kembali-transaksi-button").hide();
					$("#transaksi-pulsa-button").show();
					$("#transaksi-shipped-button").show();
				});
				$("#lihat-pulsa-button").click(function() {
					$("#lihat-pulsa").show();
					$("#lihat-shipped").hide();
				});
				$("#lihat-shipped-button").click(function() {
					$("#lihat-pulsa").hide();
					$("#lihat-shipped").show();
				});
				$("#lihat-produk-button").click(function() {
					$("#lihat-shipped-toko").show();
					$("#lihat-shipped").hide();
				});
				$("#daftar-produk-1-button").click(function() {
					$("#daftar-produk-1").show();
				});
				$("#subcategory-button").click(function() {
					forms++;
					if (forms < 4) {
						var subs = "#sub-category-"+forms;
						$(subs).show();
					}
					if (forms >= 4) {
						$("#subcategory-button").hide();
					}
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

				$.validator.setDefaults({
				        ignore: [],
					    errorElement : 'span',
					    errorClass: "invalid form-error"
				});

				$('select').material_select();
				$('.modal').modal();
				$('.datepicker').pickadate({
					selectMonths: true, // Creates a dropdown to control month
					selectYears: 15 // Creates a dropdown of 15 years to control year
				});

				$.ajax({
					type: "GET",
		          	url: "api.php?command=get_toko",
		          	success: function(data) 
		          	{
		          		var res = JSON.parse(data);
		          		if (res.status == 'success') {
		           			$("#pilih-toko").empty();
		           			var options = '';
		           			options += '<option selected disabled>Pilih toko</option>';
							$.each(res.response, function() {
								options += '<option value="' + this.nama + '">' + this.nama + '</option>';
							});
							$("#pilih-toko").html(options);
							$("#pilih-toko").material_select();
		           		}
		           		else if (res.status == 'failed') {
			           		console.error('Error using API, response: ' + JSON.stringify(res.response));
		           			Materialize.toast('Error terjadi!', 4000); 
		           		}
		          	}
				});
				$('#pilih-toko').change(function() {
					$.ajax({
						type: "GET",
			          	url: "api.php?command=get_kategori_toko&toko=" + $('#pilih-toko').val(),
			           	success: function(data)
			           	{
			           		var res = JSON.parse(data);
			           		if (res.status == 'success') {
			           			$("#pilih-kategori").empty();
			           			var string = '';
			           			string += '<option selected disabled>Pilih Kategori...</option>';
								$.each(res.response, function() {
								    string += '<option value="' + this.kode + '">' + this.nama + '</option>';
								});
								$("#pilih-kategori").html(string);		           	
								$("#pilih-kategori").material_select();		           	
							}
			           		else if (res.status == 'failed') {
			           			console.error('Error using API, response: ' + JSON.stringify(res.response));
			           			Materialize.toast('Error terjadi!', 4000); 
			           		}
			           }
					});
				});
				$('#pilih-kategori').change(function() {
					$.ajax({
						type: "GET",
			          	url: "api.php?command=get_sub_kategori_toko&kategori=" + $('#pilih-kategori').val() + "&toko=" + $('#pilih-toko').val(),
			           	success: function(data)
			           	{
			           		var res = JSON.parse(data);
			           		if (res.status == 'success') {
			           			$("#pilih-sub-kategori").empty();
			           			var string = '';
			           			string += '<option selected disabled>Pilih Sub-kategori...</option>';
								$.each(res.response, function() {
								    string += '<option value="' + this.kode + '">' + this.nama + '</option>';
								});
								$("#pilih-sub-kategori").html(string);		           	
								$("#pilih-sub-kategori").material_select();		           	
							}
			           		else if (res.status == 'failed') {
			           			console.error('Error using API, response: ' + JSON.stringify(res.response));
			           			Materialize.toast('Error terjadi!', 4000); 
			           		}
			           }
					});
				});
				$('#pilih-sub-kategori').change(function() {
					$.ajax({
						type: "GET",
			          	url: "api.php?command=get_daftar_barang&subkategori=" + $('#pilih-sub-kategori').val() + "&toko=" + $('#pilih-toko').val(),
			           	success: function(data)
			           	{
			           		var res = JSON.parse(data);
			           		if (res.status == 'success') {
			           			$("#daftar-produk-shipped").empty();
			           			var string = '';

			           			string += '<table class="striped"><thead><tr><th>Kode Produk</th><th>Nama Produk</th><th>Harga</th><th>Deskripsi</th><th>Is Asuransi</th><th>Stok</th><th>Is Baru</th><th>Harga Grosir</th><th>Beli</th></tr></thead><tbody>';

								$.each(res.response, function() {
								    string += '<tr>';
								    string += '<td>' + this.kode_produk +'</td>';
								    string += '<td>' + this.nama + '</td>';
								    string += '<td>' + this.harga +'</td>';
								    string += '<td>' + this.deskripsi +'</td>';
								    string += '<td>' + this.is_asuransi +'</td>';
								    string += '<td>' + this.stok +'</td>';
								    string += '<td>' + this.is_baru +'</td>';
								    string += '<td>' + this.harga_grosir +'</td>';
								    string += '</tr>';
								});
								string += '</tbody></table>';
								$("#daftar-produk-shipped").html(string);		           	
								$("#daftar-produk-shipped").material_select();		           	
							}
			           		else if (res.status == 'failed') {
			           			console.error('Error using API, response: ' + JSON.stringify(res.response));
			           			Materialize.toast('Error terjadi!', 4000); 
			           		}
			           }
					});
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
		           			options += '<option selected disabled>Pilih kategori</option>';
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
					$('#create-promo-form').valid();
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
								$("#create-promo-form label[for='promo-subkategori']").addClass('active');			           	
							}
			           		else if (res.status == 'failed') {
			           			console.error('Error using API, response: ' + JSON.stringify(res.response));
			           			Materialize.toast('Error terjadi!', 4000); 
			           		}
			           }
			       });
				});
				$('#promo-subkategori').change(function() {
					$('#create-promo-form').valid();
				})

				$('#create-jasa-kirim-form').validate({
				    rules: {
				      "jasa-kirim-nama": {
				        required: true
				      },
				      "jasa-kirim-lama-kirim": {
				        required: true
				      },
				      "jasa-kirim-tarif": {
				      	required: true
				      },
				    },
				    messages: {},
				    errorPlacement: function(error, element) {
				        error.appendTo( element.parent() );
				    }
				});

				$("#create-jasa-kirim-form").submit(function(e) {
					if (!$(this).valid()) {
						e.preventDefault();
						return false;
					}

				    var url = "api.php?command=create_jasa_kirim"; // the script where you handle the form input.
				    $.ajax({
			           type: "POST",
			           url: url,
			           data: $("#create-jasa-kirim-form").serialize(), // serializes the form's elements.
			           success: function(data)
			           {
			           		try {
		           				var res = JSON.parse(data);
				           		if (res.status == 'success') {
				           			Materialize.toast('Pembuatan Jasa Kirim berhasil!', 4000); 
									$('ul.tabs').tabs('select_tab', 'test1');
				           		}
				           		else if (res.status == 'failed') {
				           			console.error('Error using API, response: ' + JSON.stringify(res.response));
				           			Materialize.toast('Pembuatan Jasa Kirim gagal!<br/>Nama Jasa Kirim sudah ada!', 4000); 
				           		}
			           		}
			           		catch ($e) {
			           			console.log('Error: ' + $e);
			           			Materialize.toast('Pembuatan Jasa Kirim gagal!<br/>Nama Jasa Kirim sudah ada!', 4000);
			           		} 
			           }
			      	});
				    e.preventDefault(); // avoid to execute the actual submit of the form.
				});

				$('#create-promo-form').validate({
				    rules: {
				      "promo-periode-awal": {
				        required: true
				      },
				      "promo-periode-akhir": {
				        required: true
				      },
				      "promo-kategori": {
				      	required: true
				      },
				      "promo-subkategori": {
				      	required: true
				      }
				    },
				    messages: {},
				    errorPlacement: function(error, element) {
				        error.appendTo( element.parent() );
				    }
				});

				$("#create-promo-form").submit(function(e) {
					if (!$(this).valid()) {
						e.preventDefault();
						return false;
					}

				    var url = "api.php?command=create_promo"; // the script where you handle the form input
				    $.ajax({
			           type: "POST",
			           url: url,
			           data: $("#create-promo-form").serialize(), // serializes the form's elements.
			           success: function(data)
			           {
			           		try {
				           		var res = JSON.parse(data);
				           		if (res.status == 'success') {
				           			Materialize.toast('Pembuatan Promo berhasil!', 4000); 
									$('ul.tabs').tabs('select_tab', 'test1');
				           		}
				           		else if (res.status == 'failed') {
				           			console.error('Error using API, response: ' + JSON.stringify(res.response));
				           			Materialize.toast('Pembuatan Promo gagal!<br/>Kode promo maksimal 20 karakter!', 4000); 
				           		}
				           	}
			           		catch ($e) {
			           			console.log('Error: ' + $e);
			           			Materialize.toast('Pembuatan Promo gagal!<br/>Kode promo maksimal 20 karakter!',4000);
			           		}
			           }
			      	});
				    e.preventDefault(); // avoid to execute the actual submit of the form.
				});

				$('#review-form').validate({
					rules: {
				      "ulasan-kode-produk": {
				        required: true
				      },
				      "ulasan-rating": {
				        required: true
				      },
				    },
				    messages: {},
				    errorPlacement: function(error, element) {
				        error.appendTo( element.parent() );
				    }
				});

				$('.review-btn').click(function() {
					$('#modal-review #ulasan-kode-produk').val($(this).attr('data-kode-produk'));
					$('#modal-review').modal('open');
				});

				$("#review-form").submit(function(e) {
					if (!$(this).valid()) {
						e.preventDefault();
						return false;
					}

				    var url = "api.php?command=create_review"; // the script where you handle the form input
				    $.ajax({
			           type: "POST",
			           url: url,
			           data: $("#review-form").serialize(), // serializes the form's elements.
			           success: function(data)
			           {
			           		try {
				           		var res = JSON.parse(data);
				           		if (res.status == 'success') {
				           			Materialize.toast('Pembuatan Review berhasil!', 4000); 
									$('#modal-review').modal('close');
				           		}
				           		else if (res.status == 'failed') {
				           			console.error('Error using API, response: ' + JSON.stringify(res.response));
				           			Materialize.toast('Pembuatan Review gagal!<br/>Anda sudah pernah mereview produk ini!', 4000); 
				           		}
				           	}
			           		catch ($e) {
			           			console.log('Error: ' + $e);
			           			Materialize.toast('Pembuatan Review gagal!<br/>Anda sudah pernah mereview produk ini!', 4000);
			           		}
			           }
			      	});
				    e.preventDefault(); // avoid to execute the actual submit of the form.
				});
				$('#promo-periode-awal').change(function() {
					$('#create-promo-form').valid();
					var startDate = new Date($('#promo-periode-awal').val())
					var endDate = new Date($('#promo-periode-akhir').val())
					if (startDate > endDate)
						$('#promo-periode-akhir').val('');
						
					$('#promo-periode-akhir').pickadate('picker').set('min', startDate);
				});
				$('#promo-periode-akhir').change(function() {
					$('#create-promo-form').valid();
				});
				
				$("#sub1").on("input propertychange", function() {
					var subcode1 = $("#sub1").val();
					if (subcode1 == "") {
						$("#sub-alert-1").html("Bagian ini tidak boleh kosong");
					}
					else {
						$.post("config/config.php", {type: "subcat", typed: subcode1}, function(response) {
						if (response == "benar") {
							$("#sub-alert-1").html("");
						}
						else {
							$("#sub-alert-1").html("Kode tidak unik atau sudah ada");
						}
					});
					}
				});

				$("#sub2").on("input propertychange", function() {
					var subcode2 = $("#sub2").val();
					if (subcode2 == "") {
						$("#sub-alert-2").html("Bagian ini tidak boleh kosong");
					}
					else {
						$.post("config/config.php", {type: "subcat", typed: subcode2}, function(response) {
						if (response == "benar") {
							$("#sub-alert-2").html("");
						}
						else {
							$("#sub-alert-2").html("Kode tidak unik atau sudah ada");
						}
					});
					}

					
				});

				$("#sub3").on("input propertychange", function() {
					var subcode3 = $("#sub3").val();
					if (subcode3 == "") {
						$("#sub-alert-3").html("Bagian ini tidak boleh kosong");
					}
					else {
						$.post("config/config.php", {type: "subcat", typed: subcode3}, function(response) {
						if (response == "benar") {
							$("#sub-alert-3").html("");
						}
						else {
							$("#sub-alert-3").html("Kode tidak unik atau sudah ada");
						}
					});
					}			
				});

				$("#sub4").on("input propertychange", function() {
					var subcode4 = $("#sub4").val();
					if (subcode4 == "") {
						$("#sub-alert-4").html("Bagian ini tidak boleh kosong");
					}
					else {
						$.post("config/config.php", {type: "subcat", typed: subcode4}, function(response) {
						if (response == "benar") {
							$("#sub-alert-4").html("");
						}
						else {
							$("#sub-alert-4").html("Kode tidak unik atau sudah ada");
						}
					});
					}
				});

				$("#submit-button").on("click", function() {
					if (forms == 1) {
						$.post("config/config.php", {
							submit: "category1",
							categorycode: $("#category-code").val(),
							categoryname: $("#category-name").val(),
							subcat1: $("#sub1").val(),
							subcatname1: $("#subname1").val()
						}, function(response) {
							if (response == "sukses") {
								$("#alert-category1").html("Kategori berhasil dibuat");
								$("#alert-category2").html("");
							}
							else {
								$("#alert-category1").html("");
								$("#alert-category2").html("Periksa kembali input anda");
							}
						});
					}
					else if (forms == 2) {
						$.post("config/config.php", {
							submit: "category2",
							categorycode: $("#category-code").val(),
							categoryname: $("#category-name").val(),
							subcat1: $("#sub1").val(),
							subcatname1: $("#subname1").val(),
							subcat2: $("#sub2").val(),
							subcatname2: $("#subname2").val()
						}, function(response) {
							if (response == "sukses") {
								$("#alert-category1").html("Kategori berhasil dibuat");
								$("#alert-category2").html("");
							}
							else {
								$("#alert-category1").html("");
								$("#alert-category2").html("Periksa kembali input anda");
							}
						});
					}
					else if (forms == 3) {
						$.post("config/config.php", {
							submit: "category3",
							categorycode: $("#category-code").val(),
							categoryname: $("#category-name").val(),
							subcat1: $("#sub1").val(),
							subcatname1: $("#subname1").val(),
							subcat2: $("#sub2").val(),
							subcatname2: $("#subname2").val(),
							subcat3: $("#sub3").val(),
							subcatname3: $("#subname3").val()
						}, function(response) {
							if (response == "sukses") {
								$("#alert-category1").html("Kategori berhasil dibuat");
								$("#alert-category2").html("");
							}
							else {
								$("#alert-category1").html("");
								$("#alert-category2").html("Periksa kembali input anda");
							}
						});
					}
					else if (forms == 4) {
						$.post("config/config.php", {
							submit: "category4",
							categorycode: $("#category-code").val(),
							categoryname: $("#category-name").val(),
							subcat1: $("#sub1").val(),
							subcatname1: $("#subname1").val(),
							subcat2: $("#sub2").val(),
							subcatname2: $("#subname2").val(),
							subcat3: $("#sub3").val(),
							subcatname3: $("#subname3").val(),
							subcat3: $("#sub4").val(),
							subcatname3: $("#subname4").val()
						}, function(response) {
							if (response == "sukses") {
								$("#alert-category1").html("Kategori berhasil dibuat");
								$("#alert-category2").html("");
							}
							else {
								$("#alert-category1").html("");
								$("#alert-category2").html("Periksa kembali input anda");
							}
						});
					}
				});
				$('#create-product-shipped').ready(function(){
					$("select").material_select();
					$("select[required]").css({display: "block", height: 0, padding: 0, width: 0, position: 'absolute'});
				});
			});
		</script>
	</body>
</html>