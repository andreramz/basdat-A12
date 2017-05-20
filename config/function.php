<?php
	function connectDB() {
		$host = "localhost";
		$dbname = "postgres";
		$username = "postgres";
		$password = "marjuan2005";

		$connect = pg_connect("host=".$host." dbname=".$dbname." user=".$username." password=".$password);
		return $connect;
	}

	function lihat_transaksi_pulsa($email) {
		$connectDB = connectDB();
		$sql = "SELECT L.no_invoice, P.nama, T.tanggal, T.status, T.total_bayar, T.nominal, T.nomor FROM tokokeren.LIST_ITEM AS L, tokokeren.PRODUK AS P, tokokeren.TRANSAKSI_PULSA AS T WHERE T.email_pembeli = '".$email."' AND L.no_invoice = T.no_invoice AND L.kode_produk = P.kode_produk";

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

	
?>