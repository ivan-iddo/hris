<!doctype html>
<html><head></head><body>
<style>
     @page { margin: 180px 50px; }
     #header { position: fixed; left: -10px; top: -150px; right: -10px; bottom: -150px; height: 0px; text-align: center; }
     #foote { position: fixed; left: 0px; bottom: -180px; right: 0px; height: 150px; }
     #foote { content: counter(upper-roman); }
</style>
 <div hidden="<?php echo $result["footer"]; ?>" id="header">
    <table width="100%" class="table-1" border="0">
	<tbody>
	<tr>
      <td colspan="1" width="60"><img src="<?php echo base_url(); ?>/logo2.png" width="80%"></td>
      <td colspan="2"align="center"><b>KEMENTRIAN KESEHATAN REPUBLIK INDONESIA<br>DIREKTORAT JENDRAL PELAYANAN KESEHATAN<br>RUMAH SAKIT JANTUNG DAN PEMBULU DARAH HARAPAN KITA</b></td>
	  <td colspan="1" width="70"><img src="<?php echo base_url(); ?>/logo.png" width="100%"></td>
	</tr>
	<tr>
	<td colspan="1" width="30">&nbsp;</td>
	<td colspan="2"align="center">Jalan Let. Jend. S. Parman Kv. 87 Slipi Jakarta, 11420<br>Telp. 5684085 - 093, 5684093, Faksimile: 5684230<br>Surat Elektronik: <u>website@pjnhk.go.id</u><br><u>http:www.pjnhk.go.id</u></td>
	<td colspan="1" width="30">&nbsp;</td>
	<hr/>
	</tr>
	</tbody>
	</table>
   </div>
   <div hidden="<?php echo $result["footer"]; ?>" id="foote">
     <p><h6><u>Tembusan : </u><br>- Atasan Ybs <br>- Para Direktur RSJPDHK</h6></p>
     <p><h6><?php echo $result["createdby"]; ?>:Intern <?php echo date("d")." ".$result["tanggal"]["tanggal_now"] ?></h6></p>
   </div>
<div id="content">
<table border="0" class="table-1" style="margin:30px">
	<tr>
      <td></td>
      <td width="34%"></td>
      <td width="36%"></td>
	</tr>
    <tr>
      <td colspan="3">
        <table width="100%" border="1px solid" cellpadding="1" cellspacing="0" class="table2" style="margin-top: 15px">
          <tr>
		    <th rowspan="2" align="center">Jenis Pegawai</th>
            <th rowspan="2" align="center"></th>
            <th rowspan="2" align="center">Jenis Kegiatan</th>
            <th colspan="2" align="center">Durasi</th>
            <th rowspan="2" align="center">Biaya</th>
          </tr>
		   <tr>
              <th scope="col">Hari</th>
              <th scope="col">Jam</th>
           </tr>
          <?php if (!empty($result)): ?>
            <?php foreach ($result as $key => $value): ?>
              <tr>
			    <td><?php echo $value["profesi"]; ?></td>
			    <td></td>
				<td><?php echo $result[$key]["pengembangan_pelatihan_kegiatan"]->nama; ?></td>
                <td><?php echo $value["total_hari_kerja"]; ?></td>
                <td><?php echo $result[$key]["tanggal"]->total_jam; ?></td>
                <td><?php echo $value["uraian_total"]; ?></td>
              </tr>
            <?php endforeach ?>
          <?php endif ?>
        </table>
      </td>
    </tr>
</table>
</div>
</body></html>