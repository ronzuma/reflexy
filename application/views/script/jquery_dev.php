	//ambil detail data dev dari db
	function cek_dev(){
		var id_dev = f("#nama_badan_hukum").val();
		f.ajax({
			url : '<?php echo site_url('Pengembang/dev/'); ?>'+id_dev,
		}).success(function(data){
			var json = data,
			obj = JSON.parse(json);
			f("#nama_dev").val(obj.nama);
			f("#badan_hukum").val(obj.badan_hukum);
			f("#nama_perum").val('');
		});
	}	
	//ambil data perumahan
	function cek_perum(){
		var id_perum = f("#nama_perumahan").val();
		f.ajax({
			url : '<?php echo site_url('Perumahan/alamat_perum/'); ?>'+id_perum,
		}).success(function(data){
			var json = data,
			obj = JSON.parse(json);
			f("#alamat_perum").val(obj.alamat_perumahan);
			f("#nama_perum").val(obj.nama_perumahan);
			f("#kodepos_perum").val(obj.kode_pos);
			f("#kelurahan_perum").val(obj.kelurahan);
			f("#kecamatan_perum").val(obj.kecamatan);
			f("#agn_kota_kab").val(obj.agn_kota_kab);
			f("#provinsi_perum").val(obj.provinsi);
			f("#harga_rumah").val(obj.harga_rumah);
			f("#luas_tanah").val(obj.luas_tanah);
			f("#luas_rumah").val(obj.type_rumah);
		});
	}
	//end pengembang
	
	
	
	
	//ambil data provinsi
	f(function(){
		f.ajaxSetup({
			type:"POST",
			url: "<?php echo base_url('index.php/Token/drop_down') ?>",
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
		f("#penghasilan").change(function(){
			var value=f(this).val();
			if(value>0){
				f.ajax({
					data:{modul:'penghasilan',id:value},
					success: function(respond){
						f("#pekerjaan").html(respond);
					}
				})
			}
		});
		f("#nama_badan_hukum").change(function(){
			var value=f(this).val();
			if(value>0){
				f.ajax({
					data:{modul:'perumahan',id:value},
					success: function(respond){
						f("#nama_perumahan").html(respond);
					}
				})
			}
		});
	})

