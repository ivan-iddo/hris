<form id="form1-addnew" method="post" enctype="multipart/form-data">
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
                                                    <select class="form-control select-chosen" id="adduk" name="adduk" style="width: 100%;">
                                                     
                                                      
                                                    </select> 
                                            </div>
                                           
                                    </div> 
                                    </div>

                                     
                                    <div class="row mar-all"> 
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label" for="inputstatus">kategori SDM</label>
                                            <div class="col-sm-6">
                                            <select class="form-control select-chosen" id="katsdm" name="katsdm" style="width: 100%;">
                                                     
                                                      
                                                    </select>
                                               </div> 
                                    </div> 
                                    </div>
                                    <div class="row mar-all"> 
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label" for="inputstatus">SLTA</label>
                                            <div class="col-sm-3">
                                            <input type="text" id="slta" name="slta" class="form-control select2" />
                                              </div> 
                                    </div> 
                                    </div>
                                    <div class="row mar-all"> 
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label" for="inputstatus">D-III</label>
                                            <div class="col-sm-6">
                                            <input type="text" id="d3" name="d3" class="form-control select2" />
                                              </div> 
                                    </div> 
                                    </div>
                                    <div class="row mar-all"> 
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label" for="inputstatus">S1</label>
                                            <div class="col-sm-6">
                                            <input type="text" id="s1" name="s1" class="form-control select2" />
                                              </div> 
                                    </div> 
                                    </div>
                                    <div class="row mar-all"> 
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label" for="inputstatus">S2</label>
                                            <div class="col-sm-6">
                                            <input type="text" id="s2" name="s2" class="form-control select2" />
                                              </div> 
                                    </div> 
                                    </div>


                                                     </form>
<script>
     
        $('.addukadmin').hide();
        $('#author').val(localStorage.getItem('group'));
        $('.select-chosen').chosen();
        $('.chosen-container').css({"width": "100%"});
        getOptions("katsdm",BASE_URL+"master/jabatan_struktural");
        var group = localStorage.getItem('group');

        if((group==='1') || (group==='6')){
            getOptions("adduk",BASE_URL+"master/direktoratSub");
            $('.addukadmin').show();
        }
                                                        


    </script>