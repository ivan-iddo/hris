<form id="form4-addnew" method="post" enctype="multipart/form-data">
<div class="row mar-all"> 
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label" for="inputstatus">Tahun</label>
                                            <div class="col-sm-5">
                                                    <select class="form-control select2" id="thnadd" name="thnadd" style="width: 100%;">
                                                    <option value="">--TAHUN--</option>
                                                     <?php for($i=2010;$i<= date('Y');$i++){?>
                                                        <option value="<?php echo $i?>"><?php echo $i?></option>
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
                                    <label class="col-sm-2 control-label" for="inputstatus">Shift</label>
                                            <div class="col-sm-7">
                                                    <select class="form-control select-chosen" id="shiftfrm4" name="shiftfrm4" style="width: 100%;" >
                                                     
                                                      
                                                    </select> 
                                            </div>
                                           
                                    </div> 
                                    </div>

                                     <div class="row mar-all"> 
                                    <div class="form-group">
                                    <label class="col-sm-2 control-label" for="inputstatus">Faktor Kelonggaran</label>
                                            <div class="col-sm-7">
                                                    <select class="form-control select-chosen" id="faktorfrm4" name="faktorfrm4" style="width: 100%;" >
                                                     
                                                      
                                                    </select> 
                                            </div>
                                           
                                    </div> 
                                    </div>

                                     <div class="row mar-all"> 
                                    <div class="form-group">
                                    <label class="col-sm-2 control-label" for="inputstatus">Kategori SDM</label>
                                            <div class="col-sm-7">
                                                    <select class="form-control select-chosen" id="katsdmfrm4" name="katsdmfrm4" style="width: 100%;" >
                                                     
                                                      
                                                    </select> 
                                            </div>
                                           
                                    </div> 
                                    </div>

                                    
                                
                                    <div class="row mar-all"> 
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label" for="inputstatus">Kegiatan</label>
                                            <div class="col-sm-4">
                                            <Textarea id="kegiatanfrm4" name="kegiatanfrm4" class="form-controll" style="width:100%"></Textarea>
                                              </div> 
                                    </div> 
                                    </div>
                                    <div class="row mar-all"> 
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label" for="inputstatus">Frekuensi/thn</label>
                                            <div class="col-sm-6">
                                            <input type="text" id="frekuensifrm4" name="frekuensifrm4" class="form-control select2" />
                                              </div> 
                                    </div> 
                                    </div>
                                    <div class="row mar-all"> 
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label" for="inputstatus">Waktu (menit)</label>
                                            <div class="col-sm-6">
                                            <input type="text" id="jumlah" name="jumlah" class="form-control select2" />
                                              </div> 
                                    </div> 
                                    </div>
                                   


                                                     </form>
<script>
$('.addkb').hide()
         
         getOptions("shiftfrm4",BASE_URL+"master/getmaster?id=27");
         getOptions("faktorfrm4",BASE_URL+"master/getmaster?id=28");
         getOptions("katsdmfrm4",BASE_URL+"master/jabatan_struktural");

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