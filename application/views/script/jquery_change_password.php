f("#simpan_password").click(function(){
	f.ajax({
		url : '<?php echo site_url('User/change_password'); ?>',
		type: "POST", 
		data: f("#form_change_pass").serialize(),
		success: function(data) {
			var json = data,
			obj = JSON.parse(json);
			alert(obj.status);
			if (obj.direct=='yes'){
				window.location.href="<?php echo config_item('base_url'); ?>";
			}
		}
	});
	return false;
});