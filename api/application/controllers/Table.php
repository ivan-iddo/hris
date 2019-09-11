<?php 





/*
* Changes:
* 1. This project contains .htaccess file for windows machine.
*    Please update as per your requirements.
*    Samples (Win/Linux): http://stackoverflow.com/questions/28525870/removing-index-php-from-url-in-codeigniter-on-mandriva
*
* 2. Change 'encryption_key' in application\config\config.php
*    Link for encryption_key: http://jeffreybarke.net/tools/codeigniter-encryption-key-generator/
* 
* 3. Change 'jwt_key' in application\config\jwt.php
*
*/

class Table extends CI_Controller
{
/**
* URL: http://localhost/CodeIgniter-JWT-Sample/auth/token
* Method: GET
*/ 

function arraypostdata($id){
	$fields = $this->db->field_data($id);
	echo 'array(';
	foreach ($fields as $field)
	{
		echo "'".$field->name."'=> \$this->input->post('".$field->name."'),<br>"; 
	}

	echo ')';
}

function arraygetdata($id){
	$fields = $this->db->field_data($id);
	echo 'array(';
	foreach ($fields as $field)
	{
		echo "'".$field->name."'=> \$dat->".$field->name.",<br>"; 
	}

	echo ')';

	echo $fields[0]->name; 
}


function editdata($id){
	$fields = $this->db->field_data($id);

	foreach ($fields as $field)
	{ 
		echo "\$('#".$field->name."').val(result.data.".$field->name.");  <br>";
	}


}

function filter($id){
	$fields = $this->db->field_data($id);
//echo 'array(';
	$res ='';
	foreach ($fields as $field)
	{
		$res .=  "if(empty($('#".$field->name."').val())){
			<br>onMessage('Data  is required'); 
			<br>return false;
			<br>}else "; 
		}

		echo $res;
	}


	function form($id){
		$fields = $this->db->field_data($id);
//echo 'array(';
		$res ='';
		foreach ($fields as $field)
		{
			$res .=  '<div class="row mar-all"> 
			<div class="form-group">
			<label class="col-sm-2 control-label" for="inputstatus">'.str_replace('_',' ',$field->name).'</label>
			<div class="col-sm-7">
			<input type="text" name="'.$field->name.'" id="'.$field->name.'" class="form-control"/>
			</div>

			</div> 
			</div>'; 
		}



		echo $res;
	}

	function header($id){
		$fields = $this->db->field_data($id);
//echo 'array(';
		$res =' <pre>var columnDefs = [';
		foreach ($fields as $field)
		{
			$res .=  '{headerName: "'.str_replace('_',' ',$field->name).'", field: "'.$field->name.'", width: 190, filterParams:{newRowsAction: "keep"}},<br>'; 
		}

		$res .='];';

		$res .=" 

		<br><p>
		var autoGroupColumnDef = {
			headerName: 'Group',
			width: 200,
			field: 'nama_group',
			valueGetter: function(params) {
				if (params.node.group) {
					return params.node.key;
					} else {
						return params.data[params.colDef.field];
					}
					},
					headerCheckboxSelection: true,
// headerCheckboxSelectionFilteredOnly: true,
					cellRenderer:'agGroupCellRenderer',
					cellRendererParams: {
						checkbox: true
					}
				};

				var Gridform2 = {
					enableSorting: true,
					enableFilter: true,
					suppressRowClickSelection: false, 
					groupSelectsChildren: true,
					debug: true,
					rowSelection: 'single', 
					enableColResize: true, 
					rowGroupPanelShow: 'always',
					pivotPanelShow: 'always',
					enableRangeSelection: true,
					columnDefs: headerform2,
					pagination: false,
					paginationPageSize: 50,   
					defaultColDef:{
						editable: true,
						enableRowGroup:true,
						enablePivot:true,
						enableValue:true
						},
						onGridReady: function (params) {
							params.api.sizeColumnsToFit();
						}
					};



// setup the grid after the page has finished loading 
					var gridDiv = document.querySelector('#Gridform2');
					new agGrid.Grid(gridDiv, Gridform2);

					function listFrom2(){
						var thn= $('#thnfrm2').val(); 
						var shift =  $('#shiftpeg').val();
						var uri = BASE_URL+'abk/abk/listform2?year='+thn;
						if(empty(thn)){
							var d = new Date();
							var n = d.getFullYear();
							thn = n;
						}

						if(!empty(shift)){
							uri = BASE_URL+'abk/abk/listform2?year='+thn+'&id_shift='+shift;
						}

						$('#thnfrm2').val(thn);

						getJson(loadform2,uri);
					}

					function loadform2(result){
						if(result.hasil ==='success'){
							Gridform2.api.setRowData(result.result);
							}else{
								Gridform2.api.setRowData([]);
							}
						}

						listFrom2();

						function searchfrm2(){
							var thn=$('#thnfrm2').val();
							var uk=$('#txtdirektorat').val();
							var group = localStorage.getItem('group');
							var uri = BASE_URL+'abk/abk/listform2?year='+thn;
							var shift =  $('#shiftpeg').val();
							if(empty(thn)){
								alert('Tahun harus dipilih');
								return false;
							}

							if(!empty(shift)){
								uri = BASE_URL+'abk/abk/listform2?year='+thn+'&id_shift='+shift;
							}

							getJson(loadform2,uri);
						}

						function downloadform2(){
							var params = { 
								fileName: 'form2',
								sheetName: 'form2'
							};

							Gridform2.api.exportDataAsExcel(params);
						}
						";

						echo $res;
					}


					function getchild($id,$idd){
						$this->db->where('child',$id);
						$this->db->where('tampilkan','1');
						$res = $this->db->get('sys_grup_user')->row();
						if(!empty($res->child)){
							$idd.=$res->id_grup.',';
							return $this->getchild($res->id_grup,$idd);

						}else{
							return  $idd;
						}
					}

					function child(){
						echo $this->getchild('30','');
					}

				}