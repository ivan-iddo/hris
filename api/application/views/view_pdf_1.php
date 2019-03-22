<!doctype html>
<html><head></head><body>
<style type="text/css">
  table{
    width: 100%;
  }
</style>
<table border="0" class="table-1" style="margin:30px">
    <tr>
      <td colspan="3" align="center" style="font-size: 20px"><u><strong>S U R A T   -   I Z I N</strong></u></td>
    </tr>
    <tr>
      <td colspan="3" align="center" style="font-size: 15px">Nomor : KP.03.04/4.2.1/       /2018</td>
    </tr>
    <tr>
      <td colspan="3"><p>      Sehubungan dengan disposisi dari Direktur Umum dan SDM pada tanggal <?php echo date('d F Y',strtotime($result['created'])); ?>, dengan ini menugaskan kepada :</p></td>
    </tr>
    <tr>
      <td colspan="3"><table width="100%" border="1px solid" align="left" cellpadding="1" cellspacing="0" class="table2">
          <tr>
            <td>No</td>
            <!-- <td>NIP / Nopeg</td> -->
            <td>Nama</td>
            <td>Jabatan / Unit Kerja</td>
          </tr>
          <?php if (!empty($result["detail"])): ?>
            <?php foreach ($result["detail"] as $key => $value): ?>
              <tr>
                <td><?php echo $key+1 ?></td>
                <!-- <td><?php echo $value["nip"] ." / ". $value["nopeg"] ?></td> -->
                <td><?php echo $value["nama_pegawai"] ?></td>
                <td><?php echo $value["jabatan"] ?></td>
              </tr>
            <?php endforeach ?>
          <?php endif ?>
      </table></td>
    </tr>
    <tr>
      <td colspan="3">
      <table width="100%" border="0" style="margin-top : 50px">
        <tr>
          <td width="17%" valign="top">
            <p>Untuk</p>
          </td>
          <td width="3%" valign="top">
            <p>:</p>
          </td>
          <td width="3%" valign="top">
            <p>1.</p>
          </td>
          <td width="77%" valign="top">
            <p>Mengikuti <?php echo '<i>'.$result["nama_pelatihan"] .'</i> '. date('Y');?>, sebagai <?php echo $result["pengembangan_pelatihan_kegiatan_status"]->nama;?>, yang dilaksanakan pada tanggal <?php echo date('d',strtotime($result["tanggal"][0]["tanggal_from"])) ." s/d ". date('d F Y',strtotime($result["tanggal"][0]["tanggal_to"])) ?>, diselenggarakan oleh <?php echo $result["institusi"]; ?>. Bertempat di <?php echo $result["tujuan"]; ?> .</p>
          </td>
        </tr>
      </table>
      </td>
    </tr>
    <tr>
      <td colspan="3">
      <table width="100%" border="0">
        <tr>
          <td colspan="3">Pada Tanggal :</td>
        </tr>
          <?php if (!empty($result["tanggal"])): ?>
            <?php foreach ($result["tanggal"] as $key => $value): ?>
              <tr>
                <td valign="top" style="width:22px !important"><?php echo $key+1 ?>.</td>
                <td><?php echo $value["tanggal_from"] ." s/d ". $value["tanggal_to"] ?></td>
              </tr>
            <?php endforeach ?>
          <?php endif ?>
      </table>
      </td>
    </tr>
    <tr>
      <td width="30%">&nbsp;</td>
      <td colspan="2">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="3">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="3"><p>Agar yang bersangkutan  melaksanakan tugas dengan baik dan penuh tanggung jawab.</p></td>
    </tr>
    <tr>
      <td>Mengetahui</td>
      <td width="34%">&nbsp;</td>
      <td width="36%">Direktur Utama,</td>
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
      <td>(……………………)</td>
      <td>&nbsp;</td>
      <td>Dr. dr. Iwan Dakota,  SpJP(K), MARS,FACC,FESC</td>
    </tr>
    <tr>
      <td><em>dimulai jam :</em></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td><em>Selesai  jam :</em></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>  </td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
</table>
</body></html>