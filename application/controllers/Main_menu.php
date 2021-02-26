<?php
require_once(APPPATH.'vendor/mike42/escpos-php/autoload.php'); 
use Mike42\Escpos\Printer;
use Mike42\Escpos\EscposImage;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;

defined('BASEPATH') OR exit('No direct script access allowed');
class Main_menu extends MY_Controller {
	public function __construct(){
        parent::__construct();
		$this->load->model('M_trapis');
		$this->load->library('form_validation');
		$this->load->helper('nominal');
    }
    public function index(){
		$data['paket']=$this->M_trapis->paket();
		$data['trapis'] = $this->M_trapis->tampil();
		$data['edit'] = $this->M_trapis->tampil_edit();
		$this->load->view("home", $data);
    }

    public function add_service(){
		date_default_timezone_set('Asia/Ujung_Pandang');
		//generate no_nota
		$no_urut = $this->db->query("SELECT max(no_transaksi) as no_transaksi FROM transaksi")->row();
		$no_transaksi = $no_urut->no_transaksi;
		$noUrut = (int) substr($no_transaksi, 4);

		$noUrut++;
		$char = "KNK";
		$ns = $char.sprintf("%04s", $noUrut);
		
		//paket
		$paket=$this->M_trapis->pilih_paket($this->input->post('id_paket'));
		$durasi=$paket->durasi;
		$startDate=date('Y-m-d H:i:s');
		$endDate=date('Y-m-d H:i:s', time() + ($durasi * 60));
		$total=$paket->price+($this->input->post('titik_bekam')*$paket->price_bekam);
		
		$transaksi = array (
				'no_transaksi'	=>$ns,
				'customer'		=>$this->input->post('nama_cust'),
				'no_telp'		=>$this->input->post('telp'),
				'nama_trapis'	=>$this->input->post('trapis'),
				'paket'			=>$paket->nama,
				'price'			=>$paket->price,
				'titik_bekam'	=>$this->input->post('titik_bekam'),
				'price_bekam'	=>$paket->price_bekam,
				'salon'			=>'0',
				'total'			=>$total,
				'startDate'		=>$startDate,
				'endDate'		=>$endDate,
				'batal'			=>'0',
				'alasan'		=>'',
				'kasir'			=>$this->session->userdata('ap_nama'),
				'tgl_trx'		=>'',
				'sukses'		=>'0'
			);
		
		$trx=$this->M_trapis->transaksi($transaksi);
			
  		$paket=$this->M_trapis->pilih_paket($this->input->post('id_trapis'));
		
		$startTime=date('H:i:s');
		$endTime=date('H:i:s', time() + ($durasi * 60));
		
		$service = array (
				'id_trapis'		=>$this->input->post('id_trapis'),
				'id_paket'		=>$this->input->post('id_paket'),
				'nama_cust'		=>$this->input->post('nama_cust'),
				'telp'			=>$this->input->post('telp'),
				'startDate'		=>$startTime,
				'endDate'		=>$endTime,
				'user'			=>$this->session->userdata('ap_nama'),
				'no_transaksi'	=>$ns,
				'total'			=>$total
			);
		$data['paket']=$this->M_trapis->update_trapis($service);
		redirect();
    }

    public function finish_service(){
		date_default_timezone_set('Asia/Ujung_Pandang');
		$id_trapis=$this->input->post('id_trapis');
		$no_transaksi=$this->input->post('no_transaksi');
		
		$f_trp=$this->M_trapis->f_trapis($id_trapis);
		$f_trx=$this->M_trapis->f_transaksi($no_transaksi);
		
		$nota=$this->M_trapis->detail_transaksi($no_transaksi);
		
		$connector = new WindowsPrintConnector("POS-58");
		$printer = new Printer($connector);
		$printer -> initialize();
		
		//Name of shop
		$printer -> feed();
		$printer -> setJustification(Printer::JUSTIFY_CENTER);
		$printer -> selectPrintMode(Printer::MODE_DOUBLE_WIDTH);
		$printer -> setUnderline(1);
		$printer -> text("KENKO REFLEXY\n");
		$printer -> setUnderline(0);
		$printer -> feed();

		//Title of receipt

		$printer -> setJustification(Printer::JUSTIFY_LEFT);
		$printer -> selectPrintMode();
		$printer -> setEmphasis(true);
		$printer -> text("No. : ");
		$printer -> text($nota->no_transaksi."\n");
		$printer -> text("Tanggal : ");
		$printer -> text(date('Y-m-d', strtotime($nota->tgl_trx))."\n");
		$printer -> text("Customer : ");
		$printer -> text($nota->customer."\n");
		$printer -> text("Trapis : ");
		$printer -> text($nota->nama_trapis."\n");
		$printer -> text("Start : ");
		$printer -> text(date('H:i:s', strtotime($nota->startDate))."\n");
		$printer -> text("Finish : ");
		$printer -> text(date('H:i:s', strtotime($nota->endDate))."\n");
		$printer -> text("Titik Bekam : ");
		$printer -> text($nota->titik_bekam." Titik\n");
		$printer -> text("Paket : ");
		$printer -> text($nota->paket."\n");
		$printer -> text("Nominal : ");
		$printer -> text("Rp.".nominal($nota->price).",-\n");
		$printer -> text("Biaya Bekam : ");
		$printer -> text("Rp.".nominal($nota->price_bekam*$nota->titik_bekam).",-\n");
		$printer -> setEmphasis(false);
		$printer -> feed();

		$printer -> selectPrintMode(Printer::MODE_DOUBLE_WIDTH);
		$printer -> text("Rp.".nominal($nota->total).",-\n");
		$printer -> selectPrintMode();

		//Footer
		$printer -> feed(2);
		$printer -> setJustification(Printer::JUSTIFY_CENTER);
		$printer -> text("Terima Kasih atas Kunjungan Anda.\n");
		$printer -> feed(2);
		$printer -> text($date . "\n");

		//Cut the receipt and open the cash drawer
		$printer -> cut();
		$printer -> pulse();
		$printer -> close();
		
		//$this->load->view("nota", $data);
		redirect();
    }
	
    public function edit_service(){
		date_default_timezone_set('Asia/Ujung_Pandang');
		
		//paket
		$paket=$this->M_trapis->pilih_paket($this->input->post('id_paket'));
		
 		$durasi=$paket->durasi;
		$startDate=$this->input->post('startDate');
		$endDate=date('Y-m-d H:i:s', strtotime($startDate) + ($durasi * 60));
		$total=$paket->price+($this->input->post('titik_bekam')*$paket->price_bekam);

		$transaksi = array (
				'no_transaksi'	=>$this->input->post('no_transaksi'),
				'customer'		=>$this->input->post('nama_cust'),
				'no_telp'		=>$this->input->post('telp'),
				'nama_trapis'	=>$this->input->post('trapis'),
				'paket'			=>$paket->nama,
				'price'			=>$paket->price,
				'titik_bekam'	=>$this->input->post('titik_bekam'),
				'price_bekam'	=>$paket->price_bekam,
				'total'			=>$total,
				'endDate'		=>$endDate
			);
		
		$trx=$this->M_trapis->update_transaksi($transaksi);
		
		$startTime=date('H:i:s', strtotime($startDate));		
		$endTime=date('H:i:s', strtotime($startDate) + ($durasi * 60));
		
		
		$service = array (
				'id_trapis'		=>$this->input->post('id_trapis'),
				'id_paket'		=>$this->input->post('id_paket'),
				'nama_cust'		=>$this->input->post('nama_cust'),
				'telp'			=>$this->input->post('telp'),
				'startDate'		=>$startTime,
				'endDate'		=>$endTime,
				'user'			=>$this->session->userdata('ap_nama'),
				'no_transaksi'	=>$this->input->post('no_transaksi'),
				'total'			=>$total
			);
		$data['paket']=$this->M_trapis->update_trapis($service);
		redirect();
    }
}