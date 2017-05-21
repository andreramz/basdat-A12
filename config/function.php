<?php
	require( __DIR__.'/../config.php');
	function connectDB() {
		$host = $GLOBALS['DB_HOST'];
		$dbname = $GLOBALS['DB_NAME'];
		$username = $GLOBALS['DB_USERNAME'];
		$password = $GLOBALS['DB_PASS'];

		$connect = pg_connect("host=".$host." dbname=".$dbname." user=".$username." password=".$password);
		return $connect;
	}

	function lihat_transaksi_pulsa($email) {
		$connectDB = connectDB();
		$sql = "SELECT T.no_invoice, P.nama, T.tanggal, T.status, T.total_bayar, T.nominal, T.nomor FROM tokokeren.PRODUK AS P, tokokeren.TRANSAKSI_PULSA AS T WHERE T.email_pembeli = '".$email."' AND T.kode_produk = P.kode_produk";

		return pg_query($connectDB, $sql);
	}
	
	function lihat_transaksi_shipped($email) {
		$connectDB = connectDB();
		$sql = "SELECT T.no_invoice, T.nama_toko, T.tanggal, T.status, T.total_bayar, T.alamat_kirim, T.biaya_kirim, T.no_resi, T.nama_jasa_kirim FROM tokokeren.TRANSAKSI_SHIPPED AS T WHERE T.email_pembeli = '".$email."'";

		return pg_query($connectDB, $sql);
	}

	function lihat_daftar_produk($no_invoice) {
		$connectDB = connectDB();
		$sql = "SELECT P.kode_produk, P.nama, L.berat, L.kuantitas, L.harga, L.sub_total FROM tokokeren.PRODUK AS P, tokokeren.LIST_ITEM AS L WHERE L.no_invoice = '".$no_invoice."' AND L.kode_produk = P.kode_produk";

		return pg_query($connectDB, $sql);
	}

	function lihat_produk_pulsa() {
		$connectDB = connectDB();
		$sql = "SELECT P.kode_produk, P.nama, P.harga, P.deskripsi, PP.nominal FROM tokokeren.PRODUK AS P, tokokeren.PRODUK_PULSA AS PP WHERE P.kode_produk = PP.kode_produk";

		return pg_query($connectDB, $sql);
	}

	function lihat_toko()
	{
		$connectDB = connectDB();
		$sql = "SELECT T.nama FROM tokokeren.TOKO AS T";

		return pg_query($connectDB, $sql);
	}

	function lihat_shipped_toko($sub_kategori, $toko)
	{
		$connectDB = connectDB();
		$sql = "SELECT SP.kode_produk, P.nama, P.harga, P.deskripsi, SP.is_asuransi, SP.stok, SP.is_baru, SP.harga_grosir FROM tokokeren.SHIPPED_PRODUK AS SP, tokokeren.PRODUK AS P, tokokeren.TOKO WHERE SP.kode_produk = P.kode_produk AND SP.kategori = '".$sub_kategori."' AND SP.nama_toko = '".$toko."'";

		return pg_query($connectDB, $sql);
	}
?>