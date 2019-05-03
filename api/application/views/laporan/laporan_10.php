<!doctype html>
<html><head></head><body>
<style>
     @page { margin: 100px 20px; }
     #header { position: fixed; left: -10px; top: -90px; right: -10px; bottom: -100px; height: 0px; text-align: center; }
     #foote { position: fixed; left: 0px; bottom: -170px; right: 0px; height: 150px; }
     #foote { content: counter(upper-roman); }
</style>
 <div hidden="<?php echo $result["footer"]; ?>" id="header">
    <table width="100%" class="table-1" border="0">
	<tbody>
	<tr>
      <td colspan="3"align="left"><b>Catatan Kegiatan Seminar/lokakarya/Workshop/Pelatihan<br> Berdasarkan Usulan Biaya <br> RS. Jantung dan Pembuluh Darah Harapan Kita</b><br><br>Periode :<?php echo $result["awal"]; ?> sd <?php echo $result["akhir"]; ?></td>
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
      <td colspan="1"align="left" width="30">Prepared by SDM & Organisas</td>
      <td colspan="3"align="center" width="50">Printed : <?php echo date("d")." ".bulan(date("m")) ." ". date("Y"); ?></td>
	  <td colspan="1" width="30"></td>
	</tr>
	</tbody>
	</table>
	</div>
<div id="content">
<table width="100%" border="0" class="table-1" style="margin:30px">
	<tr>
      <td></td>
      <td width="34%"></td>
      <td width="36%"></td>
	</tr>
    <tr>
      <td colspan="3">
        <table width="100%" border="0px" cellpadding="1" cellspacing="0" class="table2" style="margin-top: 15px">
          <tr>
		   <th rowspan="2" align="center" width="25%">Jenis Kegiatan</th>
            <th rowspan="2" align="center" width="1%"></th>
            <th rowspan="2" align="center" width="2%"></th>
		    <th rowspan="2" align="center" width="13%">Jenis Pegawai</th>
            <th colspan="2" align="center" width="6%">Durasi</th>
            <th rowspan="2" align="center" width="30%">Biaya</th>
			
          </tr>
		   <tr>
              <th scope="col" width="3%">Hari</th>
              <th scope="col" width="3%">Jam</th>
           </tr>
          <?php if (!empty($result)): ?>
            <?php foreach ($result as $key => $val): ?>
              <tr>
			    <td valign="top" align="center">
					<?php echo $val["nama_kegiatan"]; ?>
				</td>
				<td>
				</td>
				<td valign="top">
				<table width="100%" border="0px" cellpadding="1" cellspacing="0" class="table2">
				  <?php foreach ($result[$key]["pegawai"] as $key_jum => $value_jum): ?>
					  <tr>
						<td><?php echo $value_jum["jum"]; ?></td>
					  </tr>
				  <?php endforeach ?>
				</table>
				</td>
				<td valign="top"><table width="100%" border="0px" cellpadding="1" cellspacing="0" class="table2">
				  <?php if (!empty($result[$key]["pegawai"])): ?>
					<?php foreach ($result[$key]["pegawai"] as $key_prof => $value_profesi): ?>
					  <tr>
						<td align="center"><?php echo $value_profesi["profesi"]; ?></td>
					  </tr>
					<?php endforeach ?>
				  <?php endif ?>
				</table></td>
				<td valign="top"><table width="100%" border="0px" cellpadding="1" cellspacing="0" class="table2">
				  <?php if (!empty($result[$key]["pegawai"])): ?>
					<?php foreach ($result[$key]["pegawai"] as $key_hari => $value_hari): ?>
					  <tr>
						<td><?php if(!empty($value_hari["hari"])) {echo $value_hari["hari"];}else{ echo "0";}; ?></td>
					  </tr>
					<?php endforeach ?>
				  <?php endif ?>
				</table></td>
                <td valign="top"><table width="100%" border="0px" cellpadding="1" cellspacing="0" class="table2">
				  <?php if (!empty($result[$key]["pegawai"])): ?>
					<?php foreach ($result[$key]["pegawai"] as $key_hr => $value_hr): ?>
					  <tr>
						<td><?php echo 8*$value_hr["hari"]; ?></td>
					  </tr>
					<?php endforeach ?>
				  <?php endif ?>
				</table></td>
                <td valign="top">
				<table width="100%" border="0px" cellpadding="1" cellspacing="0" class="table2">
				  <?php if (!empty($result[$key]["pegawai"])): ?>
					<?php foreach ($result[$key]["pegawai"] as $key_nom => $value_nom): ?>
					  <tr>
						<td>
						<table width="100%" border="0px" cellpadding="1" cellspacing="0" class="table2">
							<tr>
							  <td width="30%"></td>
							  <td width="10%">Rp.</td>
							  <td align="right" width="50%"><?php echo number_format($value_nom["nominal"], 0, ",", ".")?></td>
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
					<?php foreach ($result[$key]["pegawai"] as $key_tot => $value_tot): 
					$nominal += $value_tot["nominal"];
					$hari += $value_tot["hari"];
					$jam += 8*$value_tot["hari"];
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
      </td>
    </tr>
</table>
</div>
</body></html>