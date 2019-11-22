$(document).ready(function () {
  $('#datatable').DataTable();

  var table = $('#datatable-buttons').DataTable({
    buttons: ['copy', 'excel'],
    lengthChange: true,
    bFilter: false,

  });

  $('#key-table').DataTable({
    keys: true
  });

  $('#responsive-datatable').DataTable();

  $('#selection-datatable').DataTable({
    select: {
      style: 'multi'
    }
  });

  table.buttons().container()
    .appendTo('#datatable-buttons_wrapper .col-md-6:eq(0)');

});