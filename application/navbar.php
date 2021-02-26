<?php
$controller = $this->router->fetch_class();
$level = $this->session->userdata('ap_level');
?>

<nav class="navbar navbar-default">
	<div class="container-fluid">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
		</div>

		<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
			<ul class="nav navbar-nav">
				
				<li <?php if($controller == 'Main_menu') { echo "class='active'"; } ?>><a href="<?php echo site_url('Main_menu'); ?>"><i class='fa fa-shopping-cart fa-fw'></i> Pembayaran</a></li>
				
				<li <?php if($controller == 'history') { echo "class='active'"; } ?>><a href="<?php echo site_url('history'); ?>"><i class='fa fa-file-text-o fa-fw'></i> History Pembayaran</a></li>
				
				<li <?php if($controller == 'laporan') { echo "class='active'"; } ?>><a href="<?php echo site_url('laporan'); ?>"><i class='fa fa-file-text-o fa-fw'></i> Laporan</a></li>

				<?php if($level == 'admin') { ?>
				<li <?php if($controller == 'user') { echo "class='active'"; } ?>><a href="<?php echo site_url('user'); ?>"><i class='fa fa-users fa-fw'></i> List User</a></li>
				<?php } ?>
			</ul>

			<ul class="nav navbar-nav navbar-right">
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class='fa fa-user fa-fw'></i> <?php echo $this->session->userdata('ap_nama'); ?> <span class="caret"></span></a>
					<ul class="dropdown-menu">
						<li><a href="<?php echo site_url('user/ubah-password'); ?>" id='GantiPass'>Ubah Password</a></li>
						<li role="separator" class="divider"></li>
						<li><a href="<?php echo site_url('secure/logout'); ?>"><i class='fa fa-sign-out fa-fw'></i> Log Out</a></li>
					</ul>
				</li>
			</ul>
		</div>
	</div>
</nav>

<script>
$(document).on('click', '#GantiPass', function(e){
	e.preventDefault();

	$('.modal-dialog').removeClass('modal-lg');
	$('.modal-dialog').addClass('modal-sm');
	$('#ModalHeader').html('Ubah Password');
	$('#ModalContent').load($(this).attr('href'));
	$('#ModalGue').modal('show');
});
</script>