<?php
require_once(APPPATH.'vendor/mike42/escpos-php/autoload.php'); 
use Mike42\Escpos\Printer;
use Mike42\Escpos\EscposImage;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends MY_Controller 
{
	function __construct(){
		parent::__construct();
		$this->load->model('M_report');
		$this->load->model('M_trapis');
		$this->load->helper('nominal');
	}

	public function index(){
		$data["transaksi"] = $this->M_report->trx();
		$this->load->view('report_trx', $data);
	}
	
	public function tgl(){
		$data["transaksi"] = $this->M_report->rekap_tgl();
		$this->load->view('report_tanggal', $data);
	}
	
	public function trx_detail($tgl){
		$data["transaksi"] = $this->M_report->trx_detail($tgl);
		$this->load->view('report_trx', $data);
	}
	
	public function cetak_ulang($no_transaksi){
		$nota=$this->M_trapis->detail_transaksi($no_transaksi);
 		$connector = new WindowsPrintConnector("POS-58");
		$printer = new Printer($connector);
		$printer -> initialize();
		
		$printer -> feed();
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
		redirect('Report');
    }
	
	public function logo(){
		$connector = new WindowsPrintConnector("POS-58");
		$printer = new Printer($connector);

		try {
			$gambar=config_item('assets').'vendors/images/kenko.png';
			$tux = EscposImage::load($gambar, false);
			$printer -> text("These example images are printed with the older\nbit image print command. You should only use\n\$p -> bitImage() if \$p -> graphics() does not\nwork on your printer.\n\n");
			
			$printer -> bitImage($tux);
			$printer -> text("Regular Tux (bit image).\n");
			$printer -> feed();
			
			$printer -> bitImage($tux, Printer::IMG_DOUBLE_WIDTH);
			$printer -> text("Wide Tux (bit image).\n");
			$printer -> feed();
			
			$printer -> bitImage($tux, Printer::IMG_DOUBLE_HEIGHT);
			$printer -> text("Tall Tux (bit image).\n");
			$printer -> feed();
			
			$printer -> bitImage($tux, Printer::IMG_DOUBLE_WIDTH | Printer::IMG_DOUBLE_HEIGHT);
			$printer -> text("Large Tux in correct proportion (bit image).\n");
		} catch (Exception $e) {
			/* Images not supported on your PHP, or image file not found */
			$printer -> text($e -> getMessage() . "\n");
		}

		$printer -> cut();
		$printer -> close();
	}
}