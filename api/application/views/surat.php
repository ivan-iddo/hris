
<!doctype html>
<html><head></head><body>
<style>
     @page { margin: 100px 30px 40px; }
     #header { position: fixed; left: -10px; top: -110px; right: -10px; bottom: -160px; height: 0px; text-align: center; }
     #foote { position: fixed; left: 0px; bottom: -0px; right: 0px; }
     #foote { content: counter(upper-roman); }
</style>
 <div hidden="<?php echo $result["footer"]; ?>" id="header">
    <table width="100%" class="table-1" border="0">
	<tbody>
	<tr>
      <td colspan="1" width="70"><img src="<?php echo base_url(); ?>/logo.png" width="100%"></td>
      <td colspan="4"align="right"><h6>RUMAH SAKIT JANTUNG DAN PEMBULU DARAH<br>HARAPAN KITA<br>Jln. S. Parman Kv. 87 Slipi Jakarta, 11420<br>Telp. 5684085 - 5684093 Ext. 1154<br>Fax: 5684230<br>e-mail: website@pjnhk.go.id<br>http:www.pjnhk.go.id</h6></td>
    </tr>
	</tbody>
	</table>
   </div>
   <div hidden="<?php echo $result["footer"]; ?>" id="foote">
     <p><h6>Latbang_3:RAK Intern <?php echo date("d")." ". $result["tanggal"]["tanggal_now"] ?> <?php echo $result["createdby"]; ?></h6></p>
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
            <td width="70%">KU.02.04/4.2.1/ &nbsp; &nbsp; &nbsp;  &nbsp; /<?php echo date('Y'); ?></td>
			<td width="20%"align="right"><?php echo $result["tanggal"]["tanggal_now"] ?></td>
          </tr>
		  <tr>
            <td>Lamp</td>
            <td>:</td>
            <td width="70%">1 (Satu) berkas</td>
			<td width="20%">&nbsp;</td>
          </tr> 
		  <tr>
            <td>Prihal</td>
            <td>:</td>
            <td width="70%"><b>Permohonan Biaya</b></td>
			<td width="20%">&nbsp;</td>
          </tr>
		</tbody>
      </table></td></tr>
    <tr>
      <td colspan="3">
      <br>Yth. Direktur Keuangan<br>
      RS. Jantung dan Pembuluh Darah Harapan Kita<br>
      Jakarta
	</td>
    </tr>
    <tr>
      <td colspan="3"><p align="justify">      Dengan ini kami usulkan biaya pelatihan <?php echo $result['nama_pelatihan']; ?> tanggal <?php if($result["tanggal"]["tanggal_from"]==$result["tanggal"]["tanggal_to"]){echo $result["tanggal"]["tanggal_to"]; }else{echo date('d',strtotime($result["tanggal"][0]["tanggal_from"])) ." s.d ". $result["tanggal"]["tanggal_to"]; }?> yang diselenggarakan oleh <?php echo $result["institusi"]; ?> bertempat di <?php echo $result["tujuan"]; ?> an :</p></td>
    </tr>
    <tr>
      <td colspan="3">
        <?php if ($result["jenis"] == "Individu"): ?> 
        <table width="100%" border="1px solid" cellpadding="1" cellspacing="0" class="table2" style="margin-top: 15px">
          <tr>
				<th align="center">No</th>
				<th align="center">Nopeg</th>
				<th align="center">Nama</th>
				<th align="center">NIP</th>
				<th align="center">Jabatan</th>
			  </tr>
			  <?php if (!empty($result["detail"])): ?>
				<?php foreach ($result["detail"] as $key => $value): ?>
				  <tr>
					<td align="center"><?php echo $key+1 ?></td>
					<td align="center"><?php echo $value["nopeg"] ?></td>
					<td><?php echo $result["gelar_depan"].' '.$value["nama_pegawai"].', '.$result["gelar_belakang"] ?></td>
					<td><?php echo $value["nip"]; ?></td>
					<td><?php echo $value["jabatan"]; ?></td>
				  </tr>
				<?php endforeach ?>
			  <?php endif ?>
			</table>
		  </td>
		</tr>
        <?php elseif ($result["jenis"] == "Kelompok"): ?> 
			<center>(Nopeg, Nama Pegawai, dan Unit Kerja Terlampir)</center>
        <?php endif ?> 
      </td>
    </tr>
	<tr>
      <td colspan="3"><br>Maka bersama ini mengajukan biaya dimaksud sebesar:</td>
    </tr>  
    <tr>
      <td colspan="3"><table width="100%" border="1px solid" cellpadding="1" cellspacing="0"  class="table2">
		  <?php if ($result["jenis"] == "Individu"): ?>
		  <tr>
              <td><center><b>No</b></center></td>
              <td><center><b>Pengajuan berdasarkan <br>ketentuan Latbang</b></center></td>
			  <td><center><b>Uraian</b></center></td>
			  <td><center><b>Jumlah</b></center></td>
          </tr>
		<?php if (!empty($result["detail"][0]["detail_uraian"])): ?>
            <?php foreach ($result["detail"][0]["detail_uraian"] as $key => $value): 
			if($result["count_detail"]!=1){ ?>
          <tr>
            <td><center><?php echo $key+1 ?>.</center></td>
            <td><?php echo $value["uraian"]?></td>
            <td>1 Orang <?php if(!empty($value["uraian_nominal"])){ echo 'x '. $value["qty"].' '.$value["uraian_nominal"];}?> x Rp. <?php echo number_format($value["pernominal"], 2, ",", ".")?></td>
            <td>Rp. <?php echo number_format($value["nominal"], 2, ",", ".")?></td>
          </tr>
			<?php }else{ ?>
		  <tr>
            <td><center><?php echo $key+1 ?>.</center></td>
            <td><?php echo $value["uraian"]?></td>
            <td>1 Orang <?php if(!empty($value["uraian_nominal"])){ echo 'x '. $value["qty"].' '.$value["uraian_nominal"];}?> x Rp. <?php echo number_format($value["pernominal"], 2, ",", ".")?></td>
            <td>Rp. <?php echo number_format($result["detail"][0]["uraian_total"], 2, ",", ".")?></td>
          </tr>
			<?php } ?>
		 <?php endforeach ?>
          <?php endif ?>
		  <tr>
            <td></td>
            <td></td>
            <td></td>
            <td colspan="1">Rp. <?php echo number_format($result["detail"][0]["uraian_total"], 2, ",", ".")?></td>
          </tr> 
		  <tr>
            <td></td>
            <td></td>
            <td colspan="2">Terbilang : <?php echo ucfirst($result["total_biaya"]);?> rupiah</td>
          </tr>
		<?php endif ?>
		<?php if ($result["jenis"] == "Kelompok"): ?>
		  <tr>
              <td><center><b>No</b></center></td>
              <td><center><b>Pengajuan berdasarkan <br>ketentuan Latbang</b></center></td>
			  <td><center><b>Uraian</b></center></td>
			  <td><center><b>Jumlah</b></center></td>
          </tr>
		<?php if (!empty($result["detail"][0]["detail_uraian"])): ?>
            <?php foreach ($result["detail"][0]["detail_uraian"] as $key => $value): 
			if($result["count_detail"]!=1){ ?>
          <tr>
            <td><center><?php echo $key+1 ?>.</center></td>
            <td><?php echo $value["uraian"]?></td>
            <td><?php echo $result["count"]?> Orang <?php if(!empty($value["uraian_nominal"])){ echo 'x '. $value["qty"].' '.$value["uraian_nominal"];}?> x Rp. <?php echo number_format($value["pernominal"], 2, ",", ".")?></td>
            <td>Rp. <?php echo number_format($value["nominal"], 2, ",", ".")?></td>
          </tr>
			<?php }else{ ?>
		  <tr>
            <td><center><?php echo $key+1 ?>.</center></td>
            <td><?php echo $value["uraian"]?></td>
            <td><?php echo $result["count"]?> Orang <?php if(!empty($value["uraian_nominal"])){ echo 'x '. $value["qty"].' '.$value["uraian_nominal"];}?> x Rp. <?php echo number_format($value["pernominal"], 2, ",", ".")?></td>
            <td>Rp. <?php echo number_format($result["total"], 2, ",", ".")?></td>
          </tr>
			<?php } ?>
		 <?php endforeach ?>
          <?php endif ?>
		  <tr>
            <td></td>
            <td></td>
            <td></td>
            <td colspan="1">Rp. <?php echo number_format($result["total"], 2, ",", ".")?></td>
          </tr> 
		  <tr>
            <td></td>
            <td></td>
            <td colspan="2">Terbilang : <?php echo ucfirst($result["total_biaya_k"]);?> rupiah</td>
          </tr>
		<?php endif ?>
      </table></td>
    </tr> 
    <tr>
      <td colspan="3">Terlampir kami sampaikan bukti pendukung permintaan tersebut.</td>
    </tr> 
	<tr>
      <td colspan="3"><p>Demikian permohonan ini kami sampaikan, atas kebijakan kami diucapkan terima kasih.</p></td>
    </tr>
	<tr>
      <td><b>Mengetahui</b></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>  
	<tr>
      <td width="50%">Kepala Bagian SDM dan Organisasi</td>
      <td width="34%">&nbsp;</td>
      <td width="50%">Kepala Sub Bagian Pengembangan SDM</td>
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
      <td><b>NIP 1963101519901020001</b></td>
      <td>&nbsp;</td>
      <td><b>NIP 196611101986032004</b></td>
    </tr> 
	<tr>
      <td width="40%">&nbsp;</td>
      <td width="65%"><br><center>Direktur Umum & SDM</center></br></td>
      <td width="20%">&nbsp;</td>
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
      <td><center><b>Dr.dr. Basuni Radi, SpJP(K),FIHA</b></center></td>
      <td>&nbsp;</td>
    </tr>
    <tr>      
	  <td>&nbsp;</td>
      <td><center><b>NIP 196606122000121001</b></center></td>
      <td>&nbsp;</td>
    </tr>
</table>
</body></html>