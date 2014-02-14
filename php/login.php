<?php

include_once('DBQuery.php');

$username = DBQuery::get('username', 'user', 'id', 1);
echo $username;

$user = DBQuery::getRow('user', 1);
echo $user['password'];

$users = DBQuery::getRows('user');
$user = $users[0];
echo $user['mail'];

$lastNames = DBQuery::getSeveral('last_name', 'user');
print_r($lastNames);

$ssn = DBQuery::sql("SELECT ssn FROM user");
print_r($ssn);

?>