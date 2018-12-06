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

                                         $query= mysqli_query($con,'select count(total)as jml from his_izin where tampilkan=1 and status=1 and id_user = '.$_SESSION['userdata']['id'].' order by tgl_izin DESC');
                                          $rowcount=mysqli_num_rows($query);
                                          $row   = mysqli_fetch_row($query);
                                          $total_izin =0;
                                          
                                          if(!empty($rowcount)){
                                            $total_izin = $row[0];
                                          }
                                          $persen = round(($total_izin/(8*28))*100);
										  
										   $query2= mysqli_query($con,"select count(*) from sys_user where status='1'");
                                           $rowcount2=mysqli_num_rows($query2);
                                           $row2   = mysqli_fetch_row($query2);


                                          $persen = round(($total_izin/$row2[0])*100);
                                          //mysqli_close($con);
                                          
                                         ?>
					
					                    <div class="col-lg-4">
					                        <p class="text-semibold text-main">Total Pegawai Sedang Izin</p>
					                        <ul class="list-unstyled">
					                            <li>
					                                <div class="media">
					                                    <div class="media-left">
					                                        <span class="text-2x text-semibold text-main">
                                                            <?php echo $total_izin?></span>
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
					                                <th>Jenis Izin</th>
                                                    <th>Keterangan</th>
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
					     
					</div>
<script>
$('.judul-menu').html('Pengajuan Izin'); 

  
 listizin();
 function listizin(){
    $.ajax({
                                   url: BASE_URL+'pegawai/listizinall/',
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
 

    function prosesizin(idizin,status){
        $.ajax({
                                   url: BASE_URL+'pegawai/beristratusizin/?id='+idizin+'&status='+status,
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