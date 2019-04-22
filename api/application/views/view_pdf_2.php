<!doctype html>
<html><head></head><body>
<style>
    .logo::after{
       content: "";
       background: url(http://localhost/project/hris/logo.jpg) no-repeat;
       position:absolute;
       top: 0;
       left: 0;
       width: 50%;
       height: 300px;
    }
     @page { margin: 180px 50px; }
     #header { position: fixed; left: -10px; top: -150px; right: -10px; bottom: -180px; height: 0px; text-align: center; }
     #foote { position: fixed; left: 0px; bottom: -180px; right: 0px; height: 150px; }
     #foote { content: counter(upper-roman); }
</style>
 <div hidden="<?php echo $result["footer"]; ?>" id="header">
    <table width="100%" class="table-1" border="0">
	<tbody>
	<tr>
      <td colspan="1" width="60"><img src="<?php echo base_url(); ?>/logo2.png" width="80%"/></td>
      <td colspan="2"align="center"><b>KEMENTRIAN KESEHATAN<br>DIREKTORAT JENDRAL PELAYANAN KESEHATAN<br>RUMAH SAKIT JANTUNG DAN PEMBULU DARAH HARAPAN KITA</b></td>
	  <td colspan="1" width="70"><img src="<?php echo base_url(); ?>/logo.png" width="100%"/></td>
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
     <p><h6>Tembusan : <br>- Atasan Ybs <br>- Para Direktur RSJPDHK</h6></p>
     <p><h6><?php echo $result["createdby"]; ?>:Intern <?php echo date("d")." ".$result["tanggal"]["tanggal_now"] ?></h6></p>
   </div>
<div id="content">
<table border="0" class="table-1" style="margin:30px">
    <tr>
      <td colspan="4" align="center" style="font-size: 20px"><u><strong>S U R A T   -   I Z I N</strong></u></td>
    </tr>
    <tr>
      <td colspan="4" align="center" style="font-size: 15px">Nomor : KP.03.04/4.2.1/       /<?php echo date('Y'); ?></td>
    </tr>
    <tr>
      <td colspan="3" align="center">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="3"><p align="justify">      Yang bertanda tangan dibawah ini memberikan ijin kepada :</p></td>
    </tr>
    <tr>
      <td colspan="4">
        <?php if ($result["jenis"] == "Individu"): ?> 
        <table width="100%" border="1px solid" cellpadding="1" cellspacing="0" class="table2">
          <tr>
            <th align="center">No</th>
            <th align="center">Nopeg</th>
            <th align="center">Nama</th>
            <th align="center">NIP</th>
            <th align="center">Jabatan/Unit Kerja</th>
          </tr>
          <?php if (!empty($result["detail"])): ?>
            <?php foreach ($result["detail"] as $key => $value): ?>
              <tr>
                <td><?php echo $key+1 ?></td>
				<td><?php echo $value["nopeg"] ?></td>
                <td><?php echo $result["gelar_depan"].' '.$value["nama_pegawai"].', '.$result["gelar_belakang"] ?></td>
                <td><?php echo $value["nip"] ?></td>
				<td><?php if(!empty($result["grup"])){echo $result["grup"];}else{echo $value["jabatan"];} ?></td>
              </tr>
            <?php endforeach ?>
          <?php endif ?>
        </table>
        <?php elseif ($result["jenis"] == "Kelompok"): ?> 
			<center>(Nopeg, Nama Pegawai, dan Unit Kerja Terlampir)</center>
        <?php endif ?> 
      </td>
    </tr>
    <tr>
      <td colspan="4">
      <table width="100%" border="0" style="margin-top : 15px">
        <tr>
          <td width="17%" valign="top">
            <p>Untuk</p>
          </td>
          <td width="3%" valign="top">
            <p>:</p>
          </td>
		<td width="3%" valign="top">
            <p>1.</p>
         </td>
          <td width="88%" valign="top">
            <p align="justify">Mengikuti <?php echo '<i>'.$result["nama_pelatihan"] .'</i>';?>, sebagai <?php echo $result["pengembangan_pelatihan_kegiatan_status"]->nama;?>, yang dilaksanakan pada tanggal <?php if($result["tanggal"]["tanggal_from"]==$result["tanggal"]["tanggal_to"]){echo $result["tanggal"]["tanggal_to"]; }else{echo date('d',strtotime($result["tanggal"][0]["tanggal_from"])) ." s.d ". $result["tanggal"]["tanggal_to"]; }?>, diselenggarakan oleh <?php echo $result["institusi"]; ?>. Bertempat di <?php echo $result["tujuan"]; ?> .</p>
          </td>
        </tr>  
		<tr> 
		 <td colspan="2" valign="top">
          </td>
		<td width="3%" valign="top">
            <p>2.</p>
          </td>
          <td width="88%" valign="top">
            <p align="justify">Melaporkan kepada UPG tentang penerimaan sponsorship dalam kegiatan tersebut paling lambat 5 hari setelah pelaksanaan.</p>
          </td>
        </tr>  
        <tr>  
		 <td colspan="2" valign="top">
          </td>
		  <td width="3%" valign="top">
            <p>3.</p>
          </td>
          <td width="88%" valign="top">
           <p align="justify">RSJPDHK tidak bertanggung jawab atas kelalaian melaksanakan kewajiban melaporkan ke pihak UPG sebagaimana butir No. 2.</p>
		  </td>
        </tr>
      </table>
      </td>
    </tr>
    <tr>
      <td colspan="4"><p>Agar yang bersangkutan melaksanakan tugas dengan baik dan penuh tanggung jawab.</p></td>
    </tr>
    <tr>
      <td colspan="3">&nbsp;</td>
    </tr>
     <tr>
      <td></td>
      <td width="34%">&nbsp;</td>
      <td width="36%"><p>       <?php echo $result["tanggal"]["tanggal_now"] ?></p></td>
    </tr>
    <tr>
      <td colspan="2" width="40%" align="right"><?php if(!empty($result["phl"])){ echo "Plh. ";}?></td>
      <td width="36%"><?php if(!empty($result["phl"])){ echo "Direktur Utama,";}else{ echo "Direktur Utama,";}?></td>
	</tr>
    <tr>
      <td colspan="3">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="3">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="2" width="40%">&nbsp;</td>
      <td><?php if(!empty($result["phl"])){ echo $result["aprove_phl"]->gelar_depan.' '.$result["aprove_phl"]->name.', '.$result["aprove_phl"]->gelar_belakang;}else{ echo "Dr. dr. Iwan Dakota,  SpJP(K), MARS,FACC,FESC";}?></td>
    </tr>
    <tr>
      <td colspan="2" width="40%">&nbsp;</td>
      <td>NIP <?php if(!empty($result["phl"])){echo $result["aprove_phl"]->nip;}else{ echo "196601011996031001";}?></td>
    </tr>
    <tr>
      <td colspan="3">&nbsp;</td>
    </tr>
	<?php if ($result["jenis"] == "Kelompok"): ?>
    <tr>
      <td colspan="3">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="3">
        <table border="0" width="100%">
          <tr>
            <td width="55%">&nbsp;</td>
            <td width="15%">Nomor</td>
            <td colspan="2" width="30%">: KP.03.04/XX.4/       /<?php echo date('Y'); ?></td>
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
        <td colspan="3" align="center"><b>DAFTAR NAMA <?php echo $result["pengembangan_pelatihan_kegiatan_status"]->nama;?> <?php echo $result["nama_pelatihan"] ?> (<?php if($result["tanggal"]["tanggal_from"]==$result["tanggal"]["tanggal_to"]){echo $result["tanggal"]["tanggal_to"];}else{echo date('d',strtotime($result["tanggal"][0]["tanggal_from"])) ." s.d ". $result["tanggal"]["tanggal_to"]; }?>)</b></td>
    </tr>
    <tr>
      <td colspan="5">
        <table width="100%" border="1px solid" cellpadding="1" cellspacing="0" class="table2" style="margin-top: 15px">
          <tr>
            <th align="center">No</th>
            <th align="center">Nopeg</th>
            <th align="center">Nama</th>
            <th align="center">NIP</th>
            <th align="center">Jabatan</th>
          </tr>
          <?php if (!empty($result["detail"])): ?>
            <?php foreach ($result["detail"] as $key => $value): ?>
              <tr>
                <td align="center"><?php echo $key+1 ?></td>
                <td align="center"><?php echo $value["nopeg"] ?></td>
                <td><?php echo $result["gelar_depan"].' '.$value["nama_pegawai"].', '.$result["gelar_belakang"] ?></td>
                <td><?php echo $value["nip"]; ?></td>
                <td><?php echo $value["jabatan"]; ?></td>
              </tr>
            <?php endforeach ?>
          <?php endif ?>
        </table>
      </td>
    </tr>
	<?php endif ?> 
</table>
</div>
</body></html>