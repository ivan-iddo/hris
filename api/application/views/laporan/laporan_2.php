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
<table width="95%" border="0" class="table-1" style="margin:30px">
<tr>
			<td rowspan="2" align="center">Jenis Pegawai</td>
            <td rowspan="2" align="center">Jenis Kegiatan</td>
            <td rowspan="2" align="center">No</td>
            <td rowspan="2" align="center">Nama Pegawai</td>
            <td colspan="2" align="center">Durasi</td>
            <td rowspan="2" align="center">Tanggal</td>
            <td rowspan="2" align="center">Nama Kegiatan</td>
            <td rowspan="2" align="center">Tempat</td>
            <td rowspan="2" align="center">Biaya</td>
          </tr>
		   <tr>
              <td scope="col">Hari</td>
              <td scope="col">Jam</td>
           </tr>
          <?php if (!empty($result)): ?>
            <?php foreach ($result as $key => $val): ?>
              <tr>
			    <td valign="top"><?php echo $val["ds_group_jabatan"]; ?></td>
			    <td valign="top">
				<table width="100%" border="0px" cellpadding="1" cellspacing="0" class="table2">
				  <?php foreach ($result[$key]["kegiatan"] as $key_keg => $value_keg): ?>
					  <tr>
						<td><?php echo $value_keg["nama"]; ?></td>
					  </tr>
					  
				  <?php endforeach ?>
				</table>
				</td>
			    <td valign="top"><table width="100%" border="0px" cellpadding="1" cellspacing="0" class="table2">
				  <?php foreach ($result[$key]["kegiatan"] as $key_jum => $value): ?>
					<tr>
				     <td><?php echo $key_jum+1; ?></td>
					</tr>
				  <?php endforeach ?>
				</table></td>
				<td valign="top">
				<table width="100%" border="0px" cellpadding="1" cellspacing="0" class="table2">
				  <?php if (!empty($result[$key]["kegiatan"])): ?>
					<?php foreach ($result[$key]["kegiatan"] as $key_peg => $value_peg): ?>
					  <tr>
						<td><?php echo $value_peg["nama_pegawai"]; ?></td>
					  </tr>
					<?php endforeach ?>
				  <?php endif ?>
				</table>
				</td>
                <td valign="top">
				<table width="100%" border="0px" cellpadding="1" cellspacing="0" class="table2">
				  <?php if (!empty($result[$key]["kegiatan"])): ?>
					<?php foreach ($result[$key]["kegiatan"] as $key_hari => $value_hari): ?>
					  <tr>
						<td><?php if(!empty($value_hari["total_hari_kerja"])) {echo $value_hari["total_hari_kerja"];}else{ echo "0";}; ?></td>
					  </tr>
					<?php endforeach ?>
				  <?php endif ?>
				</table>
				</td>
                <td valign="top">
				<table width="100%" border="0px" cellpadding="1" cellspacing="0" class="table2">
				  <?php if (!empty($result[$key]["kegiatan"])): ?>
					<?php foreach ($result[$key]["kegiatan"] as $key_hr => $value_hr): ?>
					  <tr>
						<td><?php echo 8*$value_hr["total_hari_kerja"]; ?></td>
					  </tr>
					<?php endforeach ?>
				  <?php endif ?>
				</table>
				</td>
                <td valign="top">
				<table width="100%" border="0px" cellpadding="1" cellspacing="0" class="table2">
				  <?php if (!empty($result[$key]["kegiatan"])): ?>
					<?php foreach ($result[$key]["kegiatan"] as $key_tgl => $value_tgl): ?>
					  <tr>
						<td><?php echo $value_tgl["tanggal_to"]; ?></td>
					  </tr>
					<?php endforeach ?>
				  <?php endif ?>
				</table>
				</td>
				<td valign="top">
				<table width="100%" border="0px" cellpadding="1" cellspacing="0" class="table2">
				  <?php if (!empty($result[$key]["kegiatan"])): ?>
					<?php foreach ($result[$key]["kegiatan"] as $key_pelatihan => $value_pelatihan): ?>
					  <tr>
						<td><?php echo $value_pelatihan["nama_pelatihan"]; ?></td>
					  </tr>
					<?php endforeach ?>
				  <?php endif ?>
				</table>
				</td>
				<td valign="top">
				<table width="100%" border="0px" cellpadding="1" cellspacing="0" class="table2">
				  <?php if (!empty($result[$key]["kegiatan"])): ?>
					<?php foreach ($result[$key]["kegiatan"] as $key_tujuan => $value_tujuan): ?>
					  <tr>
						<td><?php echo $value_tujuan["tujuan"]; ?></td>
					  </tr>
					<?php endforeach ?>
				  <?php endif ?>
				</table>
				</td>
                <td valign="top">
				<table width="100%" border="0px" cellpadding="1" cellspacing="0" class="table2">
				  <?php if (!empty($result[$key]["kegiatan"])): ?>
					<?php foreach ($result[$key]["kegiatan"] as $key_nom => $value_nom): ?>
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