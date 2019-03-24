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
<html>
<head>
<meta charset="utf-8">
<title></title>
</head>

<body>
<button id="cetak" onclick="cetak()">Simpan</button>

<table width="100%" border="0">
  <tbody>
	<tr>
      <td colspan="3"><br><center><u><b>RINCIAN PENGHITUNGAN BIAYA PELATIHAN</b></u></center><br></td>
    </tr> 
    <tr>
      <td colspan="5"><table width="100%" border="1px solid" align="left" cellpadding="1" cellspacing="1">
        <tbody>
           <tr>
              <td><center><b>No</b></center></td>
              <td><center><b>Perincian Biaya</b></center></td>
			  <td><center><b>Jumlah</b></center></td>
			  <td><center><b>Keterangan</b></center></td>
          </tr>
          <tr>
            <td><center>1.</center></td>
            <td>EKA WARA MARTHIANTI,  SAP</td>
            <td>Sekretariat Pejabat</td>
            <td>Rp. 10101000</td>
          </tr> 
		  <tr>
            <td></td>
            <td></td>
            <td></td>
            <td>Rp. 10101000</td>
          </tr> 
		  <tr>
            <td></td>
            <td></td>
            <td colspan="3">Terbilang : <?php $terbilang=terbilang($angka); echo ucfirst($terbilang);?> rupiah</td>
          </tr>
        </tbody>
      </table></td>
    </tr>
	<tr>
      <td width="34%"><br><br>Telah dibayar<br>Rp.222222<br>eed</td>
      <td width="45%">&nbsp;</td>
      <td width="34%"><br>Jakarta,  Februari 2019<br>Telah menerima sejumlah uang sebesar,<br>Rp. 200000<br>ddd</td>
    </tr>
	<tr>
      <td width="34%">Kepala Bagian SDM dan Organisasi</td>
      <td width="45%">&nbsp;</td>
      <td width="34%">Kepala Sub Bagian Pengembangan SDM</td>
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
      <td><b>drg. Sri Handayani, MARS</b></td>
      <td>&nbsp;</td>
      <td><b>SUWASTINI, SAp, MM</b></td>
    </tr>
    <tr>
      <td><b>NIP. 1963101519901020001</b></td>
      <td>&nbsp;</td>
      <td><b>NIP 196611101986032004</b></td>
    </tr>
  </tbody>
</table>
</body>
</html>
<script type="text/javascript" >
function cetak(){
	window.print();
}
</script>
