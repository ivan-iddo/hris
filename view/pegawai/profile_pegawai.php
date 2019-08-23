<div class="row">

    <div class="tab-base mar-all">
        <!--Nav Tabs-->

        <ul class="nav nav-tabs">
            <li>
                <a href="#demo-lft-tab-1" data-toggle="tab">
						<span class="block text-center">
							<i class="fa fa-home fa-2x text-danger"></i> 
						</span>
                    Dashboard
                </a>
            </li>

            <li class="active">
                <a href="#demo-lft-tab-2" data-toggle="tab">
						<span class="block text-center">
							<i class="fa fa-laptop fa-2x text-danger"></i> 
						</span>
                    View Data
                </a>
            </li>

            <li>
                <a href="#demo-lft-tab-3" data-toggle="tab">
						<span class="block text-center">
							<i class="fa fa-lightbulb-o fa-2x text-warning"></i> 
						</span>
                    Help
                </a>
            </li>
        </ul>

        <div class="tab-content">
            <div class="tab-pane fade" id="demo-lft-tab-1">
			  <div class="panel-group accordion" id="accordion">
                    <div class="panel" style="border:none">
                        <div class="panel-collapse collapse in" id="collapseOne" aria-expanded="true" style="">
                            <div class="panel-body">
                                <div class="dataTables_wrapper form-inline dt-bootstrap no-footer"
                                     id="demo-dt-addrow_wrapper">
                                </div>
                                <div class="bootstrap-table">
                                    <div class="fixed-table-container" style="padding-bottom: 0px;">
                                        <div id="profile"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
			</div>

            <div class="tab-pane fade active in" id="demo-lft-tab-2">
                <div class="fixed-table-toolbar">

                </div>

                <div class="panel-group accordion" id="accordion">
                    <div class="panel" style="border:none">

                        <!--Accordion title-->
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a data-parent="#accordion" data-toggle="collapse" href="#collapseOne"
                                   aria-expanded="true" class="text-warning"><i class="fa fa-folder"></i> Data
                                    Pegawai</a>
                            </h4>
                        </div>

                        <div class="panel-collapse collapse in" id="collapseOne" aria-expanded="true" style="">
                            <div class="panel-body">
                                <div class="dataTables_wrapper form-inline dt-bootstrap no-footer"
                                     id="demo-dt-addrow_wrapper">
                                </div>
                                <div class="bootstrap-table">
                                    <div class="fixed-table-container" style="padding-bottom: 0px;">
                                        <div id="profilePage"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="tab-pane fade" id="demo-lft-tab-3"></div>
        </div>
    </div>
</div>


<script charset="utf-8" type="text/javascript">
    $('.judul-menu').html('Data Pegawai');
    //<![CDATA[
    // specify the columns
    function bukaProfile() {

        var selectedRowsString = localStorage.getItem("id_user");

        $.ajax({
            url: BASE_URL + 'pegawai/getuser/?id=' + selectedRowsString,
            headers: {
                'Authorization': localStorage.getItem("Token"),
                'X_CSRF_TOKEN': 'donimaulana',
                'Content-Type': 'application/json'
            },
            dataType: 'json',
            type: 'get',
            contentType: 'application/json',
            processData: false,
            success: function (res, textStatus, jQxhr) {
                const today = new Date();
                
                

                if (res.hasil !== 'error') {
                    
                    window.setTimeout(function () {
                        $('#page_nama').html(res[0].nama);
                        $('#page_foto').attr('src', res[0].foto);

                        
						if(res[0].status_pegawai_tetap!=4){
						if(res[0].tgl_kontrak){
                            const kontrak_date = new Date(res[0].tgl_kontrak);
                            // const diff = Math.abs(today.getTime() - kontrak_date.getTime());
                            const diff = kontrak_date - today;
                            const diffDays = Math.ceil(diff/(1000 * 3600* 24)); 
                            console.log(kontrak_date, today, diffDays);

                            if (diffDays <= 1)
                            {
                                $('#warning-message').html('<div class="alert alert-danger">'+
                            '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
                            '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> Masa Kontrak Anda Telah Berkhir Pada Tanggal '+ res[0].tgl_kontrak +
                             '!</div>');
                            } 
                            else if (diffDays <= 90) 
                            {
                                $('#warning-message').html('<div class="alert alert-warning">'+
                            '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
                            '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> Masa Kontrak Anda Tinggal '+ diffDays +
                             ' Hari </div>');
                            }
                            else if (diffDays <= 180) {
                                $('#warning-message').html('<div class="alert alert-info">'+
                            '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
                            '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> Masa Kontrak Anda Tinggal '+ diffDays +
                             ' Hari </div>');
                            }
                        }
						}
                        
                        if (res[0].tgl_str) {
                            const str_date = new Date(res[0].tgl_str);
                            const diffstr = str_date - today ;
                            const diffDaysstr = Math.ceil(diffstr/(1000 * 3600* 24)); 
                            console.log(str_date, today, diffDaysstr);

                            if (diffDaysstr <= 1)
                            {
                                $('#warning-message-str').html('<div class="alert alert-danger">'+
                            '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
                            '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> Masa STR Anda Telah Berkhir Pada Tanggal '+ res[0].tgl_str +
                             '!</div>');
                            } 
                            else if (diffDaysstr <= 90) 
                            {
                                $('#warning-message-str').html('<div class="alert alert-warning">'+
                            '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
                            '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> Masa STR Anda Tinggal '+ diffDaysstr +
                             ' Hari </div>');
                            }
                            else if (diffDaysstr <= 180) {
                                $('#warning-message-str').html('<div class="alert alert-info">'+
                            '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
                            '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> Masa STR Anda Tinggal '+ diffDaysstr +
                             ' Hari </div>');
                            } 
                        }

                        if(res[0].tgl_sip){
                            const sip_date = new Date(res[0].tgl_sip);
                            const diffsip = sip_date - today ;
                            const diffDayssip = Math.ceil(diffsip/(1000 * 3600* 24)); 
                            console.log(sip_date, today, res[0].tgl_sip);

                            if (diffDayssip <= 1)
                            {
                                $('#warning-message-sip').html('<div class="alert alert-danger">'+
                            '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
                            '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> Masa SIP Anda Telah Berkhir Pada Tanggal '+ res[0].tgl_sip +
                             '!</div>');
                            } 
                            else if (diffDayssip <= 90) 
                            {
                                $('#warning-message-sip').html('<div class="alert alert-warning">'+
                            '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
                            '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> Masa SIP Anda Tinggal '+ diffDayssip +
                             ' Hari </div>');
                            }
                            else if (diffDayssip <= 180) {
                                $('#warning-message-sip').html('<div class="alert alert-info">'+
                            '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
                            '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> Masa SIP Anda Tinggal '+ diffDayssip +
                             ' Hari </div>');
                            }
                        }

                         

                        $('.page-jabatan').html(res[0].jabatan);
                        $('#pass').val(res[0].pass);
                        $('#id_user').val(res[0].id);
                        $('#f_id_edit').val(res[0].id);
						$('#nop').val(res[0].nip);
                    }, 1000);
                    $('#profilePage').load('view/pegawai/profile_view.php');
                }

            },
            error: function (jqXhr, textStatus, errorThrown) {
                alert('error');
            }
        });


    }


    bukaProfile();
	
	  function buka() {
		var d = new Date();
		var n = d.getMonth();
		bulan = n+1;
		var user = localStorage.getItem("id_user");
		$('#profile').load('view/kpi/kpi_pegawai.php?bulan='+bulan+'&nopeg='+user);
	  }
    buka();
    //]]>


</script>
<script src="js/login.js" type="text/javascript">
</script>
 
