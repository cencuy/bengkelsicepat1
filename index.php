<?php
include_once 'header2.php';
include_once 'includes/pembelian.inc.php';
$pro = new Pembelian($db);
$stmt = $pro->readmen();
$stmt2 = $pro->countAll();
?>
<link href="css/style.css" rel="stylesheet">
<style>
	.columns {
		float: left;
		width: 33.3%;
		padding: 8px;
	}

	.price {
		list-style-type: none;
		border: 1px solid #eee;
		margin: 0;
		padding: 0;
		-webkit-transition: 0.3s;
		transition: 0.3s;
	}

	.price:hover {
		box-shadow: 0 8px 12px 0 rgba(0, 0, 0, 0.2)
	}

	.price .header {
		background-color: #1abc9c;
		color: white;
		font-size: 25px;
	}

	.price li {
		border-bottom: 1px solid #eee;
		padding: 20px;
		text-align: center;
	}

	.price .grey {
		background-color: #eee;
		font-size: 20px;
		font-family: Arial;

	}

	.button {
		background-color: #3498db;
		border: none;
		color: white;
		padding: 10px 25px;
		text-align: center;
		text-decoration: none;
		font-size: 18px;
	}

	.button:hover {
		text-decoration: none;
		color: white;
		background-color: #2980b9;
	}

	.green {
		color: green;
	}

	.red {
		color: red;
		background-color: #bbb;
	}

	@media only screen and (max-width: 720px) {
		.columns {
			width: 100%;
		}
	}
</style>
<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-2">

	</div>

	<div class="container">
		<center>
			<h2 style="background-color:#fff;"><b><b>BENGKEL KAMI SIAP MELAYANI
			</h2>
		</center>
		<div class="columns">
			<ul class="price">
				<li class="header"><span class="fa fa-dashboard">TROUBLE SHOOT PROBLEM</span></li>
				<li class="grey">DETEKSI KERUSAKAN</li>
				<li class="red"><span class="green"><b>KERUSAKAN PADA MESIN<span class="green"></li>
				<li class="red"><span class="green"><b>KERUSAKAN PADA SUKU CADANG</span></li>
				<li class="red"><span class="green"><b>KERUSAKAN PADA BODY</span></li>
				<li class="red"><span class="green"><b></b> DAN LAIN LAIN</span></li>
			</ul>
		</div>
		<div class="columns">
			<ul class="price" style="border-color: #777; box-shadow: 1px 2px 8px 2px rgba(0, 0, 0, 0.8);">
				<li class="header" style="background-color:#2980b9;"><span class="fa fa-cogs"> ORDER SPAREPART</li>
				<li class="grey">
					<span>PEMBELIAN SPAPERPART / SUKU CADANG MOTOR</span>
				</li>
				<li class="red"><span class="red">BAN LUAR & DALAM</span></li>
				<li class="red"><span class="red">KACA SPION<span></li>
				<li class="red"><span class="red">KABEL GAS</span></li>
				<li class="red"><span class="red">JARI-JARI</span></li>
				<li class="red"><span class="red">BUSI</span></li>
				<li class="red"><span class="red">DAN LAIN LAIN</span></li>
				<li class="grey"><a href="stok.php" class="button"><span class="fa fa-book"> Lihat Persediaan</a></li>
				<li class="grey"><a href="bengkelterdekat.php" class="button"><span class="fa fa-book"> Temukan Bengkel Terdekat</a></li>

			</ul>
		</div>

		<div class="columns">
			<ul class="price">
				<li class="header"><span class="fa fa-wrench"> SERVICE MESIN</span></li>
				<li class="grey">PERBAIKI MESIN</li>
				<li class="red"><span class="green"><b>PENUTUP OLI BOCOR<span class="green"></li>
				<li class="red"><span class="green"><b>KARBULATOR RUSAK</span></li>
				<li class="red"><span class="green"><b>GANTI PISTON</span></li>
				<li class="red"><span class="green"><b></b> DAN LAIN LAIN</span></li>
			</ul>
		</div>
	</div><br><br><br>


	<div id="chartContainer" style="height: 400px; width: 100%;"></div>
	<br />





	<footer class="text-center">BENGKEL SICEPAT &copy; 2025</footer>
</div>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="js/jquery-1.11.3.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="js/bootstrap.min.js"></script>
<script src="js/highcharts.js"></script>
<script src="js/exporting.js"></script>
<script src="js/canvasjs.min.js"></script>
<script type="text/javascript">
	window.onload = function() {
		var chart = new CanvasJS.Chart("chartContainer", {
			title: {
				text: "Data Service"
			},
			data: [{
				type: "column",
				dataPoints: [
					<?php
					$conn = mysql_connect("localhost", "root", "");
					mysql_select_db("bengkel", $conn);

					$query = mysql_query("SELECT * FROM 213_mekanik ");
					while ($row = mysql_fetch_assoc($query)) {
						$id     = $row['id_mekanik'];
						$inama     = $row['nama_mekanik'];


						$data = mysql_fetch_array(mysql_query("SELECT count(id_mekanik) as jumlah FROM 213_pembelian where id_mekanik='$id'"));
						$jumlah = $data['jumlah'];

					?> {
							y: <?php echo $jumlah ?>,
							label: "<?php echo "$inama"; ?>"
						},
					<?php } ?>
				]
			}]
		});
		chart.render();
	}
</script>
</body>

</html>