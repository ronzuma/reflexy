//hitung_angsuran
function hitung_dp() {
	var dp_pribadi = f("#dp_pribadi").val();
	var harga_rumah = f("#harga_rumah").val();
	var pembiayaanbank = parseInt(harga_rumah)-parseInt(dp_pribadi);
	var nilai_flpp = pembiayaanbank*(75/100);
	
	f("#pembiayaan").val(pembiayaanbank);
	f("#nilai_flpp").val(nilai_flpp);
	
	//Rumus Angsuran
	var a = pembiayaanbank;
 	var b = 0.05/12;
	var c = f("#tenor").val();
	var d = (1+b);
	var e = Math.pow(d,parseInt(c));
	var j = (1/e);
	var g = (1-j);
	var h = (g/b);
	var pmt = Math.round(a/h); 
	f("#angsuran").val(pmt);
}