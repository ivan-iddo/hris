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
     <p><h6><u>Tembusan : </u><br>- Para Direktur RSJPDHK</h6></p>
     <p><h6><?php echo $result["createdby"]; ?>:Intern <?php echo date("d")." ".$result["tanggal"]["tanggal_now"] ?></h6></p>
   </div>
<div id="content">
<table border="0" class="table-1" style="margin:15px">
	<tr>
      <td colspan="3" align="center" style="font-size: 20px"><u><strong>N O T A   -  D I N A S</strong></u></td>
    </tr>
    <tr>
      <td colspan="3" align="center" style="font-size: 15px">Nomor : KP.03.05/4.2.1/       /<?php echo date('Y'); ?></td>
    </tr>
    <tr>
      <td colspan="3" align="center">&nbsp;</td>
    </tr>
     <tr>
      <td colspan="3">
		<table width="100%" border="0" cellpadding="3">
		<tbody>          
		<tr>
            <td>Yth.</td>
            <td>:</td>
            <td width="70%">Ka. Sub. Bag. Kesejahteraan Pegawai dan Hubungan Industrial</td>
			<td width="20%"align="right">&nbsp;</td>
          </tr>
		  <tr>
            <td>Dari</td>
            <td>:</td>
            <td width="70%">Ka. Sub. Bag. Pengembangan SDM</td>
			<td width="20%">&nbsp;</td>
          </tr> 
		  <tr>
            <td>Hal</td>
            <td>:</td>
            <td width="70%">Ikatan Dinas Luar Negeri</td>
			<td width="20%">&nbsp;</td>
          </tr>
		  <tr>
            <td>Tanggal</td>
            <td>:</td>
            <td width="70%"><?php echo date("d")." ".$result["tanggal"]["tanggal_now"] ?></td>
			<td width="20%">&nbsp;</td>
          </tr>
		</tbody>
      </table></td></tr>
	<tr>
      <td colspan="3">
	  <p align="justify">      Berkenaan dengan pelatihan <?php echo '<i>'. $result["nama_pelatihan"].'</i>';?>, sebagai <?php echo '<i>'.$result["pengembangan_pelatihan_kegiatan_status"]->nama.'</i>';?>, an :</p>
	  </td>
    </tr>
	<tr>
      <td colspan="4">
        <table width="100%" border="0" cellpadding="3">
              <?php if (!empty($result["detail"])): ?>
            <?php foreach ($result["detail"] as $key => $value): ?>
			  <tr>
                <td width="1%">
                  <?php echo $key+1 ?>.
                </td>
				<td width="15%">
				Nama
                </td>
				<td width="1%">
				:
                </td>
				<td width="65%">
				<?php echo $result["gelar_depan"].' '.$value["nama_pegawai"].', '.$result["gelar_belakang"] ?>
                </td>
              </tr>
              <tr>
                <td width="1%">
                </td>
				<td width="15%">
				Jabatan
                </td>
				<td width="1%">
				:
                </td>
				<td width="65%">
				<?php echo $value["jabatan"]; ?>
                </td>
              </tr>
			<?php endforeach ?>
          <?php endif ?>
        </table>
      </td>
    </tr>
	<tr>
      <td colspan="3">
	  <p align="justify">      Yang akan dilaksanakan di <?php echo '<i>'.$result["tujuan"].'</i>'; ?>. Pada <?php if($result["tanggal"]["tanggal_from"]==$result["tanggal"]["tanggal_to"]){echo $result["tanggal"]["tanggal_to"]; }else{echo date("d",strtotime($result["tanggal"][0]["tanggal_from"]))." ".bulan(date("m",strtotime($result["tanggal"][0]["tanggal_from"]))) ." s.d ". $result["tanggal"]["tanggal_to"]; }?>, dengan biaya Rp. <?php if($result["jenis"] == "Kelompok"){ echo number_format($result["total"], 0, ",", ".")?> (<?php echo ucfirst($result["total_biaya_k"]);}else{echo number_format($result["detail"][0]["uraian_total"], 0, ",", ".")?> (<?php echo ucfirst($result["total_biaya"]);}?> rupiah) rincian terlampir, dengan ini mohon kerjasamanya untuk ditindaklanjut pembuatan perjanjian ikatan dinas sesuai dengan ketentuan yang berlaku.</p>
	  </td>
    </tr>
	<tr>
      <td colspan="3">
	  <p align="justify">Atas perhatian dan kerjasamanya diucapkan terimakasih.</p>
      </td>
    </tr>
    <tr>
      <td colspan="3">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="3">&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td width="34%">&nbsp;</td>
      <td width="60%">Suwastini, SAP, MM</td>
    </tr>
</table>
</div>
</body></html>