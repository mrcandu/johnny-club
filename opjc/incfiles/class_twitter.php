<?php
class twitter {

var $screen_name = '';
var $include_rts = true;
var $include_entities = true;
var $since_id = '';
var $count_no = '';

////////////////// Get Status Tweets
function getStatusTweets() {

$url = "http://api.twitter.com/1/statuses/user_timeline.xml?screen_name=".$this->screen_name."&include_rts=".$this->include_rts."&include_entities=".$this->include_entities;
if ($this->since_id) {$url .= "&since_id=".$this->since_id;}
if ($this->count_no) {$url .= "&count=".$this->count_no;}
$xml = $this->getXMLResponse($url);

foreach($xml->status as $status) {

$i++;

if(empty($status->retweeted_status[0]))
{
$tweet[$i]['id'] = $status->id;
$tweet[$i]['retweet'] = "0";
$tweet[$i]['name'] = $status->user[0]->name;
$tweet[$i]['screen_name'] = $status->user[0]->screen_name;
$tweet[$i]['created_at'] = $this->tDate($status->created_at);
$tweet[$i]['text'] = trim($status->text);	
$tweet[$i]['profile_image_url'] = $status->user[0]->profile_image_url;
}
else
{
$tweet[$i]['id'] = $status->retweeted_status[0]->id;
$tweet[$i]['retweet'] = "1";
$tweet[$i]['name'] = $status->retweeted_status[0]->user[0]->name;
$tweet[$i]['screen_name'] = $status->retweeted_status[0]->user[0]->screen_name;
$tweet[$i]['created_at'] = $this->tDate($status->retweeted_status[0]->created_at);
$tweet[$i]['text'] = trim($status->retweeted_status[0]->text);	
$tweet[$i]['profile_image_url'] = $status->retweeted_status[0]->user[0]->profile_image_url;
}

$tweet[$i]['created_at_orig'] = $this->tDate($status->created_at);
$tweet[$i]['html_text'] = $this->turl($tweet[$i]['text'],$status->entities->urls->url);	
$tweet[$i]['html_text'] = $this->html($tweet[$i]['html_text']);
}

return $tweet;

}

////////////////// Restful Curl
function getXMLResponse($url) {
$ch = curl_init($url);
curl_setopt ($ch, CURLOPT_RETURNTRANSFER, TRUE);
$resp = curl_exec ($ch);
curl_close ($ch);
//echo $resp;
$xml = new SimpleXMLElement($resp);
return $xml;
}

////////////////// Convert to PHP dates
function tDate($d) {
return date("Y-m-d H:i:s",strtotime($d));
}

////////////////// Conver to URL
function turl($t,$a) {
if(isset($a))
	{
	foreach ($a as $url);
	{
	$t = str_replace($url->url,'<a href="'.$url->url.'">'.$url->display_url.'</a>',$t);
	}
	}
return $t;
}

////////////////// Create HTML from text
function html($ret) {
	$ret = preg_replace("#(^|[\n ])([\w]+?://[\w]+[^ \â€œ\â€\“\”\"\n\r\t< ]*)#", "\\1<a href=\"\\2\">\\2</a>", $ret);
	$ret = preg_replace("#(^|[\n ])((www|ftp)\.[^ \"\t\n\r< ]*)#", "\\1<a href=\"http://\\2\">\\2</a>", $ret);
	$ret = preg_replace("/@(\w+)/", "<a href=\"http://www.twitter.com/\\1\">@\\1</a>", $ret);
	$ret = preg_replace("/#(\w+)/", "<a href=\"http://search.twitter.com/search?q=\\1\">#\\1</a>", $ret);
return $ret;
}

}
?>