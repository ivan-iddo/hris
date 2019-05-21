
<!doctype html>
<html><head></head><body>

<style>
     @page { margin: 10px 10px 15px -10px; }
     #header { position: fixed; left: -10px; top: -30px; right: -10px; bottom: -60px; height: 0px; text-align: center; }
     #foote { position: fixed; left: 20px; bottom: 0px; right: 0px; }
     #foote { content: counter(upper-roman); }
</style>
	<div hidden="<?php echo $result["footer"]; ?>" id="header">
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
            <td><u>Kementrian Negara/Lembaga :</u><br><i>Ministry/Institution</i><br>RUMAH SAKIT JANTUNG DAN PEMBULU DARAH<br>HARAPAN KITA<br>Jl. Let. Jend. S. Parman Kav, 87, Slipi<br>JAKARTA 11420</td>
			<td><table width="100%" border="0" cellpadding="3">
			<tbody>
			  <tr>
				<td><br><br><u>Lembar ke</u><br><i>Sheet No</i><br><u>Kode Nomor</u><br><i>Code No</i><br><u>Nomor</u><br><i>Number</i></td>
				<td><br><br>:<br><br>:<br><br>:<br><br></td>
				<td><br><br>..............<br><br>..............<br><br>KP.03.04/XX.4/ &nbsp; &nbsp; &nbsp;  &nbsp; /<?php echo date('Y'); ?><br><br></td>
			  </tr>
			</tbody>
		  </table></td>
          </tr>
		</tbody>
      </table></td></tr>
	<tr>
      <td colspan="3"><center><u>SURAT PERJALANAN DINAS (SPD)</u><br><i>LETTER OF OFFICIAL TRAVEL</i><center></td>
    </tr> 
	<tr>
      <td colspan="3"><table width="100%" border="1px solid" cellpadding="1" cellspacing="0" class="table2">
		<tbody>
           <tr>
              <td><center><b>1.</b></center></td>
              <td width="50%"><u>Pejabat Pembuat Komitmen</u><br><i>Authorizing Officer</i></td>
			  <td width="60%">Dr. dr. Basuni Radi. SpJP(K), FIHA</td>
          </tr> 
           <tr>
              <td><center><b>2.</b></center></td>
              <td><u>Nama/NIP Pegawai yang melaksanakan perjalanan dinas</u><br><i>Name/Employee Register Number of the assigned officer</i></td>
                </td>
			  <td><?php if(!empty($result["pengembangan_pelatihan_detail"]->nama_pegawai)){echo $result["gelar_depan"].' '.$result["pengembangan_pelatihan_detail"]->nama_pegawai.', '.$result["gelar_belakang"];}else{echo $result["pengembangan_pelatihan_detail"]->nip;}?>
          </tr> 
		  <tr>
              <td><center><b>3.</b></center></td>
              <td><table width="100%" border="0">
				<tbody>
				  <tr>
				    <td width="1%">a.<br><br>b.<br><br>c.<br><br></td>
					<td width="30%" align="left"><u>Pangkat dan golongan</u><br><i>Official rank</i><br><u>Jabatan/Instansi/Unit Kerja</u><br><i>Position/Institution</i><br><u>Tingkat Biaya Perjalanan Dinas</u><br><i>Level of Official Travel Expense</i></td>
				  </tr>
				</tbody>
			  </table></td>
			  <td>a. <?php echo $result["pengembangan_pelatihan_detail"]->pangkat;?> - <?php echo $result["pengembangan_pelatihan_detail"]->golongan;?><br><br>b. <?php if(!empty($result["pengembangan_pelatihan_detail"]->jabatan)){echo $result["pengembangan_pelatihan_detail"]->jabatan;}else{echo $result["grup"];}?><br><br>c. </td>
          </tr>
		  <tr>
              <td><center><b>4.</b></center></td>
              <td><u>Maksud perjalanan dinas</u><br><i>Purpose of Travel</i></td>
			  <td align="justify">Mengikuti <?php echo $result["nama_pelatihan"] ?>, yang akan dilaksanakan pada tanggal <?php if($result["tanggal"][0]["tanggal_from"]==$result["tanggal"][0]["tanggal_to"]){ echo $result["tanggal"]["to"];}else {echo date('d',strtotime($result["tanggal"][0]["tanggal_from"])) ." s.d ". $result["tanggal"]["to"];} ?>. Yang diselenggarakan oleh <?php echo $result["institusi"]; ?>. Bertempat di <?php echo $result["tujuan"]." ".$result["alamat"]; ?></td>
          </tr>
		  <tr>
              <td><center><b>5.</b></center></td>
              <td><u>Alat angkutan yang digunakan</u><br><i>Mode of Transportation</i></td>
			  <td> <?php echo $result["alat_angkut"]; ?></td>
          </tr>
		  <tr>
              <td><center><b>6.</b></center></td>
              <td><table width="100%" border="0">
				<tbody>
				  <tr>
				    <td width="1%">a.<br><br>b.<br><br></td>
					<td><u>Tempat berangkat</u><br><i>Poin of Departure</i><br><u>Tempat tujuan</u><br><i>Point of Destination</i></td>
				  </tr>
				</tbody>
			  </table></td>
              <td>a. Jakarta<br><br>b. <?php echo $result["tujuan"]; ?><br></td>
          </tr>
		  <tr>
              <td><center><b>7.</b></center></td>
              <td><table width="100%" border="0">
				<tbody>
				  <tr>
				    <td width="1%">a.<br><br>b.<br><br>c.<br><br></td>
					<td><u>Lama Perjalanan Dinas</u><br><i>Duration of Official Travel</i><br><u>Tanggal berangkat</u><br><i>Date of Departure</i><br><u>Tanggal harus kembali/tiba ditempat</u><br><i>End of assignment Date/start of assignment date</i></td>
                  </tr>
				</tbody>
			  </table>
			  </td>
              <td>a. <?php echo $result["total_hari_kerja"]; ?> (<?php echo ucfirst($result["total_hari_kerja_baru"]);?>) Hari<br><br>b. <?php echo $result["tanggal"]["from"] ?><br><br>c. <?php echo $result["tanggal"]["to"] ?><br></td>
          </tr>
		  <tr>
              <td><center><b>8.</b></center></td>
			  <td><u>Pengikut : Nama</u><br><i>Companion    Name</i><br>1.</td>
			  <td>Tanggal Lahir  : Keterangan<br><i>Date of Bird           :  Note</i><br><br></td>
          </tr>
		  <tr>
              <td><center><b>9.</b></center></td>
              <td><table width="100%" border="0">
				<tbody>
				  <tr>
				    <td width="50%"><u>Pembebanan Anggaran :</u><br><i>Budget Allocation</i></td>
					</tr>
				</tbody>
			  </table>
			  <table width="100%" border="0">
				<tbody>
				  <tr>
				    <td width="1%">a.<br><br>b.<br><br></td>
					<td>Instansi</u><br><i>Institution</i><br><u>Akun</u><br><i>Code of Account</i></td>
                  </tr>
				</tbody>
			  </table></td>
              <td><br>a. RS. Jantung & Pembuluh Darah Harapan Kita<br><br>b. <?php echo $result["pengembangan_pelatihan_detail"]->nopeg; ?><br></td>
          </tr><tr>
              <td><center><b>10.</b></center></td>
              <td><u>Keterangan lain-lain</u><br><i>Additional Note</i></td>
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
				<td width="40%" align="left"><u>Dikeluarkan di</u><br><i>Place of Issuance</i><br><u>Tanggal<br></u><i>Date of Issuance</i></td>
				<td>:<br><br>:<br><br></td>
				<td width="60%">Jakarta<br><br>       <?php echo bulan(date("m",strtotime($result["created"]))) ." ".date("Y",strtotime($result["created"]))?><br><br></td>
			  </tr>
			</tbody>
		  </table></td>
    </tr>
	<tr>
      <td width="20%">&nbsp;</td>
      <td width="20%">&nbsp;</td>
      <td width="40%"><u>Pejabat Pembuat Komitmen</u><br><i>Authorizing Officer</i></td>
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
      <td align="justify"><b>&nbsp;</b></td>
    </tr><tr>
      <td align="justify"><b>&nbsp;</b></td>
    </tr>
	<tr>
      <td align="justify"><b>&nbsp;</b></td>
    </tr>
	<tr>
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
              <td width="50%"><table width="100%" border="0">
				<tbody>
				  <tr>
				    <td width="1%" align="center"><br><br><br><br></td>
				    <td width="1%">I.<br><br><br><br></td>
					<td width="30%" align="left"><u>Tiba di</u><br><i>Arrival at</i><br><u>Pada Tanggal</u><br><i>Date</i><br></td>
					<td>:<br><br>:<br><br></td>
					<td width="68%"><?php echo $result["tujuan"]; ?><br><br><?php echo $result["tanggal"]["from"] ?><br><br></td>
				  </tr>
				  <tr>
				    <td width="1%" align="center"><br></td>
					<td width="1%"></td>
					<td width="30%" align="right"><u>Kepala Kantor</u><br><i>Head of Office</i></td>
					<td></td>
					<td width="68%">&nbsp;&nbsp;&nbsp;<br></td>
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
			  <td width="50%">
			  <table width="100%" border="0">
				<tbody>
				  <tr>
				    <td width="2%"><br><br><br><br><br><br></td>
				    <td width="4%">II.<br><br><br><br><br><br></td>
					<td width="50%" align="left"><u>Berangkat dari</u><br><i>Depature from</i><br><u>Ke<u><br><i>To</i><br><u>Pada Tanggal</u><br><i>Date</i></td>
					<td>:<br><br>:<br><br>:<br><br></td>
					<td width="46%">Jakarta<br><br><?php echo $result["tujuan"]; ?><br><br><?php echo $result["tanggal"]["from"] ?><br><br></td>
				  </tr>
				  <tr>
					<td colspan="5" align="center">RS. Jantung & Pembulu Darah Harapan Kita<br><?php if(!empty($result["phl"])){ if($result["jenis_plh"]!="Plh"){ echo "a. n. Direktur Utama ";}else{ echo "Plh. Direktur Utama, ";}}else{ echo "Direktur Utama, ";}?></td>
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
				    <td width="1%" align="center"><br><br><br><br></td>
				    <td width="1%">III.<br><br><br><br></td>
					<td width="30%" align="left"><u>Tiba di</u><br><i>Arrival at</i><br><u>Pada Tanggal</u><br><i>Date</i><br></td>
					<td>:<br><br>:<br><br></td>
					<td width="68%"><br><br><br><br></td>
				  </tr>
				  <tr>
				    <td width="1%" align="center"><br></td>
					<td width="1%"></td>
					<td width="30%" align="right"><u>Kepala Kantor</u><br><i>Head of Office</i></td>
					<td></td>
					<td width="68%">&nbsp;&nbsp;&nbsp;<br></td>
				  </tr>
				  <tr>
					<td colspan="3" align="center">&nbsp;</td>
				  </tr><tr>
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
				    <td width="2%"><br><br><br><br><br><br></td>
				    <td width="4%">IV.<br><br><br><br><br><br></td>
					<td width="50%" align="left"><u>Berangkat dari</u><br><i>Depature from</i><br><u>Ke<u><br><i>To</i><br><u>Pada Tanggal</u><br><i>Date</i></td>
					<td>:<br><br>:<br><br>:<br><br></td>
					<td width="46%"><?php echo $result["tujuan"]; ?><br><br>Jakarta<br><br><?php echo $result["tanggal"]["from"] ?><br><br></td>
				  </tr>
				  <tr>
				    <td width="1%" align="center"><br></td>
					<td width="1%"></td>
					<td width="30%" align="right"><u>Kepala Kantor</u><br><i>Head of Office</i></td>
					<td></td>
					<td width="68%">&nbsp;&nbsp;&nbsp;<br></td>
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
		  </tr> 
		  <tr>
              <td><table width="100%" border="0">
				<tbody>
				  <tr>
				    <td width="1%" align="center"><br><br><br><br></td>
				    <td width="1%">V.<br><br><br><br></td>
					<td width="30%" align="left"><u>Tiba di</u><br><i>Arrival at</i><br><u>Pada Tanggal</u><br><i>Date</i><br></td>
					<td>:<br><br>:<br><br></td>
					<td width="68%"><br><br><br><br></td>
				  </tr>
				  <tr>
				    <td width="1%" align="center"><br></td>
					<td width="1%"></td>
					<td width="30%" align="right"><u>Kepala Kantor</u><br><i>Head of Office</i></td>
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
				    <td width="2%"><br><br><br><br><br><br></td>
				    <td width="4%">VI.<br><br><br><br><br><br></td>
					<td width="50%" align="left"><u>Berangkat dari</u><br><i>Depature from</i><br><u>Ke<u><br><i>To</i><br><u>Pada Tanggal</u><br><i>Date</i></td>
					<td>:<br><br>:<br><br>:<br><br></td>
					<td width="46%"><br><br><br><br><br><br></td>
				  </tr>
				  <tr>
				    <td width="1%" align="center"><br></td>
					<td width="1%"></td>
					<td width="30%" align="right"><u>Kepala Kantor</u><br><i>Head of Office</i></td>
					<td></td>
					<td width="68%">&nbsp;&nbsp;&nbsp;<br></td>
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
          </tr><tr>
              <td><table width="100%" border="0">
				<tbody>
				  <tr>
				    <td width="2%"><br><br><br></td>
				    <td width="4%">VII.<br><br><br><br></td>
					<td width="60%" align="left"><u>Tiba di Tempat Kedudukan</u><br><i>Arrival at Departure Point </i><br><u>Pada Tanggal</u><br><i>Date</i></td>
					<td>:<br><br>:<br><br></td>
					<td width="30%">Jakarta<br><br><?php echo $result["tanggal"]["from"] ?><br><br></td>
				  </tr>
				  <tr>
					<td colspan="5" align="center"><u>Pejabat Pembuat Komitmen</u><br><i>Authorizing Officer</i></td>
				  </tr>
				  <tr>
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
				    <td width="1%"><br><br><br></td>
				    <td width="2%" valign="top">VII.<br><br><br></td>
					<td colspan="3" width="94%" align="justify" valign="top">Telah diperiksa, dengan keterangan bahwa perjalanan tersebut di atas benar dilakukan atas perintahnya dan samata-mata untuk kepentingan jabatan dalam waktu yang sesingkat-singkatnya</td>
				  </tr>
				</tbody>
			  </table>
			  <table width="100%" border="0">
				<tbody>
				   <tr>
					<td colspan="3" align="center"><u>Pejabat Pembuat Komitmen</u><br><i>Authorizing Officer</i></td>
				  </tr>
				  <tr>
					<td colspan="3" align="center">&nbsp;</td>
				  </tr>
				  <tr>
					<td colspan="3" align="center">(Dr. dr. Basuni Radi, SpJP(K), FIHA)<br> NIP 196606122000121001</td>
				  </tr>
				</tbody>
			  </table></td>
          </tr><tr>
             <td colspan="2"><table width="100%" border="0">
				<tbody>
				  <tr>
				    <td width="1%"></td>
				    <td width="1%"></td>
					<td width="98%" align="justify">Keterangan / <i>note</i> :</td>
				  </tr>
				  <tr>
				    <td width="1%"></td>
				    <td width="1%"></td>
					<td width="98%" align="justify"><u>Hanya untuk kebutuhan administrasi, jika Kepala Kantor tidak ada di tempat, dapat ditandatangani oleh pegawai atau petugas yang berada di tempat.</u></td>
				  </tr>
				  <tr>
				    <td width="1%"></td>
				    <td width="1%"></td>
					<td width="98%" align="justify"><i>It is only for administrative purpose, if the Head of Office is not available, can be signed by available officer.</i></td>
				  </tr>
				</tbody>
			  </table></td>
		  </tr>
        </tbody>
      </table>
	  </td>
    </tr>
    <tr>
      <td colspan="3">&nbsp;</td>
    </tr><tr>
      <td colspan="3">&nbsp;</td>
    </tr><tr>
      <td colspan="3">&nbsp;</td>
    </tr><tr>
      <td colspan="3">&nbsp;</td>
    </tr>
	  <tr>
      <td colspan="3">&nbsp;</td>
    </tr><tr>
      <td colspan="3">&nbsp;</td>
    </tr><tr>
      <td colspan="3">&nbsp;</td>
    </tr>
	  <tr>
      <td colspan="3">&nbsp;</td>
    </tr><tr>
      <td colspan="3">&nbsp;</td>
    </tr><tr>
      <td colspan="3">&nbsp;</td>
    </tr>
	  <tr>
      <td colspan="3">&nbsp;</td>
    </tr><tr>
      <td colspan="3">&nbsp;</td>
    </tr><tr>
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
		<?php if (!empty($result["detail_uraian"])): ?>
            <?php foreach ($result["detail_uraian"] as $key => $value): ?>
          <tr>
            <td width="4%"><center><?php echo $key+1 ?>.</center></td>
            <td><?php echo $value["uraian"]?> :
            <br>1 Orang <?php if(!empty($value["uraian_nominal"])){ echo 'x '. $value["qty"].' '.$value["uraian_nominal"];}?> x Rp. <?php echo number_format($value["pernominal"], 0, ",", ".")?></td>
			<td>
			<table width="100%" border="0px" cellpadding="1" cellspacing="0" class="table2">
			  <tr>
				<td width="20%"></td>
				<td width="10%">Rp.</td>
				<td align="right" width="50%"><?php echo number_format($value["nominal"], 0, ",", ".")?></td>
				<td width="20%"></td>
			  </tr>
			</table>
			</td>
            <!--<td width="40%">Dengan catatan bahwa untuk tarif satuan biaya seperti diatas, saya tidak mengajukan klaim</td>-->
            <td width="40%"></td>
          </tr>
		 <?php endforeach ?>
          <?php endif ?>
		  <tr>
            <td></td>
            <td>Jumlah</td>
            <td colspan="1">
			<table width="100%" border="0px" cellpadding="1" cellspacing="0" class="table2">
			  <tr>
				<td width="20%"></td>
				<td width="10%">Rp.</td>
				<td align="right" width="50%"><?php echo number_format($result["total"], 0, ",", ".")?></td>
				<td width="20%"></td>
			  </tr>
			</table>
			</td>
			<td></td>
          </tr>
      </table></td>
    </tr>
   <tr>
      <td width="40%"><br><br>Telah dibayar<br>Rp. <?php echo number_format($result["total"], 0, ",", ".")?><br>(<?php echo ucfirst($result["total_biaya"]);?> rupiah)</td>
      <td width="10%">&nbsp;</td>
      <td width="60%"><br>Jakarta,         <?php echo bulan(date("m",strtotime($result["created"]))) ." ".date("Y",strtotime($result["created"]))?><br>Telah menerima sejumlah uang sebesar,<br>Rp. <?php echo number_format($result["total"], 0, ",", ".")?><br>(<?php echo ucfirst($result["total_biaya"]);?> rupiah)</td>
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