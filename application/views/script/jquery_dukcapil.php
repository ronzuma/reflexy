	//dukcapil
	function autofill(){
		var ktp = f("#ktp").val();
		console.log(ktp);
		if (ktp.length==16)
		f.ajax({
			url : '<?php echo site_url('Dukcapil/nik/'); ?>'+ktp,
		}).success(function(data){
			var json = data,
			obj = JSON.parse(json);
			f("#nama").val(obj.nama);
			f("#status_kawin").val(obj.status);
			f("#usia").val(obj.umur);
			f("#jns_kelamin").val(obj.gender);			
			f("#data_pasangan").html(obj.data_pasangan);;
			f("#tanggal_lahir").val(obj.tgl_lahir);
			f("#jumlah_nik").val(obj.jumlah_nik);
			f("#tempat_lahir").val(obj.tempat_lahir);
			
			f("#alamat_ktp").val(obj.alamat);
			f("#rt_ktp").val(obj.rt);
			f("#rw_ktp").val(obj.rw);
			f("#kelurahan_ktp").val(obj.kelurahan);
			f("#kecamatan_ktp").val(obj.kecamatan);
			f("#kab_kota_ktp").val(obj.kota);
			f("#provinsi_ktp").val(obj.prov);
			f("#kodepos_ktp").val(obj.kode_pos);
		});
	}