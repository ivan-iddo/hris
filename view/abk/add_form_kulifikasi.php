
<form class="form-horizontal" role="form" id="form-penajuan" name="form-upload" method="post" enctype="multipart/form-data">
    <div class="panel panel-primary" style="border-bottom:none !important">

        <!--Panel heading-->
        <div class="panel-heading">
            <div class="panel-control">

                <!--Nav tabs-->
                <ul class="nav nav-tabs">
                    <li class="active"><a data-toggle="tab" href="#demo-tabs-box-0a" aria-expanded="true">Persyaratan</a></li>
                    <li ><a data-toggle="tab" href="#demo-tabs-box-1a" aria-expanded="true">Pendidikan</a></li>
                    <li class=""><a data-toggle="tab" href="#demo-tabs-box-1" aria-expanded="true">Keterampilan</a></li>
                    <li class=""><a data-toggle="tab" href="#demo-tabs-box-2" aria-expanded="false">Syarat Fisik</a></li>
                    <li class=""><a data-toggle="tab" href="#demo-tabs-box-3" aria-expanded="true">Syarat Khusus</a></li> 
                </ul>

            </div>
            <h3 class="panel-title">Kebutuhan SDM</h3>
        </div>

        <!--Panel body-->
        <div class="panel-body">

            <!--Tabs content-->
            <div class="tab-content">
                <div id="demo-tabs-box-0a" class="tab-pane fade active in">
                    <div class="panel-body pad-all">
                        <div class="row mar-all addukadmin"> 
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="inputstatus">Unit Kerja</label>
                                <div class="col-sm-7">

                                    <select class="form-control select-chosen" id="adduk" name="adduk" style="width: 100%;" >


                                    </select> 
                                </div>

                            </div> 
                        </div>

                        <div class="row mar-all"> 
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="inputstatus">Jabatan</label>
                                <div class="col-sm-7">
                                    <select aria-hidden="true" class="select-chosen" id="katsdmfrm4" name="katsdmfrm4" style="width: 70%;" tabindex="-1">
                                    </select>
                                <span class="text-xs text-danger">* Wajib diisi</span>
				
								</div>
                            </div> 
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="masajbt">Masa Jabatan</label>
                            <div class="col-sm-7">
                                <input class="form-control" type="hidden" id="id_jabatan" name="id_jabatan">
                                <input class="form-control" type="text" id="masajbt" name="masajbt" readonly="true"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="kompetensi">Standard Kompetesi</label>
                            <div class="col-sm-7">
                                <textarea placeholder="" class="form-control input-sm" id="kompetensi" name="kompetensi" type="text" readonly="true"/></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="formal">Pendidikan Formal</label>
                            <div class="col-sm-7">
                                <input class="form-control" type="text" id="formal" name="formal" readonly="true"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="nonformal">Pendidikan Non Formal</label>
                            <div class="col-sm-7">
                                <textarea placeholder="" class="form-control input-sm" id="nonformal" name="nonformal" type="text" readonly="true"/></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="txtkjabatans">Jabatan Yang Telah Diemban</label>
                            <div class="col-sm-7">
                                <select aria-hidden="true" class="select-chosen" id="txtkjabatans" name="txtkjabatans" style="width: 70%;" tabindex="-1" disabled="true">
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="tufoksi">Tupoksi</label>
                            <div class="col-sm-7">
                                <textarea placeholder="" class="form-control input-sm" id="tufoksi" name="tufoksi" type="text" readonly="true"/></textarea>
                            </div>
                        </div>
<!--<div class="form-group">
<label class="col-sm-2 control-label" for="kebutuhan">Kebutuhan</label>
<div class="col-sm-7">
<textarea placeholder="" class="form-control input-sm" id="kebutuhan" name="kebutuhan" type="text" readonly="true"/></textarea>
</div>
</div>-->
</div>
</div>
<div id="demo-tabs-box-1a" class="tab-pane fade">
    <div class="panel-body pad-all">
        <div class="row mar-all"> 
            <div class="form-group">
                <label class="col-sm-2 control-label" for="inputstatus">Tahun</label>
                <div class="col-sm-5">
                    <input type="text" name="id_tk" id="id_tk" style="display:none">
                    <select class="form-control select2" id="thnadd" name="thnadd" style="width: 100%;">
                        <option value="">--TAHUN--</option>
                        <?php for($i=date('Y')+8;$i>=date('Y')-1;$i--){
                            $sele='';
                            if($i== date('Y')){
                                $sele='selected';
                            }
                            ?>
                            <option value="<?php echo $i?>" <?php echo $sele?>><?php echo $i?></option>
                        <?php }?>
                    </select>
				<span class="text-xs text-danger">* Wajib diisi</span>
				</div>

            </div> 
        </div>
<!--<div class="row mar-all addukadmin"> 
<div class="form-group">
<label class="col-sm-2 control-label" for="inputstatus">Unit Kerja</label>
<div class="col-sm-7">

<select class="form-control select-chosen" id="adduk" name="adduk" style="width: 100%;" >


</select> 
</div>

</div> 
</div>-->

<div class="row mar-all"> 
<!-- <div class="form-group">
<label class="col-sm-2 control-label" for="inputstatus">Kategori SDM</label>
<div class="col-sm-7">
<select class="form-control select-chosen" id="katsdmfrm4" name="katsdmfrm4" style="width: 100%;" >


</select> 
</div>

</div>-->
</div>

<div class="row mar-all"> 
    <div class="form-group">
        <label class="col-sm-2 control-label" for="inputstatus">Jenis kelamin<span class="text-xs text-danger">*</span>
				</label>
        <div class="col-sm-7">
            <div id="kelamin" class="kelamin"></div>
        </div>

    </div> 
</div>

<div class="row mar-all"> 
    <div class="form-group">
        <label class="col-sm-2 control-label" for="inputstatus">Kisaran Usia</label>
        <div class="col-sm-7">
            <div class="col-md-3 col-sm-3 col-xs-12">
                <div class="input-group">
                    <span class="input-group-addon">Min :</span>
                    <input class="form-control" aria-label="..." id="txtusiamax" name="txtusiamax" value="" type="text">
                </div><!-- /input-group -->
            </div>
            <div class="col-md-4 col-sm-4 col-xs-12">
                <div class="input-group">
                    <span class="input-group-addon">Max :</span>
                    <input class="form-control" aria-label="..." id="txtusiamin" name="txtusiamin" value="" type="text">
                </div><!-- /input-group -->
            </div>
        </div>


    </div> 
</div>





<div class="row mar-all"> 
    <div class="form-group">
        <label class="col-sm-2 control-label" for="inputstatus">Pendidikan</label>
        <div class="col-sm-4">
            <select class="form-control select-chosen" id="pendidikan" name="pendidikan" style="width: 100%;" >


            </select> 
        <span class="text-xs text-danger">* Wajib diisi</span>
		</div> 
    </div> 
</div>
<div class="row mar-all"> 
    <div class="form-group">
        <label class="col-sm-2 control-label" for="inputstatus">Jurusan</label>
        <div class="col-sm-6">
            <div class="col-md-4 col-sm-4 col-xs-12">
                <div class="input-group">
                    <span class="input-group-addon">1 :</span>
                    <input class="form-control" aria-label="..." id="jurusan1" name="jurusan1" type="text">
                </div><!-- /input-group -->
            </div>
            <div class="col-md-4 col-sm-4 col-xs-12">
                <div class="input-group">
                    <span class="input-group-addon">2 :</span>
                    <input class="form-control" aria-label="..." id="jurusan2" name="jurusan2" type="text">
                </div><!-- /input-group -->
            </div>
            <div class="col-md-4 col-sm-4 col-xs-12">
                <div class="input-group">
                    <span class="input-group-addon">3 :</span>
                    <input class="form-control" aria-label="..." id="jurusan3" name="jurusan3" type="text">
                </div><!-- /input-group -->
            </div>
        </div> 
    </div> 
</div>
</div>
</div>
<div id="demo-tabs-box-1" class="tab-pane">
    <div class="panel-body pad-all">
        <!-- START FORM 1 -->
        <section class="content">
            <div class="row mar-all"> 
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="inputstatus">Komputer</label>
                    <div class="col-sm-7">
                        <select class="form-control select-chosen" id="kompi" name="kompi" style="width: 100%;" >


                        </select>
					<span class="text-xs text-danger">* Wajib diisi</span>
					
                    </div>
                    <div class="col-sm-7">
                        <div id="level_kompi" class="media_type"></div>
                    </div> 
                </div> 
            </div>
            <div class="row mar-all"> 
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="inputstatus">Bahasa Asing</label>
                    <div class="col-sm-7">
                        <select class="form-control select-chosen" id="bahasa" name="bahasa" style="width: 100%;" >


                        </select> 
                    <span class="text-xs text-danger">* Wajib diisi</span>
					</div>
                    <div class="col-sm-7">
                        <div id="level_bahasa" class="media_type"></div>
                    </div> 
                </div> 
            </div>

            <div class="row mar-all"> 
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="inputstatus">Pengalaman Kerja</label>
                    <div class="col-sm-7">
                        <select class="form-control select-chosen" id="pengalaman" name="pengalaman" style="width: 100%;" >


                        </select> 
                    <span class="text-xs text-danger">* Wajib diisi</span>
					</div>

                </div> 
            </div>


        </section>
        <!-- END FORM 1 -->
    </div>
</div>
<div id="demo-tabs-box-2" class="tab-pane fade">
    <div class="panel-body pad-all">
        <!-- START FORM 2 -->
        <div class="row mar-all"> 
            <div class="form-group">
                <label class="col-sm-2 control-label" for="inputstatus">Tinggi badan (Cm)</label>
                <div class="col-sm-7">
                    <div class="col-md-3 col-sm-3 col-xs-12">
                        <div class="input-group">
                            <span class="input-group-addon">Min :</span>
                            <input class="form-control" aria-label="..." id="tinggimin" name="tinggimin" value="" type="text">
                        </div><!-- /input-group -->
                    </div>
                    <div class="col-md-4 col-sm-4 col-xs-12">
                        <div class="input-group">
                            <span class="input-group-addon">Max :</span>
                            <input class="form-control" aria-label="..." id="tinggimax" name="tinggimax" value="" type="text">
                        </div><!-- /input-group -->
                    </div>
                </div> 
            </div> 
        </div>

        <div class="row mar-all"> 
            <div class="form-group">
                <label class="col-sm-2 control-label" for="inputstatus">Berat badan (Kg)</label>
                <div class="col-sm-7">
                    <div class="col-md-3 col-sm-3 col-xs-12">
                        <div class="input-group">
                            <span class="input-group-addon">Min :</span>
                            <input class="form-control" aria-label="..." id="berat_b_min" name="berat_b_min" value="" type="text">
                        </div><!-- /input-group -->
                    </div>
                    <div class="col-md-4 col-sm-4 col-xs-12">
                        <div class="input-group">
                            <span class="input-group-addon">Max :</span>
                            <input class="form-control" aria-label="..." id="berat_b_max" name="berat_b_max" value="" type="text">
                        </div><!-- /input-group -->
                    </div>
                </div> 
            </div> 
        </div>

        <div class="row mar-all"> 
            <div class="form-group">
                <label class="col-sm-2 control-label" for="inputstatus">Buta warna</label>
                <div class="col-sm-7">
                    <select class="form-control select-chosen" id="buta_warna" name="buta_warna" style="width: 100%;" >


                    </select> 
                </div>

            </div> 
        </div>

        <div class="row mar-all"> 
            <div class="form-group">
                <label class="col-sm-2 control-label" for="inputstatus">Kaca Mata</label>
                <div class="col-sm-7">
                    <select class="form-control select-chosen" id="kaca_mata" name="kaca_mata" style="width: 100%;" >


                    </select> 
                </div>

            </div> 
        </div>

        <div class="row mar-all"> 
            <div class="form-group">
                <label class="col-sm-2 control-label" for="inputstatus">Keterbatasan Fisik</label>
                <div class="col-sm-7">
                    <select class="form-control select-chosen" id="batas_fisik" name="batas_fisik" style="width: 100%;" >


                    </select> 
                </div>
                <div class="col-sm-7 pad-top">
                    <div class="input-group" id="boleh_fisik" style="display:none">
                        <span class="input-group-addon">Dibolehkan :</span>
                        <input class="form-control" aria-label="..." id="txtboleh_fisik" name="txtboleh_fisik" value="" type="text">
                    </div>
                </div>

            </div> 
        </div>



        <!-- end FORM 2 -->
    </div>
</div>
<div id="demo-tabs-box-3" class="tab-pane fade">
    <div class="panel-body pad-all">
        <!-- START FORM 3 -->
        <div class="row mar-all"> 
            <div class="form-group">
                <label class="col-sm-2 control-label" for="inputstatus">Kompetensi yang dibutuhkan</label>
                <div class="col-sm-7">
                    <textarea id="kompetensi" name="kompetensi" class="form-control col-md-12 col-xs-12" rows="2"></textarea>
                </div>

            </div> 
        </div>

        <div class="row mar-all"> 
            <div class="form-group">
                <label class="col-sm-2 control-label" for="inputstatus">Syarat Khusus yang dibutuhkan</label>
                <div class="col-sm-7">
                    <textarea id="syarat_khusus" name="syarat_khusus" class="form-control col-md-12 col-xs-12" rows="2"></textarea>
                </div>

            </div> 
        </div>

        <div class="row mar-all"> 
            <div class="form-group">
                <label class="col-sm-2 control-label" for="inputstatus">Test Khusus yang dibutuhkan</label>
                <div class="col-sm-7">
                    <textarea id="test_khusus" name="test_khusus" class="form-control col-md-12 col-xs-12" rows="2"></textarea>
                </div>

            </div> 
        </div>

        <div class="row mar-all"> 
            <div class="form-group">
                <label class="col-sm-2 control-label" for="inputstatus">Lain-lain </label>
                <div class="col-sm-7">
                    <textarea id="lainlain" name="lainlain" class="form-control col-md-12 col-xs-12" rows="2"></textarea>
                </div>

            </div> 
        </div>
        <!-- end FORM 3 -->
    </div>
</div>

</div>
</div>
</div>
</form>

<script>
    var selectedRows = gridTK.api.getSelectedRows();
// alert('>>'+selectedRows+'<<<');
if(selectedRows == ''){
    getInputTypeOptions("kelamin",BASE_URL+'dokumen/gettaksonomi?id=34');
    getInputTypeOptions("level_kompi",BASE_URL+'dokumen/gettaksonomi?id=31');
    getInputTypeOptions("level_bahasa",BASE_URL+'dokumen/gettaksonomi?id=31');
    getOptions("pendidikan",BASE_URL+'dokumen/gettaksonomi?id=29');
    getOptions("kompi",BASE_URL+'dokumen/gettaksonomi?id=30');
    getOptions("bahasa",BASE_URL+'dokumen/gettaksonomi?id=30');
    getOptions("pengalaman",BASE_URL+'dokumen/gettaksonomi?id=32');
    getOptions("buta_warna",BASE_URL+'dokumen/gettaksonomi?id=33');
    getOptions("kaca_mata",BASE_URL+'dokumen/gettaksonomi?id=33');
    getOptions("batas_fisik",BASE_URL+'dokumen/gettaksonomi?id=33');
    getOptions("shiftfrm4",BASE_URL+"master/getmaster?id=27");
    getOptions("faktorfrm4",BASE_URL+"master/getmaster?id=28");
//getOptions("katsdmfrm4",BASE_URL+"master/jabatan_struktural");
}else{
    var selectedRowsString = '';
    selectedRows.forEach( function(selectedRow, index) {

        if (index!==0) {
            selectedRowsString += ', ';
        }
        selectedRowsString += selectedRow.id;
    }); 


    getJson(getdata,BASE_URL+'abk/abk/gettk?id='+selectedRowsString)

}
function loaddata(id, url, valueEdit = null) {
    $('#' + id).children().remove();
    $('#' + id).append('<option value="" selected="selected">Pilih</option>');

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
                $('#' + id).append('<option ' + (e.result[i].id == valueEdit ? 'selected' : '') + ' value="' + e.result[i].id + '" data-id="' + e.result[i].id_jabatan + '"data-baru="' + e.result[i].baru + '" data-masa="' + e.result[i].masa_jabatan + '"data-kompetensi="' + e.result[i].kompetensi + '"data-formal="' + e.result[i].formal + '"data-nonformal="' + e.result[i].nonformal + '"jabatan-lama="' + e.result[i].id_jabatan_lama + '"data-tufoksi="' + e.result[i].tufoksi + '">' + e.result[i].jabatan_baru + ' [Kode :' + e.result[i].kd_jabatan + ']</option>');
            }
            $('#' + id).trigger("chosen:updated");
        }
    });
}
loaddata("katsdmfrm4", BASE_URL + "persyaratan/persyaratan/listdata");

$("#katsdmfrm4").on("change", function () {
    if ($(this).find(':selected').attr("data-id") != undefined) {
        $("#id_jabatan").val($(this).find(':selected').attr("data-id"));
        $("#masajbt").val($(this).find(':selected').attr("data-masa"));
        $("#kompetensi").val($(this).find(':selected').attr("data-kompetensi"));
        $("#formal").val($(this).find(':selected').attr("data-formal"));
        $("#nonformal").val($(this).find(':selected').attr("data-nonformal"));
        getOptionsEdit("txtkjabatans",BASE_URL+"master/jabatan_struktural_fix",$(this).find(':selected').attr("jabatan-lama"));
        $("#tufoksi").val($(this).find(':selected').attr("data-tufoksi"));
    }else{
        $("#id_jabatan").val('');
        $("#masajbt").val('');
        $("#kompetensi").val('');
        $("#formal").val('');
        $("#nonformal").val('');
        $("#txtkjabatans").prop('selectedIndex', 0);
        $("#txtkjabatans").trigger('chosen:updated');
        $("#txtkjabatans").trigger('change');
        $("#tufoksi").val('');
    }
});
function getdata(data){
    window.setTimeout(function(){
        $('#thnadd').val(data.result.tahun);
        $('#id_tk').val(data.result.id);
        $('#txtusiamax').val(data.result.max_usia);
        $('#txtusiamin').val(data.result.min_usia);
        $('#jurusan1').val(data.result.jurusan_1);
        $('#jurusan2').val(data.result.jrusan_2);
        $('#jurusan3').val(data.result.jrusan_3);

        $('#tinggimin').val(data.result.tinggi_b_min);
        $('#tinggimax').val(data.result.tinggi_b_max);
        $('#berat_b_min').val(data.result.berat_b_min);
        $('#berat_b_max').val(data.result.berat_b_max);

        $('#kompetensi').val(data.result.kompetensi);
        $('#syarat_khusus').val(data.result.syarat_khusus);
        $('#test_khusus').val(data.result.test_khusus);
        $('#lainlain').val(data.result.lain_lain);

        $("#id_jabatan").val(data.result.id_jabatan);
        $("#masajbt").val(data.result.masa_jabatan);
        $("#kompetensi").val(data.result.kompetensi);
        $("#formal").val(data.result.formal);
        $("#nonformal").val(data.result.nonformal);
        getOptionsEdit("txtkjabatans",BASE_URL+"master/jabatan_struktural_fix",data.result.jabatan_lama);
        $("#tufoksi").val(data.result.tufoksi);

        getOptionsEdit("adduk",BASE_URL+"master/direktoratSub",data.result.id_uk);
        getInputTypeOptionsEdit("kelamin",BASE_URL+'dokumen/gettaksonomi?id=34',data.result.kelamin);
        getInputTypeOptionsEdit("level_kompi",BASE_URL+'dokumen/gettaksonomi?id=31',data.result.komputer_level);
        getInputTypeOptionsEdit("level_bahasa",BASE_URL+'dokumen/gettaksonomi?id=31',data.result.bahasa_level);
        getOptionsEdit("pendidikan",BASE_URL+'dokumen/gettaksonomi?id=29',data.result.pendidikan);
        getOptionsEdit("kompi",BASE_URL+'dokumen/gettaksonomi?id=30',data.result.komputer);
        getOptionsEdit("bahasa",BASE_URL+'dokumen/gettaksonomi?id=30',data.result.bahasa);
        getOptionsEdit("pengalaman",BASE_URL+'dokumen/gettaksonomi?id=32',data.result.pengalaman);
        getOptionsEdit("buta_warna",BASE_URL+'dokumen/gettaksonomi?id=33',data.result.buta_warna);
        getOptionsEdit("kaca_mata",BASE_URL+'dokumen/gettaksonomi?id=33',data.result.kacamata);
        getOptionsEdit("batas_fisik",BASE_URL+'dokumen/gettaksonomi?id=33',data.result.fisik_lain);
        loaddata("katsdmfrm4", BASE_URL + "persyaratan/persyaratan/listdata",data.result.kategori_sdm);

// getOptionsEdit("katsdmfrm4",BASE_URL+"master/jabatan_struktural",data.result.kategori_sdm);

},2000);
}


$('.addkb').hide()
$('.addukadmin').hide();
$('#author').val(localStorage.getItem('group'));
$('.select-chosen').chosen();
$('.chosen-container').css({"width": "100%"});
var group = localStorage.getItem('group');

$('#batas_fisik').on('change',(event) => {
    var id =  event.target.value ;

    if(id === '69'){
        $('#boleh_fisik').show('slow');
    }else{
        $('#boleh_fisik').hide('slow');
    }
});


if((group==='1') || (group==='6')){
    getOptions("adduk",BASE_URL+"master/direktoratSub");

    $('.addukadmin').show();
}





</script>