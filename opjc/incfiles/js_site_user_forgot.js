// JavaScript Document
$(document).ready(function() {

$('#cust_email').focus(function() {
	if($('#cust_email').val() == 'Email') {
    $('#cust_email').val('')
	}
});

$('#cust_email').blur(function() {
	if($('#cust_email').val() == '') {
    $('#cust_email').val('Email')
	}
});

$('#get_jiggy').bind('click', function()
{
	$("#spm").val($("#spm2").val());
	$('#user_frm').submit();
	return false;
});

$("input").keypress(function(event) {
    if (event.which == 13) {
        event.preventDefault();
       $('#user_frm').submit();
    }
});
				   
});