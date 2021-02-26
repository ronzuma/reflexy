<?php
class M_trapis extends CI_Model {

	function tampil(){
		return $this->db->query("SELECT t.*, p.nama AS nama_paket, p.keterangan FROM trapis t LEFT JOIN paket p ON t.id_paket=p.id;")->result();
	}
	
	function paket(){
		$pkt=$this->db->query("SELECT * FROM paket");
		return $pkt->result_array();
	}

	function pilih_paket($id_paket){
		$pkt=$this->db->query("SELECT * FROM paket where id='$id_paket'");
		return $pkt->row();
	}
	
	public function update_trapis($service){
		$query="update trapis set id_paket='".$service['id_paket']."', startDate='".$service['startDate']."', endDate= '".$service['endDate']."', available='1', cust='".$service['nama_cust']."', no_transaksi='".$service['no_transaksi']."', total='".$service['total']."' where id_trapis='".$service['id_trapis']."'";				
		$update=$this->db->query($query);
		return $update;
    }
	
	public function transaksi($transaksi){
		$query="insert into transaksi values('".$transaksi['no_transaksi']."', '".$transaksi['customer']."', '".$transaksi['no_telp']."', '".$transaksi['nama_trapis']."', '".$transaksi['paket']."', '".$transaksi['price']."', '".$transaksi['titik_bekam']."', '".$transaksi['price_bekam']."', '".$transaksi['salon']."', '".$transaksi['total']."', '".$transaksi['startDate']."', '".$transaksi['endDate']."', '".$transaksi['batal']."', '".$transaksi['alasan']."', '".$transaksi['kasir']."', '".$transaksi['tgl_trx']."', '".$transaksi['sukses']."');";	
		$update=$this->db->query($query);
		return $update;
    }
	
	public function f_trapis($id_trapis){
		$query="UPDATE trapis SET available='0' WHERE id_trapis='$id_trapis';";				
		$update=$this->db->query($query);
		return $update;
    }
	
	public function f_transaksi($no_transaksi){
		$query="UPDATE transaksi SET sukses='1', tgl_trx=NOW() WHERE no_transaksi='$no_transaksi';;";				
		$update=$this->db->query($query);
		return $update;
    }
	
	public function detail_transaksi($no_transaksi){
		$query="select * from transaksi WHERE no_transaksi='$no_transaksi';";				
		$update=$this->db->query($query)->row();
		return $update;
    }
	
	public function tampil_edit(){
		$query="SELECT t.id_trapis, t.nama, t.id_paket, r.titik_bekam, r.customer, r.no_telp , r.startDate, r.no_transaksi
				FROM trapis t LEFT JOIN transaksi r ON t.no_transaksi=r.no_transaksi;";				
		$update=$this->db->query($query)->result();
		return $update;
    }
	
	public function update_transaksi($transaksi){
		$query="update transaksi set customer='".$transaksi['customer']."', no_telp='".$transaksi['no_telp']."', paket='".$transaksi['paket']."', price='".$transaksi['price']."', titik_bekam='".$transaksi['titik_bekam']."', price_bekam='".$transaksi['price_bekam']."', total='".$transaksi['total']."', endDate='".$transaksi['endDate']."' where no_transaksi='".$transaksi['no_transaksi']."';";	
		$update=$this->db->query($query);
		return $update;
    }
}