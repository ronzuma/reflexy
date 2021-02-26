<!DOCTYPE html>
<html>
<head>
	<?php $this->load->helper('nominal');?>
	<?php include('include/head.php'); ?>
</head>
<body>
	<?php include('include/header.php'); ?>
	<?php include('include/sidebar.php'); ?>
	<div class="main-container">
		<div class="pd-ltr-20 customscroll customscroll-10-p height-100-p xs-pd-20-10">
			<div class="min-height-200px">
				<div class="container pd-0">
					<div class="page-header">
						<div class="row">
							<div class="col-md-12 col-sm-12">
								<div class="title">
									<h4>Trapis</h4>
								</div>
								<nav aria-label="breadcrumb" role="navigation">
									<ol class="breadcrumb">
										<li class="breadcrumb-item"><a href="index.php">Home</a></li>
										<li class="breadcrumb-item active" aria-current="page">Data Trapis</li>
									</ol>
								</nav>
							</div>
						</div>
					</div>
					<div class="contact-directory-list">
						<ul class="row">
							<?php foreach ($trapis as $trps): ?>
							<li class="col-xl-4 col-lg-4 col-md-6 col-sm-12">
								<div class="contact-directory-box">
									
									<?php
										if ($trps->available=='1'){
											echo'
												<div class="contact-dire-info text-center">
													<div class="contact-avatar">
														<span>
															<a data-toggle="modal" data-toggle="modal" data-target="#edit_paket'.$trps->id_trapis.'">
																<img src="';echo config_item('assets'); echo 'vendors/images/'.$trps->foto.'" alt="">
															</a>
														</span>
													</div>
													<div class="contact-name">
														<h4>'.$trps->nama.'</h4>											
														<div class="work text-success"><i class="icon-copy ion-clock"></i> '.date('H:i:s', strtotime($trps->startDate)).'</div>
														<div class="work text-danger"><i class="icon-copy ion-clock"></i> '.date('H:i:s', strtotime($trps->endDate)).'</div>
													</div>
													<div class="contact-skill">
														<span class="badge badge-pill" data-bgcolor="#f46f30" data-color="#ffffff">'.$trps->nama_paket.'</span>
													</div>
													<div class="contact-name">
														'.$trps->keterangan.'
													</div>
												</div>
												<div class="view-contact">
													<a class="btn btn-sm scroll-click" data-toggle="modal" data-toggle="modal" data-target="#alert-modal'.$trps->id_trapis.'" data-bgcolor="#6495ED" data-color="#ffffff"><i class="icon-copy fa fa-check" aria-hidden="true"></i> Finish</a>
												</div>
											';
										}else{
											echo '
												<div class="contact-dire-info text-center">
													<div class="contact-avatar">
														<span>
															<img src="';echo config_item('assets'); echo 'vendors/images/'.$trps->foto.'" alt="">
														</span>
													</div>
													<div class="contact-name">
														<h4>'.$trps->nama.'</h4>											
														<div class="work text-success"><i class="icon-copy ion-clock"></i> 00:00:00 </div>
														<div class="work text-danger"><i class="icon-copy ion-clock"></i> 00:00:00 </div>
													</div>
													<div class="contact-skill">														
														<span class="badge badge-pill badge-primary"> Available </span>
													</div>
													<div class="contact-name">
														-
													</div>
												</div>
												<div class="view-contact">
													<a class="btn btn-sm scroll-click" data-toggle="modal" data-toggle="modal" data-target="#modal_edit'.$trps->id_trapis.'" data-bgcolor="#00b489" data-color="#ffffff"><i class="icon-copy fa fa-plus"></i> Start</a>
												</div>
											';											
										}
									?>
								
								
								
									
									
									
									
								</div>
							</li>
							<?php endforeach; ?>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!--Modal Edit-->
	<?php foreach($trapis as $trps):?>
	<?php echo form_open('Main_menu/add_service') ?>	
		<div class="modal fade" id="modal_edit<?php echo $trps->id_trapis;?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title" id="myLargeModalLabel">Paket Service</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					</div>					
					<div class="modal-body">
						<input type="text" name="id_trapis" id="id_trapis" value="<?php echo $trps->id_trapis?>" hidden>
						<div class="form-group row">
							<label class="col-sm-12 col-md-2 col-form-label">Trapis</label>
							<div class="col-md-10 col-sm-12">
								<input class="form-control" type="text" name="trapis" id="trapis" value="<?php echo $trps->nama?>" readonly>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-12 col-md-2 col-form-label">Paket</label>
							<div class="col-sm-12 col-md-10">
								<select class="form-control" name="id_paket" id='id_paket'>
									<?php 
										foreach ($paket as $pkt) {
											echo "<option value='$pkt[id]'>$pkt[nama]</option>";
										}
									?>
								</select>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-12 col-md-2 col-form-label">Bekam</label>
							<div class="col-sm-12 col-md-10">
								<input class="form-control" type="number" name="titik_bekam" id="titik_bekam" >
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-12 col-md-2 col-form-label">Customer</label>
							<div class="col-sm-12 col-md-10">
								<input class="form-control" type="text" name="nama_cust" id="nama_cust">
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-12 col-md-2 col-form-label">No. Hp</label>
							<div class="col-sm-12 col-md-10">
								<input class="form-control" type="number" name="telp" id="telp">
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
						<button class="btn btn-warning">Save</button>
					</div>
				</div>
			</div>
		</div>
	<?php echo form_close(); ?>
	<?php endforeach;?>


	<?php foreach($trapis as $trps):?>
	<form action="<?php echo base_url();?>Main_menu/finish_service" method="post">
		<div class="modal fade" id="alert-modal<?php echo $trps->id_trapis;?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-sm modal-dialog-centered">
				<div class="modal-content bg-danger text-white">
					<div class="modal-body text-center">
						<input type="text" name="id_trapis" id="id_trapis" value="<?php echo $trps->id_trapis?>" hidden>
						<input type="text" name="no_transaksi" id="no_transaksi" value="<?php echo $trps->no_transaksi?>" hidden>
						<h3 class="text-white mb-15"><i class="fa fa-exclamation-triangle"></i> <?php echo $trps->nama?></h3>
						<p>Paket <?php echo $trps->nama_paket; ?> an <?php echo $trps->cust; ?> Telah Selesai.</p>
						<p>Total: <?php echo nominal($trps->total); ?>.</p>
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
						<button class="btn btn-warning" onClick="window.location.reload();">Save</button>
					</div>
				</div>
			</div>
		</div>
	</form>
	<?php endforeach;?>
	

	<!--Modal Edit-->
	<?php foreach($edit as $trps):?>
	<?php echo form_open('Main_menu/edit_service') ?>	
		<div class="modal fade" id="edit_paket<?php echo $trps->id_trapis;?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title" id="myLargeModalLabel">Paket Service</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					</div>					
					<div class="modal-body">
						<input type="text" name="id_trapis" id="id_trapis" value="<?php echo $trps->id_trapis?>" hidden>
						<input type="text" name="no_transaksi" id="no_transaksi" value="<?php echo $trps->no_transaksi?>" hidden>
						<input type="text" name="startDate" id="startDate" value="<?php echo $trps->startDate?>" hidden>
						<div class="form-group row">
							<label class="col-sm-12 col-md-2 col-form-label">Trapis</label>
							<div class="col-md-10 col-sm-12">
								<input class="form-control" type="text" name="trapis" id="trapis" value="<?php echo $trps->nama?>" readonly>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-12 col-md-2 col-form-label">Paket</label>
							<div class="col-sm-12 col-md-10">
								<select class="form-control" name="id_paket" id='id_paket'>
									<?php 
										foreach ($paket as $pkt) {
											if ($trps->id_paket==$pkt[id])
												echo "<option value='$pkt[id]' selected>$pkt[nama]</option>";
												else
												echo "<option value='$pkt[id]'>$pkt[nama]</option>";
										}
									?>
								</select>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-12 col-md-2 col-form-label">Bekam</label>
							<div class="col-sm-12 col-md-10">
								<input class="form-control" type="number" name="titik_bekam" id="titik_bekam" value="<?php echo $trps->titik_bekam?>">
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-12 col-md-2 col-form-label">Customer</label>
							<div class="col-sm-12 col-md-10">
								<input class="form-control" type="text" name="nama_cust" id="nama_cust" value="<?php echo $trps->customer?>">
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-12 col-md-2 col-form-label">No. Hp</label>
							<div class="col-sm-12 col-md-10">
								<input class="form-control" type="number" name="telp" id="telp" value="<?php echo $trps->no_telp?>">
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
						<button class="btn btn-warning">Save</button>
					</div>
				</div>
			</div>
		</div>
	<?php echo form_close(); ?>
	<?php endforeach;?>
	
	<?php include('include/script.php'); ?>
</body>
</html>