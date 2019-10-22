<style type="text/css">
    /*.daterangepicker{
        position: static !important;
        }*/
    </style>
    <form class="form-horizontal">
        <input type="text" name="id" id="id" style="width: 220px;display:none" class="form-control"/>
        <div class="panel-body">
              <div class="form-group">
                   <label class="col-sm-3 control-label" for="inputstatus">Unit Kerja</label>
                   <div class="col-sm-7">
                      <select class="form-control select-chosen" id="unit" name="unit" style="width: 100%;">                                                                                        
                      </select> 
                  </div>                          
              </div>
        </div>
    </form>

    <script type="text/javascript">
        function simpan(action) {
            data = {};
            data.unit = $("#unit").val();
            console.log(data);
        // return;

        URL = BASE_URL + "jpl/save";

        save(URL, data, loaddata);
    }
	$('.select-chosen').chosen();
	$('.chosen-container').css({"width": "100%"});
	getOptions("unit",BASE_URL+"master/direktoratSub");
</script>