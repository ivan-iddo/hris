<script src="hg/code/highcharts.js"></script>
<script src="hg/code/modules/exporting.js"></script>
<script src="hg/code/modules/export-data.js"></script>

<div class="panel">
	<div class="panel-body">
		 <div class="row"> 
    <div class="col-md-12"> 
        <div class="box box-primary"> 
            <div class="box-body">
                <div class="admininput">
                    <div class="row pad-top"> 
                        <div class="form-group">
                           <label class="col-sm-1 control-label" for="inputstatus"></label>
						   <div class="form-group">
                           <div class="col-sm-3">
                              <input  id="tgl_awal" name="tgl_awal" class="form-control tanggal" placeholder="Awal dd-mm-yyyy" type="text">
                          </div>  
                          </div>  
						  <div class="form-group">
						  <div class="col-sm-3">
                          <input  name="tgl_akhir" id="tgl_akhir" class="form-control tanggal" placeholder="Akhir dd-mm-yyyy" type="text">
                      </div> 
                      </div> 
					  <div class="form-group">
					  <div class="col-sm-3">
                      <select class="form-control select-chosen" id="direktorat" name="direktorat" style="width: 100%;">                  
                      </select> 
                  </div> 
                  </div> 
				  <div class="form-group">
				  <div class="col-sm-1">
                      <a class="btn btn-primary form-control " onClick="loaddata();return false;">view</a> 
                  </div>
                      </div>
                      </div>
                  </div>                 
              </div>
              <div class="admininput">
                <div class="row pad-top"> 
                    <div class="form-group">
                       <label class="col-sm-3 control-label" for="inputstatus"></label>
                                               
                  </div>
              </div>                 
          </div>
          <div class="admininput">
            <div class="row pad-top"> 
                <div class="form-group">
                   <label class="col-sm-3 control-label" for="inputstatus"></label>
                                            
              </div>
          </div>                 
      </div>
      <div class="row "> 
        <div class="form-group">
            <label class="col-sm-3 control-label" for="inputstatus"></label>
            
  </div>
  
</div>
</div>                      
</div>
</div>
</div>
</div> 
	</div>
</div>
<div class="panel">
	<div class="panel-body">
		<div id="pendidikan_all" style="min-width: 310px; max-width: 800px; height: 400px; margin: 0 auto"></div>
	</div>
</div>

<div class="panel">
	<div class="panel-body">
		<div id="pns" style="min-width: 310px; max-width: 800px; height: 400px; margin: 0 auto"></div>
	</div>
</div>

<div class="panel">
	<div class="panel-body">
		<div id="tetap" style="min-width: 310px; max-width: 800px; height: 400px; margin: 0 auto"></div>
	</div>
</div>

<div class="panel">
	<div class="panel-body">
		<div id="pnsall" style="min-width: 310px; max-width: 800px; height: 400px; margin: 0 auto"></div>
	</div>
</div>

<div class="panel">
	<div class="panel-body">
		<div id="tetapall" style="min-width: 310px; max-width: 800px; height: 400px; margin: 0 auto"></div>
	</div>
</div>

<div class="panel">
	<div class="panel-body">
		<div id="status" style="min-width: 310px; max-width: 800px; height: 400px; margin: 0 auto"></div>
	</div>
</div>

<div class="panel">
	<div class="panel-body">
		<div id="profesi" style="min-width: 310px; max-width: 800px; height: 400px; margin: 0 auto"></div>
	</div>
</div>


<script type="text/javascript">
	$('.judul-menu').html('Demografi Pegawai');
	$(document).ready(function () {
		$('.tanggal').datepicker({
            format: "dd-mm-yyyy",
        }).on('change', function(){
         $('.datepicker').hide();
     });
    });
	$('.select-chosen').chosen();
	$('.chosen-container').css({"width": "100%"});
	getOptions("direktorat",BASE_URL+"master/direktorat");
	function loaddata(){ 
	var tgl_awal = $('#tgl_awal').val();
    var tgl_akhir = $('#tgl_akhir').val();
    var direktorat = $('#direktorat').val();
	generateChart('pns','chart/chart_pns/?tgl_awal='+tgl_awal+'&tgl_akhir='+tgl_akhir+'&direktorat='+direktorat,'Populasi Pegawai Berdasarkan Status Pegawai (PNS/NON PNS)','Jumlah Pegawai','column');
	
	generateChart('tetap','chart/chart_tetap/?tgl_awal='+tgl_awal+'&tgl_akhir='+tgl_akhir+'&direktorat='+direktorat,'Populasi Pegawai Berdasarkan Status Pegawai (Tetap/PKWT)','Jumlah Pegawai','column');

	generateChart('pnsall','chart/chart_pnsall/?tgl_awal='+tgl_awal+'&tgl_akhir='+tgl_akhir+'&direktorat='+direktorat,'Populasi Pegawai Berdasarkan Status Pegawai ALL (PNS/NON PNS)','Jumlah Pegawai','column');
	
	generateChart('tetapall','chart/chart_tetapall/?tgl_awal='+tgl_awal+'&tgl_akhir='+tgl_akhir+'&direktorat='+direktorat,'Populasi Pegawai Berdasarkan Status Pegawai ALL (Tetap/PKWT)','Jumlah Pegawai','column');

	generateChart('status','chart/chart_status/?tgl_awal='+tgl_awal+'&tgl_akhir='+tgl_akhir+'&direktorat='+direktorat,'Populasi Pegawai Berdasarkan Status Pegawai PNS/CPNS/NON PNS/','Jumlah Pegawai','column');
	
	generateChart('profesi','chart/chart_profesi/?tgl_awal='+tgl_awal+'&tgl_akhir='+tgl_akhir+'&direktorat='+direktorat,'Populasi Pegawai Berdasarkan Profesi','Jumlah Pegawai','column');
	
	generateChart('pendidikan_all','chart/chart_pendidikan_all/?tgl_awal='+tgl_awal+'&tgl_akhir='+tgl_akhir+'&direktorat='+direktorat,'Populasi Pegawai Berdasarkan Pendidikan','Jumlah Pegawai','column');
	}
	loaddata();
	
</script>