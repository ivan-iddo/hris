 <div class="panel">
  <div class="panel-heading">
     <h3 class="panel-title"><i class="fa fa-users"></i> USERS</h3>
 </div>
 <div class="panel-body">
  <div class="bootstrap-table">
     <div style="padding: 2px;">
        <button onclick="onBtStartEditing()">edit (0)</button>
        <button onclick="onBtStartEditing(46)">edit (0, Delete)</button>
        <button onclick="onBtStartEditing(null, 'T')">edit (0, 'T')</button>
        <button onclick="onBtStartEditing(null, null, 'top')">edit (0, Top)</button>
        <button onclick="onBtStartEditing(null, null, 'bottom')">edit (0, Bottom)</button>
        &nbsp;
        &nbsp;
        &nbsp;
        <button onclick="onBtStopEditing()">stop ()</button>
        <button onclick="onBtNextCell()">next ()</button>
        <button onclick="onBtPreviousCell()">previous ()</button>
        &nbsp;
        &nbsp;
        &nbsp;
        <button onclick="onBtWhich()">which ()</button>
        <div class="fixed-table-container " style="padding-bottom: 0px;">
            <div id="myGrid" style="height: 400px;width:100%;" class="ag-theme-balham"></div>
        </div>
    </div>
</div>
</div>


<script type="text/javascript" charset="utf-8">
    var columnDefs = [
    { field: 'firstName', width: 100},
    { field: 'lastName', width: 100},
    { field: 'gender', width: 90},
    { field: 'age', width: 70},
    { field: 'mood', width: 70},
    { field: 'country', width: 100},
    { field: 'address', width: 200}
    ];

    var rowData = [
    { firstName: 'Bob', lastName: 'Harrison', gender: 'Male', address: '1197 Thunder Wagon Common, Cataract, RI, 02987-1016, US, (401) 747-0763', mood: 'Happy', country: 'Ireland'},
    { firstName: 'Mary', lastName: 'Wilson', gender: 'Female', age: 11, address: '3685 Rocky Glade, Showtucket, NU, X1E-9I0, CA, (867) 371-4215', mood: 'Sad', country: 'Ireland'},
    { firstName: 'Sadiq', lastName: 'Khan', gender: 'Male', age: 12, address: '3235 High Forest, Glen Campbell, MS, 39035-6845, US, (601) 638-8186', mood: 'Happy', country: 'Ireland'},
    { firstName: 'Jerry', lastName: 'Mane', gender: 'Male', age: 12, address: '2234 Sleepy Pony Mall , Drain, DC, 20078-4243, US, (202) 948-3634', mood: 'Happy', country: 'Ireland'},
    { firstName: 'Bob', lastName: 'Harrison', gender: 'Male', address: '1197 Thunder Wagon Common, Cataract, RI, 02987-1016, US, (401) 747-0763', mood: 'Happy', country: 'Ireland'},
    { firstName: 'Mary', lastName: 'Wilson', gender: 'Female', age: 11, address: '3685 Rocky Glade, Showtucket, NU, X1E-9I0, CA, (867) 371-4215', mood: 'Sad', country: 'Ireland'},
    { firstName: 'Sadiq', lastName: 'Khan', gender: 'Male', age: 12, address: '3235 High Forest, Glen Campbell, MS, 39035-6845, US, (601) 638-8186', mood: 'Happy', country: 'Ireland'},
    { firstName: 'Jerry', lastName: 'Mane', gender: 'Male', age: 12, address: '2234 Sleepy Pony Mall , Drain, DC, 20078-4243, US, (202) 948-3634', mood: 'Happy', country: 'Ireland'},
    { firstName: 'Bob', lastName: 'Harrison', gender: 'Male', address: '1197 Thunder Wagon Common, Cataract, RI, 02987-1016, US, (401) 747-0763', mood: 'Happy', country: 'Ireland'},
    { firstName: 'Mary', lastName: 'Wilson', gender: 'Female', age: 11, address: '3685 Rocky Glade, Showtucket, NU, X1E-9I0, CA, (867) 371-4215', mood: 'Sad', country: 'Ireland'},
    { firstName: 'Sadiq', lastName: 'Khan', gender: 'Male', age: 12, address: '3235 High Forest, Glen Campbell, MS, 39035-6845, US, (601) 638-8186', mood: 'Happy', country: 'Ireland'},
    { firstName: 'Jerry', lastName: 'Mane', gender: 'Male', age: 12, address: '2234 Sleepy Pony Mall , Drain, DC, 20078-4243, US, (202) 948-3634', mood: 'Happy', country: 'Ireland'},
    { firstName: 'Bob', lastName: 'Harrison', gender: 'Male', address: '1197 Thunder Wagon Common, Cataract, RI, 02987-1016, US, (401) 747-0763', mood: 'Happy', country: 'Ireland'},
    { firstName: 'Mary', lastName: 'Wilson', gender: 'Female', age: 11, address: '3685 Rocky Glade, Showtucket, NU, X1E-9I0, CA, (867) 371-4215', mood: 'Sad', country: 'Ireland'},
    { firstName: 'Sadiq', lastName: 'Khan', gender: 'Male', age: 12, address: '3235 High Forest, Glen Campbell, MS, 39035-6845, US, (601) 638-8186', mood: 'Happy', country: 'Ireland'},
    { firstName: 'Jerry', lastName: 'Mane', gender: 'Male', age: 12, address: '2234 Sleepy Pony Mall , Drain, DC, 20078-4243, US, (202) 948-3634', mood: 'Happy', country: 'Ireland'},
    { firstName: 'Bob', lastName: 'Harrison', gender: 'Male', address: '1197 Thunder Wagon Common, Cataract, RI, 02987-1016, US, (401) 747-0763', mood: 'Happy', country: 'Ireland'},
    { firstName: 'Mary', lastName: 'Wilson', gender: 'Female', age: 11, address: '3685 Rocky Glade, Showtucket, NU, X1E-9I0, CA, (867) 371-4215', mood: 'Sad', country: 'Ireland'},
    { firstName: 'Sadiq', lastName: 'Khan', gender: 'Male', age: 12, address: '3235 High Forest, Glen Campbell, MS, 39035-6845, US, (601) 638-8186', mood: 'Happy', country: 'Ireland'},
    { firstName: 'Jerry', lastName: 'Mane', gender: 'Male', age: 12, address: '2234 Sleepy Pony Mall , Drain, DC, 20078-4243, US, (202) 948-3634', mood: 'Happy', country: 'Ireland'},
    { firstName: 'Bob', lastName: 'Harrison', gender: 'Male', address: '1197 Thunder Wagon Common, Cataract, RI, 02987-1016, US, (401) 747-0763', mood: 'Happy', country: 'Ireland'},
    { firstName: 'Mary', lastName: 'Wilson', gender: 'Female', age: 11, address: '3685 Rocky Glade, Showtucket, NU, X1E-9I0, CA, (867) 371-4215', mood: 'Sad', country: 'Ireland'},
    { firstName: 'Sadiq', lastName: 'Khan', gender: 'Male', age: 12, address: '3235 High Forest, Glen Campbell, MS, 39035-6845, US, (601) 638-8186', mood: 'Happy', country: 'Ireland'},
    { firstName: 'Jerry', lastName: 'Mane', gender: 'Male', age: 12, address: '2234 Sleepy Pony Mall , Drain, DC, 20078-4243, US, (202) 948-3634', mood: 'Happy', country: 'Ireland'},
    ];

    function getPinnedTopData() {
        return [
        { firstName: '##', lastName: '##', gender: '##', address: '##', mood: '##', country: '##'}
        ];
    }

    function getPinnedBottomData() {
        return [
        { firstName: '##', lastName: '##', gender: '##', address: '##', mood: '##', country: '##'}
        ];
    }

    var gridOptions = {
        columnDefs: columnDefs,
        rowData: rowData, 
        onRowClicked: RowClickEventHandler,
        suppressRowClickSelection: true, 
        enableColResize: true,
        pinnedTopRowData: getPinnedTopData(),
        pinnedBottomRowData: getPinnedBottomData(),
        onCellValueChanged: function(params) {
            var colId = params.column.getId();
	// var cellDefs = gridOptions.api.getEditingCells();
 
	
  alert(params.data.firstName);
},
defaultColDef: {
    editable: true
},
onGridReady: function(params) {
    params.api.sizeColumnsToFit();
},
onRowEditingStarted: function(event) {
    alert('never called - not doing row editing');
},
onRowEditingStopped: function(event) {
    alert('never called - not doing row editing');
},
onCellEditingStarted: function(event) {
    alert('cellEditingStarted');
},
onCellEditingStopped: function(event) {
    alert('cellEditingStopped');
}
};

function onBtStopEditing() {
    gridOptions.api.stopEditing();
}

function onBtStartEditing(key, char, pinned) {
    gridOptions.api.setFocusedCell(0, 'lastLame', pinned);

    gridOptions.api.startEditingCell({
        rowIndex: 0,
        colKey: 'lastName',
        // set to 'top', 'bottom' or undefined
        rowPinned: pinned,
        keyPress: key,
        charPress: char
    });
}

function getCharCodeFromEvent(event) {
    event = event || window.event;
    return typeof event.which === 'undefined' ? event.keyCode : event.which;
}

function isCharNumeric(charStr) {
    return !!/\d/.test(charStr);
}

function isKeyPressedNumeric(event) {
    var charCode = getCharCodeFromEvent(event);
    var charStr = String.fromCharCode(charCode);
    return isCharNumeric(charStr);
}

function onBtNextCell() {
    gridOptions.api.tabToNextCell();
}

function onBtPreviousCell() {
    gridOptions.api.tabToPreviousCell();
}

function onBtWhich() {
    let cellDefs = gridOptions.api.getEditingCells();
    if (cellDefs.length>0) {
        var cellDef = cellDefs[0];
        alert('editing cell is: row = ' + cellDef.rowIndex + ', col = ' + cellDef.column.getId()
            + ', floating = ' + cellDef.floating);
    } else {
        alert('no cells are editing');
    }
}

function RowClickEventHandler(event){
    if(event.node.isSelected()){
      console.log("deselected");
      event.node.setSelected(false, false);
  } else {
      event.node.setSelected(true);
      console.log("selected, add");
  }

}

// setup the grid after the page has finished loading 
var gridDiv = document.querySelector('#myGrid');
new agGrid.Grid(gridDiv, gridOptions);

</script>
<script src="js/login.js"></script>