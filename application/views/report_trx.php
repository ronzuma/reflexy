<!DOCTYPE html>
<html>
<head>
	<?php $this->load->helper('nominal');?>
	<?php $this->load->view('include/head.php'); ?>
	<link rel="stylesheet" type="text/css" href="<?php echo config_item('assets'); ?>src/plugins/datatables/media/css/jquery.dataTables.css">
	<link rel="stylesheet" type="text/css" href="<?php echo config_item('assets'); ?>src/plugins/datatables/media/css/dataTables.bootstrap4.css">
	<link rel="stylesheet" type="text/css" href="<?php echo config_item('assets'); ?>src/plugins/datatables/media/css/responsive.dataTables.css">
</head>
<body>
	<?php $this->load->view('include/header.php'); ?>
	<?php $this->load->view('include/sidebar.php'); ?>
	<div class="main-container">
		<div class="pd-ltr-20 customscroll customscroll-10-p height-100-p xs-pd-20-10">
			<div class="min-height-200px">
				<div class="page-header">
					<div class="row">
						<div class="col-md-6 col-sm-12">
							<nav aria-label="breadcrumb" role="navigation">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="index.php">Report</a></li>
									<li class="breadcrumb-item active" aria-current="page">Data Transaksi</li>
								</ol>
							</nav>
						</div>
					</div>
				</div>
				<!-- Simple Datatable start -->
				<div class="pd-20 bg-white border-radius-4 box-shadow mb-30">
					<div class="clearfix mb-20">
						<div class="pull-left">
							<h5 class="text-blue">Data Transaksi</h5>
						</div>
					</div>
					<div class="row">
						<table class="data-table stripe hover nowrap">
							<thead>
								<tr>
									<th>Tanggal</th>
									<th>No. Nota</th>
									<th>Nama Trapis</th>
									<th>Paket</th>
									<th>Bekam</th>
									<th>Nominal</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($transaksi as $trx): ?>
								<tr>
									<td width="150">
										<?php echo date('Y-m-d', strtotime($trx->tgl_trx))?>
									</td>
									<td width="150">
										<?php echo $trx->no_transaksi?>
									</td>
									<td>
										<?php echo $trx->nama_trapis ?>
									</td>
									<td>
										<?php echo $trx->paket ?>
									</td>
									<td>
										<?php echo $trx->titik_bekam." Titik" ?>
									</td>
									<td align="right">
										<?php echo nominal($trx->total) ?>
									</td>
									<td>
										<form action="<?php echo base_url();?>Report/cetak_ulang/<?php echo $trx->no_transaksi;?>" method="post">
											<button class="btn" data-bgcolor="#3d464d" data-color="#ffffff"><i class="icon-copy fa fa-print" aria-hidden="true"></i> Print</button>
										</form>
									</td>
								</tr>
								<?php endforeach; ?>

							</tbody>
						</table>
					</div>
				</div>
				<!-- Simple Datatable End -->
			</div>
		</div>
	</div>
	<?php $this->load->view('include/script.php'); ?>
	<script src="<?php echo config_item('assets'); ?>src/plugins/datatables/media/js/jquery.dataTables.min.js"></script>
	<script src="<?php echo config_item('assets'); ?>src/plugins/datatables/media/js/dataTables.bootstrap4.js"></script>
	<script src="<?php echo config_item('assets'); ?>src/plugins/datatables/media/js/dataTables.responsive.js"></script>
	<script src="<?php echo config_item('assets'); ?>src/plugins/datatables/media/js/responsive.bootstrap4.js"></script>
	<!-- buttons for Export datatable -->
	<script src="<?php echo config_item('assets'); ?>src/plugins/datatables/media/js/button/dataTables.buttons.js"></script>
	<script src="<?php echo config_item('assets'); ?>src/plugins/datatables/media/js/button/buttons.bootstrap4.js"></script>
	<script src="<?php echo config_item('assets'); ?>src/plugins/datatables/media/js/button/buttons.print.js"></script>
	<script src="<?php echo config_item('assets'); ?>src/plugins/datatables/media/js/button/buttons.html5.js"></script>
	<script src="<?php echo config_item('assets'); ?>src/plugins/datatables/media/js/button/buttons.flash.js"></script>
	<script src="<?php echo config_item('assets'); ?>src/plugins/datatables/media/js/button/pdfmake.min.js"></script>
	<script src="<?php echo config_item('assets'); ?>src/plugins/datatables/media/js/button/vfs_fonts.js"></script>
	<script>
		$('document').ready(function(){
			$('.data-table').DataTable({
				scrollCollapse: true,
				autoWidth: false,
				responsive: true,
				columnDefs: [{
					targets: "datatable-nosort",
					orderable: false,
				}],
				"lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
				"language": {
					"info": "_START_-_END_ of _TOTAL_ entries",
					searchPlaceholder: "Search"
				},
			});
			$('.data-table-export').DataTable({
				scrollCollapse: true,
				autoWidth: false,
				responsive: true,
				columnDefs: [{
					targets: "datatable-nosort",
					orderable: false,
				}],
				"lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
				"language": {
					"info": "_START_-_END_ of _TOTAL_ entries",
					searchPlaceholder: "Search"
				},
				dom: 'Bfrtip',
				buttons: [
				'copy', 'csv', 'pdf', 'print'
				]
			});
			var table = $('.select-row').DataTable();
			$('.select-row tbody').on('click', 'tr', function () {
				if ($(this).hasClass('selected')) {
					$(this).removeClass('selected');
				}
				else {
					table.$('tr.selected').removeClass('selected');
					$(this).addClass('selected');
				}
			});
			var multipletable = $('.multiple-select-row').DataTable();
			$('.multiple-select-row tbody').on('click', 'tr', function () {
				$(this).toggleClass('selected');
			});
		});
	</script>
	<?php $this->load->view('script/jquery_pembuka.php'); ?>
	<?php $this->load->view('script/jquery_change_password.php'); ?>
	<?php $this->load->view('script/jquery_penutup.php'); ?>
</body>
</html>