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
<table border="0" class="table-1" style="margin:30px">
	<tr>
		    <td rowspan="2" align="center">Departemen</td> 
		    <td rowspan="2" align="center">Jenis Pegawai</td> 
		    <td rowspan="2" align="center">Nama Pegawai</td>
            <td rowspan="2" align="center">Nama Kegiatan</td>
            <td colspan="2" align="center">Durasi</td>
            <td rowspan="2" align="center">Biaya</td>
          </tr>
		   <tr>
              <td scope="col">Hari</td>
              <td scope="col">Jam</td>
           </tr>
          <?php if (!empty($result)): ?>
            <?php foreach ($result as $key => $val): ?>
              <tr>
			    <td valign="top"><?php echo $val["grup"]; ?></td>
				<td><table width="100%" border="0px" cellpadding="1" cellspacing="0" class="table2">
				  <?php if (!empty($result[$key]["jenis"])): ?>
					<?php foreach ($result[$key]["jenis"] as $key_profesi => $value_profesi): ?>
					  <tr>
						<td><?php echo $value_profesi["ds_group_jabatan"]; ?></td>
					  </tr>
					  <tr><td>
					  <?php $jum=count($result[$key]["pegawai"]);
						for ($i = 1; $i < $jum; $i++){ ?>
					  <?php echo "<br>";} ?>
					  </td></tr>
					<?php endforeach ?>
				  <?php endif ?>
				</table>
				</td>
				<td><table width="100%" border="0px" cellpadding="1" cellspacing="0" class="table2">
				  <?php if (!empty($result[$key]["detail_pegawai"])): ?>
					<?php foreach ($result[$key]["detail_pegawai"] as $key_peg => $value_peg): ?>
					  <tr>
						<td><?php echo $value_peg["nama_pegawai"]; ?></td>
					  </tr>
					  <tr><td>
					  <?php $jum=count($result[$key]["pegawai"]);
						for ($i = 1; $i < $jum; $i++){ ?>
					  <?php echo "<br>";} ?>
					  </td></tr>
					<?php endforeach ?>
				  <?php endif ?>
				</table>
				</td>
				<td valign="top">
				<table width="100%" border="0px" cellpadding="1" cellspacing="0" class="table2">
				  <?php if (!empty($result[$key]["total_pegawai"])): ?>
					<?php foreach ($result[$key]["total_pegawai"] as $key_pelatihan => $value_pelatihan): ?>
					  <tr>
						<td><?php echo $value_pelatihan["nama_pelatihan"]; ?></td>
					  </tr>
					<?php endforeach ?>
				  <?php endif ?>
				</table></td>
				<td valign="top">
				<table width="100%" border="0px" cellpadding="1" cellspacing="0" class="table2">
				  <?php if (!empty($result[$key]["total_pegawai"])): ?>
					<?php foreach ($result[$key]["total_pegawai"] as $key_hari => $value_hari): ?>
					  <tr>
						<td><?php if(!empty($value_hari["total_hari_kerja"])) {echo $value_hari["total_hari_kerja"];}else{ echo "0";}; ?></td>
					  </tr>
					<?php endforeach ?>
				  <?php endif ?>
				</table>
				</td>
                <td valign="top">
				<table width="100%" border="0px" cellpadding="1" cellspacing="0" class="table2">
				  <?php if (!empty($result[$key]["total_pegawai"])): ?>
					<?php foreach ($result[$key]["total_pegawai"] as $key_jam => $value_jam): ?>
					  <tr>
						<td><?php echo 8*$value_jam["total_hari_kerja"]; ?></td>
					  </tr>
					<?php endforeach ?>
				  <?php endif ?>
				</table>
				</td>
                <td valign="top">
				<table width="100%" border="0px" cellpadding="1" cellspacing="0" class="table2">
				  <?php if (!empty($result[$key]["total_pegawai"])): ?>
					<?php foreach ($result[$key]["total_pegawai"] as $key_nom => $value_nom): ?>
					  <tr>
						<td>Rp. <?php echo number_format($value_nom["uraian_total"], 0, ",", ".")?></td>
					  </tr>
					<?php endforeach ?>
				  <?php endif ?>
				</table>
				</td>
              </tr>
            <?php endforeach ?>
          <?php endif ?>
</table>
</div>
</body></html>