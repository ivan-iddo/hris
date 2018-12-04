<script src="hg/code/highcharts.js"></script>
<script src="hg/code/modules/exporting.js"></script>
<script src="hg/code/modules/export-data.js"></script>

<div class="panel">
<div class="panel-body">
<div id="containers" style="min-width: 310px; max-width: 800px; height: 400px; margin: 0 auto"></div>
</div>
</div>

<div class="panel">
<div class="panel-body">
<div id="shift" style="min-width: 310px; max-width: 800px; height: 400px; margin: 0 auto"></div>
</div>
</div>

<div class="panel">
<div class="panel-body">
<div id="keluar" style="min-width: 310px; max-width: 800px; height: 400px; margin: 0 auto"></div>
</div>
</div>

<div class="panel">
<div class="panel-body">
<div id="pendidikan" style="min-width: 310px; max-width: 800px; height: 400px; margin: 0 auto"></div>
</div>
</div>



		<script type="text/javascript">
      
    generateChart('containers','chart/chart_gender','Populasi Pegawai Berdasarkan Gender','Jumlah Pegawai','column');
 
    generateChart('shift','chart/chart_shift','Populasi Pegawai Berdasarkan Jenis Shift','Jumlah Pegawai','column');

    generateChart('keluar','chart/chart_keluar','Populasi Pegawai Berdasarkan Aktif','Jumlah Pegawai','column');
   
    generateChart('pendidikan','chart/chart_pendidikan','Populasi Pegawai Berdasarkan Pendidikan','Jumlah Pegawai','column');
 
		</script>