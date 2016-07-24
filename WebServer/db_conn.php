<?php

	$connect = mysql_connect("ap-cdbr-azure-east-c.cloudapp.net:3306","가림","비밀") or die ("db error");
	$selctdb = mysql_select_db("ouijulawyer_db",$connect) or die("db error");

?>
