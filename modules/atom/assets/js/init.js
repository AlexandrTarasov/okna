$(document).ready(function(){
	$('body > .px-nav').pxNav();
    $('body > .px-footer').pxFooter();

    $('[data-toggle="tooltip"]').tooltip({container: "body"})
    $('[data-toggle="popover"]').popover();
	$('.j-datepicker').datepicker({format: 'yyyy-mm-dd', todayHighlight: true});			
	$("select.j-select2").select2();	
	$('.j-tableFilterable').tableFilterable();	

	if($('.j-atom-clock').length)
	{
		var atomVar = setInterval(function() {
		  AtomClock();
		}, 1000);
		
		function AtomClock() {
		  var d = new Date();
		  $(".j-atom-clock").text(d.toLocaleTimeString());
		}
		
	}	

});



$('.j-delete_item').click(function(e){
	e.preventDefault();
    var btn = $(this);
    swal({   
        title: "Are you sure?",   
        text: "You will not be able to recover this record!",   
        type: "warning",   
        showCancelButton: true,   
        confirmButtonColor: "#DD6B55",   
        confirmButtonText: "Yes, delete it!",   
        cancelButtonText: "No, cancel plz!",   
        closeOnConfirm: false,   
        closeOnCancel: true 
    }, function(isConfirm){   
        if (isConfirm) {     
            $.post(btn.attr('href'));
            swal({title: "Deleted!", text: "Your item has been deleted.", type: "success", timer: 1000, showConfirmButton: false}); 
            $(btn).parents('tr').hide();  
        } 
    });
    
});


$('.j-tableSelecteble').on('change', 'thead th:first input[type="checkbox"]', function(){
    var check = $(this).prop('checked');	
    var table = $(this).parents('table');
    table.find('tbody input[type="checkbox"]').prop('checked', check).trigger('change');
});


$('.j-delete_multiply').click(function(e){
	e.preventDefault();
    var btn = $(this);
	var items = get_checked_items();
	if(items.length > 0){	
	    swal({   
	        title: "Delete items",   
	        text: "You will not be able to recover this records!",   
	        type: "warning",   
	        showCancelButton: true,   
	        confirmButtonColor: "#DD6B55",   
	        confirmButtonText: "Yes, delete!",   
	        cancelButtonText: "No, cancel plz!",   
	        closeOnConfirm: false,   
	        closeOnCancel: true 
	    }, function(isConfirm){   
	        if (isConfirm) {     
	            $.post(btn.attr('href'), {items: items});
	            swal({title: "Deleted!", text: "Items was deleted.", type: "success", timer: 1000, showConfirmButton: false}, function(isConfirm)
	            {
		           window.location.href = ''; 
	            }); 
	            
	        } 
	    });
    }
});

$('.j-multiply_submit').click(function(e){
	e.preventDefault();
    var btn = $(this);
	var items = get_checked_items();
	
	if(items.length > 0){	
		 var form = $('<form action="'+btn.attr('href')+'" id="multiform" method="POST">' + 
	    '<input type="hidden" name="items" value="' + items + '">' +
	    '</form>');		
	    
	    $('body').append(form);
	    $('#multiform').submit();		
    }

	return false;
});


function get_checked_items()
{
	var rows = $('.j-tableSelecteble tbody tr');
	var items = [];	 // all client parts from our order table
	for(var i=0;i<rows.length;i++){	
		
		if(rows.eq(i).find("td:eq(0) input").is(":checked")) items.push(rows.eq(i).data("id"));
		
		console.log(rows.eq(i).data("id"));
	}
	
	return items;
}


/**
* Modal view
*/
$('[data-toggle="mainmodal"]').on('click', function(){
  var url = $(this).attr('href');

 $.post(url, function(data){
        $('#mainModal').modal();
        $('#mainModal .modal-content').html(data);
        
	    $('[data-toggle="tooltip"]').tooltip({container: "body"})
	    $('[data-toggle="popover"]').popover();
	    $('.j-datepicker').datepicker({format: 'yyyy-mm-dd', todayHighlight: true});			
		$("select.j-select2").select2();	
		
 }, 'json')
 		  
  return false;
}); 


