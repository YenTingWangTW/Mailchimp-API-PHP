
<?php

// campaign creation
// pass in your API key
// pass in the list id and the subject of the email campaign
function create_campaign_mailchimp($api_key, $list_id, $subject){

    
    $reply_to   = 'sgg11001100@gmail.com';
    $from_name  = 'Wine Lover Alleys';

    $type = 'POST';
    $timeout = 30;
    $target = 'campaigns';

    $data = array(
                'recipients' => array('list_id' => $list_id), 
                'type' => 'regular', 
                'settings' => array('subject_line' => $subject, 
                                    'reply_to' => $reply_to, 
                                    'from_name' => $from_name)
                );

    $result = mailchimp_api_request($api_key, $type, $target, $timeout = 10, $data);
    return $result;
}

// get campaign id
// pass in the response object from create_campaign_mailchimp()
function get_campaign_id($campaign){

    $campaign_id = json_decode($campaign, true);
    return $campaign_id['id'];
}


?>

