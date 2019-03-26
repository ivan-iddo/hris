<!doctype html>
<html><head></head><body>
<table border="0" class="table-1" style="margin:30px">
    <tr>
     <td colspan="3">
		<table width="100%" border="0" cellpadding="3">
		<tbody>          
		  <tr>
            <td>Kementrian Negara/Lembaga :<br>RUMAH SAKIT JANTUNG DAN PEMBULU DARAH<br>HARAPAN KITA<br>Jl. Let. Jend. S. Parman Kav, 87, Slip<br>JAKARTA 11420</td>
			<td align="right"><table width="20%" border="0" cellpadding="3">
			<tbody>
			  <tr>
				<td><br><br>Lembar ke<br>Kode Nomor<br>Nomor</td>
				<td><br><br>:<br>:<br>:</td>
				<td><br><br>..............<br>..............<br>12212121</td>
			  </tr>
			</tbody>
		  </table></td>
          </tr>
		</tbody>
      </table></td></tr>
	<tr>
      <td colspan="3"><center>SURAT PERJALANAN DINAS (SPD)<center></td>
    </tr> 
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
			  <td><?php echo $result["detail"][0]["nama_pegawai"]?> / <?php echo $result["detail"][0]["nip"]?></td>
          </tr> 
		  <tr>
              <td><center><b>3.</b></center></td>
			  <td>a. Pangkat dan golongan<br><br>b. Jabatan/Instansi/Unit Kerja<br><br>c. Tingkat Biaya Perjalanan Dinas</td>
              <td>a. <?php echo $result["detail"][0]["pangkat"]?> - <?php echo $result["detail"][0]["golongan"]?><br><br>b. <?php echo $result["detail"][0]["jabatan"]?><br><br>c. </td>
          </tr>
		  <tr>
              <td><center><b>4.</b></center></td>
              <td>Maksud perjalanan dinas</td>
			  <td align="justify">Berdasarkan disposisi Direktur Umum dan SDM tanggal <?php echo date('d F Y',strtotime($result['created'])); ?>, prihal Mengikuti <?php echo $result['nama_pelatihan']; ?> di Instansi <?php echo $result["institusi"]; ?>, yang dilaksanakan pada tanggal <?php echo date('d F',strtotime($result["tanggal"][0]["tanggal_from"])) ." s/d ". date('d F Y',strtotime($result["tanggal"][0]["tanggal_to"])) ?>, diselenggarakan oleh <?php echo $result["institusi"]; ?>. Bertempat di <?php echo $result["tujuan"]; ?></td>
          </tr>
		  <tr>
              <td><center><b>5.</b></center></td>
              <td>Alat angkutan yang digunakan</td>
			  <td>Dr. dr. Basuni Radi. SpJP(K), FIHA</td>
          </tr>
		  <tr>
              <td><center><b>6.</b></center></td>
              <td>a. Tempat berangkat<br><br>b. Tempat tujuan</td>
              <td>a. Jakarta<br><br>b. Tempat tujuan</td>
          </tr>
		  <tr>
              <td><center><b>7.</b></center></td>
              <td>a. Lama Perjalanan Dinas<br><br>b. Tanggal berangkat<br><br>c. Tanggal harus kembali/tiba ditempat baru</td>
              <td>a. Lama Perjalanan Dinas<br><br>b. <?php echo date('d F Y',strtotime($result["tanggal"][0]["tanggal_from"])) ?><br><br>c. <?php echo date('d F Y',strtotime($result["tanggal"][0]["tanggal_to"])) ?></td>
          </tr>
		  <tr>
              <td><center><b>8.</b></center></td>
			  <td colspan="1" >
			  <table width="100%" border="0" align="left" cellpadding="1" cellspacing="3">
				<tbody>
				  <tr>
					<td>Pengikut</td>
					<td>:</td>
					<td width="40%">Nama</td>
				  </tr> 
				  <tr>
					<td><center>1.</center></td>
					<td>&nbsp;</td>
					<td width="40%"></td>
				  </tr>
				</tbody>
			  </table></td>
			  <td colspan="1" ><table width="100%" border="0" align="left" cellpadding="1" cellspacing="3">
				<tbody>
				  <tr>
					<td width="20%">Tanggal Lahir</td>
					<td width="20%">Keterangan</td>
				  </tr> 
				  <tr>
					<td width="20%"><center><br><br><br><br></center></td>
					<td width="20%"><br><br><br><br></td>
				  </tr>
				</tbody>
			  </table></td>
          </tr>
		  <tr>
              <td><center><b>&nbsp;</b></center></td>
          </tr>
		  <tr>
              <td><center><b>9.</b></center></td>
              <td>a. Instansi<br><br>b. Akun</td>
              <td>a. RS. Jantung & Pembuluh Darah Harapan Kita<br><br>b. Akun</td>
          </tr><tr>
              <td><center><b>10.</b></center></td>
              <td>Keterangan lain-lain</td>
			  <td></td>
          </tr>
        </tbody>
      </table></td>
    </tr>
	  <tr>
     <td colspan="3">
		<table width="100%" border="0" cellpadding="3">
		<tbody>          
          </tr>
		  <tr>
            <td width="50%">&nbsp;</td>
			<td><table width="10%" border="0" cellpadding="3">
			<tbody>
			  <tr>
				<td>Dikeluarkan di<br>Tanggal</td>
				<td>:<br>:</td>
				<td width="50%">Jakarta<br>Februari 2019</td>
			  </tr>
			</tbody>
		  </table></td>
          </tr>
		</tbody>
      </table></td></tr>
	<tr>
      <td width="20%">&nbsp;</td>
      <td width="40%">&nbsp;</td>
      <td width="60%">Pejabat Pembuat Komitmen</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td><b>&nbsp;</b></td>
      <td>&nbsp;</td>
      <td>Dr. dr. Basuni Radi. SpJP(K), FIHA</td>
    </tr>
    <tr>
      <td><b>&nbsp;</b></td>
      <td>&nbsp;</td>
      <td>NIP. 196606122000121001</td>
    </tr>
</table>
</body></html>