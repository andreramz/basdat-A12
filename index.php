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
							    <li class="tab"><a class="black-text" href="#create-product-pulsa"><strong>Buat Produk Pulsa</strong></a></li>
							    <?php } ?>
							    <?php if (isset($_SESSION['logged']) && $_SESSION['role'] == 'pembeli') { ?>
							    <li class="tab"><a class="black-text" href="#create-toko"><strong>Buat Toko</strong></a></li>
							    <?php } ?>

							    <?php if (isset($_SESSION['logged']) && ($_SESSION['role'] == 'penjual' || $_SESSION['role'] == 'pembeli')) { ?>
								<li class="tab"><a class="black-text" href="#see-transaksi"><strong>Lihat Transaksi</strong></a></li>
								<?php } ?>

							    <?php if (isset($_SESSION['logged']) && $_SESSION['role'] == 'penjual') { ?>
							    <li class="tab"><a class="black-text" href="#create-product-shipped"><strong>Buat Produk Pulsa</strong></a></li>

							    <?php } ?>
					    	</ul>
						</div>			
					</div>
					<div class="col m1 l2"></div>
				</div>
			</div>
			<?php if (isset($_SESSION['logged']) && ($_SESSION['role'] == 'penjual' || $_SESSION['role'] == 'pembeli')) { ?>
			<div id="see-transaksi" class="col s12">
				<div class="container">
					<div class="row">
						<div class="col m2 s12 block"></div>
						<div class="col m8 s12 block">
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
											<th>Ulasan</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>P0000001</td>
											<td>Pulsa IM3</td>
											<td>4/1/2016</td>
											<td>SUDAH DIBAYAR</td>
											<td>12000</td>
											<td>10</td>
											<td>081317963432</td>
											<td><a class="waves-effect waves-light btn" href="#modal-transaksi-pulsa-1">ULAS</a></td>
										</tr>
										<tr>
											<td>P0000002</td>
											<td>Listrik PLN</td>
											<td>4/1/2016</td>
											<td>BELUM DIBAYAR</td>
											<td>23000</td>
											<td>20</td>
											<td>081532532231</td>
											<td><a class="waves-effect waves-light btn" href="#modal-transaksi-pulsa-2">ULAS</a></td>
										</tr>
									</tbody>
								</table>
							</div>
							<div id="modal-transaksi-pulsa-1" class="modal">
								<form onsubmit="Materialize.toast('Pembuatan ulasan berhasil!', 4000); $('#modal-transaksi-pulsa-1').modal('close'); return false;">
							  	<div class="modal-content">
									<div class="input-field">
										<input id="ulasan-kode-produk" type="text" name="ulasan-kode-produk" class="validate" value="P0000001" disabled required>
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
							<div id="modal-transaksi-pulsa-2" class="modal">
								<form onsubmit="Materialize.toast('Pembuatan ulasan berhasil!', 4000); $('#modal-transaksi-pulsa-2').modal('close'); return false;">
							  	<div class="modal-content">
									<div class="input-field">
										<input id="ulasan-kode-produk" type="text" name="ulasan-kode-produk" class="validate" value="P0000002" disabled required>
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
										<tr>
											<td>S0000001</td>
											<td>Fashion Keren</td>
											<td>4/1/2016</td>
											<td>BARANG SUDAH DIBAYAR</td>
											<td>12000</td>
											<td>Jl Veteran 45, Depok</td>
											<td>25000</td>
											<td>DPK9817421231</td>
											<td>JNE OKE</td>
											<td><a id="daftar-produk-1-button" class="waves-effect waves-light btn" href="#daftar-produk-1">DAFTAR PRODUK</a></td>
										</tr>
									</tbody>
								</table>
							</div>
							<div id="daftar-produk-1" class="card-panel yellow lighten-3 black-text">
								<table class="striped">
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
									<tbody>
										<tr>
											<td>Celana bagus 1</td>
											<td>4</td>
											<td>4</td>
											<td>20000</td>
											<td>80000</td>
											<td><a class="waves-effect waves-light btn" href="#modal-transaksi-shipped-1">ULAS</a></td>
										</tr>
										<tr>
											<td>Baju cantik 2</td>
											<td>1</td>
											<td>1</td>
											<td>15000</td>
											<td>15000</td>
											<td><a class="waves-effect waves-light btn" href="#modal-transaksi-shipped-2">ULAS</a></td>
										</tr>
									</tbody>
								</table>
							</div>
							<div id="modal-transaksi-shipped-1" class="modal">
								<form onsubmit="Materialize.toast('Pembuatan ulasan berhasil!', 4000); $('#modal-transaksi-shipped-1').modal('close'); return false;">
							  	<div class="modal-content">
									<div class="input-field">
										<input id="ulasan-kode-produk" type="text" name="ulasan-kode-produk" class="validate" value="S0000001" disabled required>
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
							<div id="modal-transaksi-shipped-2" class="modal">
								<form onsubmit="Materialize.toast('Pembuatan ulasan berhasil!', 4000); $('#modal-transaksi-shipped-2').modal('close'); return false;">
							  	<div class="modal-content">
									<div class="input-field">
										<input id="ulasan-kode-produk" type="text" name="ulasan-kode-produk" class="validate" value="S0000002" disabled required>
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
			<div id="create-product-pulsa" class="col s12">
				<div class="container">
					<div class="row">
						<div class="col m2 s12 block"></div>
						<div class="col m8 s12 block">
							<div class="card-panel yellow lighten-3 black-text">
								<form onsubmit="Materialize.toast('Pembuatan Produk Pulsa berhasil!', 4000); $('ul.tabs').tabs('select_tab', 'test1'); return false;">
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
									    <a class='dropdown-button yellow darken-2 black-text waves-effect waves-light btn' href='#' data-activates='dropdown1'>Jasa Kirim</a>
									    <ul id='dropdown1' class='dropdown-content'>
										    <li><a href="#!">one</a></li>
										    <li><a href="#!">two</a></li>
										    <li><a href="#!">three</a></li>
										    <li><a href="#!">view_module</a></li>
										    <li><a href="#!">cloud</a></li>
										</ul>
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
			<?php if (isset($_SESSION['logged']) && $_SESSION['role'] == 'penjual') { ?>
			<div id="create-product-shipped" class="col s12">
				<div class="container">
					<div class="row">
						<div class="col m2 s12 block"></div>
						<div class="col m8 s12 block">
							<div class="card-panel yellow lighten-3 black-text">
								<form action="#" onsubmit="Materialize.toast('Pembuatan Produk Shipped berhasil!', 4000); $('ul.tabs').tabs('select_tab', 'test1'); return false;">
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
										<a class='dropdown-button yellow darken-2 black-text waves-effect waves-light btn' href='#' data-activates='dropdown1'>Sub Kategori</a>
									    <ul id='dropdown1' class='dropdown-content'>
										    <li><a href="#!">one</a></li>
										    <li><a href="#!">two</a></li>
										    <li><a href="#!">three</a></li>
										    <li><a href="#!">view_module</a></li>
										    <li><a href="#!">cloud</a></li>
										</ul>
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
										<div class="btn">
								        	<span>File</span>
								        </div>
								        <input type="file">
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

			$('#modal-transaksi-pulsa-1').modal();
			$('#modal-transaksi-pulsa-2').modal();
			$('#modal-transaksi-shipped-1').modal();
			$('#modal-transaksi-shipped-2').modal();

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