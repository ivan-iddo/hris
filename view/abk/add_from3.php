<form id="form3-addnew" method="post" enctype="multipart/form-data">
<div class="row mar-all"> 
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label" for="inputstatus">Tahun</label>
                                            <div class="col-sm-5">
                                                    <select class="form-control select2" id="thnadd" name="thnadd" style="width: 100%;">
                                                    <?php for($i=2010;$i<= date('Y');$i++){
                                                             $sele='';
                                                             if($i== date('Y')){
                                                                     $sele='selected';
                                                             }
                                                             ?>
                                                        <option value="<?php echo $i?>" <?php echo $sele?>><?php echo $i?></option>
                                                        <?php }?>
                                                    </select> 
                                            </div>
                                           
                                    </div> 
                                    </div>
                                    <div class="row mar-all addukadmin"> 
                                    <div class="form-group">
                                    <label class="col-sm-2 control-label" for="inputstatus">Unit Kerja</label>
                                            <div class="col-sm-7">
                                                    <select class="form-control select-chosen" id="adduk" name="adduk" style="width: 100%;" >
                                                     
                                                      
                                                    </select> 
                                            </div>
                                           
                                    </div> 
                                    </div>

                                     
                                    <div class="row mar-all"> 
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label" for="inputstatus">Kegiatan Pokok</label>
                                            <div class="col-sm-6">
                                            <select class="form-control select-chosen" id="kegiatan_pokoks" name="kegiatan_pokoks" style="width: 100%;" onChange="getOptions('txtbagian',BASE_URL+'master/direktoratSub/');">
                                                     
                                                      
                                                    </select> 
                                                      </div> 
                                              <div class="col-sm-4">
                                              <button onClick="$('.addkb').show('slow');return false;" data-toggle="panel-overlay" data-target="#demo-panel-network" class="btn btn-mint btn-sm"><i class="fa fa-plus-square icon-lg"></i></button>
                                            
                                              </div>
                                              
                                              

                                    </div> 
                                    </div>
                                    <div class="row mar-all addkb"> 
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label text-success" for="inputstatus" >Kegiatan Pokok</label>
                                            <div class="col-sm-4 ">
                                            <input type="text" id="kegiatan_pokok_baru" name="kegiatan_pokok_baru" class="form-control select2" />
                                           
                                               </div> 
                                    </div> 
                                    </div>
                                    <div class="row mar-all"> 
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label" for="inputstatus">Uraian Tugas</label>
                                            <div class="col-sm-4">
                                            <Textarea id="uraian_tugas" name="uraian_tugas" class="form-controll" style="width:100%"></Textarea>
                                              </div> 
                                    </div> 
                                    </div>
                                    <div class="row mar-all"> 
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label" for="inputstatus">Produk Yang dihasilkan</label>
                                            <div class="col-sm-6">
                                            <input type="text" id="produk_dihasilkan" name="produk_dihasilkan" class="form-control select2" />
                                              </div> 
                                    </div> 
                                    </div>
                                    <div class="row mar-all"> 
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label" for="inputstatus">Jumlah Yang Dihasilkan</label>
                                            <div class="col-sm-6">
                                            <input type="text" id="jumlah" name="jumlah" class="form-control select2" />
                                              </div> 
                                    </div> 
                                    </div>
                                   


                                                     </form>
<script>
$('.addkb').hide()
         getOptions("kegiatan_pokoks",BASE_URL+"master/kegiatanpokok");
        $('.addukadmin').hide();
        $('#author').val(localStorage.getItem('group'));
        $('.select-chosen').chosen();
        $('.chosen-container').css({"width": "100%"});
        var group = localStorage.getItem('group');

        if((group==='1') || (group==='6')){
            getOptions("adduk",BASE_URL+"master/direktoratSub");
            
            $('.addukadmin').show();
        }
                                                        


    </script>