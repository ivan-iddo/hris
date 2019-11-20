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
<div id="content">
<table width="100%" border="0" class="table-1" style="margin:30px">
<tr>
	<td align="center">Nama Pegawai</td>
	<td align="center">Jenis Cuti</td>
	<td align="center">Keterangan</td>
	<td align="center">Mulai</td>
	<td align="center">Sampai</td>
	<td align="center">Hari</td>
  </tr>
  <?php if (!empty($result)): ?>
	<?php foreach ($result as $key => $val): ?>
	<tr>
	<td valign="top"><?php echo $val["namapegawai"]?></td>
	<td valign="top"><?php echo $val["namcut"]?></td>
	<td valign="top"><?php echo $val["keterangan"]?></td>
	<td valign="top"><?php echo date_format(date_create($val["tgl_cuti"]), "d-m-Y")?></td>
	<td valign="top"><?php echo date_format(date_create($val["tgl_akhir_cuti"]), "d-m-Y")?></td>
	<td valign="top"><?php echo $val["total"]?> Hari</td>
	</tr>
  <?php endforeach ?>
  <?php endif ?>
</table>
</div>
</body></html>