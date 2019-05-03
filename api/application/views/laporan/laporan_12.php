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
      <td colspan="4">
        <table width="100%" border="0px solid" cellpadding="1" cellspacing="0" class="table2" style="margin-top: 15px">
          <tr>
		    <th rowspan="2" align="center" width="35%">Departemen</th> 
		    <th rowspan="2" align="center" width="25%">Nama Pegawai</th>
            <th colspan="2" align="center" width="4%">Durasi</th>
            <th rowspan="2" align="center" width="20%">Biaya</th>
          </tr>
		   <tr>
              <th scope="col" width="2%">Hari</th>
              <th scope="col" width="2%">Jam</th>
           </tr>
          <?php if (!empty($result)): ?>
            <?php foreach ($result as $key => $val): ?>
              <tr>
			    <td valign="top" ><?php echo $val["grup"]; ?></td>
				<td><table width="100%" border="0px" cellpadding="1" cellspacing="0" class="table2">
				  <?php if (!empty($result[$key]["detail_pegawai"])): ?>
					<?php foreach ($result[$key]["detail_pegawai"] as $key_peg => $value_peg): ?>
					  <tr>
						<td><?php echo $value_peg["nama_pegawai"]; ?></td>
					  </tr>
					  <tr><td>
					  <?php $jum=count($result[$key]["pelatihan"]);
						for ($i = 0; $i < $jum; $i++){ ?>
					  <?php echo "<br>";} ?>
					  </td></tr>
					<?php endforeach ?>
				  <?php endif ?>
				</table>
				</td>
				<td valign="top">
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
                <td valign="top">
				<table width="100%" border="0px" cellpadding="1" cellspacing="0" class="table2">
				  <?php if (!empty($result[$key]["pelatihan"])): ?>
					<?php foreach ($result[$key]["pelatihan"] as $key_jam => $value_jam): ?>
					  <tr>
						<td><?php echo 8*$value_jam["total_hari_kerja"]; ?></td>
					  </tr>
					<?php endforeach ?>
				  <?php endif ?>
				</table>
				</td>
                <td valign="top">
				<table width="100%" border="0px" cellpadding="1" cellspacing="0" class="table2">
				  <?php if (!empty($result[$key]["pelatihan"])): ?>
					<?php foreach ($result[$key]["pelatihan"] as $key_nom => $value_nom): ?>
					  <tr>
						<td>
						<table width="100%" border="0px" cellpadding="1" cellspacing="0" class="table2">
							<tr>
							  <td width="20%"></td>
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