
<?php

// list creation
// pass in your API key
// pass in the name of the list ($list_name) and the permission reminder to the subscirbers 
function create_list_mailchimp($api_key, $list_name, $permission_reminder){
    
    $type = 'POST';
    $timeout = 30;
    $target = 'lists';
    $data = array(
    'name' => $list_name,
    'contact' => array('company' => 'Wine Lover Alleys', 
                        'address1' => 'somewhere in the heaven',
                        'city' => 'heaven city',
                        'state' => 'heaven state',
                        'zip' => '00001',
                        'country' => 'Utopia'
                    ),
    'permission_reminder' => $permission_reminder,
    'campaign_defaults'=> array('from_name' => 'Angel',
                                'from_email' => 'Angel@wineloveralleys.com',
                                'subject' => 'News from Wine Lover Alleys',
                                'language' => 'en'
                            ),
    'email_type_option' => TRUE
    );
    $result = mailchimp_api_request($api_key, $type, $target, $timeout, $data);
    return $result;
}   

// get list id
// pass in the response object from create_list_mailchimp()
function get_list_id($list){

    $list_id = json_decode($list, true);
    return $list_id['id'];
}

?>