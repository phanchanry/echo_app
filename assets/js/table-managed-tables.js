var tableManaged = function () {

    return {

        init: function () {
            oTable = $('#example1').dataTable();

            /* Add a click handler to the rows - this could be used as a callback */
            $("#example1 tbody").click(function(event) {
                $(oTable.fnSettings().aoData).each(function (){
                    $(this.nTr).removeClass('row_selected');
                });
                $(event.target.parentNode).addClass('row_selected');
            });
        }
    };

}();
/* Global var for counter */
var giCount = 1;
function fnClickAddRow() {
    $('#example1').dataTable().fnAddData( [
        giCount+".1",
        giCount+".2",
        giCount+".3",
        giCount+".4",
        giCount+".5" ] );

    giCount++;
}

// BEGIN BUTTON DELETE ROW
/* Add a click handler to the rows - this could be used as a callback */
$("#example tbody tr").click( function( e ) {
    if ( $(this).hasClass('row_selected') ) {
        $(this).removeClass('row_selected');
    }
    else {
        oTable.$('tr.row_selected').removeClass('row_selected');
        $(this).addClass('row_selected');
    }
});

/* Add a click handler for the delete row */
$('#delete').click( function() {
    var anSelected = fnGetSelected( oTable );
    if ( anSelected.length !== 0 ) {
        oTable.fnDeleteRow( anSelected[0] );
    }
} );
/* Get the rows which are currently selected */
function fnGetSelected( oTableLocal )
{
    return oTableLocal.$('tr.row_selected');
}
// END BUTTON DELETE ROW