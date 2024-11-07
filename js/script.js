

$(document).ready(function () {
  $(".data-table").each(function (_, table) {
    $(table).DataTable();
  });
  	
	$(document).on('click','.close', function(event){

		$('.modal').modal('hide');
				
		
	});
});
