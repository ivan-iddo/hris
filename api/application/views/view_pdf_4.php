
<!doctype html>
<html><head></head><body>

<style>
      @page { margin: 80px 10px 20px 10px; }
     #header { position: fixed; left: -10px; top: -100px; right: -10px; bottom: -180px; height: 0px; text-align: center; }
     #foote { position: fixed; left: 0px; bottom: -0px; right: 0px; }
     #foote { content: counter(upper-roman); }
</style>
	<div hidden="<?php echo $result["footer"]; ?>"id="header">
    <table width="100%" class="table-1" border="0">
	<tbody>
	<tr>
      <td colspan="1" width="50%" align="right"><img src="<?php echo base_url(); ?>/logo_ku.png" width="100"/></td>
	  <td colspan="1"><h6>LAMPIRAN 1<br>PERATURAN MENTRI KEUANGAN REPUBLIK INDONESIA<br>NOMOR 113/PMK.05/2012<br>TENTANG<br>PERJALANAN DINAS JABATAN DALAM NEGERI BAGI PEJABAT<br>NEGARA, PEGAWAI NEGERI, DAN PEGAWAI TIDAK TETAP</h6></td>
	</tr>
	</tbody>
	</table>
   </div>
   <div hidden="<?php echo $result["footer"]; ?>" id="foote">
     <p><h6><?php echo $result["createdby"]; ?>:Intern <?php echo date("d")." ".$result["tanggal"]["now"] ?></h6></p>
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
			  <td>a. Pangkat dan golongan<br>b. Jabatan/Instansi/Unit Kerja<br>c. Tingkat Biaya Perjalanan Dinas</td>
              <td>a. <?php echo $result["pengembangan_pelatihan_detail"]->pangkat;?> - <?php echo $result["pengembangan_pelatihan_detail"]->golongan;?><br>b. <?php if(!empty($result["pengembangan_pelatihan_detail"]->jabatan)){echo $result["pengembangan_pelatihan_detail"]->jabatan;}else{echo $result["grup"];}?><br>c. </td>
          </tr>
		  <tr>
              <td><center><b>4.</b></center></td>
              <td>Maksud perjalanan dinas</td>
			  <td align="justify">Mengikuti <?php echo $result["nama_pelatihan"] ?>, yang akan dilaksanakan pada tanggal <?php if($result["tanggal"][0]["tanggal_from"]==$result["tanggal"][0]["tanggal_to"]){ echo $result["tanggal"]["to"];}else {echo date('d',strtotime($result["tanggal"][0]["tanggal_from"])) ." s.d ". $result["tanggal"]["to"];} ?>. Yang diselenggarakan oleh <?php echo $result["institusi"]; ?>. Bertempat di <?php echo $result["tujuan"]; ?></td>
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
		  <td width="20%">&nbsp;</td>
		  <td width="20%">&nbsp;</td>
		  <td width="40%"><table width="100%" border="0">
			<tbody>
			  <tr>
				<td width="40%" align="left">Dikeluarkan di<br>Tanggal</td>
				<td>:<br>:</td>
				<td width="60%">Jakarta<br>       <?php echo bulan(date("m",strtotime($result["created"]))) ." ".date("Y",strtotime($result["created"]))?></td>
			  </tr>
			</tbody>
		  </table></td>
    </tr>
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
    </tr><tr>
      <td colspan="3">&nbsp;</td>
    </tr><tr>
      <td colspan="3">&nbsp;</td>
    </tr><tr>
      <td colspan="3">&nbsp;</td>
    </tr><tr>
      <td colspan="3">&nbsp;</td>
    </tr>
	<tr hidden="<?php echo $result["footer"]; ?>">
      <td colspan="3"><table width="100%" border="1px solid" cellpadding="1" cellspacing="0" class="table2">
		<tbody>
           <tr>
              <td width="50%">&nbsp;</td>
			  <td width="50%">
			  <table width="100%" border="0">
				<tbody>
				  <tr>
				    <td width="2%"><br><br><br><br></td>
				    <td width="4%">I.<br><br><br><br></td>
					<td width="50%" align="left">Dikeluarkan di<br>(Tempat kedudukan)<br>Ke<br>Pada Tanggal</td>
					<td>:<br><br>:<br>:<br></td>
					<td width="46%">Jakarta<br><br><?php echo $result["tujuan"]; ?><br><?php echo $result["tanggal"]["from"] ?><br></td>
				  </tr>
				  <tr>
					<td colspan="5" align="center">RS. Jantung & Pembulu Darah Harapan Kita<br><?php if(!empty($result["phl"])){ if($result["jenis_plh"]!="Plh"){ echo "a. n. Direktur Utama ";}else{ echo "Plh. Direktur Utama, ";}}else{ echo "Direktur Utama,";}?></td>
				  </tr>
				  <tr>
					<td colspan="3" align="center">&nbsp;</td>
				  </tr>
				  <tr>
					<td colspan="3" align="center">&nbsp;</td>
				  </tr>
				  <tr>
					<td colspan="5" align="center"><?php if(!empty($result["phl"])){ echo $result["aprove_phl"]->gelar_depan.' '.$result["aprove_phl"]->name.', '.$result["aprove_phl"]->gelar_belakang;}else{ echo "Dr. dr. Iwan Dakota,  SpJP(K), MARS,FACC,FESC";}?><br>NIP <?php if(!empty($result["phl"])){echo $result["aprove_phl"]->nip;}else{ echo "196601011996031001";}?></td>
				  </tr>
				</tbody>
			  </table>
			  </td>
          </tr> 
          <tr>
              <td><table width="100%" border="0">
				<tbody>
				  <tr>
				    <td width="2%"><br><br></td>
				    <td width="4%">II.<br><br></td>
					<td width="30%" align="left">Tiba di<br>Pada Tanggal</td>
					<td>:<br>:<br></td>
					<td width="64%"><?php echo $result["tujuan"]; ?><br><?php echo $result["tanggal"]["from"] ?><br></td>
				  </tr>
				  <tr>
					<td colspan="3" align="center">&nbsp;</td>
				  </tr>
				  <tr>
					<td colspan="3" align="center">&nbsp;</td>
				  </tr>
				  <tr>
					<td colspan="3" align="center">&nbsp;</td>
				  </tr><tr>
					<td colspan="3" align="center">&nbsp;</td>
				  </tr><tr>
					<td colspan="3" align="center">&nbsp;</td>
				  </tr>
				</tbody>
			  </table></td>
              <td><table width="100%" border="0">
				<tbody>
				  <tr>
				    <td width="1%"><br><br><br></td>
				    <td width="4%"><br><br><br></td>
					<td width="30%" align="left">Berangkat dari<br>Ke<br>Pada Tanggal</td>
					<td>:<br>:<br>:<br></td>
					<td width="64%"><?php echo $result["tujuan"]; ?><br>Jakarta<br><?php echo $result["tanggal"]["to"] ?><br></td>
				  </tr>
				  <tr>
					<td colspan="3" align="center">&nbsp;</td>
				  </tr>
				  <tr>
					<td colspan="3" align="center">&nbsp;</td>
				  </tr>
				  <tr>
					<td colspan="3" align="center">&nbsp;</td>
				  </tr>
				  <tr>
					<td colspan="3" align="center">&nbsp;</td>
				  </tr>
				</tbody>
			  </table></td>
		  </tr> 
		  <tr>
              <td><table width="100%" border="0">
				<tbody>
				  <tr>
				    <td width="1%" align="center"><br><br></td>
				    <td width="1%">III.<br><br></td>
					<td width="30%" align="left">Tiba di<br>Pada Tanggal<br></td>
					<td>:<br>:<br></td>
					<td width="68%">&nbsp;&nbsp;&nbsp;<br>&nbsp;&nbsp;&nbsp;<br></td>
				  </tr>
				  <tr>
				    <td width="1%" align="center"><br></td>
					<td width="1%"></td>
					<td width="30%" align="right">Kepala</td>
					<td></td>
					<td width="68%">&nbsp;&nbsp;&nbsp;<br></td>
				  </tr>
				  <tr>
					<td colspan="3" align="center">&nbsp;</td>
				  </tr>
				  <tr>
					<td colspan="3" align="center">&nbsp;</td>
				  </tr>
				</tbody>
			  </table>
			  <table width="100%" border="0">
				<tbody>
				  <tr>
					<td colspan="4" align="center">(.....................................................)</td>
				  </tr>
				  <tr>
					<td width="30%" align="right">NIP</td>
				  </tr>
				</tbody>
			  </table></td>
              <td><table width="100%" border="0">
				<tbody>
				  <tr>
					<td width="30%" align="left">Berangkat dari<br>Pada Tanggal<br></td>
					<td width="2%">:<br>:<br></td>
					<td width="68%">&nbsp;&nbsp;&nbsp;<br>&nbsp;&nbsp;&nbsp;<br></td>
				  </tr>
				  <tr>
					<td width="30%" align="right">Kepala</td>
					<td width="2%"></td>
					<td width="68%">&nbsp;&nbsp;&nbsp;<br></td>
				  </tr>
				  <tr>
					<td colspan="3" align="center">&nbsp;</td>
				  </tr>
				  <tr>
					<td colspan="3" align="center">&nbsp;</td>
				  </tr>
				  <tr>
					<td colspan="4" align="center">(.....................................................)</td>
				  </tr>
				  <tr>
					<td width="25%" align="right">NIP</td>
				  </tr>
				</tbody>
			  </table></td>
          </tr><tr>
              <td><table width="100%" border="0">
				<tbody>
				  <tr>
				    <td width="1%" align="center"><br><br></td>
				    <td width="1%">IV.<br><br></td>
					<td width="30%" align="left">Tiba di<br>Pada Tanggal<br></td>
					<td>:<br>:<br></td>
					<td width="68%">&nbsp;&nbsp;&nbsp;<br>&nbsp;&nbsp;&nbsp;<br></td>
				  </tr>
				  <tr>
				    <td width="1%" align="center"><br></td>
					<td width="1%"></td>
					<td width="30%" align="right">Kepala</td>
					<td></td>
					<td width="68%">&nbsp;&nbsp;&nbsp;<br></td>
				  </tr>
				  <tr>
					<td colspan="3" align="center">&nbsp;</td>
				  </tr>
				  <tr>
					<td colspan="3" align="center">&nbsp;</td>
				  </tr>
				</tbody>
			  </table>
			  <table width="100%" border="0">
				<tbody>
				  <tr>
					<td colspan="4" align="center">(.....................................................)</td>
				  </tr>
				  <tr>
					<td width="30%" align="right">NIP</td>
				  </tr>
				</tbody>
			  </table></td>
              <td><table width="100%" border="0">
				<tbody>
				  <tr>
					<td width="30%" align="left">Berangkat dari<br>Pada Tanggal<br></td>
					<td width="2%">:<br>:<br></td>
					<td width="68%">&nbsp;&nbsp;&nbsp;<br>&nbsp;&nbsp;&nbsp;<br></td>
				  </tr>
				  <tr>
					<td width="30%" align="right">Kepala</td>
					<td width="2%"></td>
					<td width="68%">&nbsp;&nbsp;&nbsp;<br></td>
				  </tr>
				  <tr>
					<td colspan="3" align="center">&nbsp;</td>
				  </tr>
				  <tr>
					<td colspan="3" align="center">&nbsp;</td>
				  </tr>
				  <tr>
					<td colspan="4" align="center">(.....................................................)</td>
				  </tr>
				  <tr>
					<td width="25%" align="right">NIP</td>
				  </tr>
				</tbody>
			  </table></td>
          </tr><tr>
              <td><table width="100%" border="0">
				<tbody>
				  <tr>
				    <td width="1%" align="center"><br><br></td>
				    <td width="1%">V.<br><br></td>
					<td width="30%" align="left">Tiba di<br>Pada Tanggal<br></td>
					<td>:<br>:<br></td>
					<td width="68%">&nbsp;&nbsp;&nbsp;<br>&nbsp;&nbsp;&nbsp;<br></td>
				  </tr>
				  <tr>
				    <td width="1%" align="center"><br></td>
					<td width="1%"></td>
					<td width="30%" align="right">Kepala</td>
					<td></td>
					<td width="68%">&nbsp;&nbsp;&nbsp;<br></td>
				  </tr>
				  <tr>
					<td colspan="3" align="center">&nbsp;</td>
				  </tr>
				  <tr>
					<td colspan="3" align="center">&nbsp;</td>
				  </tr>
				</tbody>
			  </table>
			  <table width="100%" border="0">
				<tbody>
				  <tr>
					<td colspan="4" align="center">(.....................................................)</td>
				  </tr>
				  <tr>
					<td width="30%" align="right">NIP</td>
				  </tr>
				</tbody>
			  </table></td><td><table width="100%" border="0">
				<tbody>
				  <tr>
					<td width="30%" align="left">Berangkat dari<br>Pada Tanggal<br></td>
					<td width="2%">:<br>:<br></td>
					<td width="68%">&nbsp;&nbsp;&nbsp;<br>&nbsp;&nbsp;&nbsp;<br></td>
				  </tr>
				  <tr>
					<td width="30%" align="right">Kepala</td>
					<td width="2%"></td>
					<td width="68%">&nbsp;&nbsp;&nbsp;<br></td>
				  </tr>
				  <tr>
					<td colspan="3" align="center">&nbsp;</td>
				  </tr>
				  <tr>
					<td colspan="3" align="center">&nbsp;</td>
				  </tr>
				  <tr>
					<td colspan="4" align="center">(.....................................................)</td>
				  </tr>
				  <tr>
					<td width="25%" align="right">NIP</td>
				  </tr>
				</tbody>
			  </table></td>
          </tr><tr>
              <td><table width="100%" border="0">
				<tbody>
				  <tr>
				    <td width="2%"><br><br><br></td>
				    <td width="4%">VI.<br><br><br></td>
					<td width="50%" align="left">Tiba Kembali di<br>(Tempat kedudukan)<br>Pada Tanggal</td>
					<td>:<br><br>:<br></td>
					<td width="44%">Jakarta<br><br><?php echo $result["tanggal"]["from"] ?><br></td>
				  </tr>
				  <tr>
					<td colspan="3" align="center">&nbsp;</td>
				  </tr>
				  <tr>
					<td colspan="5" align="center">Pejabat Pembuat Komitmen</td>
				  </tr>
				  <tr>
					<td colspan="3" align="center">&nbsp;</td>
				  </tr><tr>
					<td colspan="3" align="center">&nbsp;</td>
				  </tr>
				  <tr>
					<td colspan="5" align="center">(Dr. dr. Basuni Radi, SpJP(K), FIHA)<br> NIP 196606122000121001</td>
				  </tr>
				</tbody>
			  </table></td>
              <td><table width="100%" border="0">
				<tbody>
				  <tr>
				    <td colspan="3" width="99%" align="justify">Telah diperiksa, dengan keterangan bahwa perjalanan tersebut di atas benar dilakukan atas perintahnya dan samata-mata untuk kepentingan jabatan dalam waktu yang sesingkat-singkatnya</td>
				  </tr>
				  <tr>
					<td colspan="3" align="center">Pejabat Pembuat Komitmen</td>
				  </tr>
				  <tr>
					<td colspan="3" align="center">&nbsp;</td>
				  </tr><tr>
					<td colspan="3" align="center">&nbsp;</td>
				  </tr>
				  <tr>
					<td colspan="3" align="center">(Dr. dr. Basuni Radi, SpJP(K), FIHA)<br> NIP 196606122000121001</td>
				  </tr>
				</tbody>
			  </table></td>
          </tr>
		  <tr>
		      <td><table width="100%" border="0">
				<tbody>
				  <tr>
				    <td width="2%"></td>
				    <td width="2%">VII.</td>
					<td width="96%" align="justify">CATATAN LAIN-LAIN
				  </tr>
				</tbody>
			  </table></td>
              <td>&nbsp;</td>
          </tr><tr>
             <td colspan="2"><table width="100%" border="0">
				<tbody>
				  <tr>
				    <td width="1%"></td>
				    <td width="1%">VIII.</td>
					<td width="98%" align="justify">PERHATIAN</td>
				  </tr>
				  <tr>
				    <td width="1%"></td>
				    <td width="1%"></td>
					<td width="98%" align="justify">PPK yang menerbitkan SPD, Pegawai yang melakukan perjalanan dinas, para pejabat yang mengesahkan tanggal berangkat / tiba serta bendahara pengeluaran bertanggung jawab berdasarkan peraturan-peraturan Keuangan Negara, Apabila Negara menderita rugi akibat kesalahan, kelalaian dan kealpaannya.</td>
				  </tr>
				</tbody>
			  </table></td>
		  </tr>
        </tbody>
      </table></td>
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
            <br>1 Orang <?php if(!empty($value["uraian_nominal"])){ echo 'x '. $value["qty"].' '.$value["uraian_nominal"];}?> x Rp. <?php echo number_format($value["pernominal"], 0, ",", ".")?></td>
			<td>Rp. <?php echo number_format($value["nominal"], 0, ",", ".")?></td>
            <!--<td width="40%">Dengan catatan bahwa untuk tarif satuan biaya seperti diatas, saya tidak mengajukan klaim</td>-->
            <td width="40%"></td>
          </tr>
		 <?php endforeach ?>
          <?php endif ?>
		  <tr>
            <td></td>
            <td>Jumlah</td>
            <td colspan="2">Rp. <?php echo number_format($result["detail"][0]["uraian_total"], 0, ",", ".")?></td>
          </tr>
      </table></td>
    </tr>
   <tr>
      <td width="40%"><br><br>Telah dibayar<br>Rp. <?php echo number_format($result["detail"][0]["uraian_total"], 0, ",", ".")?><br>(<?php echo ucfirst($result["total_biaya"]);?> rupiah)</td>
      <td width="10%">&nbsp;</td>
      <td width="60%"><br>Jakarta,         <?php echo bulan(date("m",strtotime($result["created"]))) ." ".date("Y",strtotime($result["created"]))?><br>Telah menerima sejumlah uang sebesar,<br>Rp. <?php echo number_format($result["detail"][0]["uraian_total"], 0, ",", ".")?><br>(<?php echo ucfirst($result["total_biaya"]);?> rupiah)</td>
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