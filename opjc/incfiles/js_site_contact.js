// JavaScript Document
$(document).ready(function() {

$('#enq_forename').focus(function() {
	if($('#enq_forename').val() == 'Forename') {
    $('#enq_forename').val('')
	}
});

$('#enq_forename').blur(function() {
	if($('#enq_forename').val() == '') {
    $('#enq_forename').val('Forename')
	}
});

$('#enq_surname').focus(function() {
	if($('#enq_surname').val() == 'Surname') {
    $('#enq_surname').val('')
	}
});

$('#enq_surname').blur(function() {
	if($('#enq_surname').val() == '') {
    $('#enq_surname').val('Surname')
	}
});

$('#enq_email').focus(function() {
	if($('#enq_email').val() == 'Email') {
    $('#enq_email').val('')
	}
});

$('#enq_email').blur(function() {
	if($('#enq_email').val() == '') {
    $('#enq_email').val('Email')
	}
});


$('#enq_enq').focus(function() {
	if($('#enq_enq').val() == 'Enquiry') {
    $('#enq_enq').val('')
	}
});

$('#enq_enq').blur(function() {
	if($('#enq_enq').val() == '') {
    $('#enq_enq').val('Enquiry')
	}
});

$('#get_jiggy').bind('click', function()
{
	/*
	if($("input[name=enq_check2]").is(':checked'))
	{
	$("input[name=enq_check]").val(1);
	}
	*/
	
	$("#spm").val($("#spm2").val());
	$('#user_frm').submit();
});


$("input").keypress(function(event) {
    if (event.which == 13) {
        event.preventDefault();
       $('#user_frm').submit();
    }
});
				   
});