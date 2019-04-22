
<!doctype html>
<html><head></head><body>
<style>
     @page { margin: 160px 30px 30px; }
     #header { position: fixed; left: -10px; top: -150px; right: -10px; bottom: -150px; height: 0px; text-align: center; }
     #foote { position: fixed; left: 0px; bottom: 10px; right: 0px; height: 30px;}
     #foote { content: counter(upper-roman); }
</style>
 <div hidden="<?php echo $result["footer"]; ?>" id="header">
    <table width="100%" class="table-1" border="0">
	<tbody>
	<tr>
      <td colspan="1" width="60"><img src="<?php echo base_url(); ?>/logo2.png" width="80%"></td>
      <td colspan="2"align="center"><b>KEMENTRIAN KESEHATAN REPUBLIK INDONESIA<br>DIREKTORAT JENDRAL PELAYANAN KESEHATAN<br>RUMAH SAKIT JANTUNG DAN PEMBULU DARAH HARAPAN KITA</b></td>
	  <td colspan="1" width="70"><img src="<?php echo base_url(); ?>/logo.png" width="100%"></td>
	</tr>
	<tr>
	<td colspan="1" width="30">&nbsp;</td>
	<td colspan="2"align="center">Jalan Let. Jend. S. Parman Kv. 87 Slipi Jakarta, 11420<br>Telp. 5684085 - 093, 5684093, Faksimile: 5684230<br>Surat Elektronik: <u>website@pjnhk.go.id</u><br><u>http:www.pjnhk.go.id</u></td>
	<td colspan="1" width="30">&nbsp;</td>
	<hr/>
	</tr>
	</tbody>
	</table>
   </div>
   <div hidden="<?php echo $result["footer"]; ?>" id="foote">
     <p><h6>Tembusan : <br>- Arsip</h6></p>
	 <p><h6><?php echo $result["createdby"]; ?>:Intern <?php echo date("d")." ".$result["tanggal"]["now"] ?></h6></p>
   </div>
<div id="content">
<table border="0" class="table-1" style="margin:20px">
    <tr>
      <td colspan="3">
		<table width="100%" border="0" cellpadding="3">
		<tbody>          
		<tr>
            <td>Nomor</td>
            <td>:</td>
            <td width="70%">UM.01.05/XX.4/ &nbsp; &nbsp; &nbsp;  &nbsp; /<?php echo date('Y'); ?></td>
			<td width="20%"align="right"><?php echo $result["tanggal"]["tanggal_now"] ?></td>
          </tr>
		  <tr>
            <td>Lamp</td>
            <td>:</td>
            <td width="70%">-</td>
			<td width="20%">&nbsp;</td>
          </tr> 
		  <tr>
            <td>Prihal</td>
            <td>:</td>
            <td width="70%"><b>Biaya Pendidikan dan Pelatihan LN</b></td>
			<td width="20%">&nbsp;</td>
          </tr>
		</tbody>
      </table></td></tr>
    <tr>
      <td colspan="3">
      <br>Yth. Direktur Medik dan Keperawatan<br>
      RS. Jantung dan Pembuluh Darah Harapan Kita
	</td>
    </tr>
    <tr>
      <td colspan="3"><p align="justify">      Bersama ini kami sampaikan permohonan bantuan dana untuk mengikuti <?php echo '<i>'.$result["nama_pelatihan"].'</i>';?>, yang dilaksanakan tanggal <?php if($result["tanggal"]["tanggal_from"]==$result["tanggal"]["tanggal_to"]){echo $result["tanggal"]["tanggal_to"]; }else{echo date('d',strtotime($result["tanggal"][0]["tanggal_from"])) ." s.d ". $result["tanggal"]["tanggal_to"]; }?>, atas nama <?php echo $result["gelar_depan"].' '.$result["detail"][0]["nama_pegawai"].', '.$result["gelar_belakang"] ?>. Bertempat di <?php echo $result["tujuan"]; ?>.</p></td>
    </tr>
	<tr>
      <td colspan="3"><p align="justify">      Kami lampirkan perhitungan biaya yang dapat diberikan sesuai ketentuan Latbang SDM dengan jumlah sebesar  Rp. <?php if($result["jenis"] == "Kelompok"){ echo number_format($result["total"], 2, ",", ".");}else{echo number_format($result["detail"][0]["uraian_total"], 2, ",", ".");}?> (rincian terlampir) :</p></td>
    </tr>
	<tr>
      <td colspan="3"><p align="justify">      Demikian surat ini kami sampaikan, mohon keputusan lebih lanjut untuk dapat  diproses sebagaimana mestinya.  Atas perhatiannya kami ucapkan terima kasih.</p></td>
    </tr>
	<tr>
      <td>&nbsp;</td>
      <td width="34%" align="right">&nbsp;</td>
      <td width="60%">Direktur Umum & SDM</td>
    </tr>
    <tr>
      <td colspan="3">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="3">&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>Dr. dr. Basuni Radi, SpJP(K), FIHA</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>NIP 196606122000121001</td>
    </tr>
</table>
</body></html>