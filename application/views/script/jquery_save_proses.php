f("#submit").click(function(){
	f.ajax({
		url : '<?php echo site_url('Calon_nasabah/proses_lengkapi_data'); ?>',
		type: "POST", 
		data: f("#form_proses").serialize(),
		success: function(data) {
			var json = data,
			obj = JSON.parse(json);
			alert(obj.status);
			window.location.href="<?php echo config_item('base_url'); ?>index.php/Calon_nasabah";
		}
	});
	return false;
});