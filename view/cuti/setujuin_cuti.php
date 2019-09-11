<?php
require_once('../../connectdb.php');

?>


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
											<span id="jum" class="text-2x text-semibold text-main">
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
							<th>Action</th>
						</tr>
					</thead>
					<tbody id="isicuti">

					</tbody>
				</table>
			</div>

		</div>
	</div>

</div>
<script>
$('.judul-menu').html('Persetujuan Cuti'); 


listcuti();
function listcuti(){
$.ajax({
	url: BASE_URL+'cuti/listcutiall/',
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
		$('#jum').html(res.jum);

	}
});
}


function prosesCuti(idcuti,status){
var id_user = '<?php echo $_SESSION['userdata']['id'];?>';
swal({
	title: 'Apakah Anda Yakin Mengubah Data Ini?',
	text: 'Data segera di proses!',
	type: "warning",
	confirmButtonColor: '#d9534f',
	confirmButtonText: "Ya, Segera proses!",
	showCancelButton: true,
},function(){
	$.ajax({
		url: BASE_URL+'cuti/beristratuscuti/?id='+idcuti+'&status='+status+'&id_user='+id_user,
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
			listcuti();

		}
	});
});
return false;
}
</script>