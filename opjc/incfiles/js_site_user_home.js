// JavaScript Document
$(document).ready(function() {

	$('.padblk').each(function() {
		
		/*dhide(this.id)*/
		
		var $mat = this.id;

		$("#tog_hide_"+$mat).mousedown(function() {
			dhide($mat);
		});
				
		$("#tog_show_"+$mat).mousedown(function() {
			dshow($mat,2);
		});
		
		$("#can_"+$mat).click(function() {
			cshow($mat);
			return false;
		});
		
	});
	
	dshow($('.padblk:first').attr('id'),1);
	
});

function dshow(div,mat2){

	if(mat2>1)
 	{
    $("#"+div+" .det").slideToggle();
  	}
	else
  	{
  	$("#"+div+" .det").show();
  	}
  
	$("#tog_show_"+div).hide();
	$("#tog_hide_"+div).show();
}

function dhide(div){
	$("#"+div+" .det").slideToggle();
	$("#tog_show_"+div).show();
	$("#tog_hide_"+div).hide();
}

function cshow(div){
  	$("#ccan_"+div).slideToggle(); 
	if($("#can_"+div).attr('value')=="Cancel")
	{
	$("#can_"+div).attr('value','Noooooo!!'); 
	}
	else
	{
	$("#can_"+div).attr('value','Cancel');
	}
}