<script src="http://localhost:8888/hrd01/hg/code/highcharts.js"></script>
<script src="http://localhost:8888/hrd01/hg/code/modules/exporting.js"></script>
<script src="http://localhost:8888/hrd01/hg/code/modules/export-data.js"></script>

<div class="panel">
<div class="panel-body">
<div id="containers" style="min-width: 310px; max-width: 800px; height: 400px; margin: 0 auto"></div>
</div>
</div>

<div class="panel">
<div class="panel-body">
<div id="Jabatan" style="min-width: 310px; max-width: 800px; height: 400px; margin: 0 auto"></div>
</div>
</div>

<div class="panel">
<div class="panel-body">
<div id="masakerja" style="min-width: 310px; max-width: 800px; height: 400px; margin: 0 auto"></div>
</div>
</div>



		<script type="text/javascript">
var chart;
chart = new Highcharts.chart('containers', {
    chart: {
        type: 'bar'
    },
    title: {
        text: 'Populasi pegawai berdasarkan Gender'
    },
    subtitle: {
        text: 'Tahun : 2018'
    },
    xAxis: {
        categories: ['Dinas Pendidikan', 'Dinas Tata ruang', 'KOMINFO', 'POLPP', 'DISHUB'],
        title: {
            text: null
        }
    },
    yAxis: {
        min: 0,
        title: {
            text: 'Population (millions)',
            align: 'high'
        },
        labels: {
            overflow: 'justify'
        }
    },
    tooltip: {
        valueSuffix: ' millions'
    },
    plotOptions: {
        bar: {
            dataLabels: {
                enabled: true
            }
        }
    },
    legend: {
        layout: 'vertical',
        align: 'right',
        verticalAlign: 'top',
        x: -40,
        y: 80,
        floating: true,
        borderWidth: 1,
        backgroundColor: ((Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'),
        shadow: true
    },
    credits: {
        enabled: false
    },
    series: [{
        name: 'Laki Laki',
        data: [107, 31, 635, 203, 2]
    }, {
        name: 'Perempuan',
        data: [133, 156, 947, 408, 6]
    }]
});


chart = new  Highcharts.chart('Jabatan', {
    chart: {
        type: 'bar'
    },
    title: {
        text: 'Populasi pegawai berdasarkan Jabatan'
    },
    subtitle: {
        text: 'Tahun : 2018'
    },
    xAxis: {
        categories: ['Dinas Pendidikan', 'Dinas Tata ruang', 'KOMINFO', 'POLPP', 'DISHUB'],
        title: {
            text: null
        }
    },
    yAxis: {
        min: 0,
        title: {
            text: 'Population (millions)',
            align: 'high'
        },
        labels: {
            overflow: 'justify'
        }
    },
    tooltip: {
        valueSuffix: ' millions'
    },
    plotOptions: {
        bar: {
            dataLabels: {
                enabled: true
            }
        }
    },
    legend: {
        layout: 'vertical',
        align: 'right',
        verticalAlign: 'top',
        x: -40,
        y: 80,
        floating: true,
        borderWidth: 1,
        backgroundColor: ((Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'),
        shadow: true
    },
    credits: {
        enabled: false
    },
    series: [{
        name: 'Kadis',
        data: [1, 1, 1, 1, 1]
    }, {
        name: 'Staff PNS',
        data: [33, 56, 47, 48, 6]
    }, {
        name: 'Honorer',
        data: [122, 33, 15, 24, 16]
    }, {
        name: 'Tenaga Ahli',
        data: [22, 33, 25, 44, 36]
    }]
});


chart = new  Highcharts.chart('masakerja', {
    chart: {
        type: 'bar'
    },
    title: {
        text: 'Populasi pegawai berdasarkan Masa Kerja'
    },
    subtitle: {
        text: 'Tahun : 2018'
    },
    xAxis: {
        categories: ['Dinas Pendidikan', 'Dinas Tata ruang', 'KOMINFO', 'POLPP', 'DISHUB'],
        title: {
            text: null
        }
    },
    yAxis: {
        min: 0,
        title: {
            text: 'Population (millions)',
            align: 'high'
        },
        labels: {
            overflow: 'justify'
        }
    },
    tooltip: {
        valueSuffix: ' millions'
    },
    plotOptions: {
        bar: {
            dataLabels: {
                enabled: true
            }
        }
    },
    legend: {
        layout: 'vertical',
        align: 'right',
        verticalAlign: 'top',
        x: -40,
        y: 80,
        floating: true,
        borderWidth: 1,
        backgroundColor: ((Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'),
        shadow: true
    },
    credits: {
        enabled: false
    },
    series: [{
        name: '1 - 4 Bulan',
        data: [1, 1, 1, 1, 1]
    }, {
        name: '5 bulan - 1 tahun',
        data: [33, 56, 47, 48, 6]
    }, {
        name: '2 - 5 tahun',
        data: [122, 33, 15, 24, 16]
    }, {
        name: '6 - 10 tahun',
        data: [22, 33, 25, 44, 36]
    }, {
        name: '> 11 tahun',
        data: [22, 33, 25, 44, 36]
    }, {
        name: 'Menuju Pensiun',
        data: [23, 11, 5, 12, 11]
    }]
});
		</script>