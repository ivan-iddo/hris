<!doctype html>
<?php
  header("Content-type: application/vnd-ms-excel");
  header("Content-Disposition: attachment; filename=$file_title.xls"); 
  header('Content-Type: application/force-download');
?> 
<html><head></head><body>
<style>
     @page { margin: 130px 20px 40px 15px; }
     #header { position: fixed; left: -10px; top: -120px; right: -10px; bottom: -80px; height: 0px; text-align: center; }
     #foote { position: fixed; left: 0px; bottom: -30px; right: 0px; height: 40px; }
     #foote { content: counter(upper-roman); }
</style>
 <div hidden="<?php echo $result["footer"]; ?>" id="header">
    <table width="100%" class="table-1" border="0">
	<tbody>
	<tr>
      <td colspan="3"align="left"><b>Catatan Kegiatan Seminar/lokakarya/Workshop/Pelatihan<br> Berdasarkan Usulan Biaya <br> RS. Jantung dan Pembuluh Darah Harapan Kita</b><br><br>Periode :<?php echo $result[0]["awal"]; ?> sd <?php echo $result[0]["akhir"]; ?></td>
	  <td colspan="1" width="100"><img src="<?php echo base_url(); ?>/logo.png" width="100%"></td>
	</tr>
	<tr>
	<hr/>
	</tr>
	</tbody>
	</table>
   </div>
   <div hidden="<?php echo $result["footer"]; ?>" id="foote">
	 <hr/>
	 <table width="100%" class="table-1" border="0">
	<tbody>
	<tr>
      <td colspan="1"align="left" width="30">Prepared by SDM & Organisasi</td>
      <td colspan="3"align="center" width="50">Printed : <?php echo date("d")." ".bulan(date("m")) ." ". date("Y"); ?></td>
	  <td colspan="1" width="30"></td>
	</tr>
	</tbody>
	</table>
	</div>
<div id="content">
<table width="100%" border="0" class="table-1" style="margin:30px">
	<tr>
		    <td rowspan="2" width="25%">Jenis Pegawai</td>
            <td rowspan="2" align="center" width="1%"></td>
            <td rowspan="2" align="center" width="2%"></td>
            <td rowspan="2" width="13%">Jenis Kegiatan</td>
            <td colspan="2" align="center" width="9%">Durasi</td>
            <td rowspan="2" align="center" width="30%">Biaya</td>
          </tr>
		   <tr>
              <td scope="col">Hari</td>
              <td scope="col">Jam</td>
           </tr>
          <?php if (!empty($result)): ?>
            <?php foreach ($result as $key => $val): ?>
              <tr>
			    <td valign="top"><?php echo $val["profesi"]; ?></td>
			    <td></td>
				<td valign="top"><table width="100%" border="0px" cellpadding="1" cellspacing="0" class="table2">
				<?php if (!empty($result[$key]["data"])): ?>
					<?php foreach ($result[$key]["data"] as $key_jum => $value_jum): ?>
					<tr>
				     <td><?php echo $value_jum["jum_pegawai"]; ?></td>
					</tr>
					<?php endforeach ?>
				<?php endif ?>
				 </table>
				</td>
				<td>
				<table valign="top" width="100%" border="0px" cellpadding="1" cellspacing="0" class="table2">
				<?php if (!empty($result[$key]["data"])): ?>
					<?php foreach ($result[$key]["data"] as $key_kegiatan_nama => $value_kegiatan_nama): ?>
					<tr>
				     <td><?php echo $value_kegiatan_nama["kegiatan_nama"]; ?></td>
					</tr>
					<?php endforeach ?>
				<?php endif ?>
				</table>
				</td>
                <td><table valign="top" width="100%" border="0px" cellpadding="1" cellspacing="0" class="table2">
				<?php if (!empty($result[$key]["data"])): ?>
					<?php foreach ($result[$key]["data"] as $key_hari=> $value_hari): ?>
					<tr>
				     <td><?php echo $value_hari["jum_hari"]; ?></td>
					</tr>
					<?php endforeach ?>
				<?php endif ?>
				</table>
				</td>
                <td><table valign="top" width="100%" border="0px" cellpadding="1" cellspacing="0" class="table2">
				<?php if (!empty($result[$key]["data"])): ?>
					<?php foreach ($result[$key]["data"] as $key_jam=> $value_jam): ?>
					<tr>
				     <td><?php echo $value_jam["jum_jam"]; ?></td>
					</tr>
					<?php endforeach ?>
				<?php endif ?>
				</table>
				</td>
                <td>
				<table width="100%" border="0px" cellpadding="1" cellspacing="0" class="table2">
				<?php if (!empty($result[$key]["data"])): ?>
					<?php foreach ($result[$key]["data"] as $key_nominal=> $value_nominal): ?>
					
					<tr>
						<td>
						<table width="100%" border="0px" cellpadding="1" cellspacing="0" class="table2">
							<tr>
							  <td width="30%"></td>
							  <td width="10%">Rp.</td>
							  <td align="right" width="50%"><?php echo number_format($value_nominal["pernomin"], 0, ",", ".")?></td>
							  <td width="20%"></td>
							</tr>
						</table>
						</td>
					  </tr>
					<?php endforeach ?>
				<?php endif ?>
					</table>
				</td>
              </tr>
			  <tr>
			    <td valign="top"></td>
			    <td valign="bottom" align="center">Jumlah</td>
				<td valign="top"><?php echo $val["jum"]?></td>
				<?php $a += $val["jum"]?>
				<td valign="top"></td>
				<td valign="top"><b><?php echo $val["hari"]; $hari+=$val["hari"];?></b></td>
                <td valign="top"><b></b><?php echo $val["total_jam"]; $jam+=$val["total_jam"]; ?></td>
				<td valign="top">
				<table width="100%" border="0px" cellpadding="1" cellspacing="0" class="table2">
				  <tr>
					<td width="30%"></td>
					<td width="10%">Rp.</td>
					<td align="right" width="50%"><b><?php echo number_format($val["harga"], 0, ",", "."); $total+=$val["harga"];?></b></td>
					<td width="20%"></td>
				   </tr>
				 </table>
				</td>
              </tr>
            <?php endforeach ?>
          <?php endif ?>
			<tr>
			    <td valign="top"></td>
			    <td valign="bottom" align="center">Total</td>
				<td valign="top"><b><?php echo $a; ?></b></td>
				<td valign="top"></td>
				<td valign="top"><b><?php echo $hari; ?></b></td>
                <td valign="top"><b><?php echo $jam; ?></b></td>
				<td valign="top">
				<table width="100%" border="0px" cellpadding="1" cellspacing="0" class="table2">
					<tr>
						<td width="30%"></td>
						<td width="10%">Rp.</td>
						<td align="right" width="50%"><b><?php echo number_format($total, 0, ",", ".")?></b></td>
						<td width="20%"></td>
					</tr>
				</table>
				</td>
              </tr>
</table>
</div>
</body></html>
