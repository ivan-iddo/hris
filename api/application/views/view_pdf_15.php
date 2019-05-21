<!doctype html>
<html><head></head><body>
<style>
     @page { margin: 80px 20px 20px 10px; }
     #header { position: fixed; left: -0px; top: -50px; right: -10px; bottom: -150px; height: 0px; text-align: center; }
     #foote { position: fixed; left: 0px; bottom: 0; right: 0px; height: 10px}
     #foote { content: counter(upper-roman); }
</style>
   <div hidden="<?php echo $result["footer"]; ?>" id="header">
    <table width="100%" class="table-1" border="0">
	<tbody>
	<tr>
      <td colspan="3" width="80"></td>
      <td colspan="1" width="20" align="right">F.4.1.1/064/A</td>
	</tr>
	</tbody>
	</table>
   </div>
   <div hidden="<?php echo $result["footer"]; ?>" id="foote">
     <p><h6><?php echo date("d")." ".$result["tanggal"]["tanggal_now"] ?></h6></p>
   </div>
<div id="content">
<table border="0" class="table-1" style="margin:30px">
	<tr>
      <td colspan="3"><b>RUMAH SAKIT JANTUNG DAN PEMBULU DARAH <br>HARAPAN KITA</b></td>
    </tr>
    <tr>
      <td colspan="4">
        <table width="100%" border="0" cellpadding="0">
          <tr>
            <td width="35%">Agenda Surat Masuk No.</td>
              <td width="2%">:</td>
              <td width="46%"></td>
              <td width="41%" ></td>
          </tr>
          <tr>
            <td width="35%">Diselesaikan Oleh</td>
              <td width="2%">:</td>
              <td colspan="2" width="70%"><?php echo $result["createdby"]; ?></td>
          </tr>
		  <tr>
            <td width="35%">Diperiksa Oleh</td>
            <td width="2%">:</td>
            <td width="60%">1. Ka. Subbagian Pengembangan SDM</td>
            <td colspan="2" width="20%">
			    <table width="100%" border="0" cellpadding="0">
				  <tr>
				   <td width="10%" valign="top">Dikirim</td>
				   <td width="1%" valign="top">:</td>
				   <td width="15%" valign="top"></td>
				  </tr> 
				  <tr>
				   <td width="10%" valign="top">Sifat Surat</td>
				   <td width="1%" valign="top">:</td>
				   <td width="15%" valign="top">Biasa</td>
				  </tr>
				</table>
			  </td>
			</tr></td>
          </tr>
		  <tr>
            <td width="35%"></td>
            <td width="2%"></td>
            <td width="60%">2. Ka. Subbagian TU & Pelaporan</td>
            <td colspan="2" width="20%"></td>
          </tr>
        </table>
      </td>
    </tr>
    <tr>
	<td colspan="4"><hr/></td>
    </tr>
	<tr>
      <td colspan="4">
        <table width="100%" border="0" cellpadding="0"> 
		  <tr>
            <td width="11%">Nomor</td>
              <td width="2%">:</td>
              <td width="46%">KP.03.04/XX.4/ &nbsp; &nbsp; &nbsp;  &nbsp; /<?php echo date('Y'); ?></td>
              <td width="41%" align="right">Jakarta, &nbsp; &nbsp; &nbsp;  &nbsp; <?php echo $result["tanggal"]["tanggal_now"] ?></td>
          </tr>
        </table>
      </td>
    </tr>
	<tr>
      <td colspan="4">
        <table width="100%" border="0" cellpadding="0">
		  <tr>
            <td width="30%">TERLEBIH DAHULU<br><br><br></td>
              <td width="2%">:<br><br><br></td>
              <td colspan="2" width="20%"></td>
              <td colspan="2" width="40%"></td>
          </tr>
		  <tr>
            <td width="30%">Ka. Bag SDM & Organisasi<br><br><br><br></td>
            <td width="2%">:<br><br><br><br></td>
            <td colspan="2" width="20%"></td>
            <td colspan="2" width="40%" align="left" valign="top">MEMBACA :<?php echo $result["membaca"]; ?></td>
          </tr>
		  <tr>
            <td width="30%">Direktur Umum & SDM<br><br><br></td>
            <td width="2%">:<br><br><br></td>
            <td colspan="2" width="20%"></td>
            <td colspan="2" width="40%"></td>
          </tr>
        </table>
      </td>
    </tr>
	<tr>
      <td colspan="4">
        <table width="100%" border="0" cellpadding="0">
		  <tr>
		    <td width="4%" align="right"></td>
            <td width="30%">Ditetapkan :</td>
            <td width="2%"></td>
            <td colspan="2" width="20%"></td>
            <td colspan="2" width="40%" align="left">Yth. <?php echo $result["yth"]; ?></td>
          </tr>
        </table>
      </td>
    </tr>
	<tr>
      <td colspan="4">
        <table width="100%" border="0" cellpadding="0">
		  <tr>
            <td width="4%" align="right"><?php if($result["jenis_plh"]=="Plh"){ echo "Plh. ";}else if($result["jenis_plh"]=="an"){ echo "a. n. ";}else{echo "";}?></td>
		    <td width="40%"><?php if(!empty($result["phl"])){ echo "Direktur Utama,";}else{ echo "Direktur Utama,";}?></td>
		    <td colspan="2" width="20%"></td>
            <td colspan="2" width="40%" align="left"></td>
          </tr>
		  <tr>
			<td colspan="6">&nbsp;</td>
		  </tr>
		  <tr>
			<td colspan="6">&nbsp;</td>
		  </tr>
		  <tr>
            <td width="4%" align="right"></td>
		    <td width="40%"><?php if(!empty($result["phl"])){ echo $result["aprove_phl"]->gelar_depan.' '.$result["aprove_phl"]->name.', '.$result["aprove_phl"]->gelar_belakang;}else{ echo "Dr. dr. Iwan Dakota,  SpJP(K), MARS,FACC,FESC";}?></td>
		    <td colspan="2" width="20%"></td>
            <td colspan="2" width="40%" align="left"></td>
          </tr>
		  <tr>
            <td width="4%" align="right"></td>
		    <td width="40%">NIP <?php if(!empty($result["phl"])){echo $result["aprove_phl"]->nip;}else{ echo "196601011996031001";}?></td>
		    <td colspan="2" width="20%"></td>
            <td colspan="2" width="40%" align="left"></td>
          </tr>
        </table>
      </td>
    </tr>
	<tr>
      <td colspan="3">&nbsp;</td>
    </tr><tr>
      <td colspan="3">&nbsp;</td>
    </tr><tr>
      <td colspan="3">&nbsp;</td>
    </tr>
	<tr>
      <td colspan="3"><p>Lampiran: 1 Berkas</p></td>
    </tr>
	<tr>
      <td colspan="4">
        <table width="100%" border="0" cellpadding="0">
		  <tr>
           <td width="10%" valign="top">Hal :</td>
           <td width="90%" align="justify" valign="top">Mengikuti Pelatihan <?php echo $result["nama_pelatihan"] ?> diselenggarakan oleh <?php echo $result["institusi"] ?>, yang dilaksanakan pada hari/tanggal <?php if($result["tanggal"]["tanggal_from"]==$result["tanggal"]["tanggal_to"]){echo $result["tanggal"]["day_to"]." ".$result["tanggal"]["tanggal_to"]; }else{echo $result["tanggal"]["day_from"]." ".date('d',strtotime($result["tanggal"][0]["tanggal_from"])) ." s.d ". $result["tanggal"]["day_to"]." ".$result["tanggal"]["tanggal_to"]; }?>. Bertempat di <?php echo $result["tujuan"]." ".$result["alamat"]; ?>.</td>
          </tr>
        </table>
      </td>
    </tr>
</table>
</div>
</body></html>