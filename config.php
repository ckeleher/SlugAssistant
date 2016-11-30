<?php
session_start();
include_once("src/Google_Client.php");
include_once("src/contrib/Google_Oauth2Service.php");
######### edit details ##########
$clientId = '771073429113-2ig6lk17jv844u2d4po8erun6ubtlsgv.apps.googleusercontent.com'; //Google CLIENT ID
$clientSecret = 'gSHfbPQ6DRovH5iBxQWImOhC'; //Google CLIENT SECRET
$redirectUrl = 'http://slugassistant.me';  //return url (url to script)
$homeUrl = 'http://slugassistant.me';  //return to home

##################################

$gClient = new Google_Client();
$gClient->setApplicationName('Login to codexworld.com');
$gClient->setClientId($clientId);
$gClient->setClientSecret($clientSecret);
$gClient->setRedirectUri($redirectUrl);

$google_oauthV2 = new Google_Oauth2Service($gClient);
?>
