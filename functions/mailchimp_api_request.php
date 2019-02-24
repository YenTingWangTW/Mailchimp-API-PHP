

<?php

/*	Mailchimp API Request function
 
	$api_key    'Your Mailchimp API key'

	$type		'GET','POST','PUT','PATCH','DELETE'
 
	$target		The MailChimp API endpoint for the request (without starting slash).

	$timeout	Maximum time the request is allowed to take
	
	$data		Associative array with the key => values to be passed.

	$return_httpCode	Return only Http Code if true. Default would return json response.
*/
 
function mailchimp_api_request($api_key, $type, $target, $timeout = 10, $data = false, $return_httpCode = false)
{
	//setting url
	$core_api_endpoint = 'https://<dc>.api.mailchimp.com/3.0/';
    	list(, $datacenter) = explode( '-', $api_key );
    	$api = str_replace( '<dc>', $datacenter, $core_api_endpoint);
	$url = $api . $target;
	
	//curl operations
	$ch = curl_init($url);

	curl_setopt($ch, CURLOPT_USERPWD, 'user:' . $api_key);
    	curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
    	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    	curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
    	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $type);
    	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                                                                                                                   
	// encode json to data if any
	if ($data){
			$json = json_encode($data);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
	}

	// store the result after curl execution
	$result = curl_exec($ch);
	$err = curl_error($ch);
	if ($err) {
		$result = $err;
	}

	// return httpCode if return_httpCode is set to be true
	if ($return_httpCode){
		$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);	
		curl_close($ch);	 
		return $httpCode;
	}
	
	curl_close($ch);
	return $result;
}

?>
