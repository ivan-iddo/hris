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
	</div>
<div id="content">
	<table width="95%" border="0px" cellpadding="1" cellspacing="0" class="table2" style="margin:10px 10px 10px 30px">
		<tbody>
			<tr>
			  <td align="left" width="5%">Nama</td>
			  <td align="left" width="1%">:</td>
			  <td align="left" width="89%"><?php echo $result[0]["nama_pegawai"]; ?></td>
			</tr>
			<tr>
			  <td align="left" width="5%">Nopeg</td>
			  <td align="left" width="1%">:</td>
			  <td align="left" width="89%"><?php echo $result[0]["pengembangan_pelatihan_detail"]->nopeg; ?></td>
			</tr>
			<tr>
			  <td align="left" width="5%">Unit</td>
			  <td align="left" width="1%">:</td>
			  <td align="left" width="89%"><?php echo $result[0]["grup"]; ?></td>
			</tr>
		</tbody>
	</table>
<table width="95%" border="1px" cellpadding="1" cellspacing="0" class="table2" style="margin:10px 10px 10px 30px">
		<tr>
            <td rowspan="2" align="center" width="1%">No</td>
			<td rowspan="2" align="center" width="13%">Nama Kegiatan</td>
            <td rowspan="2" align="center" width="10%">Lembaga</td>
			<td rowspan="2" align="center" width="5%">Status</td>
            <td colspan="2" align="center" width="4%">Durasi</td>
            <td rowspan="2" align="center" width="10%">Tanggal</td>
            <td rowspan="2" align="center" width="5%">Jenis Kegiatan</td>
            <td rowspan="2" align="center" width="15%">Tempat</td>
            <td rowspan="2" align="center" width="20%">Biaya</td>
          </tr>
		   <tr>
              <td scope="col" width="2%">Hari</td>
              <td scope="col" width="2%">Jam</td>
           </tr>
          <?php if (!empty($result)): ?>
            <?php foreach ($result as $key => $value): ?>
              <tr>
			    <td align="center"><?php echo $key+1 ?></td>
				<td align="center"><?php echo $value["nama_pelatihan"]; ?></td>
				<td align="center"><?php echo $value["institusi"]; ?></td>
                <td><?php echo $result[$key]["pengembangan_pelatihan_kegiatan_status"]->nama; ?></td>
                <td><?php echo $value["total_hari_kerja"]; ?></td>
                <td><?php echo $result[$key]["tanggal"]->total_jam; ?></td>
                <td><?php if($value["tanggal_from"]==$value["tanggal_to"]){echo $value["tanggal_to"];}else{ echo $value["tanggal_from"]." s/d ".$value["tanggal_to"];} ?></td>
				<td><?php echo $result[$key]["pengembangan_pelatihan_kegiatan"]->nama; ?></td>
                <td align="center"><?php echo $value["tujuan"]; ?></td>
                <td>
					<table width="100%" border="0px" cellpadding="1" cellspacing="0" class="table2">
							<tr>
							  <td width="20%"></td>
							  <td width="10%">Rp.</td>
							  <td align="right" width="50%"><?php echo number_format($value["pernominal"], 0, ",", "."); $total += $value["pernominal"];?></td>
							  <td width="20%"></td>
							</tr>
					</table>
				</td>
				</tr>
            <?php endforeach ?>
          <?php endif ?>
</table>
<table width="95%" border="0px" cellpadding="1" cellspacing="0" class="table2" style="margin:10px 10px 10px 30px">
	<tr>
        <td align="right" width="75%"><b>Total</b></td>
        <td width="25%">
		<table width="100%" border="0px" cellpadding="1" cellspacing="0" class="table2">
		  <tr>
			<td width="30%"></td>
			<td width="10%">Rp.</td>
			<td align="right" width="50%"><b><?php echo number_format($total, 0, ",", ".")?></b></td>
			<td width="20%"></td>
		   </tr>
	    </table>
	    </td>
	</tr>
</table>
</div>
</body></html>