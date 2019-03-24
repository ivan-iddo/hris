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
      <td colspan="1" width="50"><img src="tes.jpg" width="60%"></td>
      <td colspan="4"align="right"><h6>RUMAH SAKIT JANTUNG DAN PEMBULU DARAH<br>HARAPAN KITA<br>Jln. S. Parman Kv. 87 Slipi Jakarta, 11420<br>Telp. 5684085 - 5684093 Ext. 1154<br>Fax: 5684230<br>e-mail: website@pjnhk.go.id<br>http:www.pjnhk.go.id</h6></td>
    </tr>
    <tr>
      <td colspan="5"><table width="100%" border="0" align="left" cellpadding="1" cellspacing="1">
        <tbody>
          <tr>
            <td>Nomor</td>
            <td>:</td>
            <td width="80%">&nbsp;</td>
			<td align="right">04 Februari 2019</td>
          </tr>
		  <tr>
            <td>Lamp</td>
            <td>:</td>
            <td width="80%">&nbsp;</td>
			<td>&nbsp;</td>
          </tr> 
		  <tr>
            <td>Prihal</td>
            <td>:</td>
            <td width="80%">&nbsp;</td>
			<td>&nbsp;</td>
          </tr>
        </tbody>
      </table></td>
    </tr>
	<td colspan="1">
      <br>Yth. Direktur Keuangan<br>
      RS. Jantung dan Pembuluh Darah Harapan Kita<br>
      Jakarta
	</td>
    </tr>
    <tr>
      <td colspan="3" align="justify"><br><p>      Berdasarkan disposisi Direktur Umum dan SDM tanggal 15 Januari 2019, prihal Mengikiti Kegiatan Magang di Instansi Kedokteran Nuklir RSUP Dr. Hasan Sadikin Bandung, yang dilaksanakan pada tanggal 06 Februari sd 26 Februari 2019. Bertempat di RSUD Dr. Hasan Sadikin Bandung, an :</p><br></td>
    </tr>
	<tr>
	<tr>
      <td colspan="5"><table width="100%" border="0" align="left" cellpadding="1" cellspacing="1">
        <tbody>
          <tr>
            <td>Nama</td>
            <td>:</td>
            <td width="85%">&nbsp;</td>
          </tr> 
		  <tr>
            <td>NIP</td>
            <td>:</td>
            <td width="85%">&nbsp;</td>
          </tr> 
		  <tr>
            <td>Pangkat / Gol</td>
            <td>:</td>
            <td width="85%">&nbsp;</td>
          </tr> 
		  <tr>
            <td>Jabatan</td>
            <td>:</td>
            <td width="85%">&nbsp;</td>
          </tr>
        </tbody>
      </table></td>
    </tr>
	</tr>
	<tr>
      <td colspan="3"><br><p>Maka bersama ini mengajukan biaya dimaksud sebesar:</p></td>
    </tr> 
    <tr>
      <td colspan="5"><table width="100%" border="1px solid" align="left" cellpadding="1" cellspacing="1">
        <tbody>
           <tr>
              <td><center><b>No</b></center></td>
              <td><center><b>Pengajuan berdasarkan ketentuan Latbang</b></center></td>
			  <td><center><b>Uraian</b></center></td>
			  <td><center><b>Jumlah</b></center></td>
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
      <td colspan="3"><p>Terlampir kami sampaikan bukti pendukung perminaan tersebut.</p><br></td>
    </tr> 
	<tr>
      <td colspan="3"><p>Demikian surat ini disampaikan, atas bantuan dan kerjasamanya diucapkan terima kasih.</p><br></td>
    </tr>
    <tr>
      <td>Mengetahui</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>  
	<tr>
      <td width="34%">Kepala Bagian SDM dan Organisasi</td>
      <td width="34%">&nbsp;</td>
      <td width="34%"align="right">Kepala Sub Bagian Pengembangan SDM</td>
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
      <td align="right"><b>SUWASTINI, SAp, MM</b></td>
    </tr>
    <tr>
      <td><b>NIP. 1963101519901020001</b></td>
      <td>&nbsp;</td>
      <td align="right"><b>NIP 196611101986032004</b></td>
    </tr> 
	<tr>
      <td width="34%">&nbsp;</td>
      <td width="34%"><br><center>Direktur Umum & SDM</center></br></td>
      <td width="50%">&nbsp;</td>
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
	  <td>&nbsp;</td>
      <td><b><center>Dr.dr. Basuni Radi, SpJP(K),FIHA</center></b></td>
      <td>&nbsp;</td>
    </tr>
    <tr>      
	  <td>&nbsp;</td>
      <td><b><center>NIP. 196606122000121001</center></b></td>
      <td>&nbsp;</td>
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
