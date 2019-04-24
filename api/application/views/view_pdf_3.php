<!doctype html>
<html><head></head><body>
<style>
     @page { margin: 150px 20px; }
     #header { position: fixed; left: -10px; top: -150px; right: -10px; bottom: -180px; height: 0px; text-align: center; }
     #foote { position: fixed; left: 0px; bottom: -40px; right: 0px; height: 10px}
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
     <p><h6>Tembusan : <br>- Atasan Ybs <br>- Kepala Unit Pengendalian Garatifikasi</h6></p>
	 <p><h6><?php echo $result["createdby"]; ?>:Intern <?php echo date("d")." ".$result["tanggal"]["now"] ?></h6></p>
   </div>
<div id="content">
<table border="0" class="table-1" style="margin:30px">
    <tr>
      <td colspan="3">
        <table width="100%" border="0" cellpadding="0">
          <tr>
            <td width="11%">Nomor</td>
              <td width="2%">:</td>
              <td width="46%">UM.01.05/XX.4/ &nbsp; &nbsp; &nbsp;  &nbsp; /<?php echo date('Y'); ?></td>
              <td width="41%" align="right"><?php echo $result["tanggal"]["now"] ?></td>
          </tr>
          <tr>
            <td width="11%">Hal</td>
              <td width="2%">:</td>
              <td colspan="2" width="87%">Surat Rekomendasi</td>
          </tr>
        </table>
      </td>
    </tr>
    <tr>
	<td colspan="3">
	<table width="100%" border="0" cellpadding="2">
	  <td width="30%" valign="top">
        <p align="justify">Yth. <?php echo $result["institusi"] ?> <br><?php echo $result["alamat"] ?></p>
	  </td>
	  <td width="60%">
	  &nbsp;
      </td>
	</table>
    </td>
	</tr>
	<tr>
      <td colspan="3">  
	  <p align="justify">       Kami yang bertandatangan dibawah ini memberikan rekomendasi kepada Pegawai RS Jantung Dan Pembuluh Darah Harapan Kita (RSJPDHK) :</p></td>
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
                  Unit           
                </td>
                <td width="2%">
                  :
                </td>
                <td width="77%">
                  <?php echo $result["pengembangan_pelatihan_detail"]->grup;?>
                </td>
              </tr>
              <tr>
                <td colspan="3" align="center">&nbsp;</td>
              </tr>
              <tr>
                <td colspan="3">Untuk berpartisipasi dalam kegiatan :</td>
              </tr>
              <tr>
                <td width="21%">
                  Nama Acara              
                </td>
                <td width="2%">
                  :
                </td>
                <td width="77%">
                  <?php if($result['jenis_perjalanan'] == "Dalam Negeri") {echo $result["nama_pelatihan"];}else{echo '<i>'.$result["nama_pelatihan"].'</i>';}?>
                </td>
              </tr>
              <tr>
                <td width="21%">
                  Hari / Tanggal              
                </td>
                <td width="2%">
                  :
                </td>
                <td width="77%">
                 <?php if($result["tanggal"]["from"]==$result["tanggal"]["to"]){echo $result["tanggal"]["to"]; }else{echo date('d',strtotime($result["tanggal"][0]["tanggal_from"])) ." s.d ". $result["tanggal"]["to"]; }?>
                </td>
              </tr>
              <tr>
                <td width="21%">
                  Tempat              
                </td>
                <td width="2%">
                  :
                </td>
                <td width="77%">
                  <?php echo $result["tujuan"]; ?>
                </td>
              </tr>
              <tr>
                <td width="21%">
                  Sebagai              
                </td>
                <td width="2%">
                  :
                </td>
                <td width="77%">
                  <?php echo $result["pengembangan_pelatihan_kegiatan_status"]->nama;?>
                </td>
              </tr>
            
        </table>
      </td>
    </tr>
	<tr>
      <td colspan="3"><p>Dengan memperhatikan ketentuan sebagai berikut :</p></td>
    </tr>
    <tr>
      <td colspan="3">
        <table width="100%" border="0">
		  <tr>
		  <td width="3%" valign="top">
            <p>1.</p>
          </td>
          <td width="97%" valign="top">
            <p align="justify">Dengan syarat bahwa apabila pegawai tersebut di atas mendapatkan sponsorship, hal tersebut tidak mempengaruhi independensi dan kemungkinan benturan kepentingan bagi institusi RSJPDHK maupun yang bersangkutan dalam menjalankan tugasnya di RSJPDHK.</p>
          </td>
		  </tr>
		  <tr>
		  <td width="3%" valign="top">
            <p>2.</p>
          </td>
          <td width="97%" valign="top">
            <p align="justify">Memberikan rincian biaya/sponsorship yang akan diberikan kepada ybs untuk bukti/laporan pertanggung jawaban.</p>
		  </td>
		  </tr>
		  <tr>
		  <td width="3%" valign="top">
            <p>3.</p>
          </td>
          <td width="97%" valign="top">
            <p align="justify">Setelah mengikuti penugasan kegiatan tersebut yang bersangkutan diwajibkan membuat laporan sesuai ketentuan yang berlaku.</p>
          </td>
		  </tr>
		  <tr>
		  <td width="3%" valign="top">
            <p>4.</p>
          </td>
          <td width="97%" valign="top">
            <p align="justify">Pegawai yang bersangkutan dapat menjalankan kegiatan tersebut di atas setelah ada Surat Izin atau Persetujuan sesuai ketentuan yang berlaku.</p>
		  </td>
		  </tr>
        </table>
      </td>
    </tr>
    <tr>
      <td colspan="3"><p>Demikian Surat Rekomendasi ini dibuat, untuk dapat dipergunakan sebagaimana mestinya.</p><br></td>
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
</div>
</body></html>