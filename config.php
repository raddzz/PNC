<?php
// PNC - JAMES RADLEY
$username = '';
$password = '';
$host = '';
$db = '';
error_reporting(2);
mysql_connect($host,$username,$password);
mysql_select_db($db) or die(mysql_error());