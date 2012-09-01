// JavaScript Document
$(document).ready(function() {

$('#dummy_pass').show();
$('#cust_pass').hide();

$('#dummy_pass').focus(function() {
    $('#dummy_pass').hide();
    $('#cust_pass').show();
    $('#cust_pass').focus();
});

$('#cust_pass').blur(function() {
    if($('#cust_pass').val() == '') {
        $('#dummy_pass').show();
        $('#cust_pass').hide();
    }
});

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
				   
});