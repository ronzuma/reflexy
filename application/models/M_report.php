<?php
class M_report extends CI_Model {

	function trx(){
		return $this->db->query("SELECT * from transaksi;")->result();
	}
	
	function rekap_tgl(){
		return $this->db->query("SELECT tgl_trx, SUM(titik_bekam*price_bekam) AS bekam, SUM(price) AS paket, SUM(total) AS total, COUNT(nama_trapis) AS jml_cust FROM transaksi WHERE sukses='1' AND batal='0' GROUP BY DATE(tgl_trx);")->result();
	}
	
	function trx_detail($tgl){
		return $this->db->query("SELECT * FROM transaksi WHERE DATE(tgl_trx)='$tgl';")->result();
	}
}