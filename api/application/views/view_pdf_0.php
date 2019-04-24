<!doctype html>
<html><head></head><body>
<style>
     @page { margin: 180px 50px; }
     #header { position: fixed; left: -10px; top: -150px; right: -10px; bottom: -150px; height: 0px; text-align: center; }
     #foote { position: fixed; left: 0px; bottom: -180px; right: 0px; height: 150px; }
     #foote { content: counter(upper-roman); }
</style>
   <div hidden="<?php echo $result["footer"]; ?>" id="foote">
     <p><h6><u>Tembusan : </u><br>- Atasan Ybs <br>- Para Direktur RSJPDHK</h6></p>
     <p><h6><?php echo $result["createdby"]; ?>:Intern <?php echo date("d")." ".$result["tanggal"]["tanggal_now"] ?></h6></p>
   </div>
<div id="content">
<table border="0" class="table-1" style="margin:30px">
    <tr>
      <td colspan="3" align="center" style="font-size: 20px"><u><strong>S U R A T   -   T U G A S</strong></u></td>
    </tr>
    <tr>
      <td colspan="3" align="center" style="font-size: 15px">Nomor : KP.03.04/XX.4/       /<?php echo date('Y'); ?></td>
    </tr>
    <tr>
      <td colspan="3" align="center">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="3"><p align="justify">      Yang bertanda tangan di bawah ini memberikan tugas kepada :</p></td>
    </tr>
    <tr>
      <td colspan="3" align="center"><center>(Nopeg, Nama Pegawai, dan Jabatan Terlampir)</center></td>
    </tr>
    
    <tr>
      <td colspan="3">
      <table width="100%" border="0" style="margin-top : 15px">
        <tr>
          <td width="9%" valign="top">
            <p>Untuk</p>
          </td>
          <td width="3%" valign="top">
            <p>:</p>
          </td>
		  <td width="3%" valign="top">
            <p>1.</p>
          </td>
          <td width="88%" valign="top">
            <p align="justify">Menghadiri <?php echo $result["nama_pelatihan"] ?>, yang akan dilaksanakan pada tanggal <?php if($result["tanggal"]["tanggal_from"]==$result["tanggal"]["tanggal_to"]){echo $result["tanggal"]["tanggal_to"]; }else{echo date('d',strtotime($result["tanggal"][0]["tanggal_from"])) ." s.d ". $result["tanggal"]["tanggal_to"]; }?>. Yang diselenggarakan oleh <?php echo $result["institusi"]; ?>. Bertempat di <?php echo $result["tujuan"]; ?>.</p>
          </td>
        </tr>
		<tr>
		  <td colspan="2" valign="top">
          </td>
		  <td width="3%" valign="top">
            <p>2.</p>
          </td>
		  <td width="88%" valign="top">
            <p align="justify">Melaporkan PertanggungJawaban Biaya dan Kegiatan Perjalanan Dinas Ke Sub Bag Perbendaharaan Biaya dan Khusus Untuk Kegiatan Perjalanan Dinas ke Sub Pengembangan SDM melalui Emai: <b>subbag.pengembangan@pjnhk.go.id.</b> Paling lambat 5 (lima) hari kerja setelah Perjalanan Dinas dilaksanakan.</p>
          </td>
        </tr>
      </table>
      </td>
    </tr>
    <tr>
      <td colspan="3"><p>Agar yang bersangkutan melaksanakan tugas dengan baik dan penuh tanggung jawab.</p></td>
    </tr>
    <tr>
      <td colspan="3">&nbsp;</td>
    </tr>
	<tr>
      <td>Mengetahui</td>
      <td width="34%">&nbsp;</td>
      <td width="36%">         <?php echo $result["tanggal"]["tanggal_now"] ?></td>
    </tr>
	<tr>
      <td>Penyelenggara</td>
      <td width="34%" align="right"><?php if($result["jenis_plh"]=="Plh"){ echo "Plh. ";}else if($result["jenis_plh"]=="an"){ echo "a. n. ";}else{echo "";}?></td>
      <td width="36%"><?php if(!empty($result["phl"])){ echo "Direktur Utama,";}else{ echo "Direktur Utama,";}?></td>
	</tr>
    <tr>
      <td colspan="3">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="3">&nbsp;</td>
    </tr>
    <tr>
      <td>(……………………)</td>
      <td>&nbsp;</td>
      <td><?php if(!empty($result["phl"])){ echo $result["aprove_phl"]->gelar_depan.' '.$result["aprove_phl"]->name.', '.$result["aprove_phl"]->gelar_belakang;}else{ echo "Dr. dr. Iwan Dakota,  SpJP(K), MARS,FACC,FESC";}?></td>
    </tr>
    <tr>
      <td><em>dimulai jam : <?php if(!empty($result["jam_mulai"])){ echo $result["jam_mulai"];}?></em></td>
      <td>&nbsp;</td>
      <td>NIP <?php if(!empty($result["phl"])){echo $result["aprove_phl"]->nip;}else{ echo "196601011996031001";}?></td>
    </tr>
    <tr>
      <td><em>Selesai  jam : <?php if(!empty($result["jam_mulai"])){if(!empty($result["jam_sampai"])){ echo $result["jam_sampai"];}else{ echo 'Selesai';}}else{echo '';}?></em></td>
      <td colspan="2">&nbsp;</td>
    </tr><tr>
      <td colspan="3">&nbsp;</td>
    </tr><tr>
      <td colspan="3">&nbsp;</td>
    </tr><tr>
      <td colspan="3">&nbsp;</td>
    </tr>
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
      <td colspan="3">&nbsp;</td>
    </tr>
    <tr>
        <td colspan="3" align="center"><b>DAFTAR NAMA <?php echo $result["pengembangan_pelatihan_kegiatan_status"]->nama;?> <?php echo $result["nama_pelatihan"] ?> (<?php if($result["tanggal"]["tanggal_from"]==$result["tanggal"]["tanggal_to"]){echo $result["tanggal"]["tanggal_to"];}else{echo date('d',strtotime($result["tanggal"][0]["tanggal_from"])) ." s.d ". $result["tanggal"]["tanggal_to"]; }?>)</b></td>
    </tr>
    <tr>
      <td colspan="3">
        <table width="100%" border="1px solid" cellpadding="1" cellspacing="0" class="table2" style="margin-top: 15px">
          <tr>
            <th align="center">No</th>
            <th align="center">Nopeg</th>
            <th align="center">Nama</th>
            <th align="center">Jabatan</th>
          </tr>
          <?php if (!empty($result["detail"])): ?>
            <?php foreach ($result["detail"] as $key => $value): ?>
              <tr>
                <td align="center"><?php echo $key+1 ?></td>
                <td align="center"><?php echo $value["nopeg"] ?></td>
                <td><?php echo $result["gelar_depan"].' '.$value["nama_pegawai"].', '.$result["gelar_belakang"] ?></td>
                <td><?php echo $value["jabatan"]; ?></td>
              </tr>
            <?php endforeach ?>
          <?php endif ?>
        </table>
      </td>
    </tr>
</table>
</div>
</body></html>