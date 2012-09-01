<?php
class johnny_tweet {
 	
	public $error;
 	protected $connect,$sql; 
	
	//DB Connect & Syslog
	public function __construct() {
		global $site_config;
		$this->connect = $site_config['connect']; 
	}
	
	//Get Latest Tweet From Twitter
	public function get_tweet() {
	
		$tweet = new twitter();
		$tweet->screen_name = 'OPJClub';
		$tweet->count_no = 1;
		$tweets = $tweet->getStatusTweets();
		
		if(!empty($tweets)){
		foreach($tweets as $row)
		{
			$this->sql = "UPDATE tweet SET tweet = '".addslashes($row['html_text'])."';";
			$this->connect->query($this->sql);
		}
		}
	}

	//Show Tweet
	public function show_tweet() {
	
		$this->sql = "SELECT tweet FROM tweet;";
		$this->connect->query($this->sql);
		$result = $this->connect->resultArray();
		if(!empty($result[0]))
		{
		$this->tweet = $result[0]['tweet'];
		}
	}

}
?>