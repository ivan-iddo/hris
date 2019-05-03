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
        <table width="100%" border="1px solid" cellpadding="1" cellspacing="0" class="table2" style="margin-top: 15px">
          <tr>
            <th rowspan="2" align="center" width="1%">No</th>
			<th rowspan="2" align="center" width="13%">Nama Kegiatan</th>
            <th rowspan="2" align="center" width="10%">Lembaga</th>
			<th rowspan="2" align="center" width="5%">Status</th>
            <th colspan="2" align="center" width="4%">Durasi</th>
            <th rowspan="2" align="center" width="10%">Tanggal</th>
            <th rowspan="2" align="center" width="5%">Jenis Kegiatan</th>
            <th rowspan="2" align="center" width="15%">Tempat</th>
            <th rowspan="2" align="center" width="20%">Biaya</th>
          </tr>
		   <tr>
              <th scope="col" width="2%">Hari</th>
              <th scope="col" width="2%">Jam</th>
           </tr>
          <?php if (!empty($result)): ?>
            <?php foreach ($result as $key => $value): ?>
              <tr>
			    <td align="center"><?php echo $key+1 ?></td>
				<td><?php echo $value["nama_pelatihan"]; ?></td>
				<td><?php echo $value["institusi"]; ?></td>
                <td><?php echo $result[$key]["pengembangan_pelatihan_kegiatan_status"]->nama; ?></td>
                <td><?php echo $value["total_hari_kerja"]; ?></td>
                <td><?php echo $result[$key]["tanggal"]->total_jam; ?></td>
                <td><?php if($value["tanggal_from"]==$value["tanggal_to"]){echo $value["tanggal_to"];}else{ echo $value["tanggal_from"]." s/d ".$value["tanggal_to"];} ?></td>
				<td><?php echo $result[$key]["pengembangan_pelatihan_kegiatan"]->nama; ?></td>
                <td><?php echo $value["tujuan"]; ?></td>
                <td>Rp. <?php echo number_format($value["nominal"], 0, ",", ".")?></td>
              </tr>
            <?php endforeach ?>
          <?php endif ?>
        </table>
      </td>
    </tr>
</table>
</div>
</body></html>