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
	<table width="95%" border="0px" cellpadding="1" cellspacing="0" class="table2" style="margin:10px 10px 10px 30px">
		<tbody>
			<tr>
			  <td align="left" width="5%">Nama</td>
			  <td align="left" width="1%">:</td>
			  <td align="left" width="89%"><?php echo $result[0]["prof"][0]["kegiatan"][0]["nama_pegawai"]; ?></td>
			</tr>
			<tr>
			  <td align="left" width="5%">Nopeg</td>
			  <td align="left" width="1%">:</td>
			  <td align="left" width="89%"><?php echo $result[0]["prof"][0]["kegiatan"][0]["nopeg"]?></td>
			</tr>
			<tr>
			  <td align="left" width="5%">Unit</td>
			  <td align="left" width="1%">:</td>
			  <td align="left" width="89%"><?php echo $result[0]["prof"][0]["kegiatan"][0]["grup"] ?></td>
			</tr>
		</tbody>
	</table>
<table width="95%" border="0px" cellpadding="1" cellspacing="0" class="table2" style="margin:10px 10px 10px 30px">
	<tr>
		    <td rowspan="2" align="center" width="5%">Jenis Pegawai</td>
            <td rowspan="2" align="center" width="10%">Jenis Kegiatan</td>
            <td rowspan="2" align="center" width="2%">No</td>
			<td rowspan="2" align="center" width="15%">Nama Kegiatan</td>
            <td rowspan="2" align="center" width="10%">Lembaga</td>
			<td rowspan="2" align="center" width="5%">Status</td>
			<td rowspan="2" align="center" width="8%">Tempat</td>
            <td colspan="2" align="center" width="4%">Durasi</td>
            <td rowspan="2" align="center" width="10%">Tanggal</td>
            <td rowspan="2" align="center" width="20%">Biaya</td>
          </tr>
		   <tr>
              <td scope="col" width="2%">Hari</td>
              <td scope="col" width="2%">Jam</td>
           </tr>
          <?php if (!empty($result)): ?>
            <?php foreach ($result as $key => $val): ?>
              <tr>
			    <td valign="top" width="15%" align="center"><?php echo $val["ds_group_jabatan"]; ?></td>
			   </tr>
				<?php if (!empty($result[$key]["prof"])): ?>
					<?php foreach ($result[$key]["prof"] as $key_pelatihan => $value_pelatihan): ?>
				<tr>
				<td valign="top"></td> 
				<td valign="top" width="15%">
				<table width="100%" border="0px" cellpadding="1" cellspacing="0" class="table2">
				    <tr>
						<td align="center"><?php echo $value_pelatihan["nama"]; ?></td>
					  </tr>
					</table>
				</td>
			    <td valign="top" width="1%"><table width="100%" border="0px" cellpadding="1" cellspacing="0" class="table2">
				  <?php foreach ($result[$key]["prof"][$key_pelatihan]["kegiatan"] as $key_jum => $value): ?>
					<tr>
				     <td><?php echo $key_jum+1; $jum+=$key_jum+1; ?></td>
					</tr>
				  <?php endforeach ?>
				</table></td>
				<td valign="top">
				<table width="100%" border="0px" cellpadding="1" cellspacing="0" class="table2">
				  <?php if (!empty($result[$key]["prof"][$key_pelatihan]["kegiatan"])): ?>
					<?php foreach ($result[$key]["prof"][$key_pelatihan]["kegiatan"] as $key_pel => $value_pel): ?>
					  <tr>
						<td align="center"><?php echo $value_pel["nama_pelatihan"]; ?></td>
					  </tr>
					<?php endforeach ?>
				  <?php endif ?>
				</table>
				</td>
				<td valign="top" width="10%">
				<table width="100%" border="0px" cellpadding="1" cellspacing="0" class="table2">
				  <?php if (!empty($result[$key]["prof"][$key_pelatihan]["kegiatan"])): ?>
					<?php foreach ($result[$key]["prof"][$key_pelatihan]["kegiatan"] as $key_tujuan => $value_tujuan): ?>
					  <tr>
						<td><?php echo $value_tujuan["tujuan"]; ?></td>
					  </tr>
					<?php endforeach ?>
				  <?php endif ?>
				</table>
				</td>
                <td valign="top" width="5%">
				<table width="100%" border="0px" cellpadding="1" cellspacing="0" class="table2">
				  <?php if (!empty($result[$key]["prof"][$key_pelatihan]["kegiatan"])): ?>
					<?php foreach ($result[$key]["prof"][$key_pelatihan]["kegiatan"] as $key_status => $value_status): ?>
					  <tr>
						<td><?php echo $value_status["status"]; ?></td>
					  </tr>
					<?php endforeach ?>
				  <?php endif ?>
				</table>
				</td>
                <td valign="top" width="10%">
				<table width="100%" border="0px" cellpadding="1" cellspacing="0" class="table2">
				  <?php if (!empty($result[$key]["prof"][$key_pelatihan]["kegiatan"])): ?>
					<?php foreach ($result[$key]["prof"][$key_pelatihan]["kegiatan"] as $key_tuj => $value_tuj): ?>
					  <tr>
						<td align="center"><?php echo $value_tuj["tujuan"]; ?></td>
					  </tr>
					<?php endforeach ?>
				  <?php endif ?>
				</table>
				</td>
				<td valign="top" width="2%">
				<table width="100%" border="0px" cellpadding="1" cellspacing="0" class="table2">
				  <?php if (!empty($result[$key]["prof"][$key_pelatihan]["kegiatan"])): ?>
					<?php foreach ($result[$key]["prof"][$key_pelatihan]["kegiatan"] as $key_hari => $value_hari): ?>
					  <tr>
						<td><?php if(!empty($value_hari["total_hari_kerja"])) {echo $value_hari["total_hari_kerja"];}else{ echo "0";}; ?></td>
					  </tr>
					<?php endforeach ?>
				  <?php endif ?>
				</table>
				</td>
                <td valign="top" width="2%">
				<table width="100%" border="0px" cellpadding="1" cellspacing="0" class="table2">
				  <?php if (!empty($result[$key]["prof"][$key_pelatihan]["kegiatan"])): ?>
					<?php foreach ($result[$key]["prof"][$key_pelatihan]["kegiatan"] as $key_hr => $value_hr): ?>
					  <tr>
						<td><?php echo $value_hr["total_jam"]; ?></td>
					  </tr>
					<?php endforeach ?>
				  <?php endif ?>
				</table>
				</td>
                <td valign="top" width="10%">
				<table width="100%" border="0px" cellpadding="1" cellspacing="0" class="table2">
				  <?php if (!empty($result[$key]["prof"][$key_pelatihan]["kegiatan"])): ?>
					<?php foreach ($result[$key]["prof"][$key_pelatihan]["kegiatan"] as $key_tgl => $value_tgl): ?>
					  <tr>
						<td><?php echo $value_tgl["tanggal_to"]; ?></td>
					  </tr>
					<?php endforeach ?>
				  <?php endif ?>
				</table>
				</td>
			    <td valign="top" width="15%">
				<table width="100%" border="0px" cellpadding="1" cellspacing="0" class="table2">
				  <?php if (!empty($result[$key]["prof"][$key_pelatihan]["kegiatan"])): ?>
					<?php foreach ($result[$key]["prof"][$key_pelatihan]["kegiatan"] as $key_nom => $value_nom): ?>
					  <tr>
						<td>
					  <table width="100%" border="0px" cellpadding="1" cellspacing="0" class="table2">
						  <tr>
							<td width="30%"></td>
							<td width="10%">Rp.</td>
							<td align="right" width="50%"><?php echo number_format($value_nom["pernominal"], 0, ",", ".");$pernominal+=$value_nom["pernominal"];?></td>
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
			<?php endforeach ?>
          <?php endif ?>
			<?php endforeach ?>
          <?php endif ?>
				<tr>
                <td valign="top">
				</td><td valign="top">
				</td><td valign="top">
				</td><td valign="top">
				</td><td valign="top">
				</td><td valign="top">
				</td><td valign="top">
				</td><td valign="top">
				</td><td valign="top">
				</td><td valign="top"><b>Total</b>
				</td>
			    <td valign="top" width="15%">
				<table width="100%" border="0px" cellpadding="1" cellspacing="0" class="table2">
				   <tr>
						<td>
					  <table width="100%" border="0px" cellpadding="1" cellspacing="0" class="table2">
						  <tr>
							<td width="30%"></td>
							<td width="10%">Rp.</td>
							<td align="right" width="50%"><b><?php echo number_format($pernominal, 0, ",", ".")?></b></td>
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