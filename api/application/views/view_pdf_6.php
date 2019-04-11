
<!doctype html>
<html><head></head><body>

<style>
      @page { margin: 120px 50px; }
     #header { position: fixed; left: -10px; top: -100px; right: -10px; bottom: -180px; height: 0px; text-align: center; }
     #foote { position: fixed; left: 0px; bottom: -80px; right: 0px; height: 50px; }
     #foote { content: counter(upper-roman); }
</style>
	<div id="header">
    <table width="100%" class="table-1" border="0">
	<tbody>
	<tr>
      <td colspan="1" width="50%" align="right"><img src="<?php echo base_url(); ?>/logo.png" width="100"/></td>
	  <td colspan="1"><h6>LAMPIRAN 1<br>PERATURAN MENTRI KEUANGAN REPUBLIK INDONESIA<br>NOMOR 113/PMK.05/2012<br>TENTANG<br>PERJALANAN DINAS JABATAN DALAM NEGERI BAGI PEJABAT<br>NEGARA, PEGAWAI NEGERI, DAN PEGAWAI TIDAK TETAP</h6></td>
	</tr>
	</tbody>
	</table>
   </div>
   <div hidden="<?php echo $result["footer"]; ?>" id="foote">
     <p><h6>Latbang_2 C:SrtTgs Intern <?php echo $result["tanggal"]["tanggal_now"] ?> <?php echo $result["createdby"]; ?></h6></p>
  </div>
<div id="content">
<table border="0" class="table-1" style="margin:30px">
	<tr>
      <td colspan="3"><table width="100%" border="1px solid" cellpadding="1" cellspacing="0" class="table2">
		<tbody>
           <tr>
              <td><center><b>1.</b></center></td>
              <td width="50%">Pejabat Pembuat Komitmen</td>
			  <td width="60%">Dr. dr. Basuni Radi. SpJP(K), FIHA</td>
          </tr> 
           <tr>
              <td><center><b>2.</b></center></td>
              <td>Nama/NIP Pegawai yang melaksanakan perjalanan dinas</td>
                </td>
			  <td><?php if(!empty($result["pengembangan_pelatihan_detail"]->nama_pegawai)){echo $result["gelar_depan"].' '.$result["pengembangan_pelatihan_detail"]->nama_pegawai.', '.$result["gelar_belakang"];}else{echo $result["pengembangan_pelatihan_detail"]->nip;}?>
          </tr> 
		  <tr>
              <td><center><b>3.</b></center></td>
			  <td>a. Pangkat dan golongan<br>b. Jabatan/Instansi/Unit Kerja<br><br>c. Tingkat Biaya Perjalanan Dinas</td>
              <td>a. <?php echo $result["pengembangan_pelatihan_detail"]->pangkat;?> - <?php echo $result["pengembangan_pelatihan_detail"]->golongan;?><br>b. <?php if(!empty($result["pengembangan_pelatihan_detail"]->jabatan)){echo $result["pengembangan_pelatihan_detail"]->jabatan;}else{echo $result["grup"];}?><br>c. </td>
          </tr>
		  <tr>
              <td><center><b>4.</b></center></td>
              <td>Maksud perjalanan dinas</td>
			  <td align="justify">Mengikuti <?php echo $result["nama_pelatihan"] ?>, yang akan dilaksanakan pada tanggal <?php echo date('d',strtotime($result["tanggal"][0]["tanggal_from"])) ." s.d ". $result["tanggal"]["tanggal_to"]; ?>. Yang diselenggarakan oleh <?php echo $result["institusi"]; ?>. Bertempat di <?php echo $result["tujuan"]; ?></td>
          </tr>
		  <tr>
              <td><center><b>5.</b></center></td>
              <td>Alat angkutan yang digunakan</td>
			  <td> <?php echo $result["alat_angkut"]; ?></td>
          </tr>
		  <tr>
              <td><center><b>6.</b></center></td>
              <td>a. Tempat berangkat<br>b. Tempat tujuan</td>
              <td>a. Jakarta<br>b. <?php echo $result["tujuan"]; ?></td>
          </tr>
		  <tr>
              <td><center><b>7.</b></center></td>
              <td>a. Lama Perjalanan Dinas<br>b. Tanggal berangkat<br>c. Tanggal harus kembali/tiba ditempat</td>
              <td>a. <?php echo $result["total_hari_kerja"]; ?> (<?php echo ucfirst($result["total_hari_kerja_baru"]);?>) Hari<br>b. <?php echo $result["tanggal"]["from"] ?><br>c. <?php echo $result["tanggal"]["to"] ?></td>
          </tr>
		  <tr>
              <td><center><b>8.</b></center></td>
			  <td>Pengikut : Nama<br>1.<br>2.</td>
			  <td>Tanggal Lahir  : Keterangan<br><br><br></td>
          </tr>
		  <tr>
              <td><center><b>9.</b></center></td>
              <td>Pembebanan Anggaran :<br>a. Instansi<br>b. Akun</td>
              <td><br>a. RS. Jantung & Pembuluh Darah Harapan Kita<br>b. <?php echo $result["pengembangan_pelatihan_detail"]->nopeg; ?></td>
          </tr><tr>
              <td><center><b>10.</b></center></td>
              <td>Keterangan lain-lain</td>
			  <td></td>
          </tr>
        </tbody>
      </table></td>
    </tr> 
</table>
</div>
</body></html>