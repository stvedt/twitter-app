<?php

include '../db.inc.php';

function user_exists($username){
	$user = mysql_real_escape_string($username); //security against injection
	$username_exists = mysql_query("SELECT * FROM `users` WHERE `username`='$user' LIMIT 1 ");
	return(mysql_result($username_exists, 0) >= 1) ? true : false;
}

function addUser($username){
	$user = mysql_real_escape_string($username);//security against injection
	mysql_query("INSERT INTO `users` VALUES ('','$user','0','0')");
}

//Output
function output(){
	$query="SELECT * FROM users";
	$result=mysql_query($query);
	$num = mysql_numrows($result);

	for($i = 0; $i < $num; $i++){
		$username=mysql_result($result,$i,"username");
		$up=mysql_result($result,$i,"up_votes");
		$down=mysql_result($result,$i,"down_votes");
		
		echo $username . ' ' . $up . ' ' . $down;
		echo '<br />';
	}
}

?>