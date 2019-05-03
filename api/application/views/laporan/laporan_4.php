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
<table width="95%" border="0" class="table-1" style="margin:30px">
	<tr>
      <td></td>
      <td width="34%"></td>
      <td width="36%"></td>
	</tr>
    <tr>
      <td colspan="3">
        <table width="100%" border="0px solid" cellpadding="1" cellspacing="0" class="table2" style="margin-top: 15px">
          <tr>
		    <th rowspan="2" align="center" width="5%">Jenis Pegawai</th>
            <th rowspan="2" align="center" width="10%">Jenis Kegiatan</th>
            <th rowspan="2" align="center" width="2%">No</th>
			<th rowspan="2" align="center" width="15%">Nama Kegiatan</th>
            <th rowspan="2" align="center" width="10%">Lembaga</th>
			<th rowspan="2" align="center" width="5%">Status</th>
			<th rowspan="2" align="center" width="8%">Tempat</th>
            <th colspan="2" align="center" width="4%">Durasi</th>
            <th rowspan="2" align="center" width="10%">Tanggal</th>
            <th rowspan="2" align="center" width="20%">Biaya</th>
          </tr>
		   <tr>
              <th scope="col" width="2%">Hari</th>
              <th scope="col" width="2%">Jam</th>
           </tr>
          <?php if (!empty($result)): ?>
            <?php foreach ($result as $key => $val): ?>
              <tr>
			    <td valign="top" width="15%"><?php echo $val["ds_group_jabatan"]; ?></td>
			    <td valign="top" width="15%">
				<table width="100%" border="0px" cellpadding="1" cellspacing="0" class="table2">
				  <?php foreach ($result[$key]["baru"] as $key_keg => $value_keg): ?>
					  <tr>
						<td><?php echo $value_keg["nama"]; ?></td>
					  </tr>
					  <tr><td>
					  <?php $jum=count($result[$key]["pelatihan"]);
						for ($i = 1; $i < $jum; $i++){ ?>
					  <?php echo "<br>";} ?>
					  </td></tr>
				  <?php endforeach ?>
				</table>
				</td>
			    <td valign="top" width="1%"><table width="100%" border="0px" cellpadding="1" cellspacing="0" class="table2">
				  <?php foreach ($result[$key]["pelatihan"] as $key_jum => $value): ?>
					<tr>
				     <td><?php echo $key_jum+1; ?></td>
					</tr>
				  <?php endforeach ?>
				</table></td>
				<td valign="top">
				<table width="100%" border="0px" cellpadding="1" cellspacing="0" class="table2">
				  <?php if (!empty($result[$key]["pelatihan"])): ?>
					<?php foreach ($result[$key]["pelatihan"] as $key_pelatihan => $value_pelatihan): ?>
					  <tr>
						<td><?php echo $value_pelatihan["nama_pelatihan"]; ?></td>
					  </tr>
					<?php endforeach ?>
				  <?php endif ?>
				</table>
				</td>
				<td valign="top" width="10%">
				<table width="100%" border="0px" cellpadding="1" cellspacing="0" class="table2">
				  <?php if (!empty($result[$key]["pelatihan"])): ?>
					<?php foreach ($result[$key]["pelatihan"] as $key_tujuan => $value_tujuan): ?>
					  <tr>
						<td><?php echo $value_tujuan["tujuan"]; ?></td>
					  </tr>
					<?php endforeach ?>
				  <?php endif ?>
				</table>
				</td>
                <td valign="top" width="5%">
				<table width="100%" border="0px" cellpadding="1" cellspacing="0" class="table2">
				  <?php if (!empty($result[$key]["pelatihan"])): ?>
					<?php foreach ($result[$key]["pelatihan"] as $key_status => $value_status): ?>
					  <tr>
						<td><?php echo $value_status["status"]; ?></td>
					  </tr>
					<?php endforeach ?>
				  <?php endif ?>
				</table>
				</td>
                <td valign="top" width="10%">
				<table width="100%" border="0px" cellpadding="1" cellspacing="0" class="table2">
				  <?php if (!empty($result[$key]["pelatihan"])): ?>
					<?php foreach ($result[$key]["pelatihan"] as $key_tujuan => $value_tujuan): ?>
					  <tr>
						<td><?php echo $value_tujuan["tujuan"]; ?></td>
					  </tr>
					<?php endforeach ?>
				  <?php endif ?>
				</table>
				</td>
				<td valign="top" width="2%">
				<table width="100%" border="0px" cellpadding="1" cellspacing="0" class="table2">
				  <?php if (!empty($result[$key]["pelatihan"])): ?>
					<?php foreach ($result[$key]["pelatihan"] as $key_hari => $value_hari): ?>
					  <tr>
						<td><?php if(!empty($value_hari["total_hari_kerja"])) {echo $value_hari["total_hari_kerja"];}else{ echo "0";}; ?></td>
					  </tr>
					<?php endforeach ?>
				  <?php endif ?>
				</table>
				</td>
                <td valign="top" width="2%">
				<table width="100%" border="0px" cellpadding="1" cellspacing="0" class="table2">
				  <?php if (!empty($result[$key]["pelatihan"])): ?>
					<?php foreach ($result[$key]["pelatihan"] as $key_hr => $value_hr): ?>
					  <tr>
						<td><?php echo 8*$value_hr["total_hari_kerja"]; ?></td>
					  </tr>
					<?php endforeach ?>
				  <?php endif ?>
				</table>
				</td>
                <td valign="top" width="10%">
				<table width="100%" border="0px" cellpadding="1" cellspacing="0" class="table2">
				  <?php if (!empty($result[$key]["pelatihan"])): ?>
					<?php foreach ($result[$key]["pelatihan"] as $key_tgl => $value_tgl): ?>
					  <tr>
						<td><?php echo $value_tgl["tanggal_to"]; ?></td>
					  </tr>
					<?php endforeach ?>
				  <?php endif ?>
				</table>
				</td>
			    <td valign="top" width="15%">
				<table width="100%" border="0px" cellpadding="1" cellspacing="0" class="table2">
				  <?php if (!empty($result[$key]["pelatihan"])): ?>
					<?php foreach ($result[$key]["pelatihan"] as $key_nom => $value_nom): ?>
					  <tr>
						<td>
					  <table width="100%" border="0px" cellpadding="1" cellspacing="0" class="table2">
						  <tr>
							<td width="30%"></td>
							<td width="10%">Rp.</td>
							<td align="right" width="50%"><?php echo number_format($value_nom["uraian_total"], 0, ",", ".")?></td>
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
        </table>
      </td>
    </tr>
</table>
</div>
</body></html>