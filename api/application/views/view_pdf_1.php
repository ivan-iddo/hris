<!doctype html>
<html><head></head><body>
<style>
     @page { margin: 200px 50px; }
     #header { position: fixed; left: -10px; top: -150px; right: -10px; bottom: -180px; height: 0px; text-align: center; }
     #foote { position: fixed; left: 0px; bottom: -180px; right: 0px; height: 150px; }
     #foote { content: counter(upper-roman); }
</style>
 <div id="header">
    <table width="100%" class="table-1" border="0">
	<tbody>
	<tr>
      <td colspan="1" width="60"><img src="http://localhost/project/hris/logo2.png" width="80%"></td>
      <td colspan="2"align="center"><b>KEMENTRIAN KESEHATAN<br>DIREKTORAT JENDRAL PELAYANAN KESEHATAN<br>RUMAH SAKIT JANTUNG DAN PEMBULU DARAH HARAPAN KITA</b></td>
	  <td colspan="1" width="70"><img src="http://localhost/project/hris/logo.png" width="100%"></td>
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
     <p>Tembusan : <br>- Atasan Ybs <br>- Para Direktur RSJPDHK</p>
     <p><h6>Latbang_4 G:SrtTgs Intern <?php echo $result["tanggal"]["tanggal_now"] ?></h6></p>
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
      <td colspan="3"><p align="justify">      Sehubungan dengan surat dari Direktur Kesehatan Kerja dan Olahraga Nomor : DL.02.01/IV.2/2454/<?php echo date('Y'); ?> tanggal <?php echo $result["tanggal"]["tanggal_now"] ?> hal Undangan <?php echo '<i>'.$result["nama_pelatihan"];?>, dengan ini kami menugaskan kepada :</p></td>
    </tr>
    <tr>
      <td colspan="3">
        <table width="100%" border="0" cellpadding="3">
          <?php if (!empty($result["detail"])): ?> 
             <?php foreach ($result["detail"] as $key => $value): ?> 
                <tr>
                  <td width="7%" rowspan="4">
                    &nbsp;            
                  </td>
                  <td width="21%">
                    Nama              
                  </td>
                  <td width="2%">
                    :
                  </td>
                  <td width="70%">
                    <?php echo $value["nama_pegawai"] ?>
                  </td>
                </tr>
                <tr>
                  <td width="21%">
                    NIP              
                  </td>
                  <td width="2%">
                    :
                  </td>
                  <td width="70%">
                    <?php echo $value["nip"]; ?>
                  </td>
                </tr>
                <tr>
                  <td width="21%">
                    Pangkat / Gol              
                  </td>
                  <td width="2%">
                    :
                  </td>
                  <td width="70%">
                    <?php echo $value["pangkat"] ." - ". $value["golongan"] ?>
                  </td>
                </tr>
                <tr>
                  <td width="21%">
                    Jabatan              
                  </td>
                  <td width="2%">
                    :
                  </td>
                  <td width="70%">
                    <?php echo $value["jabatan"]; ?>
                  </td>
                </tr>
              <?php endforeach ?>
            <?php endif ?> 
        </table>
      </td>
    </tr>
    <tr>
      <td colspan="3">
      <table width="100%" border="0" style="margin-top : 15px">
        <tr>
          <td width="9%" valign="top" rowspan="4">
            <p>Untuk</p>
          </td>
          <td width="2%" valign="top" rowspan="4">
            <p>:</p>
          </td>
          <td width="2%" valign="top">
            <p>1.</p>
          </td>
          <td width="87%" valign="top">
            <p align="justify">Menjadi <?php echo $result["pengembangan_pelatihan_kegiatan_status"]->nama;?> dalam kegiatan tersebut di <?php echo $result["tujuan"]; ?> tanggal <?php echo date('d',strtotime($result["tanggal"][0]["tanggal_from"])) ." s/d ". $result["tanggal"]["tanggal_to"]; ?>.</p>
          </td>
        </tr>
        <tr>
          <td width="2%" valign="top">
            <p>2.</p>
          </td>
          <td width="87%" valign="top">
            <p align="justify">Melaporkan hasil kegiatan secara tertulis kepada atasan.</p>
          </td>
        </tr>
        <tr>
          <td width="2%" valign="top">
            <p>3.</p>
          </td>
          <td width="87%" valign="top">
            <p align="justify">Tidak melakukan rekam kehadiran pada tanggal tersebut.</p>
          </td>
        </tr>
        <tr>
          <td width="2%" valign="top">
            <p>4.</p>
          </td>
          <td width="87%" valign="top">
            <p align="justify">Biaya yang dikeluarkan sebagai akibat Surat Tugas ini dibebankan pada Satker Direktorat Kesehatan Kerja Dan Olahraga TA <?php echo date('Y') ?></p>
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
      <td width="36%">Direktur Utama,</td>
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
      <td>Dr. dr. Iwan Dakota,  SpJP(K), MARS,FACC,FESC</td>
    </tr>
    <tr>
      <td><em>dimulai jam :</em></td>
      <td>&nbsp;</td>
      <td>NIP 196601011996031001</td>
    </tr>
    <tr>
      <td><em>Selesai  jam :</em></td>
      <td colspan="2">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="3">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="3">&nbsp;</td>
    </tr>
</table>
</div>
</body></html>