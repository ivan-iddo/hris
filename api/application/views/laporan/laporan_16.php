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
<table width="95%" border="1px" cellpadding="1" cellspacing="0" class="table2" style="margin:30px">
	 <tr>
            <td align="center">Nomor Berkas</th>
            <td align="center">Nopeg</th>
            <td align="center">Nama Pegawai</th>
			<td align="center">Tanggal</th>
			<td align="center">Nama Kegiatan</th>
            <td align="center">Status</th>
			<td align="center">Jenis Kegiatan</th>
			<td align="center">Jenis Pegawai</th>
            <td align="center">Tempat</th>
			<td align="center">Lembaga</th>
            <td align="center">Per orang</th>
          </tr>
          <?php if (!empty($result)): ?>
            <?php foreach ($result as $key => $value): ?>
              <tr>
                <td align="center"><?php echo date("y",strtotime($value["tanggal_to"])).''.date("m",strtotime($value["tanggal_to"])).'.'.$value["id"] ?></td>
                <td><?php echo $result[$key]["pengembangan_pelatihan_detail"]->nopeg; ?></td>
				<td><?php echo $value["gelar_depan"].' '.$result[$key]["pengembangan_pelatihan_detail"]->nama_pegawai.', '.$value["gelar_belakang"] ?></td>
                <td><?php if($value["tanggal_from"]==$value["tanggal_to"]){echo $value["tanggal_to"];}else{ echo $value["tanggal_from"]." s/d ".$value["tanggal_to"];} ?></td>
                <td><?php echo $value["nama_pelatihan"]; ?></td>
                <td><?php echo $result[$key]["pengembangan_pelatihan_kegiatan_status"]->nama; ?></td>
                <td><?php echo $result[$key]["pengembangan_pelatihan_kegiatan"]->nama; ?></td>
				<td><?php echo $value["profesi"]; ?></td>
				<td><?php echo $value["tujuan"]; ?></td>
                <td><?php echo $value["institusi"]; ?></td>
				<td>
				<table width="100%" border="0px" cellpadding="1" cellspacing="0" class="table2">
				 <tr>
					 <td>
						<table width="100%" border="0px" cellpadding="1" cellspacing="0" class="table2">
							<tr>
							  <td width="20%"></td>
							  <td width="10%">Rp.</td>
							  <td align="right" width="50%"><?php echo number_format($value["nominal"], 0, ",", ".")?></td>
							  <td width="20%"></td>
							</tr>
						</table>
					  </td>
				  </tr>
				</table>
				</td>
              </tr>
            <?php endforeach ?>
          <?php endif ?>
</table>
</div>
</body></html>