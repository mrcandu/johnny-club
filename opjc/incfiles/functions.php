<?php
function texttohtml($txt)
{
$txt = trim($txt);
$txt = preg_replace('/\ \ +/', ' ', $txt);
$txt = htmlspecialchars($txt);
$eol = ( strpos($txt,"\r") === FALSE ) ? "\n" : "\r\n";
$html = '<p>'.str_replace("$eol$eol","</p><p>",$txt).'</p>';
$html = str_replace("$eol","<br />\n",$html);
$html = str_replace("</p>","</p>\n\n",$html);
$html = str_replace("<p></p>","<p>&nbsp;</p>",$html);
$html = substr($html,0,-2);
return $html;
}

function htmltotext($str)
{
if($str!="")
{
$str = strip_tags($str);
$str = htmlspecialchars_decode($str);
return $str;
}
else
{
return $str;
}
}

function createlink($link)
{
$link = strtolower($link);
$link = trim($link);
$link = preg_replace('/\s\s+/', ' ', $link);
$link = str_replace(" ","-",$link);
$link = str_replace("_","-",$link);
$link = str_replace("/","-",$link);
$link = preg_replace("/[^a-zA-Z0-9s-]/", "", $link);
$link = preg_replace("/\-\-+/", "-", $link);
return $link;
}

//Required Variables
function required_fields($rv_array)
{
while (@list($var, $val) = @each($rv_array))
{
if (empty($val))
{
$vars_error .= $var.", ";
}
}
if(!empty($vars_error))
{
$error_message = "Data is required for the following fields: ".substr($vars_error,0,-2);
}
return $error_message;
}

//Image File
function image_file($img)
{
if(!empty($img['prd_img']['tmp_name']))
{
$gis = getimagesize($img['prd_img']['tmp_name']);
$return['temp'] = $img['prd_img']['tmp_name'];
$return['width'] = $gis['0'];
$return['height'] = $gis['1'];
$return['type'] = strrchr($img['prd_img']['name'],'.');
$return['name'] = substr($img['prd_img']['name'],0,strpos($img['prd_img']['name'],'.'));
$return['link'] = createlink(substr($img['prd_img']['name'],0,strpos($img['prd_img']['name'],'.')));
$return['size'] = $img['prd_img']['size'];
return $return;
}
else
{
$return['error']="No file man! - Crazy Fool.";
return $return;
}
}

//Image File
function check_image($img,$w,$h,$t)
{
$det = image_file($img);
if($det['width'] != $w or $det['height'] != $h or $det['type'] != $t)
{
return "Incorrect Image Type - The image format should be: w-$w, h-$h, t-$t";
}
}

function generatePassword($length=9, $strength=0) {
	$vowels = 'aeuy';
	$consonants = 'bdghjmnpqrstvz';
	if ($strength & 1) {
		$consonants .= 'BDGHJLMNPQRSTVWXZ';
	}
	if ($strength & 2) {
		$vowels .= "AEUY";
	}
	if ($strength & 4) {
		$consonants .= '23456789';
	}
	if ($strength & 8) {
		$consonants .= '@#$%';
	}
 
	$password = '';
	$alt = time() % 2;
	for ($i = 0; $i < $length; $i++) {
		if ($alt == 1) {
			$password .= $consonants[(rand() % strlen($consonants))];
			$alt = 0;
		} else {
			$password .= $vowels[(rand() % strlen($vowels))];
			$alt = 1;
		}
	}
	return $password;
}

	function sql_criteria($array,$where) {
	foreach($array as $arr => $val)
	{
	if(!empty($val))
	{
	$i++;
	if($i>1){$sql .= "AND ";}
	$sql .= $arr." LIKE '%".strtolower(preg_replace('/\s+/','',$val))."%'";
	}
	}
	if(!empty($where) and !empty($sql))
	{
	$sql = "WHERE ".$sql;
	}
	return $sql;
	}

	function concat_address($a,$s) {
	$len=strlen($s);
	foreach($a as $r => $v)
	{
	if($v!="") {
	$ret .= $v.$s;
	}
	}
	return substr($ret,0,-$len);
	}
		
function curPageURL() {
 $pageURL = 'http';
 if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
 $pageURL .= "://";
 if ($_SERVER["SERVER_PORT"] != "80") {
  $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
 } else {
  $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
 }
 return $pageURL;
}

function date_form($d) {
if($d!="0000-00-00 00:00:00"){
return date("d-m-y H:i",strtotime($d));
}	
}

function date_rev($dt) {
$y = substr($dt,6,4);
$m = substr($dt,3,2);
$d = substr($dt,0,2);
$dt = $y."-".$m."-".$d;
return date("Y-m-d",strtotime($dt));	
}

function limitwordchr($str,$limit)
{
if(strlen($str)>$limit)
{
$post = substr($str,$limit,1);
$position=$limit;
if($post !=" ")
{
while($post !=" " and $position > 0)
{
$i++;
$position=$limit-$i; 
$post = substr($str,$position,1);
}
}
$str  = substr($str,0,$position);
}
return $str;
}

function numword($num) {
switch ($num) {
	case 0:
        return "zero";
        break;
    case 1:
        return "one";
        break;
    case 2:
        return "two";
        break;
    case 3:
        return "three";
        break;
    case 4:
        return "four";
        break;
    case 5:
        return "five";
        break;
    case 6:
        return "six";
        break;
    case 7:
        return "seven";
        break;
    case 8:
        return "eight";
        break;
    case 9:
        return "nine";
        break;
    case 10:
        return "ten";
        break;	
    case 11:
        return "eleven";
        break;	
    case 12:
        return "twelve";
        break;	
    case 13:
        return "thirteen";
        break;	
    case 14:
        return "fourteen";
        break;	
    case 15:
        return "fithteen";
        break;	
    case 16:
        return "sixteen";
        break;	
    case 17:
        return "seventeen";
        break;	
    case 18:
        return "eighteen";
        break;	
    case 19:
        return "nineteen";
        break;	
    case 20:
        return "twenty";
        break;	
		}
}

function spamcheck() {
$n1 = rand(1,10);
$n2 = rand(1,$n1-1);
$m1 = array('plus','minus');
$m2 = array('+','-');
$m3 = rand(0,1);
$sc['q'] = numword($n1)." ".$m1[$m3]." ".numword($n2);
$eq = '$sc[\'a\'] = '.$n1." ".$m2[$m3]." ".$n2.";";
eval($eq);
$sc['w'] = numword($sc['a']);
return $sc;
}
function wspace($s) {
return preg_replace( '/\s+/', ' ', $s );
}
?>