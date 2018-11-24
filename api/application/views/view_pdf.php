<?php 
// echo "<pre>";
// print_r($result);
// echo "<pre>";
// die;
 ?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
<style type="text/css">
  table{
    width: 100%;
  }
</style>
</head>

<body>
<table border="0" class="table-1" style="margin:30px">
  <tbody>
    <tr>
      <td colspan="3" align="center"><u><strong>S U R A T   -   T U  G A S</strong></u></td>
    </tr>
    <tr>
      <td colspan="3" align="center">Nomor : KP.03.04/XX.4/          /2018</td>
    </tr>
    <tr>
      <td colspan="3"><p>      Sehubungan dengan disposisi Direktur Umum  dan SDM tanggal 30 Mei 2018, dengan ini kami  menugaskan kepada :</p></td>
    </tr>
    <tr>
      <td colspan="3"><table width="100%" border="1px solid" align="left" cellpadding="1" cellspacing="1" class="table2">
        <tbody>
          <tr>
            <td>No</td>
            <td>NIP / Nopeg</td>
            <td>Nama</td>
            <td>Jabatan / Unit Kerja</td>
          </tr>
          <?php if (!empty($result["detail"])): ?>
            <?php foreach ($result["detail"] as $key => $value): ?>
              <tr>
                <td><?php echo $key+1 ?></td>
                <td><?php echo $value["nip"] ." / ". $value["nopeg"] ?></td>
                <td><?php echo $value["nama_pegawai"] ?></td>
                <td><?php echo $value["jabatan"] ?></td>
              </tr>
            <?php endforeach ?>
          <?php endif ?>
        </tbody>
      </table></td>
    </tr>
    <tr>
      <td colspan="3">
      <table width="100%" border="0" style="margin-top : 130px">
        <tr style="margin-top:100px">
          <td colspan="3">Keperluan :
            <?php if (!empty($result["pengembangan_pelatihan_kegiatan"])): ?>
            <?php echo $result["pengembangan_pelatihan_kegiatan"]->nama ?>
            <?php endif ?>
          </td>
        </tr>
<!--         <tbody>
        </tbody> -->
      </table>
      </td>
    </tr>
    <tr>
      <td colspan="3">
      <table width="100%" border="0">
        <tr>
          <td colspan="3">Pada Tanggal :</td>
        </tr>
        <tbody>
          <?php if (!empty($result["tanggal"])): ?>
            <?php foreach ($result["tanggal"] as $key => $value): ?>
              <tr>
                <td valign="top" style="width:22px !important"><?php echo $key+1 ?>.</td>
                <td><?php echo $value["tanggal_from"] ." s/d ". $value["tanggal_to"] ?></td>
              </tr>
            <?php endforeach ?>
          <?php endif ?>
        </tbody>
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
  </tbody>
</table>
</body>
</html>
