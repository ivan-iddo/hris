<form id="form-pengajuan-detail"  method="post" role="form" class="form-horizontal pad-all">
<div class="row">
	<h3 class="nama_pengaju"></h3>
	<div class="col-lg-5 col-sm-offset-1">
		<h4>Persyaratan Jabatan</h4>
		<div class="form-group">
			<label class="col-sm-4 control-label" for="txtjabatan">Jabatan</label>
			<div class="col-sm-8">
				<input class="form-control" type="hidden" id="id_pengajuan" name="id_pengajuan" >
				<input class="form-control" type="text" id="txtjabatan" name="txtjabatan" style="border:none" readonly>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-4 control-label" for="masajbt">Masa Jabatan</label>
			<div class="col-sm-8">
				<input class="form-control" type="text" id="masajbt" name="masajbt" style="border:none" readonly>
			</div>
		</div>
		<div class="form-group">
	     <label class="col-sm-4 control-label" for="kompetensi">Standard Kompetesi</label>
	      <div class="col-sm-8">
	         <textarea placeholder="" class="form-control input-sm" id="kompetensi" name="kompetensi" type="text" style="border:none" readonly></textarea>
	    	</div>
	   </div>
		<div class="form-group">
			<label class="col-sm-4 control-label" for="formal">Pendidikan Formal</label>
			<div class="col-sm-8">
			 <input class="form-control" type="text" id="formal" name="formal" style="border:none" readonly>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-4 control-label" for="nonformal">Pendidikan Non Formal</label>
			<div class="col-sm-8">
				<textarea placeholder="" class="form-control input-sm" id="nonformal" name="nonformal" type="text" style="border:none" readonly></textarea>
		</div>
	   </div>
	   <div class="form-group">
			<label class="col-sm-4 control-label" for="txtjabatans">Jabatan Yang Telah Diemban</label>
			<div class="col-sm-8">
				<input class="form-control" type="text" id="txtjabatans" name="txtjabatans" style="border:none" readonly>
			</div>
		</div>
		  
	   <div class="form-group">
	     <label class="col-sm-4 control-label" for="tufoksi">Tufoksi</label>
	      <div class="col-sm-8">
	         <textarea placeholder="" class="form-control input-sm" id="tufoksi" name="tufoksi" type="text" style="border:none" readonly></textarea>
	     </div>
	   </div>

	</div>

	<div class="col-lg-5">
		<h4>Kompetensi Jabatan</h4>
		<!-- <div class="form-group">
			<label class="col-sm-4 control-label" for="txtjabatan">Jabatan</label>
			<div class="col-sm-8">
				
				<input class="form-control" type="text" id="txtjabatan" name="txtjabatan" style="border:none" readonly>
			</div>
		</div> -->
		<div class="form-group">
	     <label class="col-sm-4 control-label" for="status">Status</label>
	      <div class="col-sm-8">
	      	<input class="form-control" type="hidden" id="id_persyaratan" name="id_persyaratan" >
	         <select class="form-control input-sm" id="status" name="status">
	         	<option value="">-Pilih Status-</option>
	         	<option value="Sudah Sesuai">Sudah Sesuai</option>
	         	<option value="Dengan Syarat">Dengan Syarat</option>
	         	<option value="Tidak Sesuai">Tidak Sesuai</option>
	         </select>
	     </div>
	   </div>
		<div class="form-group">
			<label class="col-sm-4 control-label" for="masajbtpengaju">Masa Jabatan</label>
			<div class="col-sm-8">
				<input class="form-control" type="text" id="masajbtpengaju" name="masajbtpengaju" style="border:none" readonly>
			</div>
		</div>
		<div class="form-group">
	     <label class="col-sm-4 control-label" for="kompetensipengaju">Standard Kompetesi</label>
	      <div class="col-sm-8">
	         <textarea placeholder="" class="form-control input-sm" id="kompetensipengaju" name="kompetensipengaju" type="text" style="border:none" readonly></textarea>
	    	</div>
	   </div>
		<div class="form-group">
			<label class="col-sm-4 control-label" for="formalpengaju">Pendidikan Formal</label>
			<div class="col-sm-8">
			 <input class="form-control" type="text" id="formalpengaju" name="formalpengaju" style="border:none" readonly>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-4 control-label" for="nonformalpengaju">Pendidikan Non Formal</label>
			<div class="col-sm-8">
				<textarea placeholder="" class="form-control input-sm" id="nonformalpengaju" name="nonformalpengaju" type="text" style="border:none" readonly></textarea>
		</div>
	   </div>
	   <div class="form-group">
			<label class="col-sm-4 control-label" for="txtjabatanspengaju">Jabatan Yang Telah Diemban</label>
			<div class="col-sm-8">
				<input class="form-control" type="text" id="txtjabatanspengaju" name="txtjabatanspengaju" style="border:none" readonly>
			</div>
		</div>
		  
	   <div class="form-group">
	     <label class="col-sm-4 control-label" for="tufoksipengaju">Tufoksi</label>
	      <div class="col-sm-8">
	         <textarea placeholder="" class="form-control input-sm" id="tufoksipengaju" name="tufoksipengaju" type="text" style="border:none" readonly></textarea>
	     </div>
	   </div>

	   <div class="form-group">
	     <label class="col-sm-4 control-label" for="keterangan">Keterangan</label>
	      <div class="col-sm-8">
	         <textarea placeholder="" class="form-control input-sm" id="keterangan" name="keterangan" type="text"></textarea>
	     </div>
	   </div>
	</div>

</div>
</form>



<script>

 var idcell = getGridId(gridOptions_pengajuan,'id');
 $('#id_pengajuan').val(idcell);
  

    window.setTimeout(function(){
    if(!empty($('#id_pengajuan').val())){
    
        getJson(getdata_pengajuan, url_api2+'listdatadetail?id='+idcell);
    }
    },500);
    


function getdata_pengajuan(result){
    
   $('#id_pengajuan').val(result.result[0].id);
   $('#id_persyaratan').val(result.result[0].id_persyaratan);
   $('#txtjabatan').val(result.result[0].jabatan_baru);
   $('#masajbt').val(result.result[0].masa_jabatan_persyaratan);
   $('#kompetensi').val(result.result[0].kompetensi_persyaratan);
   $('#formal').val(result.result[0].formal_persyaratan);
   $('#nonformal').val(result.result[0].nonformal_persyaratan);
   $('#txtjabatans').val(result.result[0].jabatan_lama);
   $('#tufoksi').val(result.result[0].tufoksi_persyaratan);

   $('#masajbtpengaju').val(result.result[0].masa_jabatan);
   $('#kompetensipengaju').val(result.result[0].kompetensi);
   $('#formalpengaju').val(result.result[0].formal);
   $('#nonformalpengaju').val(result.result[0].nonformal);
   $('#txtjabatanspengaju').val(result.result[0].jabatan_lama);
   $('#tufoksipengaju').val(result.result[0].tufoksi);
   $('#status').val(result.result[0].status);
   $('#keterangan').val(result.result[0].keterangan);
}


</script>