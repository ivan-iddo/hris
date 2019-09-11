<form id="form-detail-pengajuan" method="post">
	<div class="row mar-all"> 
		<div class="form-group">
			<label class="col-sm-2 control-label" for="spanstatus"></label>
			<div class="col-sm-7"> 
			</div>

		</div> 
	</div><div class="row mar-all"> 
		<div class="form-group">
			<label class="col-sm-2 control-label" for="spanstatus">Rencana Penempatan</label>
			<div class="col-sm-7">
				<span type="text" name="id_uk_det" id="id_uk_det" ></span>

			</div>

		</div> 
	</div>
	<div class="row mar-all"> 
		<div class="form-group">
			<label class="col-sm-2 control-label" for="spanstatus">Jumlah</label>
			<div class="col-sm-7">
				<span type="text" name="jumlah" id="jumlah" ></span>
			</div>

		</div> 
	</div>
	<div class="row mar-all"> 
		<div class="form-group">
			<label class="col-sm-2 control-label" for="spanstatus">Estimasi Gaji Pasar</label>
			<div class="col-sm-7">
				<span type="text" name="gaji" id="gaji" ></span>
			</div>

		</div> 
	</div><div class="row mar-all"> 
		<div class="form-group">
			<label class="col-sm-2 control-label" for="spanstatus">Kelompok Profesi</label>
			<div class="col-sm-7">
				<span type="text" name="id_kp" id="id_kp" ></span>

			</div>

		</div> 
	</div><div class="row mar-all"> 
		<div class="form-group">
			<label class="col-sm-2 control-label" for="spanstatus">Jml yang ada saat ini</label>
			<div class="col-sm-7">
				<span type="text" name="jml_saatini" id="jml_saatini" ></span>
			</div>

		</div> 
	</div><div class="row mar-all"> 
		<div class="form-group">
			<label class="col-sm-2 control-label" for="spanstatus">Kebutuhan sesuai ABK</label>
			<div class="col-sm-7">
				<span type="text" name="kebutuhan_sesuai_abk" id="kebutuhan_sesuai_abk" ></span>
			</div>

		</div> 
	</div><div class="row mar-all"> 
		<div class="form-group">
			<label class="col-sm-2 control-label" for="spanstatus"></label>
			<div class="col-sm-7">
				<span type="text" name="iddettk" id="iddettk" class="form-control" style="display:none"/>
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
		$('#id_uk_det').html(result.data.namauk); 
		$('#id_kp').html(result.data.namakp); 
		$('#gaji').html(result.data.gaji); 
		$('#jml_saatini').html(result.data.jml_saatini);
		$('#kebutuhan_sesuai_abk').html(result.data.kebutuhan_sesuai_abk);
		$('#idtk').html(result.data.id_pengajuan);
		$('#jumlah').html(result.data.jumlah);


	}else{

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