<?php

foreach(glob("functions/*.php") as $file){
    include $file;
}

// subscribers' data

$sample_data = [
    'email'     => 'xxx@gmail.com',
    'status'    => 'subscribed',
    'firstname' => 'Yen-Ting',
    'lastname'  => 'Wang'
];
$data_1 = [
    'email'     => 'yyy@gmail.com',
    'status'    => 'subscribed',
    'firstname' => 'Anna',
    'lastname'  => 'Lin'
];
$data_2 = [
    'email'     => 'zzz@gmail.com',
    'status'    => 'subscribed',
    'firstname' => 'Layla',
    'lastname'  => 'Li'
];
$data_3 = [
    'email'     => 'mmm@gmail.com',
    'status'    => 'subscribed',
    'firstname' => 'Max',
    'lastname'  => 'Nols'
];
$data_4 = [
    'email'     => 'ddd@gmail.com',
    'status'    => 'subscribed',
    'firstname' => 'Dev',
    'lastname'  => 'Lu'
];
$data_5 = [
    'email'     => 'ttt@gmail.com',
    'status'    => 'subscribed',
    'firstname' => 'Ning',
    'lastname'  => 'Tang'
];

// implementation part starts here 

$api_key = 'Your Mailchimp API key';

// create list and get list id
$list_name = 'Wine from Napa Valley';
$permission_reminder = "You're receiving this email because you signed up for updates when Wine from Napa Valley is in stock.";

$list = create_list_mailchimp($api_key, $list_name, $permission_reminder);
$list_id = get_list_id($list);

// add subscribers to the list
$data = array($sample_data, $data_1, $data_2, $data_3, $data_4, $data_5);

foreach ($data as $d) {
    add_subscriber_mailchimp($api_key, $d, $list_id);
}

// create campaign and get campaign id
$subject = 'Wine from Napa Valley';

$campaign = create_campaign_mailchimp($api_key, $list_id, $subject);
$campaign_id = get_campaign_id($campaign);

// update campaign content and check if it's set
$message = array('html' => '<h2>WINE IS HERE!</h2><p>from Napa Valley!</p>');

$content_set = set_campaign_content($api_key, $campaign_id, $message);
$check_content_set = check_content_set($content_set);

// if campaign content is set, send campaign to the subscribers on the list
// if successfully sent, echo back "it's sent!"
if ($check_content_set){
    $campaign_sent = send_campaign_mailchimp($api_key, $campaign_id);
    $check_campaign_sent = check_campaign_sent($campaign_sent);
    if ($check_campaign_sent){
        echo "it's sent!"; 
    } 
}

?>