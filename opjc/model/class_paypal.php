<?php

class opjc_paypal {

 	protected $connect,$sql; 
	
	//DB Connect & Syslog
	public function __construct() {
		global $site_config;
		$this->connect = $site_config['connect']; 
		$this->syslog = new syslog();
	}
	
	//Process Order
	public function process_order()
	{
		global $site_config;
		$order = new order();
		$order->report = $this->report;
		$order->order_hash = $this->custom;
		$sql = "INSERT INTO paypal_log (order_hash,paypal_report) VALUES ('".addslashes($this->custom)."','".addslashes($this->report)."');";			
		$this->connect->query($sql);

		//Check Seller Email Matches
		if ($this->receiver_email != $site_config['receiver_email']) {
		$order->create_error(1);
		$this->error = "Error 1";
		}

		if(empty($this->error)){ //##//
		//Get Order Details
		$order->get_order();
		
		//Error if not order
		if($order->cust_id==""){
		$order->create_error(2);
		$this->error = "Error 2";
		}
		
		if(empty($this->error)){ //####//
		
		//Check Total Price Matches
		if (in_array($this->txn_type,array("subscr_payment","web_accept")) and $this->mc_gross != $order->tot_price) {
		$order->create_error(3);
		$this->error = "Error 3a";
		}
		
		if(empty($this->error)){ //######//
		if ($this->txn_type=="subscr_signup" and $this->mc_amount3 != $order->tot_price) {
		$order->create_error(3);
		$this->error = "Error 3b";
		}

		if(empty($this->error)){ //########//
		
		//Check Total Price Matches
		if (in_array($this->txn_type,array("subscr_payment","web_accept")) and $this->mc_currency != $site_config['currency']) {
		$order->create_error(4);
		$this->error = "Error 4";
		}
		
		if(empty($this->error)){ //##########//

		if(!empty($this->parent_txn_id))
		{
		$order->txn_id = $this->parent_txn_id;
		}
		else
		{
		$order->txn_id = $this->txn_id;
		}
		
		$order->txn_type = $site_config['txn_type_lu'][$this->txn_type];
		$order->order_name = $this->item_name;
		$order->order_code = $this->item_number;
		$order->payment_status = $this->payment_status;
		$order->payment_type = $this->payment_type;
		$order->subscr_id = $this->subscr_id;

		//Create Order
		if($order->order_new == "1"){
		$order->create_order();
		$order->delete_stage_order();
		}
		
		//Update Order
		if(empty($this->txn_id)){
		$order->update_order();
		}
		
		//Create Action
		if(!empty($this->txn_id)){
		$order->create_action();
		}

		//New Order Email
		if($order->order_new == "1"){
		$order->email_new_order();
		}

		}//##//
		}//####//
		}//######//
		}//########//
		}//##########//
	}



	//Process PDT

	function process_pdt()

	{

		global $site_config;

		

        // Init cURL

        $request = curl_init();



        // Set request options

        curl_setopt_array($request, array

        (

                CURLOPT_URL => $site_config['paypal_url'],

                CURLOPT_POST => TRUE,

                CURLOPT_POSTFIELDS => http_build_query(array

                (

                        'cmd' => '_notify-synch',

                        'tx' => $this->tx,

                        'at' => $this->token,

                )),

                CURLOPT_RETURNTRANSFER => TRUE,

                CURLOPT_HEADER => FALSE,

                CURLOPT_SSL_VERIFYPEER => FALSE,

                CURLOPT_CAINFO => 'cacert.pem',

        ));



        // Execute request and get response and status code

        $response = curl_exec($request);

        $status   = curl_getinfo($request, CURLINFO_HTTP_CODE);



        // Close connection

        curl_close($request);



        // Validate response

        if($status == 200 AND strpos($response, 'SUCCESS') === 0)

        {

                // Remove SUCCESS part (7 characters long)

                $response = substr($response, 7);



                // Urldecode it

                $response = urldecode($response);



                // Turn it into associative array

                preg_match_all('/^([^=\r\n]++)=(.*+)/m', $response, $m, PREG_PATTERN_ORDER);

                $response = array_combine($m[1], $m[2]);



                // Fix character encoding if needed

                if(isset($response['charset']) AND strtoupper($response['charset']) !== 'UTF-8')

                {

                        foreach($response as $key => &$value)

                        {

                                $value = mb_convert_encoding($value, 'UTF-8', $response['charset']);

                        }



                        $response['charset_original'] = $response['charset'];

                        $response['charset'] = 'UTF-8';

                }



                // Sort on keys

                ksort($response);



                // Done!

                foreach ($response as $key => &$val)

				{

					$this->$key = $val;

					$report .= $key.": ".$val."\r\n";

				}

				$this->report = $report;

				$this->success = 1;	

        }

		else

		{

		$this->error = 1;

		}

	}



	//Change Subscription Status

	function change_subscription_status() {

	

		global $site_config;

		

		$api_request = 'USER=' . urlencode($site_config['api_user'])

				.  '&PWD=' . urlencode($site_config['api_pwd'])

				.  '&SIGNATURE=' . urlencode($site_config['api_sig'])

				.  '&VERSION=76.0'

				.  '&METHOD=ManageRecurringPaymentsProfileStatus'

				.  '&PROFILEID=' . urlencode($this->profile_id)

				.  '&ACTION=' . urlencode($this->action)

				.  '&NOTE=' . urlencode( 'Profile cancelled at OPJC User Home' );



		$ch = curl_init();

		curl_setopt( $ch, CURLOPT_URL, $site_config['api_url']); // For live transactions, change to 'https://api-3t.paypal.com/nvp'

		curl_setopt( $ch, CURLOPT_VERBOSE, 1 );



		// Uncomment these to turn off server and peer verification

		curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, FALSE );

		// curl_setopt( $ch, CURLOPT_SSL_VERIFYHOST, FALSE );

		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 );

		curl_setopt( $ch, CURLOPT_POST, 1 );



		// Set the API parameters for this transaction

		curl_setopt( $ch, CURLOPT_POSTFIELDS, $api_request );



		// Request response from PayPal

		$response = curl_exec( $ch );



		// If no response was received from PayPal there is no point parsing the response

		if( ! $response )

		die( 'Calling PayPal to change_subscription_status failed: ' . curl_error( $ch ) . '(' . curl_errno( $ch ) . ')' );



		curl_close( $ch );



		// An associative array is more usable than a parameter string

		parse_str( $response, $parsed_response );



		if($parsed_response['ACK'] == "Success")

		{

			$this->success = 1;

		}

		else

		{

			$this->error = 1;

		}

	}

		

}



/* Fields for Log

custom 

ipn_track_id

mc_amount3

mc_currency

mc_gross 

parent_txn_id

payer_email

payer_status

payer_status

payment_date

payment_status

payment_status

payment_type

reattempt 

receiver_email

subscr_date

subscr_id

txn_id  

txn_type

*/

?>