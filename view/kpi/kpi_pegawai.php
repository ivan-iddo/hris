<div class="panel-body">
   <div class="table-responsive">
       <table class="table table-striped">
           <tbody id="tabel">
              
           </tbody>
       </table>
   </div>
</div>
<script>
    getJson(reskpi,BASE_URL+'kpi/mpenilaian/listiki?nopeg=<?php echo $_GET["nopeg"]?>&bulan=<?php echo $_GET["bulan"]?>&status=5');

    function reskpi(result){
        var Nama = '';
        var Unit = '';
        var Iki = '';
        var Iku ='';


        var table ='';
        $.each( result.result, function( key, value ) {
            Nama = value.nama;
            Unit = value.unit;
            Iki = value.nilai;
            Iku = value.iku;
            
            table +='<tr>';
            table +='<td>';
            table += 'Nilai IKI <b>'+Nama+' : '+Iki;
            table +='</td>';
            table +='<td>';
            table += 'Nilai IKU <b> : '+Iku;
            table +='</td>';
            table +='</tr>';
            

        });

        $('#tabel').html(table);



    }
</script>