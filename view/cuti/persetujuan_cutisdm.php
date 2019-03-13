<?php
require_once('../../connectdb.php');

?>
<div class="row">
	
    <div class="tab-base mar-all">
      <!--Nav Tabs-->
  
      <ul class="nav nav-tabs">
        <li class="active">
                  <a href="#demo-lft-tab-1" data-toggle="tab">
                          <span class="block text-center">
                              <i class="fa fa-check-square-o fa-2x text-danger"></i> 
                          </span>
                          Persetujuan Cuti SDM
                      </a>
              </li>
      </ul>
  
      <div class="tab-content">
        <div class="tab-pane fade active in" id="demo-lft-tab-1">
         
            <div class="row"> 
                    <div class="col-md-6"> 
                            <div class="box box-primary"> 
                                <div class="box-body">
                               
                                <div class="row pad-top">
									<div class="form-group">
                                        <label class="col-sm-2 control-label" for="inputstatus">Bulan</label>
                                            <div class="col-sm-3">
                                                    <select class="form-control select2" id="bulan" name="bulan" style="width: 100%;">
                                                    <option value="">Bulan</option>
                                                      <?php for($i=1;$i<=12;$i++){?>
                                                        <option value="<?php echo $i?>"><?php echo $i?></option>
                                                        <?php }?>
                                                    </select> 
                                            </div>
                                           
                                    </div> 								
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label" for="inputstatus">Tahun</label>
                                            <div class="col-sm-3">
                                                    <select class="form-control select2" id="thn" name="thn" style="width: 100%;">
                                                    <option value="">--TAHUN--</option>
                                                      <?php for($i=date('Y');$i>=2010;$i--){?>
                                                        <option value="<?php echo $i?>"><?php echo $i?></option>
                                                        <?php }?>
                                                    </select> 
                                            </div>
                                           
                                    </div> 
                                    </div>
                                    <?php if(($_SESSION['userdata']['group']=='1') OR ($_SESSION['userdata']['group']=='6') ){?>
                                    <div class="admininput">
                                    <div class="row pad-top"> 
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label" for="inputstatus">Unit Kerja</label>
                                            <div class="col-sm-9">
                                                    <select class="form-control select-chosen" id="txtdirektorat" name="txtdirektorat" style="width: 100%;">
                                                     
                                                      
                                                    </select> 
                                            </div>
                                           
                                    </div>
                                    </div>
                                     
                                    
                                                     </div>
                                    
                                    <?php }?>
                                    <div class="row "> 
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label" for="inputstatus"></label>
                                            <div class="col-sm-5">
                                             
                                            <div class="row  text-left"> 
                                    <button class="btn btn-primary mar-all" href="javascript:void(0);" onClick="search();">Search</button> 
                                   </div>
                                            </div>
                                    </div>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                        
            </div> 
            
             
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

                                         $query= pg_query("select count(total)as jml from his_cuti where tampilkan=1 and status=1
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
        </div>
      </div>
    </div>
      
      
  </div>
  <script>
$('.judul-menu').html('Persetujuan Cuti SDM'); 
		search();
		function search(){
			 var thn=$('#thn').val();
			 var bulan=$('#bulan').val();
			 var uk=$('#txtdirektorat').val();
			    $.ajax({
               url: BASE_URL+'cuti/listcutisdm?bulan='+bulan+'&tahun='+thn+'&id_uk='+uk,
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
      var id_user = '<?php echo $_SESSION['userdata']['id'];?>';
      swal({
            title: 'Apakah Anda Yakin Mengubah Data Ini?',
            text: 'Data segera di proses!',
            type: "warning",
            confirmButtonColor: '#d9534f',
            confirmButtonText: "Ya, Segera proses!",
            showCancelButton: true,
            },function(){
                $.ajax({
                 url: BASE_URL+'cuti/beristratuscuti/?id='+idcuti+'&status='+status+'&id_user='+id_user,
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
        });
        return false;
    }

  $('.select-chosen').chosen();
     $('.chosen-container').css({"width": "100%"});
 getOptions("txtdirektorat",BASE_URL+"master/direktoratSub");
</script>