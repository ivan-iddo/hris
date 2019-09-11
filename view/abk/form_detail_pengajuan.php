<form id="form-detail-pengajuan" method="post">
	<div class="row mar-all"> 
		<div class="form-group">
			<label class="col-sm-2 control-label" for="inputstatus"></label>
			<div class="col-sm-7">
				<input type="text" name="idtk" id="idtk" class="form-control" style="display:none"/>
			</div>

		</div> 
	</div><div class="row mar-all"> 
		<div class="form-group">
			<label class="col-sm-2 control-label" for="inputstatus">Rencana Penempatan</label>
			<div class="col-sm-7">
				<select aria-hidden="true" class="form-control select-chosen" id="id_uk_det" name="id_uk_det" onchange="getToSub(this.value,'txtbagian','master/direktoratSub/')" style="width: 100%;" tabindex="-1">

				</select> 
			</div>

		</div> 
	</div>
	<div class="row mar-all"> 
		<div class="form-group">
			<label class="col-sm-2 control-label" for="inputstatus">Jumlah</label>
			<div class="col-sm-7">
				<input type="text" name="jumlah" id="jumlah" class="form-control"/>
			</div>

		</div> 
	</div>
	<div class="row mar-all"> 
		<div class="form-group">
			<label class="col-sm-2 control-label" for="inputstatus">Estimasi Gaji Pasar</label>
			<div class="col-sm-7">
				<input type="text" name="gaji" id="gaji" class="form-control"/>
			</div>

		</div> 
	</div><div class="row mar-all"> 
		<div class="form-group">
			<label class="col-sm-2 control-label" for="inputstatus">Kelompok Profesi</label>
			<div class="col-sm-7">
				<select aria-hidden="true" class="form-control select-chosen" id="id_kp" name="id_kp" onchange="cekABK(this.value)" style="width: 100%;" tabindex="-1">

				</select> 
			</div>

		</div> 
	</div><div class="row mar-all"> 
		<div class="form-group">
			<label class="col-sm-2 control-label" for="inputstatus">Jml yang ada saat ini</label>
			<div class="col-sm-7">
				<input type="text" name="jml_saatini" id="jml_saatini" class="form-control"/>
			</div>

		</div> 
	</div><div class="row mar-all"> 
		<div class="form-group">
			<label class="col-sm-2 control-label" for="inputstatus">Kebutuhan sesuai ABK</label>
			<div class="col-sm-7">
				<input type="text" name="kebutuhan_sesuai_abk" id="kebutuhan_sesuai_abk" class="form-control"/>
			</div>

		</div> 
	</div><div class="row mar-all"> 
		<div class="form-group">
			<label class="col-sm-2 control-label" for="inputstatus"></label>
			<div class="col-sm-7">
				<input type="text" name="iddettk" id="iddettk" class="form-control" style="display:none"/>
			</div>

		</div> 
	</div>
</form>
<script>

	$('.select-chosen').chosen();
	$('.chosen-container').css({"width": "100%"});

	var selectedRows = gridTK.api.getSelectedRows();
// alert('>>'+selectedRows+'<<<');
if(selectedRows == ''){

}else{
	var selectedRowsString = '';
	var id_ukres = '';
	var tahunres = '';
	selectedRows.forEach( function(selectedRow, index) {

		if (index!==0) {
			selectedRowsString += ', ';
		}
		selectedRowsString += selectedRow.id;
		id_ukres += selectedRow.id_unit;
		tahunres += selectedRow.tahun;
	});  
	$('#idtk').val(selectedRowsString);
	getJson(setPengajuan,BASE_URL+'abk/abk/getrowpengajuan?id='+selectedRowsString);

}


function setPengajuan(result){
	if(result.hasil ==='success'){
		getOptionsEdit("id_uk_det",BASE_URL+"master/direktoratSub",result.data.id_uk_det);
		getOptionsEdit("id_kp",BASE_URL+'dokumen/gettaksonomi?id=35',result.data.id_kp);

		$('#iddettk').val(result.data.id); 
		$('#gaji').val(result.data.gaji); 
		$('#jml_saatini').val(result.data.jml_saatini);
		$('#kebutuhan_sesuai_abk').val(result.data.kebutuhan_sesuai_abk);
		$('#idtk').val(result.data.id_pengajuan);
		$('#jumlah').val(result.data.jumlah);


	}else{
		getOptions("id_uk_det",BASE_URL+"master/direktoratSub");
		getOptions("id_kp",BASE_URL+'dokumen/gettaksonomi?id=35');
	}
}

function cekABK(a){ 
	getJson(loadKelompokProfesi,BASE_URL+'abk/abk/countkelompokprofesi?id='+a);

	if(a !=='77'){
		getJson(loadCekABK,BASE_URL+'abk/abk/listshift?year='+tahunres+'&uk='+id_ukres);
	}else{
		getJson(loadCekABK,BASE_URL+'abk/abk/listnonshift?year='+tahunres+'&uk='+id_ukres);
	}

}
function loadCekABK(result){
	var arr = result.result.length-1;
	var jml = 0;
	if(result.hasil ==='success'){
		$('#kebutuhan_sesuai_abk').val(result.result[arr].sdm);
	}else{
		$('#kebutuhan_sesuai_abk').val('0');
	}

}
function loadKelompokProfesi(result){
	if(result.hasil ==='success'){
		$('#jml_saatini').val(result.jumlah);
	}else{
		$('#jml_saatini').val('0');
	}
}
</script>