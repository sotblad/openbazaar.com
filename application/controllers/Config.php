<?php
class Config extends CI_Controller {

        public function index()
        {
	        	
	        	$languages = file_get_contents(asset_url().'js/languages.json');
	        	$languages = json_decode($languages, true);

	        	try {
		        	$currencies = file_get_contents(asset_url().'js/currencies.json');
		        } catch (Exception $e) {
			        print_r($e);
		        }
	        	$currencies = json_decode($currencies, true);
	        	asort($currencies, 0);
	        	
	        	$countries = file_get_contents(asset_url().'js/countries.json');
	        	$countries = json_decode($countries, true);
	        	print_r("test".$countries);
	        	
				
				$user_language = ($_COOKIE['language'] != "") ? $_COOKIE['language'] : "";
				$user_country = ($_COOKIE['country'] != "") ? $_COOKIE['country'] : "";
				$user_nsfw = ($_COOKIE['nsfw'] != "") ? $_COOKIE['nsfw'] : "";

				$user_currency = ($_COOKIE['currency'] != "") ? $_COOKIE['currency'] : "USD";
				$user_gateway = ($_COOKIE['gateway'] != "") ? $_COOKIE['gateway'] : "https://gateway.ob1.io";				
				

                $this->load->view('config', array(
                	'languages'=>$languages, 
                	'currencies'=>$currencies, 
                	'countries'=>$countries,
                	'user_language'=>$user_language,
                	'user_nsfw'=>$user_nsfw,
                	'user_country'=>$user_country,
                	'user_currency'=>$user_currency,
                	'user_gateway'=>$user_gateway           
                	)
                );
        }
        
        public function save_settings() {	       

	        foreach($_POST as $key=>$value) {		        
		        setcookie($key, $value, time() + (86400 * 30), "/"); 
	        }
        }
               
}