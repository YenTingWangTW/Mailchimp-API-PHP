
<?php

// add subscribers to the list
// pass in your API key
// pass in the list id and data of the subscribers
function add_subscriber_mailchimp($api_key, $data, $list_id) {
    
    
    $type = 'PUT';
    $member_id = md5(strtolower($data['email']));
    $target = 'lists/' . $list_id . '/members/' . $member_id;

    $data_array = array(
                'email_address' => $data['email'],
                'status'        => $data['status'], // "subscribed","unsubscribed","cleaned","pending"
                'merge_fields'  => array('FNAME'     => $data['firstname'],
                                        'LNAME'     => $data['lastname'])
                );
                                                                                                                
    $result = mailchimp_api_request($api_key, $type, $target, $timeout, $data_array);
    return $result;
}
?>
