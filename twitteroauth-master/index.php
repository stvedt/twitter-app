<?php
/**
 * @file
 * User has successfully authenticated with Twitter. Access tokens saved to session and DB.
 */

/* Load required lib files. */
session_start();
require_once('twitteroauth/twitteroauth.php');
require_once('config.php');
require_once('func.inc.php');

/* If access tokens are not available redirect to connect page. */
if (empty($_SESSION['access_token']) || empty($_SESSION['access_token']['oauth_token']) || empty($_SESSION['access_token']['oauth_token_secret'])) {
    header('Location: ./clearsessions.php');
}
/* Get user access tokens out of the session. */
$access_token = $_SESSION['access_token'];

/* Create a TwitterOauth object with consumer/user tokens. */
$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $access_token['oauth_token'], $access_token['oauth_token_secret']);

/* If method is set change API call made. Test is called by default. */
$content = $connection->get('account/verify_credentials');

$user_name = $content->screen_name;
$user_id = $content->id;
$status;
if (user_exists($user_id)){
		$status =  'user_exists';
	}else{
		$status = 'added user';
		addUser($user_id, $user_name);
	}
	
	
//User List

$users_list = json_encode($connection->get('users/lookup', array('screen_name' => 'stvedt,jeffrey_way,mike_dory')));

$file = "../js/web-users.json";
//$put = json_decode($users_list, true);
$put = $users_list;
//$put = 'test';

//echo($put);
file_put_contents($file, $put);


//$test = $content["id"];
/* Some example calls */

//$user = $connection->get('users/show', array('screen_name' => 'stvedt'));
//$connection->post('statuses/update', array('status' => date(DATE_RFC822)));
//$connection->post('statuses/destroy', array('id' => 5437877770));
//$connection->post('friendships/create', array('id' => 9436992));
//$connection->post('friendships/destroy', array('id' => 9436992));

/* Include HTML to display on the page */
include('html.inc');
