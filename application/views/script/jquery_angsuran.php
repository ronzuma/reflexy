function hitung_dp() {
	var dp_pribadi = f("#dp_pribadi").val();
	var sbum = f("#sbum").val();
	var harga_rumah = f("#harga_rumah").val();
	
	if (dp_pribadi==''){
		f("#dp_pribadi").val('0');
		dp_pribadi=0;
	}
	
	var total_dp_nasabah = parseInt(dp_pribadi)+parseInt(sbum);		
	var pembiayaanbank = parseInt(harga_rumah)-parseInt(total_dp_nasabah);
	
	var nilai_flpp = pembiayaanbank*(75/100);
	
	f("#total_dp_nasabah").val(total_dp_nasabah);
	f("#pembiayaan").val(pembiayaanbank);
	f("#nilai_flpp").val(nilai_flpp);
}