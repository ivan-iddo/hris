<!doctype html>
<html><head></head><body>
<table border="0" class="table-1" style="margin:30px">
    <tr>
      <td colspan="3" align="center" style="font-size: 20px"><u><strong>S U R A T   -   I Z I N</strong></u></td>
    </tr>
    <tr>
      <td colspan="3" align="center" style="font-size: 15px">Nomor : KP.03.04/4.2.1/       /<?php echo date('Y'); ?></td>
    </tr>
    <tr>
      <td colspan="3" align="center">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="3"><p align="justify">      Sehubungan dengan disposisi dari Direktur Umum dan SDM pada tanggal <?php echo $result['created']['date']); ?>, dengan ini menugaskan kepada :</p></td>
    </tr>
    <tr>
      <td colspan="3">
        <?php if ($result["jenis"] == "Individu"): ?> 
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
        <?php elseif ($result["jenis"] == "Kelompok"): ?> 
        <table width="100%" border="1px solid" cellpadding="1" cellspacing="0" class="table2">
          <tr>
            <th>No</th>
            <!-- <th>NIP / Nopeg</th> -->
            <th>Nama</th>
            <th>Jabatan / Unit Kerja</th>
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
        </table>
        <?php endif ?> 
      </td>
    </tr>
    <tr>
      <td colspan="3">
      <table width="100%" border="0" style="margin-top : 15px">
        <tr>
          <td width="17%" valign="top" rowspan="3">
            <p>Untuk</p>
          </td>
          <td width="3%" valign="top" rowspan="3">
            <p>:</p>
          </td>
          <td width="3%" valign="top">
            <p>1.</p>
          </td>
          <td width="77%" valign="top">
            <p align="justify">Mengikuti <?php echo '<i>'.$result["nama_pelatihan"] .'</i> '. date('Y');?>, sebagai <?php echo $result["pengembangan_pelatihan_kegiatan_status"]->nama;?>, yang dilaksanakan pada tanggal <?php echo date('d',strtotime($result["tanggal"][0]["tanggal_from"])) ." s/d ". $result["tanggal"]["tanggal_to"]; ?>, diselenggarakan oleh <?php echo $result["institusi"]; ?>. Bertempat di <?php echo $result["tujuan"]; ?> .</p>
          </td>
        </tr>
        <tr>
          <td width="3%" valign="top">
            <p>2.</p>
          </td>
          <td width="77%" valign="top">
            <p align="justify">Melaporkan kepada UPG tentang penerimaan sponsorship dalam kegiatan tersebut paling lambat 5 hari setelah pelaksanaan.</p>
          </td>
        </tr>
        <tr>
          <td width="3%" valign="top">
            <p>3.</p>
          </td>
          <td width="77%" valign="top">
            <p align="justify">RSJPDHK tidak bertanggung jawab atas kelalaian melaksanakan kewajiban melaporkan ke pihak UPG sebagaimana butir No. 2.</p>
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
      <td></td>
      <td width="34%">&nbsp;</td>
      <td width="36%">Dikeluarkan di  : Jakarta</td>
    </tr>
     <tr>
      <td></td>
      <td width="34%">&nbsp;</td>
      <td width="36%">Pada tanggal    : <?php echo date('d F Y'); ?></td>
    </tr>
    <tr>
      <td colspan="3">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="2" width="40%">&nbsp;</td>
      <td width="60%">Direktur Utama,</td>
    </tr>
    <tr>
      <td colspan="3">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="3">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="2" width="40%">&nbsp;</td>
      <td width="60%">Dr. dr. Iwan Dakota,  SpJP(K), MARS,FACC,FESC</td>
    </tr>
    <tr>
      <td colspan="2" width="40%">&nbsp;</td>
      <td width="60%">NIP 196601011996031001</td>
    </tr>
    <tr>
      <td colspan="3">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="3">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="3">&nbsp;</td>
    </tr>
</table>
</body></html>