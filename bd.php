<?php

$dbuser="root";
$dbpass="";
$dbname="tmn";
$dbhost='localhost';
($link = mysql_pconnect("$dbhost", "$dbuser", "$dbpass")) || die("Couldn't connect to MySQL");
mysql_select_db("$dbname", $link) || die("Couldn't open db: $dbname. Error if any was: ".mysql_error() );