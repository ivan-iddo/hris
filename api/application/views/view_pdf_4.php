
<!doctype html>
<html><head></head><body>

<style>
      @page { margin: 100px 30px 40px; }
     #header { position: fixed; left: -10px; top: -100px; right: -10px; bottom: -180px; height: 0px; text-align: center; }
     #foote { position: fixed; left: 0px; bottom: -0px; right: 0px; }
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
     <p><h6>Latbang_1:SPD Intern <?php echo date("d")." ". $result["tanggal"]["now"] ?> <?php echo $result["createdby"]; ?></h6></p>
  </div>
<div id="content">
<table border="0" class="table-1" style="margin:30px">
    <tr>
     <td colspan="3">
		<table width="100%" border="0" cellpadding="3">
		<tbody>          
		  <tr>
            <td>Kementrian Negara/Lembaga :<br>RUMAH SAKIT JANTUNG DAN PEMBULU DARAH<br>HARAPAN KITA<br>Jl. Let. Jend. S. Parman Kav, 87, Slipi<br>JAKARTA 11420</td>
			<td><table width="100%" border="0" cellpadding="3">
			<tbody>
			  <tr>
				<td><br><br>Lembar ke<br>Kode Nomor<br>Nomor</td>
				<td><br><br>:<br>:<br>:</td>
				<td><br><br>..............<br>..............<br>KP.03.04/XX.4/ &nbsp; &nbsp; &nbsp;  &nbsp; /<?php echo date('Y'); ?></td>
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
	  <tr>
     <td colspan="3">
		<table width="100%" border="0" cellpadding="3">
		<tbody>          
          </tr>
		  <tr>
            <td width="50%">&nbsp;</td>
			<td><table width="100%" border="0" cellpadding="3">
			<tbody>
			  <tr>
				<td>Dikeluarkan di<br>Tanggal</td>
				<td>:<br>:</td>
				<td width="50%">Jakarta<br>       <?php echo bulan(date("m",strtotime($result["created"]))) ." ".date("Y",strtotime($result["created"]))?></td>
			  </tr>
			</tbody>
		  </table></td>
          </tr>
		</tbody>
      </table></td></tr>
	<tr>
      <td width="20%">&nbsp;</td>
      <td width="20%">&nbsp;</td>
      <td width="40%">Pejabat Pembuat Komitmen</td>
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
      <td>NIP 196606122000121001</td>
    </tr>
	<tr>
      <td colspan="3">&nbsp;</td>
    </tr>
	<tr>
      <td colspan="3"><br><center><u><b>RINCIAN PENGHITUNGAN BIAYA PELATIHAN</b></u></center><br></td>
    </tr> 
    <tr>
      <td colspan="3"><table width="100%" border="1px solid" cellpadding="1" cellspacing="0"  class="table2">
		  <tr>
              <td><center><b>No</b></center></td>
			  <td><center><b>Perincian Biaya</b></center></td>
			  <td><center><b>Jumlah</b></center></td>
			  <td><center><b>Keterangan</b></center></td>
          </tr>
		<?php if (!empty($result["detail"][0]["detail_uraian"])): ?>
            <?php foreach ($result["detail"][0]["detail_uraian"] as $key => $value): ?>
          <tr>
            <td width="4%"><center><?php echo $key+1 ?>.</center></td>
            <td><?php echo $value["uraian"]?> :
            <br>1 Orang <?php if(!empty($value["uraian_nominal"])){ echo 'x '. $value["qty"].' '.$value["uraian_nominal"];}?> x Rp. <?php echo number_format($value["pernominal"], 2, ",", ".")?></td>
			<td>Rp. <?php echo number_format($value["nominal"], 2, ",", ".")?></td>
            <!--<td width="40%">Dengan catatan bahwa untuk tarif satuan biaya seperti diatas, saya tidak mengajukan klaim</td>-->
            <td width="40%"></td>
          </tr>
		 <?php endforeach ?>
          <?php endif ?>
		  <tr>
            <td></td>
            <td>Jumlah</td>
            <td colspan="2">Rp. <?php echo number_format($result["detail"][0]["uraian_total"], 2, ",", ".")?></td>
          </tr>
      </table></td>
    </tr>
   <tr>
      <td width="40%"><br><br>Telah dibayar<br>Rp. <?php echo number_format($result["detail"][0]["uraian_total"], 2, ",", ".")?><br>(<?php echo ucfirst($result["total_biaya"]);?> rupiah)</td>
      <td width="10%">&nbsp;</td>
      <td width="60%"><br>Jakarta,         <?php echo bulan(date("m",strtotime($result["created"]))) ." ".date("Y",strtotime($result["created"]))?><br>Telah menerima sejumlah uang sebesar,<br>Rp. <?php echo number_format($result["detail"][0]["uraian_total"], 2, ",", ".")?><br>(<?php echo ucfirst($result["total_biaya"]);?> rupiah)</td>
    </tr>
	<tr>
      <td width="40%">Bendahara Pengeluaran</td>
      <td width="10%">&nbsp;</td>
      <td width="60%">Yang berpergian,</td>
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
      <td>WIHARSA, S.E</td>
      <td>&nbsp;</td>
      <td><?php echo $result["pengembangan_pelatihan_detail"]->nama_pegawai;?></td>
    </tr>
    <tr>
      <td>NIP 197402092008121001</td>
      <td>&nbsp;</td>
      <td>NIP/Nopeg <?php if(!empty($result["pengembangan_pelatihan_detail"]->nip)){echo $result["pengembangan_pelatihan_detail"]->nip;}else{echo $result["pengembangan_pelatihan_detail"]->nopeg;}?></td>
    </tr>
</table>
</div>
</body></html>