
<div class="panel-body">
					                <div class="table-responsive">
					                    <table class="table table-striped">
					                        <thead>
					                            <tr>
					                                <th>Nama</th>
                                                    <th>Pendidikan</th>
					                                <th>Unit Kerja</th>
					                                <th>Profesi</th>
					                            </tr>
					                        </thead>
					                        <tbody id="tabel">
					                             
					                        </tbody>
					                    </table>
					                </div>
					            </div>

<script>	
getJson(respegawai,BASE_URL+'abk/abk/getpegawai?bagian=<?php echo $_GET["bagian"]?>&jejang=<?php echo $_GET["jenjang"]?>');

function respegawai(result){
    var name = '';
    var bagian = '';
    var profesi = '';
    var pendidikan='';


    var table ='';
    $.each( result.result, function( key, value ) {
    name = value.name;
    bagian = value.grup;
    profesi = value.profesi;
    pendidikan = value.jenjang;

    table +='<tr>';
    table +='<td>';
    table += name;
    table +='</td>';
    table +='<td>';
    table += pendidikan;
    table +='</td>';
    table +='<td>';
    table += bagian;
    table +='</td>';
    table +='<td>';
    table += profesi;
    table +='</td>';
    table +='</tr>';
    

});

$('#tabel').html(table);



}
</script>