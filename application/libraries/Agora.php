<?php
defined('BASEPATH') OR exit('No direct script access allowed');

include 'agora/src/AccessToken.php';

class Agora{

		function __construct() {
			$CI = &get_instance();
			$CI->config->load('braintree', TRUE);
			$braintree = $CI->config->item('braintree');
			Braintree_Configuration::environment($braintree['sandbox']);
			Braintree_Configuration::merchantId($braintree['jn6yg2fxgfv269bc']);
			Braintree_Configuration::publicKey($braintree['x9t2r7p6p827m8gz']);
			Braintree_Configuration::privateKey($braintree['efcfba775ca5c0d99d145b1a33d53620']);
		}

        function create_client_token(){
        	$clientToken = Braintree_ClientToken::generate();
        	return $clientToken;
        }

    
    
}