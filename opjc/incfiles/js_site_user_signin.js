// JavaScript Document
$(document).ready(function() {

$('#dummy_pass').show();
$('#cust_pass').hide();

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

$('#cust_pass').blur(function() {
    if($('#cust_pass').val() == '') {
        $('#dummy_pass').show();
        $('#cust_pass').hide();
    }
});

$('#dummy_pass').focus(function() {
    $('#dummy_pass').hide();
    $('#cust_pass').show();
    $('#cust_pass').focus();
});

	
$("input[name='cust_type']").change(function() {
            if ($("input[name='cust_type']:checked").val() == '1'){
                $("#cust_pass").attr("disabled",true);
				$("#dummy_pass").attr("disabled",true);
				$("#cust_pass").css("background-color","#eee");
				$("#dummy_pass").css("background-color","#eee");

			}
            else if ($("input[name='cust_type']:checked").val() == '2'){
                $("#cust_pass").removeAttr("disabled");
				$("#dummy_pass").removeAttr("disabled");
				$("#cust_pass").css("background-color","white");
				$("#dummy_pass").css("background-color","white");
			}
});

});