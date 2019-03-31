<!doctype html>
<html><head></head><body>
<style>
     @page { margin: 120px 50px; }
     #header { position: fixed; left: -10px; top: -110px; right: -10px; bottom: -160px; height: 0px; text-align: center; }
     #foote { position: fixed; left: 0px; bottom: -130px; right: 0px; height: 50px; }
     #foote { content: counter(upper-roman); }
</style>
 <div id="header">
    <table width="100%" class="table-1" border="0">
	<tbody>
	<tr>
      <td colspan="1" width="70"><img src="<?php echo base_url(); ?>/logo.png" width="100%"></td>
      <td colspan="4"align="right"><h6>RUMAH SAKIT JANTUNG DAN PEMBULU DARAH<br>HARAPAN KITA<br>Jln. S. Parman Kv. 87 Slipi Jakarta, 11420<br>Telp. 5684085 - 5684093 Ext. 1154<br>Fax: 5684230<br>e-mail: website@pjnhk.go.id<br>http:www.pjnhk.go.id</h6></td>
    </tr>
	</tbody>
	</table>
   </div>
   <div hidden="<?php echo $result["footer"]; ?>" id="foote">
     <p><h6>Latbang_4:RAK_<?php echo $result["tanggal"]["tanggal_now"] ?></h6></p>
   </div>
<div id="content">
<table border="0" width="100%" class="table-1" style="margin:30px">
    <tr>
      <td colspan="3">
        <table border="0" width="100%">
          <tr>
            <td width="55%">&nbsp;</td>
            <td width="15%">Nomor</td>
            <td width="30%">: KP.03.04/XX.4/       /<?php echo date('Y'); ?></td>
          </tr>
          <tr>
            <td width="55%">&nbsp;</td>
            <td width="15%">Lampiran</td>
            <td width="30%">: <?php echo $result["jenis_surat"]; ?></td>
          </tr>
          <tr>
            <td width="55%">&nbsp;</td>
            <td width="15%">Hal</td>
            <td width="30%">: <?php echo $result["pengembangan_pelatihan_kegiatan_status"]->nama;?></td>
          </tr>
        </table>
      </td>
    </tr>
    <tr>
      <td colspan="3">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="3">&nbsp;</td>
    </tr>
    <tr>
      <?php if ($result["tanggal"][0]["tanggal_to"] != $result["tanggal"][0]["tanggal_from"]): ?>
        <td colspan="3" align="center"><b>DAFTAR NAMA PESERTA ACLS (<?php echo date('d',strtotime($result["tanggal"][0]["tanggal_from"])) ." s.d ". $result["tanggal"]["tanggal_to"]; ?>)</b></td>
      <?php else: ?>
        <td colspan="3" align="center"><b>DAFTAR NAMA PESERTA ACLS (<?php echo $result["tanggal"]["tanggal_to"]; ?>)</b></td>
      <?php endif ?>
      
    </tr>
    <tr>
      <td colspan="3">
        <table width="100%" border="1px solid" cellpadding="1" cellspacing="0" class="table2" style="margin-top: 15px">
          <tr>
            <th>No</th>
            <th>Nopeg</th>
            <th>Nama</th>
            <th>Unit Kerja</th>
          </tr>
          <?php if (!empty($result["detail"])): ?>
            <?php foreach ($result["detail"] as $key => $value): ?>
              <tr>
                <td><?php echo $key+1 ?></td>
                <td><?php echo $value["nopeg"] ?></td>
                <td><?php echo $result["gelar_depan"].' '.$value["nama_pegawai"].' '.$result["gelar_belakang"] ?></td>
                <td><?php if(!empty($result["grup"])){echo $result["grup"];}else{echo $value["jabatan"];} ?></td>
              </tr>
            <?php endforeach ?>
          <?php endif ?>
        </table>
      </td>
    </tr>
</table>
</div>
</body></html>