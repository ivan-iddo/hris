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

                                         $query= mysqli_query($con,'select sum(total)as jml from his_cuti where tampilkan=1 and id_user = '.$_SESSION['userdata']['id'].' order by tgl_cuti DESC');
                                          $rowcount=mysqli_num_rows($query);
                                          $row   = mysqli_fetch_row($query);
                                          $total_cuti =0;
                                          
                                          if(!empty($rowcount)){
                                            $total_cuti = $row[0];
                                          }
                                          $persen = round(($total_cuti/22)*100);
                                          //mysqli_close($con);
                                          
                                         ?>
					
					                    <div class="col-lg-4">
					                        <p class="text-semibold text-main">Total Cuti Anda</p>
					                        <ul class="list-unstyled">
					                            <li>
					                                <div class="media">
					                                    <div class="media-left">
					                                        <span class="text-2x text-semibold text-main">
                                                            <?php echo $total_cuti?></span>
					                                    </div>
					                                    <div class="media-body">
					                                        <p class="mar-no">Hari</p>
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
					                                <th>Jenis Cuti</th>
					                                <th>Mulai</th>
					                                <th>Sampai</th>
                                                    <th>Hari</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
					                            </tr>
					                        </thead>
					                        <tbody id="isicuti">
                                            
					                        </tbody>
					                    </table>
					                </div>
					
					        </div>
					    </div>
					    <div class="col-sm-6">
					        <div class="panel">
					            <div class="panel-heading">
					                <h3 class="panel-title">Form Permohonan Cuti</h3>
					            </div>
					
					            <!--Horizontal Form-->
					            <!--===================================================-->
					            <form id="form-cuti" name="form-cuti" method="post" class="form-horizontal pad-all">
					                <div class="panel-body">
					                    <div class="form-group">
					                        <label class="col-sm-3 control-label">Jenis Cuti</label>
					                        <div class="col-sm-9">
                                            <input style="display:none" type="text" id="id_user" name="id_user" value="<?php echo $_SESSION['userdata']['id']?>">
                                            <select class="select-chosen" name="jenis_cuti" id="jenis_cuti" style="width: 100%;" tabindex="-1" onChange="cekCuti(this.value)">
									 
								            </select>
					                        </div>
					                    </div>
                                        <div class="form-group">
					                        <label class="col-sm-3 control-label">Jumlah Cuti</label>
					                        <div class="col-sm-9">
                                             <select class="select-chosen" name="jumlahCuti" id="jumlahCuti" style="width: 100%;" onChange="hitungTanggal(this.value)">
									 
								            </select>
					                        </div>
					                    </div>
                                        <div class="form-group">
					                        <label class="col-sm-3 control-label">Tanggal Mulai Cuti</label>
					                        <div class="col-sm-9">
                                             <input class="form-control" type="date" id="tgl_cuti" name="tgl_cuti" onChange="hitungTanggalB(this.value)" >
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
					                    <button class="btn btn-primary" type="submit" onCLick="ajukan();return false;">Ajukan Cuti</button>
					                </div>
					            </form>
					            <!--===================================================-->
					            <!--End Horizontal Form-->
					
					        </div>
					    </div>
					</div>
<script>
$('.judul-menu').html('Pengajuan Cuti');
$('.select-chosen').chosen();
 $('.chosen-container').css({"width": "100%"});
 getOptions("jenis_cuti",BASE_URL+"master/jenis_cuti");

 function cekCuti(nilai){
    $.ajax({
                                   url: BASE_URL+'pegawai/cekcuti/?id='+nilai+'&id_user='+$('#id_user').val(),
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
                                       $('#jumlahCuti').empty();
                                       for( var i = 0; i < res.jumlah; i++ ){
                                        
                                        $('#jumlahCuti').append('<option value="'+(i+1)+'" >'+(i+1)+'</option>');
                                    }
                                    $('#jumlahCuti').trigger("chosen:updated");

                                   }
    });
 }
 listcuti();
 function listcuti(){
    $.ajax({
                                   url: BASE_URL+'pegawai/listcuti/?id_user='+$('#id_user').val(),
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
                                       $('#isicuti').html(res.isi);
                                        
                                       
                                   

                                   }
    });
 }

function hitungTanggal(jml){
    var tt = document.getElementById('tgl_cuti').value;

    if(!empty(tt)){
        var h = incrementDate(tt,jml);
        var dd = h.getDate();
        var mm = h.getMonth() + 1;
        var y = h.getFullYear();
        $('#sampai').html(mm+'-'+dd+'-'+y); 
    }
     
 }

 function hitungTanggalB(tgl){
    var tt = document.getElementById('jumlahCuti').value;

    if(!empty(tt)){
        var h = incrementDate(tgl,tt);
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
        var jml = $('#jumlahCuti').val();
        var tgl = $('#tgl_cuti').val();
        var jenis = $('#jenis_cuti').val();
        var keterangan = $('#keterangan').val();

  if(empty(jenis)){
      alert('jenis cuti wajib diisi');
      return false;
  }else if(empty(tgl)){
    alert('Tanggal cuti wajib diisi');
      return false;
  }else if(empty(jml)){
    alert('Jumlah cuti wajib diisi');
      return false;
  }else{
    var data = formJson('form-cuti');
    var form = $("#form-cuti");
    $.ajax({
       url: BASE_URL + 'pegawai/savecuti',
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
             $('#jumlahCuti').val('');
            $('#tgl_cuti').val('');
            $('#jenis_cuti').val('');
            listcuti();
           }
           
       } 
   });	
  }
   
    }


    function prosesCuti(idcuti){
        $.ajax({
                                   url: BASE_URL+'pegawai/beristratuscuti/?id='+idcuti+'&status=0',
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
                                    listcuti();
                                        
                                       
                                   

                                   }
    });
    }
</script>