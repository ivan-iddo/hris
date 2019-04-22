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
     <p><h6><u>Tembusan : </u><br>- Para Direktur RSJPDHK</h6></p>
     <p><h6><?php echo $result["createdby"]; ?>:Intern <?php echo date("d")." ".$result["tanggal"]["tanggal_now"] ?></h6></p>
   </div>
<div id="content">
<table border="0" class="table-1" style="margin:15px">
    <tr>
      <td colspan="3" align="center" style="font-size: 20px"><u><strong>S U R A T   -   I Z I N</strong></u></td>
    </tr>
    <tr>
      <td colspan="3" align="center" style="font-size: 15px">Nomor : KP.03.04/XX.4/       /<?php echo date('Y'); ?></td>
    </tr>
    <tr>
      <td colspan="3" align="center">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="3">
	  <p align="justify">      Dalam rangka mengikuti <?php echo '<i>'.$result["nama_pelatihan"].'</i>';?>, sebagai <?php echo '<i>'.$result["pengembangan_pelatihan_kegiatan_status"]->nama.'</i>';?>. Dengan ini memberikan tugas kepada :</p>
      </td>
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
                  Pangkat           
                </td>
                <td width="2%">
                  :
                </td>
                <td width="77%">
                  <?php echo $result["pengembangan_pelatihan_detail"]->pangkat.' - '.$result["pengembangan_pelatihan_detail"]->golongan;?>
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
        </table>
      </td>
    </tr>
	<tr>
      <td colspan="3">
	  <p align="justify">      Di <?php echo '<i>'.$result["tujuan"].'</i>'; ?>, selama <?php echo $result["total_hari_kerja"]; ?> hari, mulai <?php if($result["tanggal"]["tanggal_from"]==$result["tanggal"]["tanggal_to"]){echo $result["tanggal"]["tanggal_to"]; }else{echo date("d",strtotime($result["tanggal"][0]["tanggal_from"]))." ".bulan(date("m",strtotime($result["tanggal"][0]["tanggal_from"]))) ." s.d ". $result["tanggal"]["tanggal_to"]; }?>, dengan rincian sebagai berikut :</p>
      </td>
    </tr>
	<tr>
      <td colspan="3">
        <table width="100%" border="0" cellpadding="3">
              <tr>
                <td width="35%">
                  a. Waktu Perjalanan Pergi             
                </td>
                <td width="2%">
                  :
                </td>
                <td width="60%">
                  <?php echo $result["tanggal"][0]["hari_go"]; ?> hari, tanggal <?php if($result["tanggal"][0]["tanggal_go"]==$result["tanggal"][0]["tanggal_go1"]){echo date("d",strtotime($result["tanggal"][0]["tanggal_go1"]))." ".bulan(date("m",strtotime($result["tanggal"][0]["tanggal_go1"]))) ." ".date("Y",strtotime($result["tanggal"][0]["tanggal_go1"])); }else{echo date("d",strtotime($result["tanggal"][0]["tanggal_go"]))." s.d ". date("d",strtotime($result["tanggal"][0]["tanggal_go1"]))." ".bulan(date("m",strtotime($result["tanggal"][0]["tanggal_go1"]))) ." ".date("Y",strtotime($result["tanggal"][0]["tanggal_go1"])); }?>
				  </td>
              </tr>
              <tr>
                <td width="35%">
                  b. waktu melaksanakan kegiatan          
                </td>
                <td width="2%">
                  :
                </td>
                <td width="60%">
                  <?php echo $result["total_hari_kerja"]; ?> hari, tanggal <?php if($result["tanggal"]["tanggal_from"]==$result["tanggal"]["tanggal_to"]){echo $result["tanggal"]["tanggal_to"]; }else{echo date('d',strtotime($result["tanggal"][0]["tanggal_from"])) ." s.d ". $result["tanggal"]["tanggal_to"]; }?>
               </td>
              </tr>
              <tr>
                <td width="35%">
                  c. waktu perjalanan pulang           
                </td>
                <td width="2%">
                  :
                </td>
                <td width="60%">
                  <?php echo $result["tanggal"][0]["hari_back"]; ?> hari, tanggal <?php if($result["tanggal"][0]["tanggal_back"]==$result["tanggal"][0]["tanggal_back1"]){echo date("d",strtotime($result["tanggal"][0]["tanggal_back1"]))." ".bulan(date("m",strtotime($result["tanggal"][0]["tanggal_back1"]))) ." ".date("Y",strtotime($result["tanggal"][0]["tanggal_back1"])); }else{echo date("d",strtotime($result["tanggal"][0]["tanggal_back"]))." s.d ". date("d",strtotime($result["tanggal"][0]["tanggal_back1"]))." ".bulan(date("m",strtotime($result["tanggal"][0]["tanggal_back1"]))) ." ".date("Y",strtotime($result["tanggal"][0]["tanggal_back1"])); }?>
				</td>
              </tr> 
        </table>
      </td>
    </tr>
	<tr>
      <td colspan="3">
	  <?php if ($result["jenis_biaya"]!="Sponsor"){ ?>
	  <p align="justify">      Biaya yang berkaitan dengan pelaksanaan tugas tersebut akan ditanggung sendiri oleh yang bersangkutan, dengan target kinerja atau hasil yang akan dicapai adalah <?php echo $result["target_kinerja"]; ?></p>
	  <?php }else{ ?>
	  <p align="justify">      Biaya yang berkaitan dengan pelaksanaan tugas dibebankan pada Sponsor <?php echo $result["institusi"] ?>, dengan target kinerja atau hasil yang akan dicapai adalah <?php echo $result["target_kinerja"]; ?></p>
	  <?php } ?>
	  <p align="justify">      Surat tugas ini disusun untuk dilaksanakan dan setelah dilaksanakan pelaksana tugas segera Melaporkan hasil kegiatan yang telah diikuti :</p>
      </td>
    </tr>
	<tr>
      <td colspan="3">
        <table width="100%" border="0" cellpadding="3">
              <tr>
                <td width="2%" valign="top">
                  <p>1.</p>
                </td>
				<td width="98%" valign="top">
					<p align="justify"> Keatasan langsung secara tertulis dengan tembusan ke Sub Bag Pengembangan SDM Beserta Sertifikat.</p>
                </td>
              </tr>
              <tr>
                <td width="2%" valign="top">
                  <p>2.</p>
                </td>
				<td width="98%"valign="top">
					<p align="justify"> Mempresentasikan pada Direksi RSJPDHK dan unit kerja sebagai bahan pembelajaran dengan bukti dokumen presentasi.</p>
                </td>
              </tr>
        </table>
      </td>
    </tr>
	<tr>
      <td colspan="3">
	  <p align="justify">      Demikian Surat Tugas ini dibuat untuk dilaksanakan dengan penuh tanggung jawab</p>
      </td>
    </tr>
	<tr>
      <td>&nbsp;</td>
      <td width="34%">&nbsp;</td>
      <td width="60%"><table width="100%" border="0">
			<tbody>
			  <tr>
				<td width="40%" align="left">Dikeluarkan di<br>Tanggal</td>
				<td>:<br>:</td>
				<td width="60%">Jakarta<br>       <?php echo $result["tanggal"]["tanggal_now"];?></td>
			  </tr>
			</tbody>
		  </table></td>
    </tr>
	<tr>
      <td>&nbsp;</td>
      <td width="34%" align="right"><?php if(!empty($result["phl"])){ echo "Plh. ";}?></td>
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
</div>
</body></html>