<?php
ini_set('display_errors', 1);
require_once('TwitterAPIExchange.php');

/** Imported from https://developer.twitter.com/en/apps **/
$settings = array(
'oauth_access_token' => "AKSES TOKEN",
'oauth_access_token_secret' => "AKSES TOKEN SECRET",
'consumer_key' => "Consumer KEY",
'consumer_secret' => "Consumer Secret"
);

$url = 'https://api.twitter.com/1.1/direct_messages/events/list.json';
$getfield = '';
$requestMethod = 'GET';
$twitter = new TwitterAPIExchange($settings);
$data = $twitter->setGetfield($getfield)
->buildOauth($url, $requestMethod)
->performRequest();

$someObject = json_decode($data);
foreach ($someObject->events as $item) {
if( strpos($item->message_create->message_data->text, '[sambatan]') !== false) {
ngetweet($item->message_create->message_data->text);
}
}

function ngetweet($kata) {
/** URL for REST request, see: https://dev.twitter.com/docs/api/1.1/ **/
$url = 'https://api.twitter.com/1.1/statuses/update.json';
$requestMethod = 'POST';

$postfields = array(
'status' => $kata
);

$twitter = new TwitterAPIExchange($GLOBALS['settings']);
echo $twitter->buildOauth($url, $requestMethod)
->setPostfields($postfields)
->performRequest();
}
?>