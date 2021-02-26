	f(function(){
		f.ajaxSetup({
			type:"POST",
			url: "<?php echo base_url('index.php/Provinsi/ambil_data') ?>",
			cache: false,
		});
		f("#provinsi").change(function(){
			var value=f(this).val();
			if(value>0){
				f.ajax({
					data:{modul:'kabupaten',id:value},
					success: function(respond){
						f("#agn_kota_kab").html(respond);
					}
				})
			}
		});
		f("#agn_kota_kab").change(function(){
			var value=f(this).val();
			if(value>0){
				f.ajax({
					data:{modul:'kecamatan',id:value},
					success: function(respond){
						f("#kecamatan").html(respond);
					}
				})
			}
		});
		f("#kecamatan").change(function(){
			var value=f(this).val();
			if(value>0){
				f.ajax({
					data:{modul:'kelurahan',id:value},
					success: function(respond){
						f("#kelurahan").html(respond);
					}
				})
			}
		});
	})