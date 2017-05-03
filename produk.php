<!DOCTYPE html>
<html>
	<head>
		<?php include("head.php");?>
	</head>
	<body>
		<?php include("navbar.php");?>
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
					<div class="container">
						<td><a class="waves-effect waves-light btn" href="#modal1">beli</a></td>
					</div>
				</tr>
				<tr>
					<td>P0000002</td>
					<td>Pulsa XL</td>
					<td>12000</td>
					<td></td>
					<td>10</td>
					<div class="container">
						<td><a class="waves-effect waves-light btn" href="#modal2">beli</a></td>
					</div>
				</tr>
			</tbody>
		</table>
		<div id="modal1" class="modal">
	    <div class="modal-content">
	      <h4>FORM MEMBELI PRODUK PULSA</h4>
	      <div class="row">
	      	<p>Kode Produk: P0000001</p>
	      	<form class="col s12">
	      		<div class="input-field col s6">
          			No Telepon: <input placeholder="Placeholder" id="no_telepon" type="tel" class="validate">
          		</div>
          	</form>
	      </div>
	    </div>
	    <div class="modal-footer">
	      <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Agree</a>
	    </div>
	 	</div>
	 	<div id="modal2" class="modal">
	    <div class="modal-content">
	      <h4>FORM MEMBELI PRODUK PULSA</h4>
	      <div class="row">
	      	<p>Kode Produk: P0000002</p>
	      	<form class="col s12">
	      		<div class="input-field col s6">
          			No Telepon: <input placeholder="Placeholder" id="no_telepon" type="tel" class="validate">
          		</div>
          	</form>
	      </div>
	    </div>
	    <div class="modal-footer">
	      <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Agree</a>
	    </div>
	 	</div>
		</div>
		<?php include("footer.php");?>
		<?php include("script.php");?>
	</body>
</html>