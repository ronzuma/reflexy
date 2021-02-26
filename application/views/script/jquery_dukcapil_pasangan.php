	//dukcapil pasangan
	function cek_pasangan(){
		var ktp_p = f("#ktp_p").val();
		if (ktp_p.length==16)
		f.ajax({
			url : '<?php echo site_url('Dukcapil/nik/'); ?>'+ktp_p,
		}).success(function(data){
			var json = data,
			obj = JSON.parse(json);
			f("#nama_p").val(obj.nama);
			f("#tempat_lahir_p").val(obj.tempat_lahir);
			f("#tanggal_lahir_p").val(obj.tgl_lahir);
		});
	}