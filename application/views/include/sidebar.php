<?php
$controller = $this->router->fetch_class();
$level = $this->session->userdata('ap_level');
?>
	<div class="left-side-bar">
		<div class="brand-logo">
			<a href="<?php echo site_url('Main_menu/grafik'); ?>">
				<img src="<?php echo config_item('assets'); ?>vendors/images/deskapp-logo.png" alt="">
			</a>
		</div>
		<div class="menu-block customscroll">
			<div class="sidebar-menu">
				<ul id="accordion-menu">
					<li>
						<a href="<?php echo site_url('Main_menu'); ?>" class="dropdown-toggle no-arrow">
							<span class="icon-copy fa fa-home"></span><span class="mtext">Home</span>
						</a>
					</li>
					<li class="dropdown">
						<a href="javascript:;" class="dropdown-toggle">
							<span class="fa fa-tasks"></span><span class="mtext">Report</span>
						</a>
						<ul class="submenu">							
							<li><a href="<?php echo site_url('Report'); ?>">Laporan Transaksi</a></li>
							<li><a href="<?php echo site_url('Report/tgl'); ?>">Transaksi Pertanggal</a></li>
						</ul>
					</li>
				</ul>
			</div>
		</div>
	</div>