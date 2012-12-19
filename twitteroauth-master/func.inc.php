<?php

include '../db.inc.php';

function user_exists($id){
	$id = mysql_real_escape_string($id); //security against injection
	$id_exists = mysql_query("SELECT * FROM `users` WHERE `id`='$id' LIMIT 1 ");
	return(mysql_result($id_exists, 0) >= 1) ? true : false;
}

function addUser($id, $username){
	$user = mysql_real_escape_string($username);//security against injection
	mysql_query("INSERT INTO `users` VALUES ($id,'$user','0','0')");
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