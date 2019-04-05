<!doctype html>
<html><head></head><body>
<style>
     @page { margin: 160px 50px; }
     #header { position: fixed; left: -10px; top: -100px; right: -10px; bottom: -100px; height: 0px; text-align: center; }
     #foote { position: fixed; left: 0px; bottom: -150px; right: 0px; height: 50px;}
     #foote { content: counter(upper-roman); }
</style>
 <div id="header">
    <table width="100%" class="table-1" border="0">
	<tbody>
	<tr>
      <td colspan="1" width="90"><img src="<?php echo base_url(); ?>/logo2.png" width="80%"></td>
      <td colspan="1" width="100"><img src="<?php echo base_url(); ?>/logo.png" width="100%"></td>
	  <td colspan="2">&nbsp;</td>
	</tr>
	</tbody>
	</table>
   </div>
<div id="content">
<table border="0" class="table-1" style="margin:30px">
    <tr>
      <td colspan="3" align="center" style="font-size: 20px"><u><strong>N O T A   -   D I N A S</strong></u></td>
    </tr>
    <tr>
      <td colspan="3" align="center" style="font-size: 15px">Nomor : KP.03.04/XX.4/       /<?php echo date('Y'); ?></td>
    </tr>
	<tr>
      <td colspan="3">&nbsp;</td>
    </tr>
	<tr>
      <td colspan="3">
		<table width="100%" border="0" cellpadding="3">
		<tbody>          
		<tr>
            <td>Yth</td>
            <td>:</td>
            <td width="70%">Kepala Sub Bagian Kesejahteraan Pegawai</td>
			<td width="20%"align="right">&nbsp;</td>
          </tr>
		  <tr>
            <td>Dari</td>
            <td>:</td>
            <td width="70%"><?php if(!empty($result["subbag_asal"])){echo $result["subbag_asal"];}elseif(!empty($result["bag_asal"])){echo $result["bag_asal"]; }else{echo $result["dir_asal"];}?></td>
			<td width="20%">&nbsp;</td>
          </tr> 
		  <tr>
            <td>Hal</td>
            <td>:</td>
            <td width="70%"><b><?php echo $result["jenis"]?> Pegawai</b></td>
			<td width="20%">&nbsp;</td>
          </tr>
		  <tr>
            <td>Tangal</td>
            <td>:</td>
            <td width="70%"><b>       <?php echo bulan(date("m")) ." ".date("Y")?></b></td>
			<td width="20%">&nbsp;</td>
          </tr>
		</tbody>
      </table></td></tr>
    <tr>
      <td colspan="3" align="center">&nbsp;</td>
    </tr>
	<?php if($result["jum"]>=2){?>
	<tr>
      <td colspan="3"><p align="justify">      Menindaklanjuti hasil wawancara Bagian SDM dan Organisasi dengan ybs tanggal ........., berikut disampaikan <?php echo $result["jenis"]?> Pegawai an. <?php echo $result["name"]?>, dkk dengan TMT <?php echo $result["tanggal"]?> untuk dapat diproses administrasi kepegawaian selanjutnya yang meliputi :</p></td>
    </tr>
	<?php }else{?>
	<tr>
      <td colspan="3"><p align="justify">      Menindaklanjuti hasil wawancara Bagian SDM dan Organisasi dengan ybs tanggal ........., berikut disampaikan <?php echo $result["jenis"]?> Pegawai an. <?php echo $result["name"]?> dengan TMT <?php echo $result["tanggal"]?> untuk dapat diproses administrasi kepegawaian selanjutnya yang meliputi :</p></td>
    </tr>
	<?php }?>
    <tr>
      <td colspan="3">
        <table width="100%" border="0" cellpadding="3">                <tr>
                  <td width="1%" rowspan="4">
                    &nbsp;            
                  </td>
                  <td width="21%">
                    •	Penetapan SK              
                  </td>
                </tr>
                <tr>
                  <td width="21%">
                    •	Pembuatan Surat Tugas             
                  </td>
                </tr>
                <tr>
                  <td width="21%">
                    •	Perubahan Remunerasi             
                  </td>
                </tr>
                <tr>
                  <td width="21%">
                    •	Dan administrasi kepegawaian lainnya yang menjadi kewenangan di Sub Bagian  Kesejahteraan dan Hubungan Industrial              
                  </td>
                </tr>
        </table>
      </td>
    </tr>
    <tr>
      <td colspan="3"><p>Adapun data perubahan sebagai berikut :</p></td>
    </tr>
	 <tr>
      <td colspan="3"><table width="100%" border="1px solid" cellpadding="1" cellspacing="0"  class="table2">
		  <tr>
              <th rowspan="2" width="2%" align="center">Nopeg</th>
              <th rowspan="2" width="5%" >Nama</th>
              <th rowspan="1" colspan="2" width="10%" align="center">Lama</th>
              <th rowspan="1" colspan="2" width="10%" align="center">Baru</th>
          </tr>
		  <tr>
			  <th scope="col" align="center">Unit Kerja</th>
              <th scope="col" width="10%" align="center">Jabatan</th>
			  <th scope="col" align="center">Unit Kerja</th>
              <th scope="col" width="10%" align="center">Jabatan</th>
          </tr>
		  <?php if (!empty($result["mutasi"])): ?> 
             <?php foreach ($result["mutasi"] as $key => $value): ?> 
		  <tr>
            <td><center><?php echo $value["user_id"]?></center></td>
            <td><center><?php echo $value["name"]?></center></td>
            <td><?php if(!empty($value["subbag_asal"])){echo $value["subbag_asal"];}elseif(!empty($value["bag_asal"])){echo $value["bag_asal"]; }else{echo $value["dir_asal"];}?></td>
            <td><?php echo $value["ds_jabatan"]?></td>
            <td><?php if(!empty($value["subbag_tujuan"])){echo $value["subbag_tujuan"];}elseif(!empty($value["bag_tujuan"])){echo $value["bag_tujuan"]; }else{echo $value["dir_tujuan"];}?></td>
            <td><?php echo $value["ds_jabatan"]?></td>
		  </tr>
		 <?php endforeach ?>
            <?php endif ?>
      </table></td>
    </tr> 
	<tr>
      <td colspan="3"><p>Demikian surat ini disampaikan, atas bantuan dan kerjasamanya diucapkan terima kasih.</p></td>
    </tr>
    <tr>
      <td colspan="3">&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td width="34%">&nbsp;</td>
      <td width="36%">&nbsp;</td>
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
      <td><b>SUWASTINI, SAp, MM,</b></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td><b>NIP 196611101986032004</b></td>
    </tr>
</table>
</div>
</body></html>