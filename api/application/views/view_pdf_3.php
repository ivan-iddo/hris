<!doctype html>
<html><head></head><body>
<style>
     @page { margin: 80px 50px; }
     #header { position: fixed; left: -10px; top: -150px; right: -10px; bottom: -180px; height: 0px; text-align: center; }
     #foote { position: fixed; left: 0px; bottom: -30px; right: 0px; height: 50px; }
     #foote { content: counter(upper-roman); }
</style>
   <div hidden="<?php echo $result["footer"]; ?>" id="foote">
     <p><h6>Tembusan : <br>- Atasan Ybs <br>- Kepala Unit Pengendalian Garatifikasi</h6></p>
	 <p><h6>Latbang_2 C:SrtTgs Intern <?php echo $result["tanggal"]["tanggal_now"] ?> <?php echo $result["createdby"]; ?></h6></p>
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
              <td width="87%">Surat Rekomendasi</td>
          </tr>
        </table>
      </td>
    </tr>
    <tr>
      <td colspan="3"><br>Yth. <?php echo $result["institusi"] ?><br><p align="justify">       Dengan ini, kami memberikan rekomendasi kepada Pegawai RS Jantung Dan Pembuluh Darah Harapan KIta (RSJPDHK) :</p></td>
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
                  <?php echo $result["nama_pelatihan"]?>
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
                 <?php echo date("d",strtotime($result["tanggal"][0]["tanggal_from"])) ?> s/d <?php echo $result["tanggal"]["to"] ?>
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
      <td colspan="3">
        <table width="100%" border="0">
          <tr>
            <td width="3%" valign="top">
              <p>1.<br><br><br></p>
			  <p>2.<br><br></p>
			  <p>3.<br><br></p>
			  <p>4.<br><br><br></p>
            </td>
            <td width="97%" valign="top">
              <p align="justify">Dengan syarat bahwa apabila pegawai tersebut di atas mendapatkan sponsorship, hal tersebut tidak mempengaruhi independensi dan kemungkinan benturan kepentingan bagi institusi RSJPDHK maupun yang bersangkutan dalam menjalankan tugasnya di RSJPDHK.</p>
              <p align="justify">Memberikan rincian biaya/sponsorship yang akan diberikan kepada ybs untuk bukti/laporan pertanggung jawaban.</p>
			  <p align="justify">Setelah mengikuti penugasan kegiatan tersebut yang bersangkutan diwajibkan membuat laporan sesuai ketentuan yang berlaku.</p>
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
      <td colspan="2" width="40%">&nbsp;</td>
      <td width="60%">Direktur Utama,</td>
    </tr>
    <tr>
      <td colspan="3">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="3">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="2" width="40%">&nbsp;</td>
      <td width="60%">Dr. dr. Iwan Dakota,  SpJP(K), MARS,FACC,FESC</td>
    </tr>
    <tr>
      <td colspan="2" width="40%">&nbsp;</td>
      <td width="60%">NIP 196601011996031001</td>
    </tr>
</table>
</div>
</body></html>