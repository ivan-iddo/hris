
<!doctype html>
<html><head></head><body>
<style>
     @page { margin: 160px 30px 30px; }
     #header { position: fixed; left: -10px; top: -150px; right: -10px; bottom: -150px; height: 0px; text-align: center; }
     #foote { position: fixed; left: 0px; bottom: 10px; right: 0px; height: 30px;}
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
     <p><h6>Tembusan : <br>- Kepala Biro Umum Sekretariat Jenderal Kementerian Kesehatan</h6></p>
	 <p><h6><?php echo $result["createdby"]; ?>:Intern <?php echo date("d")." ".$result["tanggal"]["tanggal_now"] ?></h6></p>
   </div>
<div id="content">
<table border="0" class="table-1" style="margin:20px">
    <tr>
      <td colspan="3">
		<table width="100%" border="0" cellpadding="3">
		<tbody>          
		<tr>
            <td>Nomor</td>
            <td>:</td>
            <td width="70%">UM.01.05/XX.4/ &nbsp; &nbsp; &nbsp;  &nbsp; /<?php echo date('Y'); ?></td>
			<td width="20%"align="right"><?php echo $result["tanggal"]["tanggal_now"] ?></td>
          </tr>
		  <tr>
            <td>Lamp</td>
            <td>:</td>
            <td width="70%">1 (Satu) berkas</td>
			<td width="20%">&nbsp;</td>
          </tr> 
		  <tr>
            <td>Prihal</td>
            <td>:</td>
            <td width="70%"><b>Permohonan pengurusan izin perjalanan dinas luar negeri</b></td>
			<td width="20%">&nbsp;</td>
          </tr>
		</tbody>
      </table></td></tr>
    <tr>
      <td colspan="3">
      <br>Yth. Sekretaris Direktorat Jenderal Pelayanan Kesehatan<br>
      Kementerian Kesehatan RI<br>
      Jalan H. R. Rasuna Said Blok X 5 Kav. 4-9,<br>
      Jakarta Selatan 12950<br>
	</td>
    </tr>
    <tr>
      <td colspan="3"><p align="justify">      Sehubungan dengan akan mengikuti <?php echo '<i>'.$result["nama_pelatihan"].'</i>';?>, sebagai <?php echo $result["pengembangan_pelatihan_kegiatan_status"]->nama;?>, yang dilaksanakan tanggal <?php if($result["tanggal"]["tanggal_from"]==$result["tanggal"]["tanggal_to"]){echo $result["tanggal"]["tanggal_to"]; }else{echo date('d',strtotime($result["tanggal"][0]["tanggal_from"])) ." s.d ". $result["tanggal"]["tanggal_to"]; }?>. Bertempat di <?php echo $result["tujuan"]; ?>, dengan ini kami mohon bantuan saudara untuk dapat memproses persetujuan Pemerintah atas nama :</p></td>
    </tr>
    <tr>
      <td colspan="3">
        <table width="100%" border="0" cellpadding="3">
              <tr>
                <td width="21%">
                  Nama Pegawai             
                </td>
                <td width="2%">
                  :
                </td>
                <td width="77%">
                  <?php echo $result["gelar_depan"].' '.$result["pengembangan_pelatihan_detail"]->nama_pegawai.', '.$result["gelar_belakang"];?>
                </td>
              </tr>
              <tr>
                <td width="21%">
                  Jabatan           
                </td>
                <td width="2%">
                  :
                </td>
                <td width="77%">
                  <?php echo $result["pengembangan_pelatihan_detail"]->jabatan;?>
                </td>
              </tr>
			  <tr>
                <td width="21%">
                  NIP           
                </td>
                <td width="2%">
                  :
                </td>
                <td width="77%">
                  <?php echo $result["pengembangan_pelatihan_detail"]->nip;?>
                </td>
              </tr>
			  <tr>
                <td width="21%">
                  NIK           
                </td>
                <td width="2%">
                  :
                </td>
                <td width="77%">
                  <?php echo $result["pengembangan_pelatihan_detail"]->nik;?>
                </td>
              </tr>
              <tr>
                <td width="21%">
                  Email           
                </td>
                <td width="2%">
                  :
                </td>
                <td width="77%">
                  <?php echo $result["email"];?>
                </td>
              </tr> 
			  <tr>
                <td width="21%">
                  Nomor Telp/HP          
                </td>
                <td width="2%">
                  :
                </td>
                <td width="77%">
                  <?php echo $result["phone"];?>
                </td>
              </tr>
        </table>
      </td>
    </tr>
	<tr>
      <td colspan="3"><p align="justify">      Adapun biaya untuk mengikuti kegiatan tersebut akan ditanggung oleh <?php echo $result["institusi"] ?>, meliputi biaya Tiket Pesawat, Akomodasi, Registrasi. Terlampir kami sampaikan  berkas – berkas yang diperlukan.</p></td>
    </tr> 
	<tr>
      <td colspan="3">Atas perhatian dan kerja sama saudara kami ucapkan terima kasih.</td>
    </tr>
	<tr>
      <td>&nbsp;</td>
      <td width="34%" align="right"><?php if($result["jenis_plh"]!="Plh"){ echo "a. n. ";}else{ echo "Plh. ";}?></td>
      <td width="60%"><?php if(!empty($result["phl"])){ echo "Direktur Utama,";}else{ echo "Direktur Utama,";}?></td>
    </tr>
    <tr>
      <td colspan="3">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="3">&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td><?php if(!empty($result["phl"])){ echo $result["aprove_phl"]->gelar_depan.' '.$result["aprove_phl"]->name.', '.$result["aprove_phl"]->gelar_belakang;}else{ echo "Dr. dr. Iwan Dakota,  SpJP(K), MARS,FACC,FESC";}?></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>NIP <?php if(!empty($result["phl"])){echo $result["aprove_phl"]->nip;}else{ echo "196601011996031001";}?></td>
    </tr>
</table>
</body></html>