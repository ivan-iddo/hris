<?php session_start()?>
<form id="form3-upload" method="post" enctype="multipart/form-data">
    <div class="row mar-all"> 
        <div class="form-group">
            <label class="col-sm-2 control-label" for="inputstatus">Tahun</label>
            <div class="col-sm-5">
                <select class="form-control select2" id="thnfrm3add" name="thnfrm3add" style="width: 100%;">
                    <option value="">--TAHUN--</option>
                    <?php for($i=date('Y')+9;$i>=date('Y')-1;$i--){?>
                        <option value="<?php echo $i?>"><?php echo $i?></option>
                    <?php }?>
                </select> 
            </div>

        </div> 
    </div>
    <?php if(($_SESSION['userdata']['group']=='1') ){?>

        <div class="row mar-all"> 
            <div class="form-group">
                <label class="col-sm-2 control-label" for="inputstatus">Unit Kerja</label>
                <div class="col-sm-9"> 
                    <select class="form-control select-chosen" id="ukfrm3upload" name="ukfrm3upload" style="width: 100%;">


                    </select> 
                </div>

            </div>

        </div>
    <?php }?>
    <div class="row mar-all"> 
        <div class="form-group">
            <label class="col-sm-2 control-label" for="inputstatus">File Xlsx</label>
            <div class="col-sm-9">
                <input type="file" id="fileform3" name="fileform3" />
                <input type="text" id="author" name="author" style="display:none" />
            </div>

        </div>

    </div>
    <div class="row mar-all"> 
        <div class="form-group">
            <div class="alert alert-danger">
                <strong>Perhatian!</strong> Pastikan format excel yg akan anda upload sudah sesuai dengan format dasar, <strong><a href="xls/form3.xlsx">Download contoh file disini </a></strong>
            </div>
        </div>

    </div>
</form>
<script>

    $('#author').val(localStorage.getItem('group'));
</script>
<?php if(($_SESSION['userdata']['group']=='1') ){?>

    <script>
        getOptions("ukfrm3upload",BASE_URL+"master/direktoratSub");
    </script>
    <?php }?>