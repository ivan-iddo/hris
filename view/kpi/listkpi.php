
<div class="panel-body">
					                <div class="table-responsive">
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
					                            </tr>
					                        </thead>
					                        <tbody id="tabel">
					                             
					                        </tbody>
					                    </table>
					                </div>
					            </div>

<script>
getJson(reskpi,BASE_URL+'kpi/mpenilaian/getlistkpi?id=<?php echo $_GET["id"]?>&pid=<?php echo $_GET["pid"]?>');

function reskpi(result){
    var parameter = '';
    var bobot = '';
    var target = '';
    var capaian='';
    var capaianp='';
    var nilai='';
    var nilaib='';


    var table ='';
    $.each( result.result, function( key, value ) {
    parameter = value.keterangan;
    bobot = value.bobot;
    target = value.target_kinerja;
    capaian = value.capaian;
    capaianp = value.capaian_persen;
    nilai = value.nilai;
    nilaib = value.nilai_bobot;

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
    table +='</tr>';
    

});

$('#tabel').html(table);



}
</script>