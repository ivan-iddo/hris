<script src="hg/code/highcharts.js"></script>
<script src="hg/code/modules/exporting.js"></script>
<script src="hg/code/modules/export-data.js"></script>

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
	
	generateChart('pns','chart/chart_pns','Populasi Pegawai Berdasarkan Status Pegawai (PNS/NON PNS)','Jumlah Pegawai','column');
	
	generateChart('tetap','chart/chart_tetap','Populasi Pegawai Berdasarkan Status Pegawai (Tetap/PKWT)','Jumlah Pegawai','column');

	generateChart('pnsall','chart/chart_pnsall','Populasi Pegawai Berdasarkan Status Pegawai ALL (PNS/NON PNS)','Jumlah Pegawai','column');
	
	generateChart('tetapall','chart/chart_tetapall','Populasi Pegawai Berdasarkan Status Pegawai ALL (Tetap/PKWT)','Jumlah Pegawai','column');

	generateChart('status','chart/chart_status','Populasi Pegawai Berdasarkan Status Pegawai PNS/CPNS/NON PNS/','Jumlah Pegawai','column');
	
	generateChart('profesi','chart/chart_profesi','Populasi Pegawai Berdasarkan Profesi','Jumlah Pegawai','column');
	
	generateChart('pendidikan_all','chart/chart_pendidikan_all','Populasi Pegawai Berdasarkan Pendidikan','Jumlah Pegawai','column');
	
</script>