
<?php

// update campaign content 
// pass in your API key
// pass in the campaign id and the content massage of the email campaign
function set_campaign_content($api_key, $campaign_id, $message){
   
    $type = 'PUT';
    $target = 'campaigns/' . $campaign_id . '/content';
    $timeout = 30;
    $return_httpCode = true;

    $httpCode = mailchimp_api_request($api_key, $type, $target, $timeout, $message, $return_httpCode);
    return $httpCode;    
}

// check if the campaign content is set
function check_content_set($content_set){

    $re = '/2\d\d/';
    if (preg_match_all($re, $content_set)){
        return true;
    }
    return false;
}

// send out the campaign 
// pass in your API key and the campaign id
function send_campaign_mailchimp($api_key, $campaign_id){

    $type = 'POST';
    $target = 'campaigns/' . $campaign_id . '/actions/send';
    $timeout = 30;
    $return_httpCode = true;

    $httpCode = mailchimp_api_request($api_key, $type, $target, $timeout, $data = false, $return_httpCode);
    return $httpCode;   
}

// check if the campaign is sent
function check_campaign_sent($campaign_sent){

    $re = '/2\d\d/';
    if (preg_match_all($re, $campaign_sent)){
        return true;
    }
    return false;
}

?>
