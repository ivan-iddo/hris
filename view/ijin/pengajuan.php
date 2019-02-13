<?php
require_once('../../connectdb.php');

?>

 
<div class="row">
					    <div class="col-sm-6">
					        <div class="panel">
					             
					
					            <!--Block Styled Form -->
					            <!--===================================================-->
					            <form>
					                <div class="panel-body">
                                    <div class="row pad-top pad-all">
                                         <?php 
                                        // print_r($_SESSION['userdata'] );

                                         $query= pg_query('select sum(total)as jml from his_izin where tampilkan=1 and id_user = '.$_SESSION['userdata']['id'].'');
                                          $rowcount=pg_num_rows($query);
                                          $row   = pg_fetch_row($query);
                                          $total_izin =0;
                                          
                                          if(!empty($rowcount)){
                                            $total_izin = $row[0];
                                          }
                                          $persen = round(($total_izin/(8*28))*100);
                                          //pg_close($con);
                                          
                                         ?>
					
					                    <div class="col-lg-4">
					                        <p class="text-semibold text-main">Total Izin Anda</p>
					                        <ul class="list-unstyled">
					                            <li>
					                                <div class="media">
					                                    <div class="media-left">
					                                        <span class="text-2x text-semibold text-main">
                                                            <?php echo $total_izin?></span>
					                                    </div>
					                                    <div class="media-body">
					                                        <p class="mar-no">Jam</p>
					                                    </div>
					                                </div>
					                            </li>
					                            <li>
					                                <div class="clearfix">
					                                    <p class="pull-left mar-no">Outcome</p>
					                                    <p class="pull-right mar-no"><?php echo $persen?>%</p>
					                                </div>
					                                <div class="progress progress-xs">
					                                    <div class="progress-bar progress-bar-info" style="width: <?php echo $persen?>%;">
					                                        <span class="sr-only"><?php echo $persen?>%</span>
					                                    </div>
					                                </div>
					                            </li>
					                        </ul>
					                    </div>
					                </div>
					                </div>
					                
					            </form>
					            <!--===================================================-->
					            <!--End Block Styled Form -->
                                <div class="table-responsive">
					                    <table class="table table-striped">
					                        <thead>
					                            <tr>
					                                <th>Jenis Izin</th>
					                                <th>Mulai</th>
					                                <th>Sampai</th>
                                                    <th>Jam</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
					                            </tr>
					                        </thead>
					                        <tbody id="isiizin">
                                            
					                        </tbody>
					                    </table>
					                </div>
					
					        </div>
					    </div>
					    <div class="col-sm-6">
					        <div class="panel">
					            <div class="panel-heading">
					                <h3 class="panel-title">Form Permohonan Izin</h3>
					            </div>
					
					            <!--Horizontal Form-->
					            <!--===================================================-->
					            <form id="form-izin" name="form-izin" method="post" class="form-horizontal pad-all">
					                <div class="panel-body">
					                    <div class="form-group">
					                        <label class="col-sm-3 control-label">Jenis Izin</label>
					                        <div class="col-sm-9">
                                            <input style="display:none" type="text" id="id_user" name="id_user" value="<?php echo $_SESSION['userdata']['id']?>">
                                            <select class="select-chosen" name="jenis_izin" id="jenis_izin" style="width: 100%;" tabindex="-1" onChange="cekizin(this.value)">
									 
								            </select>
					                        </div>
					                    </div>
                                        <div class="form-group">
					                        <label class="col-sm-3 control-label">Jumlah Izin</label>
					                        <div class="col-sm-9">
                                             <select class="select-chosen" name="jumlahizin" id="jumlahizin" style="width: 100%;" onChange="hitungTanggal(this.value)">
									 
								            </select>
					                        </div>
					                    </div>
                                        <div class="form-group">
					                        <label class="col-sm-3 control-label">Tanggal Mulai Izin</label>
					                        <div class="col-sm-9">
                                             <input class="form-control" type="date" id="tgl_izin" name="tgl_izin" onChange="hitungTanggalB(this.value)" >
					                        </div>
					                    </div>
                                       
                                        <div class="form-group">
					                        <label class="col-sm-3 control-label">Tanggal Berakhir</label>
					                        <div class="col-sm-9">
                                            <div id="sampai" style="padding-top:7px"></div>
					                        </div>
					                    </div>

                                        <div class="form-group">
					                        <label class="col-sm-3 control-label">Keterangan </label>
					                        <div class="col-sm-9">
                                             <textarea class="form-control" type="text" id="keterangan" name="keterangan"  > </textarea>
					                        </div>
					                    </div>
                                       
					                     
					                </div>
                                    <div class="form-group pad-all">
                                    <div id="pesan"></div>
                                    </div>
					                <div class="panel-footer text-left">
					                    <button class="btn btn-primary" type="submit" onCLick="ajukan();return false;">Ajukan Izin</button>
					                </div>
					            </form>
					            <!--===================================================-->
					            <!--End Horizontal Form-->
					
					        </div>
					    </div>
					</div>
<script>
$('.judul-menu').html('Pengajuan Izin');
$('.select-chosen').chosen();
 $('.chosen-container').css({"width": "100%"});
 getOptions("jenis_izin",BASE_URL+"master/jenis_izin");

 function cekizin(nilai){
    $.ajax({
                                   url: BASE_URL+'pegawai/cekizin/?id='+nilai+'&id_user='+$('#id_user').val(),
                                   headers: {
                                       'Authorization': localStorage.getItem("Token"),
                                       'X_CSRF_TOKEN':'donimaulana',
                                       'Content-Type':'application/json'
                                   },
                                   dataType: 'json',
                                   type: 'get',
                                   contentType: 'application/json', 
                                   processData: false,
                                   success: function( res, textStatus, jQxhr ){
                                       $('#pesan').html(res.message);
                                       $('#jumlahizin').empty();
                                       for( var i = 0; i < res.jumlah; i++ ){
                                        
                                        $('#jumlahizin').append('<option value="'+(i+1)+'" >'+(i+1)+'</option>');
                                    }
                                    $('#jumlahizin').trigger("chosen:updated");

                                   }
    });
 }
 listizin();
 function listizin(){
    $.ajax({
                                   url: BASE_URL+'pegawai/listizin/?id_user='+$('#id_user').val(),
                                   headers: {
                                       'Authorization': localStorage.getItem("Token"),
                                       'X_CSRF_TOKEN':'donimaulana',
                                       'Content-Type':'application/json'
                                   },
                                   dataType: 'json',
                                   type: 'get',
                                   contentType: 'application/json', 
                                   processData: false,
                                   success: function( res, textStatus, jQxhr ){
                                       $('#isiizin').html(res.isi);
                                        
                                       
                                   

                                   }
    });
 }

function hitungTanggal(jml){
    var tt = document.getElementById('tgl_izin').value;

    if(!empty(tt)){
        var h = incrementDate(tt,0);
        var dd = h.getDate();
        var mm = h.getMonth() + 1;
        var y = h.getFullYear();
        $('#sampai').html(mm+'-'+dd+'-'+y); 
    }
     
 }

 function hitungTanggalB(tgl){
    var tt = document.getElementById('jumlahizin').value;

    if(!empty(tt)){
        var h = incrementDate(tgl,0);
        var dd = h.getDate();
        var mm = h.getMonth() + 1;
        var y = h.getFullYear();
        $('#sampai').html(mm+'-'+dd+'-'+y); 
    }
     
 }

 function incrementDate(dateInput,increment) {
        var dateFormatTotime = new Date(dateInput);
        var increasedDate = new Date(dateFormatTotime.getTime() +(increment *86400000));
        return increasedDate;
    }

    function ajukan(){
        var data = formJson('form-golongan'); //$("#form-upload").serializeArray();
        var jml = $('#jumlahizin').val();
        var tgl = $('#tgl_izin').val();
        var jenis = $('#jenis_izin').val();
        var keterangan = $('#keterangan').val();

  if(empty(jenis)){
      alert('jenis izin wajib diisi');
      return false;
  }else if(empty(tgl)){
    alert('Tanggal izin wajib diisi');
      return false;
  }else if(empty(jml)){
    alert('Jumlah izin wajib diisi');
      return false;
  }else{
    var data = formJson('form-izin');
    var form = $("#form-izin");
    $.ajax({
       url: BASE_URL + 'pegawai/saveizin',
       headers: {
           'Authorization': localStorage.getItem("Token"),
           'X_CSRF_TOKEN': 'donimaulana',
           'Content-Type': 'application/json'
       },
       dataType: 'json',
       type: 'post',
       contentType: 'application/json',
       processData: false,
       data: data,
       success: function(data, textStatus, jQxhr) {
           if(data.hasil ==='success'){
             $('#jumlahizin').val('');
            $('#tgl_izin').val('');
            $('#jenis_izin').val('');
            listizin();
           }
           
       } 
   });	
  }
   
    }


    function prosesizin(idizin){
        $.ajax({
                                   url: BASE_URL+'pegawai/beristratusizin/?id='+idizin+'&status=0',
                                   headers: {
                                       'Authorization': localStorage.getItem("Token"),
                                       'X_CSRF_TOKEN':'donimaulana',
                                       'Content-Type':'application/json'
                                   },
                                   dataType: 'json',
                                   type: 'get',
                                   contentType: 'application/json', 
                                   processData: false,
                                   success: function( res, textStatus, jQxhr ){
                                    listizin();
                                        
                                       
                                   

                                   }
    });
    }
</script>