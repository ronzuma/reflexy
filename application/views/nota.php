<!DOCTYPE html>
<html>
<head>
<?php $this->load->helper('nominal');?>
</head>

<body onload="window.print();";>
	
		<table border="0">
	  <tbody>
		<tr align="center" valign="top">
		  <td height="34" colspan="3" style="font-size: 12px"><img src="<?php echo config_item('assets')?>src/images/kenko.png" width="138" height="54" alt=""/></td>
	    </tr>
		<tr>
		  <td width="67" style="font-size: 12px">No.</td>
		  <td width="4" style="font-size: 12px">:</td>
		  <td width="70" style="font-size: 12px"><?php echo $nota->no_transaksi ?></td>
		</tr>
		<tr>
		  <td style="font-size: 12px">Tanggal</td>
		  <td style="font-size: 12px">:</td>
		  <td style="font-size: 12px"><?php echo date('Y-m-d', strtotime($nota->tgl_trx)) ?></td>
		</tr>
		<tr>
		  <td style="font-size: 12px">Customer</td>
		  <td style="font-size: 12px">:</td>
		  <td style="font-size: 12px"><?php echo $nota->customer ?></td>
		</tr>
		<tr>
		  <td style="font-size: 12px">Trapis</td>
		  <td style="font-size: 12px">:</td>
		  <td style="font-size: 12px"><?php echo $nota->nama_trapis ?></td>
		</tr>
		<tr>
		  <td style="font-size: 12px">Start</td>
		  <td style="font-size: 12px">:</td>
		  <td style="font-size: 12px"><?php echo date('H:i:s', strtotime($nota->startDate)) ?></td>
		</tr>
		<tr>
		  <td style="font-size: 12px">Finish</td>
		  <td style="font-size: 12px">:</td>
		  <td style="font-size: 12px"><?php echo date('H:i:s', strtotime($nota->tgl_trx)) ?></td>
		</tr>
		<tr>
		  <td style="font-size: 12px">Titik Bekam</td>
		  <td style="font-size: 12px">:</td>
		  <td style="font-size: 12px"><?php echo $nota->titik_bekam." Titik" ?></td>
		</tr>
		<tr>
		  <td style="font-size: 12px">Paket</td>
		  <td style="font-size: 12px">:</td>
		  <td style="font-size: 12px"><?php echo $nota->paket ?></td>
		</tr>
		<tr>
		  <td style="font-size: 12px">Nominal</td>
		  <td style="font-size: 12px">:</td>
		  <td align=right style="font-size: 12px"><?php echo "Rp.".nominal($nota->price).",-" ?></td>
		</tr>
		<tr>
		  <td style="font-size: 12px">Biaya Bekam</td>
		  <td style="font-size: 12px">:</td>
		  <td align=right style="font-size: 12px"><?php echo "Rp.".nominal($nota->price_bekam*$nota->titik_bekam).",-" ?></td>
		</tr>
		<tr>
		  <td style="font-size: 12px">Total</td>
		  <td style="font-size: 12px">:</td>
		  <td align=right style="font-size: 12px"><b><?php echo "Rp.".nominal($nota->total).",-" ?></b></td>
		</tr>
		<tr align="right" valign="botton">
		  <td height="63" colspan="3" style="font-size: 10px"> Tanggal Cetak <?php echo date('Y-m-d H:i:s') ?></td>
	    </tr>
	  </tbody>
	</table>

</body>
</html>