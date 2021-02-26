<script src="<?php echo config_item('assets'); ?>src/plugins/switchery/dist/switchery.js"></script>
<script>
	//cegah conflict
	var s=jQuery.noConflict();
	// Switchery
	var elems = Array.prototype.slice.call(document.querySelectorAll('.switch-btn'));
	s('.switch-btn').each(function() {
		new Switchery(s(this)[0], s(this).data());
	});
</script>