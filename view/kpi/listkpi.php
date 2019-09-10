
<div class="panel-body">
					                <div class="table-responsive">
										 <h4><b><center>Akhir</center></b></h4>
					                    <table class="table table-striped">
					                        <thead>
					                            <tr>
					                                <th>Parameter</th>
                                                    <th>Bobot %</th>
					                                <th>Target Kinerja</th>
					                                <th>Capaian</th>
					                                <th>Capaian %</th>
					                                <th>Nilai</th>
					                                <th>Bobot x Nilai</th>
					                                <th>Keterangan</th>
					                            </tr>
					                        </thead>
					                        <tbody id="tabel">
					                             
					                        </tbody>
					                    </table>
										<?php if($_GET["awal"]!=$_GET["akhir"]){?>
										<h4><b><center>Awal</center></b></h4>
					                    <table class="table table-striped">
					                        <thead>
					                            <tr>
					                                <th>Parameter</th>
                                                    <th>Bobot %</th>
					                                <th>Target Kinerja</th>
					                                <th>Capaian</th>
					                                <th>Capaian %</th>
					                                <th>Nilai</th>
					                                <th>Bobot x Nilai</th>
					                                <th>Keterangan</th>
					                            </tr>
					                        </thead>
					                        <tbody id="tabellama">
					                             
					                        </tbody>
					                    </table>
										<?php }?>
					                </div>
					            </div>

<script>
getJson(reskpi,BASE_URL+'kpi/mpenilaian/getlistkpi?id=<?php echo $_GET["id"]?>&pid=<?php echo $_GET["pid"]?>');
getJson(reskpilama,BASE_URL+'kpi/mpenilaian/getlistkpilama?id=<?php echo $_GET["id"]?>&pid=<?php echo $_GET["pid"]?>');

function reskpi(result){
    var parameter = '';
    var bobot = '';
    var target = '';
    var capaian='';
    var capaianp='';
    var nilai='';
    var nilaib='';
    var ket='';


    var table ='';
    $.each( result.result, function( key, value ) {
    parameter = value.grup;
    bobot = value.bobot;
    target = value.target_kinerja;
    capaian = value.capaian;
    capaianp = value.capaian_persen;
    nilai = value.nilai;
    nilaib = value.nilai_bobot;
    ket = value.keterangan;

    table +='<tr>';
    table +='<td>';
    table += parameter;
    table +='</td>';
    table +='<td>';
    table += bobot;
    table +='</td>';
    table +='<td>';
    table += target;
    table +='</td>';
    table +='<td>';
    table += capaian;
    table +='</td>';  
	table +='<td>';
    table += capaianp;
    table +='</td>';
	table +='<td>';
    table += nilai;
    table +='</td>';
    table +='<td>';
    table += nilaib;
    table +='</td>';
	table +='<td>';
    table += ket;
    table +='</td>';
    table +='</tr>';
    

});

$('#tabel').html(table);



}
function reskpilama(result){
    var parameter = '';
    var bobot = '';
    var target = '';
    var capaian='';
    var capaianp='';
    var nilai='';
    var nilaib='';
    var ket='';


    var table ='';
    $.each( result.result, function( key, value ) {
    parameter = value.grup;
    bobot = value.bobot;
    target = value.target_kinerja;
    capaian = value.capaian;
    capaianp = value.capaian_persen;
    nilai = value.nilai;
    nilaib = value.nilai_bobot;
    ket = value.keterangan;

    table +='<tr>';
    table +='<td>';
    table += parameter;
    table +='</td>';
    table +='<td>';
    table += bobot;
    table +='</td>';
    table +='<td>';
    table += target;
    table +='</td>';
    table +='<td>';
    table += capaian;
    table +='</td>';  
	table +='<td>';
    table += capaianp;
    table +='</td>';
	table +='<td>';
    table += nilai;
    table +='</td>';
    table +='<td>';
    table += nilaib;
    table +='</td>';
	table +='<td>';
    table += ket;
    table +='</td>';
    table +='</tr>';
    

});

$('#tabellama').html(table);



}
</script>