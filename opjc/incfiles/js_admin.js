// JavaScript Document
$(document).ready(function() {
/*
$("select").uniform();
$("input").uniform();
*/
$('.menu > li').bind('mouseover', openSubMenu);
$('.menu > li').bind('mouseout', closeSubMenu);
		
function openSubMenu() {
$(this).find('ul').css('visibility', 'visible');	
};
		
function closeSubMenu() {
$(this).find('ul').css('visibility', 'hidden');	
};
				   
});