<form id="form-detail-pengajuan" method="post">
	<div class="row mar-all"> 
		<div class="col-sm-6">
			<div class="row mar-all"> 
				<div class="form-group">
					<label class="col-sm-5 control-label" for="spanstatus"></label>
					<div class="col-sm-7"> 
					</div>

				</div> 
			</div><div class="row mar-all"> 
				<div class="form-group">
					<label class="col-sm-5 control-label" for="spanstatus">Rencana Penempatan</label>
					<div class="col-sm-7">
						<span type="text" name="id_uk_det" id="id_uk_det" ></span>

					</div>

				</div> 
			</div>
			<div class="row mar-all"> 
				<div class="form-group">
					<label class="col-sm-5 control-label" for="spanstatus">Jumlah</label>
					<div class="col-sm-7">
						<span type="text" name="jumlah" id="jumlah" ></span>
					</div>

				</div> 
			</div>
			<div class="row mar-all"> 
				<div class="form-group">
					<label class="col-sm-5 control-label" for="spanstatus">Estimasi Gaji Pasar</label>
					<div class="col-sm-7">
						<span type="text" name="gaji" id="gaji" ></span>
					</div>

				</div> 
			</div><div class="row mar-all"> 
				<div class="form-group">
					<label class="col-sm-5 control-label" for="spanstatus">Kelompok Profesi</label>
					<div class="col-sm-7">
						<span type="text" name="id_kp" id="id_kp" ></span>

					</div>

				</div> 
			</div><div class="row mar-all"> 
				<div class="form-group">
					<label class="col-sm-5 control-label" for="spanstatus">Jml yang ada saat ini</label>
					<div class="col-sm-7">
						<span type="text" name="jml_saatini" id="jml_saatini" ></span>
					</div>

				</div> 
			</div><div class="row mar-all"> 
				<div class="form-group">
					<label class="col-sm-5 control-label" for="spanstatus">Kebutuhan sesuai ABK</label>
					<div class="col-sm-7">
						<span type="text" name="kebutuhan_sesuai_abk" id="kebutuhan_sesuai_abk" ></span>
					</div>

				</div> 
			</div><div class="row mar-all"> 
				<div class="form-group">
					<label class="col-sm-5 control-label" for="spanstatus"></label>
					<div class="col-sm-7">
						<span type="text" name="iddettk" id="iddettk" class="form-control" style="display:none"/>
					</div>

				</div> 

			</div>
		</div>
		<div class="col-sm-5">
			<div class="panel">
				<!--Heading-->
				<div class="panel-heading">
					<div class="panel-control">
						<div class="btn-group">
							<button type="button" class="btn btn-default" data-toggle="dropdown"><i class="demo-pli-gear icon-lg"></i></button>
							<ul class="dropdown-menu dropdown-menu-right">
								<li><a href="#">Available</a></li>
								<li><a href="#">Busy</a></li>
								<li><a href="#">Away</a></li>
								<li class="divider"></li>
								<li><a id="demo-connect-chat" href="#" class="disabled-link" data-target="#demo-chat-body">Connect</a></li>
								<li><a id="demo-disconnect-chat" href="#" data-target="#demo-chat-body">Disconect</a></li>
							</ul>
						</div>
					</div>
					<h3 class="panel-title">Chat</h3>
				</div>

				<!--Widget body-->
				<div>
					<div class="nano" style="height:300px">
						<div class="nano-content pad-all">
							<ul class="list-unstyled media-block">


							</ul>
						</div>
					</div>

					<!--Widget footer-->
					<div class="panel-footer">
						<div class="row">
							<div class="col-xs-9">
								<input type="text" id="idtk" name="idtk" style="display:none">
								<input type="text" name="kategori_chat" id="kategori_chat" style="display:none" value="2">
								<input placeholder="Enter your text" class="form-control chat-input" type="text" id="isi" name="isi">
							</div>
							<div class="col-xs-3">
								<a class="btn btn-primary btn-block"  onClick="chat();return false;">Send</a>
							</div>
						</div>
					</div>

				</div>

			</div>
			<a style="margin-left:3px" class="btn btn-success" onclick="proses('84')"><i class="fa fa-file-excel-o"></i> Setujui dan kirim ke SDM</a>

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

	getJson(listchatAll,BASE_URL+'abk/abk/getchatall?id='+selectedRowsString);

}

function chat(){
	if(empty($('#isi').val())){
		alert('Tidakada text untuk dikirim');
		return false;
	}
	postFormMore('form-detail-pengajuan',BASE_URL+'abk/abk/chat',getchat);
	return false;
}

function getchat(){
	$('#isi').val('');
	getJson(listchat,BASE_URL+'abk/abk/getchat?kategori=2&id='+selectedRowsString);
}

function listchat(obj){
	var isi = '';
	var idgue = localStorage.getItem("id_user");
	$.each( obj.result, function( key, value ) {
//alert(value.isi);
if(idgue===value.id_user){
	isi+='<li class="mar-btm">';
	isi+='<div class="media-left">';
	isi+='<img src="img/profile-photos/1.png" class="img-circle img-sm" alt="Profile Picture">';
	isi+='</div>';
	isi+='<div class="media-body pad-hor">';
	isi+='<div class="speech">';
	isi+='<a href="#" class="media-heading">'+value.username+'</a>';
	isi+='<p>'+value.isi+'</p>';
	isi+='<p class="speech-time">';
	isi+='<i class="demo-pli-clock icon-fw"></i> '+value.tgl;
	isi+='</p>';
	isi+=' </div>';
	isi+='</div>';
	isi+='</li>';
}else{
	isi+='<li class="mar-btm">';
	isi+='<div class="media-right">';
	isi+='<img src="img/profile-photos/8.png" class="img-circle img-sm" alt="Profile Picture">';
	isi+='</div>';
	isi+='<div class="media-body pad-hor speech-right">';
	isi+='<div class="speech">';
	isi+=' <a href="#" class="media-heading">'+value.username+'</a>';
	isi+='<p>'+value.isi+'</p>';
	isi+='<p class="speech-time">';
	isi+='<i class="demo-pli-clock icon-fw"></i> '+value.tgl;
	isi+='</p>';
	isi+=' </div>';
	isi+='</div>';
	isi+='</li>';
}

});

	$( ".media-block" ).append( isi );
}

function listchatAll(obj){
	var isi = '';
	var idgue = localStorage.getItem("id_user");
	$.each( obj.result, function( key, value ) {
//alert(value.isi);
if(idgue===value.id_user){
	isi+='<li class="mar-btm">';
	isi+='<div class="media-left">';
	isi+='<img src="img/profile-photos/1.png" class="img-circle img-sm" alt="Profile Picture">';
	isi+='</div>';
	isi+='<div class="media-body pad-hor">';
	isi+='<div class="speech">';
	isi+='<a href="#" class="media-heading">'+value.username+'</a>';
	isi+='<p>'+value.isi+'</p>';
	isi+='<p class="speech-time">';
	isi+='<i class="demo-pli-clock icon-fw"></i> '+value.tgl;
	isi+='</p>';
	isi+=' </div>';
	isi+='</div>';
	isi+='</li>';
}else{
	isi+='<li class="mar-btm">';
	isi+='<div class="media-right">';
	isi+='<img src="img/profile-photos/8.png" class="img-circle img-sm" alt="Profile Picture">';
	isi+='</div>';
	isi+='<div class="media-body pad-hor speech-right">';
	isi+='<div class="speech">';
	isi+=' <a href="#" class="media-heading">'+value.username+'</a>';
	isi+='<p>'+value.isi+'</p>';
	isi+='<p class="speech-time">';
	isi+='<i class="demo-pli-clock icon-fw"></i> '+value.tgl;
	isi+='</p>';
	isi+=' </div>';
	isi+='</div>';
	isi+='</li>';
}

});

	$( ".media-block" ).append( isi );
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