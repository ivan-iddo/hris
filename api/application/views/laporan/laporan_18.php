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
<table width="95%" border="1px" cellpadding="1" cellspacing="0" class="table2" style="margin:30px 30px 0px 30px">
	 <tr>
            <td align="center" width="2%">No</td>
            <td align="center" width="5%">Nopeg</td>
            <td align="center">Nama Pegawai</td>
            <td align="center">Unit Kerja</td>
            <td align="center" width="1%">Durasi (JPL)</td>
          </tr>
          <?php if (!empty($result)): ?>
            <?php foreach ($result as $key => $value): ?>
              <tr>
                <td align="center"><?php echo $count=$key+1 ?></td>
                <td><?php echo $value["nopeg"]; ?></td>
                <td><?php echo $value["gelar_depan"].' '.$value["nama_pegawai"].', '.$value["gelar_belakang"] ?></td>
                <td><?php echo $value["grup"]; ?></td>
                <td width="1%"><?php echo $jumlah=round(($result[$key]["tanggal"]->total_jam*11)/8, 0); 
				$total +=$jumlah;?></td>
              </tr>
            <?php endforeach ?>
          <?php endif ?>
		  <table width="95%" border="1px" cellpadding="1" cellspacing="0" class="table2" style="margin:0px 30px 30px 30px">
		  <tr>
            <td width="20%" colspan="2">JUMLAH JAM PELATIHAN</td>
			<td width="1%"><?php echo $total; ?></td>
          </tr>
		  <tr>
           <td width="20%" colspan="2">RATA - RATA JAM PELATIHAN PER PEGAWAI</td>
			<td width="1%"><?php echo round($total/$count, 2); ?></td>
          </tr>
		  <table width="95%" border="1px" cellpadding="1" cellspacing="0" class="table2" style="margin:30px">
		  <tr>
            <td width="20%" colspan="2">Total seluruh pegawai RSJPDHK</td>
			<td width="1%"><?php echo $result[0]['total_pegawai']; ?></td>
          </tr>  
		  <tr>
            <td width="20%" colspan="2">Persentase pelatihan bagi seluruh pegawai minimal 30 jpl/tahun</td>
			<td width="1%"><?php echo round(($count/$result[0]['total_pegawai']), 3) ?>%</td>
          </tr>
</table>
</div>
</body></html>