<?php
require_once('../../connectdb.php');

?>

 
<div class="row">
					    <div class="col-sm-12">
					        <div class="panel">
					             
					
					            <!--Block Styled Form -->
					            <!--===================================================-->
					            <form>
					                <div class="panel-body">
                                    <div class="row pad-top pad-all">
                                        <?php 
                                        // print_r($_SESSION['userdata'] );

                                         $query= pg_query("select count(total)as jml from his_cuti where tampilkan=1
                                         and tgl_cuti < '".date('Y-m-d')."' AND tgl_akhir_cuti >= '".date('Y-m-d')."'
                                           ");
                                          $rowcount=pg_num_rows($query);
                                          $row   = pg_fetch_row($query);
                                          $total_cuti =0;

                                          if(!empty($rowcount)){
                                            $total_cuti = $row[0];
                                          }

                                          $query2= pg_query("select count(*) from sys_user where status='1'");
                                           $rowcount2=pg_num_rows($query2);
                                           $row2   = pg_fetch_row($query2);


                                          $persen = round(($total_cuti/$row2[0])*100);
                                          //pg_close($con);
                                          
                                         ?>
					
					                    <div class="col-lg-4">
					                        <p class="text-semibold text-main">Total Pegawai Sedang Cuti</p>
					                        <ul class="list-unstyled">
					                            <li>
					                                <div class="media">
					                                    <div class="media-left">
					                                        <span class="text-2x text-semibold text-main">
                                                            <?php echo $total_cuti?></span>
					                                    </div>
					                                    <div class="media-body">
					                                        <p class="mar-no">Orang</p>
					                                    </div>
					                                </div>
					                            </li>
					                            <li>
					                                <div class="clearfix">
					                                    <p class="pull-left mar-no">Karyawan</p>
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
                                                    <th>Nama Pegawai</th>
					                                <th>Jenis Cuti</th>
                                                    <th>Keterangan</th>
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
					     
					</div>
<script>
$('.judul-menu').html('Pengajuan Cuti'); 

  
 listcuti();
 function listcuti(){
    $.ajax({
                                   url: BASE_URL+'pegawai/listcutiall/',
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
 

    function prosesCuti(idcuti,status){
        $.ajax({
                                   url: BASE_URL+'pegawai/beristratuscuti/?id='+idcuti+'&status='+status,
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