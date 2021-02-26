<?php
	require_once(APPPATH.'vendor/mike42/escpos-php/autoload.php'); 
	use Mike42\Escpos\Printer;
	use Mike42\Escpos\EscposImage;
	use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;

	defined('BASEPATH') OR exit('No direct script access allowed');

	class Welcome extends CI_Controller {

	
	public function index(){
		$this->load->view('welcome_message');
	}

	public function simpan(){
		$this->load->model('Model_item');
 		$wr=$this->input->post('warung');

		foreach($wr as $key => $value){
			if($wr[$key] == "kopi") $this->Model_item->simpan($wr[$key], '2000');
			if($wr[$key] == "buryam") $this->Model_item->simpan($wr[$key], '5000');
			if($wr[$key] == "sate") $this->Model_item->simpan($wr[$key], '2000');
			if($wr[$key] == "intel") $this->Model_item->simpan($wr[$key], '3000');
		}
		
		/* urusan cetak nota */
		$list = $this->Model_item->list_bayar();
		
		
		$connector = new WindowsPrintConnector("POS-58");
		$printer = new Printer($connector);
		$printer -> initialize();

		/* Date is kept the same for testing */
		$date = date('D j M Y H:i:s');
		/* Name of shop */
		$printer -> feed();
		$printer -> setJustification(Printer::JUSTIFY_CENTER);
		$printer -> selectPrintMode(Printer::MODE_DOUBLE_WIDTH);
		$printer -> text("Codeigniter Cafe\n");
		$printer -> selectPrintMode();
		$printer -> setUnderline(1);
		$printer -> text("Facebook Group Indonesia\n");
		$printer -> setUnderline(0);
		$printer -> feed();

		/* Title of receipt */
		$printer -> setJustification(Printer::JUSTIFY_LEFT);
		$printer -> setEmphasis(true);
		$printer -> text("Tagihan : \n");
		$printer -> setEmphasis(false);
		$printer -> feed(2);

		/* Items */
		$printer -> setEmphasis(true);
		//$printer -> text(new item(", '$'));
		$printer -> setEmphasis(false);

		$harga = 0;
		foreach ($list->result() as $r) {
			$printer -> setJustification(Printer::JUSTIFY_LEFT);
			$printer -> text("$r->nama_item ______");
			$printer -> text("Rp.");
			$printer -> text("$r->harga\n");
			$printer-> feed();

			$total = $harga + $r->harga;
			$harga = $total;
		}

		$printer -> setJustification(Printer::JUSTIFY_LEFT);
		$printer -> setEmphasis(true);
		$printer -> text("Total : Rp. ");
		$printer -> text($total);
		$printer -> setEmphasis(false);
		$printer -> feed();

		/* Tax and total */
		//$printer -> text($tax);
		$printer -> selectPrintMode(Printer::MODE_DOUBLE_WIDTH);
		//$printer -> text($total);
		$printer -> selectPrintMode();

		/* Footer */
		$printer -> feed(2);
		$printer -> setJustification(Printer::JUSTIFY_CENTER);
		$printer -> text("Terima Kasih sudah Menunggu :D\n");
		$printer -> text("Semangaatt !\n");
		$printer -> feed(2);
		$printer -> text($date . "\n");

		/* Cut the receipt and open the cash drawer */
		$printer -> cut();
		$printer -> pulse();
		$printer -> close();

		$this->Model_item->customer_baru();
		redirect('welcome');
	}

	public function customer_baru(){
		$this->load->model('Model_item');
		$this->Model_item->customer_baru();
		redirect('welcome');
	}

}