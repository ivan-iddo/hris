<?php
require_once('../../connectdb.php');

?>
<div class="row">

  <div class="tab-base mar-all">
    <!--Nav Tabs-->

    <ul class="nav nav-tabs">
      <li class="active">
        <a href="#demo-lft-tab-1" data-toggle="tab">
          <span class="block text-center">
            <i class="fa fa-check-square-o fa-2x text-danger"></i> 
          </span>
          List Cuti
        </a>
      </li>
    </ul>

    <div class="tab-content">
      <div class="tab-pane fade active in" id="demo-lft-tab-1">

        <div class="row"> 
          <div class="col-md-6"> 
            <div class="box box-primary"> 
              <div class="box-body">

                <div class="row pad-top">
				<div class="admininput">
                   <div class="row pad-top"> 
					 <div class="form-group">
					   <label class="col-sm-3 control-label" for="inputstatus">Tanggal Awal</label>
					   <div class="col-sm-7">
						  <input  id="awal" name="awal" class="form-control tanggal" placeholder="Awal dd-mm-yyyy" type="text">
					  </div>                          
					</div>
				</div>                          
			    </div>
			  <div class="admininput">
				<div class="row pad-top"> 
					<div class="form-group">
					   <label class="col-sm-3 control-label" for="inputstatus">Tanggal Akhir</label>
					   <div class="col-sm-7">
						  <input  name="akhir" id="akhir" class="form-control tanggal" placeholder="Akhir dd-mm-yyyy" type="text">
					  </div>                          
					</div>
				</div>
			  </div>
                </div>
                <?php if(($_SESSION['userdata']['group']=='1') OR ($_SESSION['userdata']['group']=='6')OR ($_SESSION['userdata']['group']=='97')OR ($_SESSION['userdata']['group']=='98')OR ($_SESSION['userdata']['group']=='99')OR ($_SESSION['userdata']['group']=='100') ){?>

                  <div class="admininput">
                    <div class="row pad-top"> 
                      <div class="form-group">
                        <label class="col-sm-3 control-label" for="inputstatus">Unit Kerja</label>
                        <div class="col-sm-7">
                          <select class="form-control select-chosen" id="txtdirektorat" name="txtdirektorat" style="width: 100%;">


                          </select> 
                        </div>

                      </div>
                    </div>
					</div>
					<div class="admininput">
                    <div class="row pad-top"> 
                      <div class="form-group">
                        <label class="col-sm-3 control-label" for="inputstatus">Pegawai</label>
                        <div class="col-sm-7">
                          <select class="form-control select-chosen" id="user" name="user" style="width: 100%;">


                          </select> 
                        </div>

                      </div>
                    </div>
					</div>
					<div class="admininput">
                    <div class="row pad-top"> 
                      <div class="form-group">
                        <label class="col-sm-3 control-label" for="inputstatus">Jenis Cuti</label>
                        <div class="col-sm-7">
                          <select class="form-control select-chosen" id="jenis" name="jenis" style="width: 100%;">


                          </select> 
                        </div>

                      </div>
                    </div>
					</div>
                  <?php } ?>


                <div class="row "> 
                  <div class="form-group">
                    <label class="col-sm-3 control-label" for="inputstatus"></label>
                    <div class="col-sm-2">

                      <div class="row  text-left"> 
                        <button class="btn btn-primary mar-all" href="javascript:void(0);" onClick="search();">Search</button> 
                      </div>
                    </div>
					<div class="col-sm-2">
                      <div class="row  text-left"> 
                        <button class="btn btn-primary mar-all" href="javascript:void(0);" onClick="cetak();">Cetak</button> 
                      </div>
                    </div>
                  </div>
                </div>

              </div>
            </div>
          </div>

        </div> 


        <div class="row">
          <div class="col-sm-12">
            <div class="panel">


              <!--Block Styled Form -->
              <!--===================================================-->
              <form>
                <div class="panel-body">
                  <div class="row pad-top pad-all">
                    <div class="col-lg-4">
                      <p class="text-semibold text-main">Total Pegawai Sedang Cuti</p>
                      <ul class="list-unstyled">
                        <li>
                          <div class="media">
                            <div class="media-left">
                              <span id="jumlah" class="text-2x text-semibold text-main">
                              </span>
                            </div>
                            <div class="media-body">
                              <p class="mar-no">Orang</p>
                            </div>
                          </div>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>

              </form>
              <!--===================================================-->
              <!--End Block Styled Form -->
              <div class="table-responsive">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>Nama Pegawai</th>
                      <th>Jenis Cuti</th>
                      <th>Keterangan</th>
                      <th>Mulai</th>
                      <th>Sampai</th>
                      <th>Hari</th>
                      <th>No Telp</th>
                      <th>Alamat</th>
                      <th>Alih Tanggung Jawab</th>    
                      <th>Status</th>
                    </tr>
                  </thead>
                  <tbody id="isicuti">

                  </tbody>
                </table>
              </div>

            </div>
          </div>

        </div>
      </div>
    </div>
  </div>


</div>
<script>
	function cetak() {
	var awal=$('#awal').val();
	var akhir=$('#akhir').val();
	var uk=$('#txtdirektorat').val();
	var user=$('#user').val();
	window.open(BASE_URL + 'laporan_cuti/cetak?awal='+awal+'&akhir='+akhir+'&id_uk='+uk+'&user='+user);
	}
  $('.judul-menu').html('Persetujuan Cuti SDM'); 
  search();
  function search(){
    var awal=$('#awal').val();
    var akhir=$('#akhir').val();
    var uk=$('#txtdirektorat').val();
    var user=$('#user').val();
    var jenis=$('#jenis').val();
    $.ajax({
      url: BASE_URL+'cuti/list_cutis?awal='+awal+'&akhir='+akhir+'&id_uk='+uk+'&user='+user+'&jenis='+jenis,
      headers: {
        'Authorization': localStorage.getItem("Token"),
        'X_CSRF_TOKEN':'donimaulana',
        'Content-Type':'application/json'
      },
      dataType: 'json',
      type: 'get',
      contentType: 'application/json', 
      processData: false,
      success: function( res, textStatus, jQxhr ){
        $('#isicuti').html(res.isi);
        $('#jumlah').html(res.jum);

      }
    });

  }

    $(document).ready(function () {
		$('.tanggal').datepicker({
            format: "dd-mm-yyyy",
        }).on('change', function(){
         $('.datepicker').hide();
     });
    });
	
  $('.select-chosen').chosen();
  $('.chosen-container').css({"width": "100%"});
</script>
<?php if(($_SESSION['userdata']['group']=='1') OR ($_SESSION['userdata']['group']=='6')OR ($_SESSION['userdata']['group']=='97')OR ($_SESSION['userdata']['group']=='98')OR ($_SESSION['userdata']['group']=='99')OR ($_SESSION['userdata']['group']=='100') ){?>                             
  <script>

    function loadUser(id, url, valueEdit = null) {
    $('#' + id).children().remove();
    $('#' + id).append('<option value="null" selected="selected">Pilih</option>');

    $.ajax({
        type: "GET",
        url: url,
        headers: {
            'Authorization': localStorage.getItem("Token"),
            'X_CSRF_TOKEN': 'donimaulana',
            'Content-Type': 'application/json'
        },
        dataType: "json",
        success: function (e) {
            for (var i = 0; i < e.result.length; i++) {
                $('#' + id).append('<option ' + (e.result[i].id == valueEdit ? 'selected' : '') + ' value="' + e.result[i].id + '" >' + e.result[i].id + ' - ' + e.result[i].nama + '</option>');
            }
            $('#' + id).trigger("chosen:updated");
			}
		});
	}
	loadUser("user", BASE_URL + "users/list_usernew");
    getOptions("jenis",BASE_URL+"master/jenis_cuti");
    getOptions("txtdirektorat",BASE_URL+"master/direktoratSub");
  </script>
<?php } ?>
