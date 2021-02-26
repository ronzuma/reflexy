	<div class="pre-loader"></div>
	<div class="header clearfix">
		<div class="header-right">
			<div class="brand-logo">
				<a href="index.php">
					<img src="<?php echo config_item('assets'); ?>vendors/images/logo.png" alt="" class="mobile-logo">
				</a>
			</div>
			<div class="menu-icon">
				<span></span>
				<span></span>
				<span></span>
				<span></span>
			</div>
			<div class="user-info-dropdown">
				<div class="dropdown">
					<a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown">
						<span class="user-icon"><i class="fa fa-user-o"></i></span>
						<span class="user-name"><?php echo $this->session->userdata('ap_nama'); ?></span>
					</a>
					<div class="dropdown-menu dropdown-menu-right">
						<a class="dropdown-item" href="#"><i class="fa fa-user-md" aria-hidden="true"></i> Profile</a>
						<a class="dropdown-item" data-toggle="modal" data-target="#modal_edit_user" ><i class="fa fa-cog" aria-hidden="true"></i> Change Password</a>
						<a class="dropdown-item" href="<?php echo site_url('secure/logout'); ?>"><i class="fa fa-sign-out" aria-hidden="true"></i> Log Out</a>
					</div>
				</div>
			</div>
		</div>
	</div>
	<form id='form_change_pass'>
		<div class="modal fade bs-example-modal-lg" id="modal_edit_user" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-lg modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title" id="myLargeModalLabel">Change Password</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					</div>					
					<div class="modal-body">
						<div class="form-group row">
							<div class="col-md-12 col-sm-12">
								<label>Masukan Password Lama:</label>
								<input class="form-control" type="text" name="pass_old" id="pass_old" >
							</div>
						</div>
						<div class="form-group row">
							<div class="col-sm-12 col-md-12">
								<label>Masukan Password Baru:</label>
								<input class="form-control" type="text" name="pass_baru" id="pass_baru">
							</div>
						</div>
						<div class="form-group row">
							<div class="col-sm-12 col-md-12">
								<label>Konfirmasi Password Baru:</label>
								<input class="form-control" type="text" name="pass_konf" id="pass_konf">
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						<button class="btn btn-success notika-btn-success" id="simpan_password">Simpan</button>
					</div>
				</div>
			</div>
		</div>
	</form>