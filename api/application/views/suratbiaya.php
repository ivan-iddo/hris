<?php
	function penyebut($nilai) {
		$nilai = abs($nilai);
		$huruf = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
		$temp = "";
		if ($nilai < 12) {
			$temp = " ". $huruf[$nilai];
		} else if ($nilai <20) {
			$temp = penyebut($nilai - 10). " belas";
		} else if ($nilai < 100) {
			$temp = penyebut($nilai/10)." puluh". penyebut($nilai % 10);
		} else if ($nilai < 200) {
			$temp = " seratus" . penyebut($nilai - 100);
		} else if ($nilai < 1000) {
			$temp = penyebut($nilai/100) . " ratus" . penyebut($nilai % 100);
		} else if ($nilai < 2000) {
			$temp = " seribu" . penyebut($nilai - 1000);
		} else if ($nilai < 1000000) {
			$temp = penyebut($nilai/1000) . " ribu" . penyebut($nilai % 1000);
		} else if ($nilai < 1000000000) {
			$temp = penyebut($nilai/1000000) . " juta" . penyebut($nilai % 1000000);
		} else if ($nilai < 1000000000000) {
			$temp = penyebut($nilai/1000000000) . " milyar" . penyebut(fmod($nilai,1000000000));
		} else if ($nilai < 1000000000000000) {
			$temp = penyebut($nilai/1000000000000) . " trilyun" . penyebut(fmod($nilai,1000000000000));
		}     
		return $temp;
	}
 
	function terbilang($nilai) {
		if($nilai<0) {
			$hasil = "minus ". trim(penyebut($nilai));
		} else {
			$hasil = trim(penyebut($nilai));
		}     		
		return $hasil;
	}
	$angka = 10101000;
?>
<!doctype html>
<html><head></head><body>
<table border="0" class="table-1" style="margin:30px">
	<tr>
      <td colspan="3"><br><center><u><b>RINCIAN PENGHITUNGAN BIAYA PELATIHAN</b></u></center><br></td>
    </tr> 
    <tr>
      <td colspan="3"><table width="100%" border="1px solid" cellpadding="1" cellspacing="0"  class="table2">
		  <tr>
              <td><center><b>No</b></center></td>
			  <td><center><b>Perincian Biaya</b></center></td>
			  <td><center><b>Jumlah</b></center></td>
			  <td><center><b>Keterangan</b></center></td>
          </tr>
		<?php if (!empty($result["detail"][0]["detail_uraian"])): ?>
            <?php foreach ($result["detail"][0]["detail_uraian"] as $key => $value): ?>
          <tr>
            <td><center><?php echo $key+1 ?>.</center></td>
            <td><?php echo $value["uraian"]?>
            <br><?php echo $value["qty"]?> Orang x Rp. <?php echo number_format($value["pernominal"], 2, ",", ".")?></td>
            <td>Rp. <?php echo number_format($value["nominal"], 2, ",", ".")?></td>
            <td></td>
          </tr>
		 <?php endforeach ?>
          <?php endif ?>
		  <tr>
            <td></td>
            <td>Jumlah</td>
            <td colspan="2">Rp. <?php echo number_format($result["detail"][0]["uraian_total"], 2, ",", ".")?></td>
          </tr>
      </table></td>
    </tr>
   <tr>
      <td width="40%"><br><br>Telah dibayar<br>Rp. <?php echo number_format($result["detail"][0]["uraian_total"], 2, ",", ".")?><br>(<?php $terbilang=terbilang($result["detail"][0]["uraian_total"]); echo ucfirst($terbilang);?> rupiah)</td>
      <td width="10%">&nbsp;</td>
      <td width="60%"><br>Jakarta,  Februari 2019<br>Telah menerima sejumlah uang sebesar,<br>Rp. <?php echo number_format($result["detail"][0]["uraian_total"], 2, ",", ".")?><br>(<?php $terbilang=terbilang($result["detail"][0]["uraian_total"]); echo ucfirst($terbilang);?> rupiah)</td>
    </tr>
	<tr>
      <td width="40%">Bendahara Pengeluaran</td>
      <td width="10%">&nbsp;</td>
      <td width="60%">Yang berpergian,</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td><b>WIHARSA, S.E</b></td>
      <td>&nbsp;</td>
      <td><b><?php echo $result["detail"][0]["nama_pegawai"]?></b></td>
    </tr>
    <tr>
      <td><b>NIP. 197402092008121001</b></td>
      <td>&nbsp;</td>
      <td><b>NIP/Nopeg. <?php echo $result["detail"][0]["nip"]?></b></td>
    </tr>
</table>
</body></html>