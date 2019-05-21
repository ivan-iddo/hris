<!doctype html>
<?php
  header("Content-type: application/vnd-ms-excel");
  header("Content-Disposition: attachment; filename=$file_title.xls"); 
  header('Content-Type: application/force-download');
?> 
<html><head></head><body>
<style>
     @page { margin: 100px 10px 10px 10px; }
     #header { position: fixed; left: -10px; top: -90px; right: -10px; bottom: -80px; height: 0px; text-align: center; }
     #foote { position: fixed; left: 0px; bottom: -30px; right: 0px; height: 40px; }
     #foote { content: counter(upper-roman); }
</style>
 <div hidden="<?php echo $result["footer"]; ?>" id="header">
    <table width="100%" class="table-1" border="0">
	<tbody>
	<tr>
	  <td colspan="1" width="60"><img src="<?php echo base_url(); ?>/logo2.png" width="100%"></td>
      <td colspan="2"align="left"><u><b>Rekapitulasi Laporan Keuangan Pelatihan dan Pengembangan Tahun 2019<br>Sub. Bag. SDM & Organisasi<br>RS. Jantung & Pembuluh Darah Harapan Kita</b></u></td>
	  <td colspan="1" width="100"><img src="<?php echo base_url(); ?>/logo.png" width="100%"></td>
	</tr>
	<tr>
	<hr/>
	</tr>
	</tbody>
	</table>
   </div>
<div id="content">
<table width="95%" border="1px" cellpadding="1" cellspacing="0" class="table2" style="margin:30px">
		  <tr>
            <td rowspan="3" align="center" width="1%">No</td>
            <td rowspan="3" align="center" width="6%">Bulan</td>
            <td colspan="6" align="center" width="30%">Kegiatan Dalam Negeri</td>
            <td rowspan="2" colspan="2" align="center" width="7%">Luar Negeri</td>
            <td rowspan="2" colspan="2" align="center" width="7%">Narasumber Tamu dari luar (Non Pegawai)</td>
            <td rowspan="2" colspan="3" align="center" width="7%">Pembuat surat</td>
            <td rowspan="2" colspan="2" align="center" width="35%">Total</td>
          </tr>
		  <tr>
            <td rowspan="1" colspan="2" width="7%" align="center">Managerial/Undangan atau sosialisasi/workshop dan seminar/prajabatan/diklat kepempimpinan</td>
            <td rowspan="1" colspan="2" width="7%" align="center">Rutin In House dan In House dll</td>
            <td rowspan="1" colspan="2" width="7%" align="center">Pendidikan Formal dan Pengembangan Pegawai</td>
          </tr>
		   <tr>
              <td scope="col" width="2%" align="center">Jumlah Pegawai</td>
              <td scope="col" width="16%" align="center">Jumlah Biaya</td>
			  <td scope="col" width="2%" align="center">Jumlah Pegawai</td>
              <td scope="col" width="16%" align="center">Jumlah Biaya</td> 
			  <td scope="col" width="2%" align="center">Jumlah Pegawai</td>
              <td scope="col" width="16%" align="center">Jumlah Biaya</td>
			  <td scope="col" width="2%" align="center">Jumlah Pegawai</td>
              <td scope="col" width="16%" align="center">Jumlah Biaya</td> 
			  <td scope="col" width="2%" align="center">Jumlah Pegawai</td>
              <td scope="col" width="16%" align="center">Jumlah Biaya</td>
			  <td scope="col" width="2%" align="center">ST</td> 
			  <td scope="col" width="2%" align="center">RAK</td>
              <td scope="col" width="2%" align="center">SPD</td>
			  <td scope="col" width="2%" align="center">Total Pegawai</td>
              <td scope="col" width="30%" align="center">Total Biaya</td>
           </tr>
	<?php if (!empty($result)): ?>
            <?php foreach ($result as $key => $value): ?>
              <tr>
                <td align="center" width="1%"><?php echo $key+1 ?></td>
                <td width="5%"><?php echo bulan($value["tanggal"]) ?></td>
				<td align="center" width="1%">
				<?php echo $result[$key]['diklat']['jum']+$result[$key]['managerial']['jum']+$result[$key]['workshop']['jum'];
					$jum_dik +=$result[$key]['diklat']['jum']+$result[$key]['managerial']['jum']+$result[$key]['workshop']['jum'];				?>
			</td>   
                <td width="10%">
				<table width="100%" border="0px" cellpadding="1" cellspacing="0" class="table2">
				  <tr>
					  <td>
						<table width="100%" border="0px" cellpadding="1" cellspacing="0" class="table2">
						<tr>
							  <td width="20%"></td>
							  <td width="10%">Rp.</td>
							  <td align="right" width="50%"><?php
							   $diklat =$result[$key]['diklat']['nominal']+$result[$key]['managerial']['nominal']+$result[$key]['workshop']['nominal'];
							  echo number_format($diklat, 0, ",", ".");
							  $biaya_dik += $diklat?></td>
							  <td width="20%"></td>
							</tr>
						</table>
					  </td>
				  </tr>
				</table>
				</td> 
				<td align="center" width="1%">
				<?php echo $result[$key]['inhouse']['jum'];
						$inhouse += $result[$key]['inhouse']['jum'];?>
				</td>    
				<td width="16%">
				<table width="100%" border="0px" cellpadding="1" cellspacing="0" class="table2">
				  <tr>
					  <td>
						<table width="100%" border="0px" cellpadding="1" cellspacing="0" class="table2">
						<tr>
							  <td width="20%"></td>
							  <td width="10%">Rp.</td>
							  <td align="right" width="50%"><?php echo number_format($result[$key]['inhouse']['nominal'], 0, ",", ".");
							  $biaya_inhouse += $result[$key]['inhouse']['nominal']?></td>
							  <td width="20%"></td>
							</tr>
						</table>
					  </td>
				  </tr>
				</table>
				</td>
				<td align="center" width="1%">
				<?php echo $result[$key]['pendidikan']['jum'];
						$pendidikan += $result[$key]['pendidikan']['jum'];?>
				</td>    
				<td width="16%">
				<table width="100%" border="0px" cellpadding="1" cellspacing="0" class="table2">
				  <tr>
					  <td>
						<table width="100%" border="0px" cellpadding="1" cellspacing="0" class="table2">
						<tr>
							  <td width="20%"></td>
							  <td width="10%">Rp.</td>
							  <td align="right" width="50%"><?php echo number_format($result[$key]['pendidikan']["nominal"], 0, ",", ".");
							  $biaya_pendidikan += $result[$key]['pendidikan']["nominal"];?></td>
							  <td width="20%"></td>
							</tr>
						</table>
					  </td>
				  </tr>
				</table>
				</td>
				<td align="center" width="1%">
					<?php echo $result[$key]['luar']['jum'];
						$luar +=$result[$key]['luar']['jum']?>
				</td>    
				<td width="16%">
				<table width="100%" border="0px" cellpadding="1" cellspacing="0" class="table2">
				  <tr>
					  <td>
						<table width="100%" border="0px" cellpadding="1" cellspacing="0" class="table2">
						<tr>
							  <td width="20%"></td>
							  <td width="10%">Rp.</td>
							  <td align="right" width="50%"><?php echo number_format($result[$key]['luar']["nominal"], 0, ",", ".");
							  $biaya_luar += $result[$key]['luar']["nominal"];?></td>
							  <td width="20%"></td>
							</tr>
						</table>
					  </td>
				  </tr>
				</table>
				</td>
				<td align="center" width="1%">
				<?php echo $result[$key]['tamu']['jum'];
						$tamu +=$result[$key]['tamu']['jum']?>
				</td>    
				<td width="16%">
				<table width="100%" border="0px" cellpadding="1" cellspacing="0" class="table2">
				  <tr>
					  <td>
						<table width="100%" border="0px" cellpadding="1" cellspacing="0" class="table2">
						<tr>
							  <td width="20%"></td>
							  <td width="10%">Rp.</td>
							  <td align="right" width="50%"><?php echo number_format($result[$key]['tamu']["nominal"], 0, ",", ".");
							  $biaya_tamu += $result[$key]['tamu']["nominal"];?></td>
							  <td width="20%"></td>
							</tr>
						</table>
					  </td>
				  </tr>
				</table>
			</td>
				<td align="center" width="1%">
				<?php echo $result[$key]['total']["jum"];
						$total +=$result[$key]['total']["jum"];?>
				</td>
				<td align="center" width="1%">
				<?php echo $result[$key]['jum_total']["jum"]+$result[$key]['dalam']["jum"];
						$dalam +=$result[$key]['jum_total']["jum"]+$result[$key]['dalam']["jum"]?>
				</td>
				<td align="center" width="1%">
				<?php echo $result[$key]['jum_total']["jum"]+$result[$key]['dalam']["jum"];
						$dalam1 +=$result[$key]['jum_total']["jum"]+$result[$key]['dalam']["jum"]?>
				
				</td>
				<td align="center" width="1%">
				<?php echo $result[$key]['total']["jum"];
						$total_1 +=$result[$key]['total']["jum"];?>
				</td>    
				<td width="30%">
				<table width="100%" border="0px" cellpadding="1" cellspacing="0" class="table2">
				  <tr>
					  <td>
						<table width="100%" border="0px" cellpadding="1" cellspacing="0" class="table2">
						<tr>
							  <td width="20%"></td>
							  <td width="10%">Rp.</td>
							  <td align="right" width="50%"><?php echo number_format($result[$key]['total']["nominal"], 0, ",", ".");
							  $biaya_total += $result[$key]['total']["nominal"];?></td>
							  <td width="20%"></td>
							</tr>
						</table>
					  </td>
				  </tr>
				</table>
				</td>
              </tr>
            <?php endforeach ?>
          <?php endif ?>
		  <tr>
                <td width="2%" align="center" colspan="2">Total</td>
				<td align="center" width="1%"><?php echo $jum_dik ?></td>   
                <td width="16%">
				<table width="100%" border="0px" cellpadding="1" cellspacing="0" class="table2">
				  <tr>
					  <td>
						<table width="100%" border="0px" cellpadding="1" cellspacing="0" class="table2">
							<tr>
							  <td width="20%"></td>
							  <td width="10%">Rp.</td>
							  <td align="right" width="50%"><?php echo number_format($biaya_dik, 0, ",", ".")?></td>
							  <td width="20%"></td>
							</tr>
						</table>
					  </td>
				  </tr>
				</table>
				</td> 
				<td align="center" width="1%"><?php echo $inhouse ?></td>    
				<td width="16%">
				<table width="100%" border="0px" cellpadding="1" cellspacing="0" class="table2">
				  <tr>
					  <td>
						<table width="100%" border="0px" cellpadding="1" cellspacing="0" class="table2">
							<tr>
							  <td width="20%"></td>
							  <td width="10%">Rp.</td>
							  <td align="right" width="50%"><?php echo number_format($biaya_inhouse, 0, ",", ".")?></td>
							  <td width="20%"></td>
							</tr>
						</table>
					  </td>
				  </tr>
				</table>
				</td>
				<td align="center" width="1%"><?php echo $pendidikan ?></td>    
				<td width="16%">
				<table width="100%" border="0px" cellpadding="1" cellspacing="0" class="table2">
				  <tr>
					  <td>
						<table width="100%" border="0px" cellpadding="1" cellspacing="0" class="table2">
							<tr>
							  <td width="20%"></td>
							  <td width="10%">Rp.</td>
							  <td align="right" width="50%"><?php echo number_format($biaya_pendidikan, 0, ",", ".")?></td>
							  <td width="20%"></td>
							</tr>
						</table>
					  </td>
				  </tr>
				</table>
				</td>
				<td align="center" width="1%"><?php echo $luar ?></td>    
				<td width="16%">
				<table width="100%" border="0px" cellpadding="1" cellspacing="0" class="table2">
				  <tr>
					  <td>
						<table width="100%" border="0px" cellpadding="1" cellspacing="0" class="table2">
							<tr>
							  <td width="20%"></td>
							  <td width="10%">Rp.</td>
							  <td align="right" width="50%"><?php echo number_format($biaya_luar, 0, ",", ".")?></td>
							  <td width="20%"></td>
							</tr>
						</table>
					  </td>
				  </tr>
				</table>
				</td>
				<td align="center" width="1%"><?php echo $tamu; ?></td>    
				<td width="16%">
				<table width="100%" border="0px" cellpadding="1" cellspacing="0" class="table2">
				  <tr>
					  <td>
						<table width="100%" border="0px" cellpadding="1" cellspacing="0" class="table2">
							<tr>
							  <td width="20%"></td>
							  <td width="10%">Rp.</td>
							  <td align="right" width="50%"><?php echo number_format($biaya_tamu, 0, ",", ".")?></td>
							  <td width="20%"></td>
							</tr>
						</table>
					  </td>
				  </tr>
				</table>
				</td>
				<td align="center" width="1%"><?php echo $total ?></td>
				<td align="center" width="1%"><?php echo $dalam ?></td>
				<td align="center" width="1%"><?php echo $dalam1 ?></td>
				<td align="center" width="1%"><?php echo $total_1 ?></td>    
				<td width="30%">
				<table width="100%" border="0px" cellpadding="1" cellspacing="0" class="table2">
				  <tr>
					  <td>
						<table width="100%" border="0px" cellpadding="1" cellspacing="0" class="table2">
							<tr>
							  <td width="20%"></td>
							  <td width="10%">Rp.</td>
							  <td align="right" width="50%"><?php echo number_format($biaya_total, 0, ",", ".")?></td>
							  <td width="20%"></td>
							</tr>
						</table>
					  </td>
				  </tr>
				</table>
				</td>
              </tr>  
</table>
<table width="95%" border="0px" cellpadding="1" cellspacing="0" class="table2" style="margin:30px">
	<tr>
      <td><u>Jakarta <br>Direkap Oleh :</u></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td><br>Mengetahui,</td>
	  <td>&nbsp;</td>
    </tr>  
	<tr>
      <td width="15%">1 Staf latbang</td>
      <td width="15%">2 Staf latbang</td>
      <td width="15%">3 Staf latbang</td>
	  <td width="50%">Kepala Urusan Pelatihan & Pengembangan SDM</td>
	  <td width="30%">&nbsp;</td>
	</tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
	  <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
	  <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>Putri Ayuningtyas, SE</td>
      <td>Safiera Amelia, SKM</td>
      <td>Endra Mursalim, S, Kom</td>
	  <td>Much. Nuh, SE</td>
	  <td>&nbsp;</td>
    </tr>
    <tr>
      <td>Nopeg 2189</td>
      <td>Nopeg 2601</td>
      <td>Nopeg 1896</td>
	  <td>NIP 197112132009121001</td>
	  <td>&nbsp;</td>
    </tr> 
</table>
</div>
</body></html>