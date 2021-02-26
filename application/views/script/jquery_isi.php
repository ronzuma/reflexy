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
			f("#alamat").val(obj.alamat_perumahan);
			f("#nama_perum").val(obj.nama_perumahan);
			f("#kode_pos").val(obj.kode_pos);
			f("#kelurahan").val(obj.kelurahan);
			f("#kecamatan").val(obj.kecamatan);
			f("#agn_kota_kab").val(obj.agn_kota_kab);
			f("#provinsi").val(obj.provinsi);
			f("#harga_rumah").val(obj.harga_rumah);
		});
	}
	//end pengembang
	
	//dukcapil
	function autofill(){
		var ktp = f("#ktp").val();
		console.log(ktp);
		if (ktp.length==16)
		f.ajax({
			url : '<?php echo site_url('token/nik/'); ?>'+ktp,
		}).success(function(data){
			console.log(data);
			var json = data,
			obj = JSON.parse(json);
			f("#nama").val(obj.nama);
			f("#status_kawin").val(obj.status);
			f("#usia").val(obj.umur);
			f("#jns_kelamin").val(obj.gender);			
			f("#data_pasangan").html(obj.data_pasangan);;
			f("#tanggal_lahir").val(obj.tgl_lahir);
			f("#jumlah_nik").val(obj.jumlah_nik);
			
			var jumlah_nik = f("#jumlah_nik").val();
			var nama = f("#nama").val();
			if (jumlah_nik > 0){
				alert('NIK '+ktp+' a/n '+nama+' Sudah terdaftar!');
				f("#duplikat").val('1');
			}
		});
	}
	
	
	//dukcapil pasangan
	function cek_pasangan(){
		var ktp_p = f("#ktp_p").val();
		if (ktp_p.length==16)
		f.ajax({
			url : '<?php echo site_url('token/nik/'); ?>'+ktp_p,
		}).success(function(data){
			var json = data,
			obj = JSON.parse(json);
			f("#nama_p").val(obj.nama);
		});
	}
	
	
	//angka
	function hanyaAngka(evt) {
	var charCode = (evt.which) ? evt.which : event.keyCode
		if (charCode > 31 && (charCode < 48 || charCode > 57))
 		  return false;
		  return true;
	}	
	
	
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

	
	//usia maksimal
	function cek_max_usia(){
		var id_pekerjaan = f("#pekerjaan").val();
		f.ajax({
			url : '<?php echo site_url('Token/maksimal_usia/'); ?>'+id_pekerjaan,
		}).success(function(data){
			var json = data,
			obj = JSON.parse(json);
			f("#usia_maksimal").val(obj.max);
			f("#data_penghasilan").html(obj.penghasilan);
			f("#min_penghasilan").val(obj.min_penghasilan);
			f("#jangka_waktu").val(obj.jangka_waktu);
		});
	}
	//uji slik
	function cek_status_slik(){
		var ideb = f("#ideb").val();
		var npl = f("#npl").val();
		f.ajax({
			url : '<?php echo site_url('Token/uji_slik/'); ?>'+npl+"/"+ideb,
		}).success(function(data){
			var json = data,
			obj = JSON.parse(json);
			f("#status_slik").val(obj.status);
		});
	}
	function hitung_penghasilan1() {
		var pendapatan1 = f("#pendapatan1").val();
		var pendapatan2 = f("#pendapatan2").val();
		var pendapatan = parseInt(pendapatan1)+parseInt(pendapatan2);
		f("#pendapatan").val(pendapatan);
		
		f("#pdp").val(pendapatan);
		f("#pdp1").val(pendapatan1);
		f("#pdp2").val(pendapatan2);
	}
	function hitung_penghasilan2() {
		var pendapatan1 = f("#pendapatan1").val();
		var pendapatan2 = f("#pendapatan2").val();
		var pengeluaran1 = f("#pengeluaran1").val();
		var pengeluaran2 = f("#pengeluaran2").val();
		var pendapatan = (parseInt(pendapatan1)+parseInt(pendapatan2))-(parseInt(pengeluaran1)+parseInt(pengeluaran2));
		f("#pendapatan").val(pendapatan);
		
		f("#pdp").val(pendapatan);
		f("#pdp1").val(pendapatan1);
		f("#pdp2").val(pendapatan2);
		f("#pl1").val(pengeluaran1);
		f("#pl2").val(pengeluaran2);
	}