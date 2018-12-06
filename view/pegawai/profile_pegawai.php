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
            <div class="tab-pane fade" id="demo-lft-tab-1"></div>

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
                if (res.hasil !== 'error') {
                    window.setTimeout(function () {
                        $('#page_nama').html(res[0].nama);
                        $('#page_foto').attr('src', res[0].foto);

                        $('.page-jabatan').html(res[0].jabatan);
                        $('#id_user').val(res[0].id);
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
    //]]>


</script>
<script src="js/login.js" type="text/javascript">
</script>
 
