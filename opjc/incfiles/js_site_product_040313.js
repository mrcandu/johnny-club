// JavaScript Document

$(document).ready(function() {



$('#prd_item_id').change(function() {

$('#item' + selection).hide();

$('#itemimg' + selection).hide();

selection = $(this).val();

update_img(selection);

});



var selection = $("#prd_item_id").val();

update_img(selection);



$('.item_image_list a').click(function() {



$("#prd_img").attr({

  src:this.href,

  title:this.title,

  alt:this.title

});



return false;

});



});



function update_img(selection){

$('#item' + selection).show();

$('#itemimg' + selection).show();

$('#itemimg' + selection +' li a').each(function() {

(new Image).src = this.href;

});



$('#itemimg' + selection +' li:first-child a').each(function() {



/*$("#prd_image").html($("<img>").attr("src", this.href));*/



$("#prd_img").attr({

  src:this.href,

  title:this.title,

  alt:this.title

});



});



$('#gj').hide();

$('#get_jiggy').show();

$('#get_jiggy').bind('click', function()

{
	$("#vcher").val($("#vcherval").val());
	$('#prd_frm').submit();
	

	return false;

});

$('#get_vcher').bind('click', function()
{
	if($('#vcherval').val() != 'Voucher Code' && $('#vcherval').val() != '') {
  		$.get("http://onepoundjohnnyclub.com/voucher.php",{vcher:$("#vcherval").val()},function(ret,status){
   		$('#vresult').html(ret);
  		});		
	}
		
	return false;
});


$("input").keypress(function(event) {

    if (event.which == 13) {

        event.preventDefault();

       $('#prd_frm').submit();

    }

});

$('#vcherval').focus(function() {

	if($('#vcherval').val() == 'Voucher Code') {

    $('#vcherval').val('')

	}

});



$('#vcherval').blur(function() {

	if($('#vcherval').val() == '') {

    $('#vcherval').val('Voucher Code')

	}

});

}