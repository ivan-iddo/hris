<!doctype html>
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
				  <?php foreach ($result[$key]["pegawai"] as $key_jum => $value): ?>
					<tr>
				     <td><?php echo $value["jum"]; ?></td>
					</tr>
				  <?php endforeach ?>
				</table>
				</td>
				<td>
				<table width="100%" border="0px" cellpadding="1" cellspacing="0" class="table2">
				  <?php foreach ($result[$key]["pegawai"] as $key_keg => $value_keg): ?>
					  <tr>
						<td><?php echo $value_keg["kegiatan"]; ?></td>
					  </tr>
				  <?php endforeach ?>
				</table>
				</td>
                <td><table width="100%" border="0px" cellpadding="1" cellspacing="0" class="table2">
				  <?php if (!empty($result[$key]["pegawai"])): ?>
					<?php foreach ($result[$key]["pegawai"] as $key_hr => $value_hr): ?>
					  <tr>
						<td><?php echo $value_hr["hari"]; ?></td>
						</tr>
					<?php endforeach ?>
				  <?php endif ?>
				</table>
				</td>
                <td><table width="100%" border="0px" cellpadding="1" cellspacing="0" class="table2">
				  <?php if (!empty($result[$key]["pegawai"])): ?>
					<?php foreach ($result[$key]["pegawai"] as $key_h => $value_h): ?>
					  <tr>
						<td><?php echo 8*$value_h["hari"]; ?></td>
						</tr>
					<?php endforeach ?>
				  <?php endif ?>
				</table>
				</td>
                <td>
				<table width="100%" border="0px" cellpadding="1" cellspacing="0" class="table2">
				  <?php if (!empty($result[$key]["pegawai"])): ?>
					<?php foreach ($result[$key]["pegawai"] as $key_biy => $value_biy): ?>
					  <tr>
						<td>
						<table width="100%" border="0px" cellpadding="1" cellspacing="0" class="table2">
							<tr>
							  <td width="30%"></td>
							  <td width="10%">Rp.</td>
							  <td align="right" width="50%"><?php echo number_format($value_biy["nominal"], 0, ",", ".")?></td>
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
			     <?php if (!empty($result[$key]["pegawai"])): ?>
					<?php foreach ($result[$key]["pegawai"] as $key_jum => $value_jum): 
					$nominal += $value_jum["nominal"];
					$hari += $value_jum["hari"];
					$jam += 8*$value_jum["hari"];
					?>
				    <?php endforeach ?>
				  <?php endif ?>
				<td valign="top"><?php echo $val["jum"]?></td>
				<?php $a += $val["jum"]?>
				<td valign="top"></td>
				<td valign="top"><b><?php echo $val["hari"]?></b></td>
                <td valign="top"><b></b><?php echo 8*$val["hari"] ?></td>
				<td valign="top">
				<table width="100%" border="0px" cellpadding="1" cellspacing="0" class="table2">
				  <tr>
					<td width="30%"></td>
					<td width="10%">Rp.</td>
					<td align="right" width="50%"><b><?php echo number_format($val["nominal"], 0, ",", ".")?></b></td>
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
						<td align="right" width="50%"><b><?php echo number_format($nominal, 0, ",", ".")?></b></td>
						<td width="20%"></td>
					</tr>
				</table>
				</td>
              </tr>
</table>
</div>
</body></html>
