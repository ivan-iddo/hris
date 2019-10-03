<div class="panel" style="border:none">
 
  <!--Accordion title-->
  <div class="panel-heading">
    <h4 class="panel-title">
      <a data-parent="#accordion" data-toggle="collapse" href="#collapseOne" aria-expanded="true" class="text-warning"><i class="fa fa-folder"></i> Data Pegawai</a>
    </h4>
  </div>
  
  <div class="panel-collapse collapse in" id="collapseOne" aria-expanded="true" style="">
    <div class="panel-body pad-all">
      <div class="dataTables_wrapper form-inline dt-bootstrap no-footer" id="demo-dt-addrow_wrapper">
       
        <div class="dataTables_filter" id="demo-dt-addrow_filter">
          <label>Search:<input aria-controls="demo-dt-addrow" class="form-control input-sm" placeholder="" type="search" id="searchPegawai" onkeydown="if(event.keyCode=='13'){loaddata(0);}" ></label>

        </div>
        
      </div>
      <div class="bootstrap-table">
        <div class="fixed-table-container" style="padding-bottom: 0px;">
          <div class="ag-theme-balham" id="gridSearchPegawai" style="height: 300px;width:100%;">
          </div>

          <div class="paging pull-right mar-all"> 
          </div>
          
        </div>
      </div>
    </div>
  </div>
</div>
</div>


<script charset="utf-8" type="text/javascript">
  $('.judul-menu').html('Data Pegawai');
//<![CDATA[
           // specify the columns
           var ColPegawaiSearch = [
           {headerName: "NIP", field: "nip", width: 190, filterParams:{newRowsAction: 'keep'}},
           {headerName: "NIK", field: "nik", width: 190, filterParams:{newRowsAction: 'keep'}},
           {headerName: "Nama", field: "nama", width: 190, filterParams:{newRowsAction: 'keep'}},
           {headerName: "Devisi", field: "nama_group", width: 190, filterParams:{newRowsAction: 'keep'}},
           {headerName: "Jabatan", field: "nama_uk", width: 190, filterParams:{newRowsAction: 'keep'}},
           {headerName: "Username", field: "username", width: 190, filterParams:{newRowsAction: 'keep'}},
           {headerName: "E-Mail", field: "email", width: 190, filterParams:{newRowsAction: 'keep'}},
           
           ];

           var autoGroupColumnDef = {
             headerName: "Group",
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

         var gridSearchPegawai = {
           enableSorting: true,
           enableFilter: true,
           suppressRowClickSelection: false, 
           onRowClicked: Profile,
           groupSelectsChildren: true,
           debug: true,
           rowSelection: 'single',
           enableColResize: true,
           rowGroupPanelShow: 'always',
           pivotPanelShow: 'always',
           enableRangeSelection: true,
           columnDefs: ColPegawaiSearch,
           pagination: false,
           paginationPageSize: 50,
           autoGroupColumnDef: autoGroupColumnDef,
           defaultColDef:{
             editable: false,
             enableRowGroup:true,
             enablePivot:true,
             enableValue:true
           }
         };

        // setup the grid after the page has finished loading 
        var gridDiv = document.querySelector('#gridSearchPegawai');
        new agGrid.Grid(gridDiv, gridSearchPegawai);

           // do http request to get our sample data - not using any framework to keep the example self contained.
           // you will probably use a framework like JQuery, Angular or something else to do your HTTP calls.
           function Profile(){
             
             var selectedRows = gridSearchPegawai.api.getSelectedRows();
            // alert('>>'+selectedRows+'<<<');
            if(selectedRows == ''){
             onMessage('Silahkan Pilih Pegawai Terlebih dahulu!');
             return false;
           }else{
            var selectedRowsString = '';
            var nip='';
            var nama='';
            var id_grup='';
            var id_user='';
            var id_jab='';
            var nama_group ='';
            selectedRows.forEach( function(selectedRow, index) {
              
             if (index!==0) {
               selectedRowsString += ', ';
             }
             selectedRowsString += selectedRow.nip;
             nip += selectedRow.nip;
             nama += selectedRow.nama;
             id_grup += selectedRow.id_grup;
             id_user += selectedRow.id;
             id_jab += selectedRow.id_jab;
             nama_group +=  selectedRow.nama_group;
           });
            
            $('#nama_pegawai').val(nama);
            $('#nip').val(nip);
            $('#id_grup').val(id_grup);
            $('#id_user').val(id_user);
            $('#id_jab').val(id_jab);
            $('.modal').modal('hide');
            $('#uk').val(nama_group);
            
          }
          
          
          
        }
        
        function loaddata(jml){
          var search = 0;
          var group = localStorage.getItem("group");
          var url = BASE_URL + 'kpi/mpenilaian/listuserunitk/' + search + '/' + jml;
          
          if($('#searchPegawai').val() !==''){
            search = $('#searchPegawai').val();
            url = BASE_URL + 'kpi/mpenilaian/listuserunitk/' + search + '/' + jml ;
          }
          
          if ((group !== '1') && (group !== '6')) {
            url = BASE_URL + 'kpi/mpenilaian/listuserunitk/' + search + '/' + jml + "/" + group;
          }
          $.ajax({
           url: url,
           headers: {
             'Authorization': localStorage.getItem("Token"),
             'X_CSRF_TOKEN':'donimaulana',
             'Content-Type':'application/json'
           },
           dataType: 'json',
           type: 'get',
           contentType: 'application/json', 
           processData: false,
           
           success: function( data, textStatus, jQxhr ){
            
            
            gridSearchPegawai.api.setRowData(data.result);
            paging(data.total,'loaddata');
          },
          error: function( jqXhr, textStatus, errorThrown ){
           alert('error');
         }
       });

        }
        
        loaddata(0);

      </script><script src="js/login.js" type="text/javascript">
      </script>
      
