// JavaScript Document

$(document).ready(function() {



$('#add_address').bind('click', function(){

	$('#add_address_frm').submit();

	return false;

});



if($('#add_list').length != 0)

{

$('#address').hide();

}

else

{

$('#new').hide();

}

$('#add_address_frm')[0].reset();



	



if ($("#address_error").length>0) {

    $('#address').show();

}





$('#show_add_address_frm').bind('click', function(){

	$('#address').slideToggle();

	/*$(':input','#add_address_frm').val('');*/

	return false;

});





if($("input[@name=add_id]:checked").val()){

$('#get_jiggy').show();

$('#get_jiggy').bind('click', function(){

	$('#get_jiggy_frm').submit();

	return false;

});

$("input").keypress(function(event) {

    if (event.which == 13) {

        event.preventDefault();

       $('#get_jiggy_frm').submit();

    }

});

}



else

{
$('#pp_logo').hide();
$('#get_jiggy').hide();

}



});



