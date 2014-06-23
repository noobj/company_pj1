<?php

require_once 'bootstrap.php';

$content = mysql_escape_string($_POST['content']);
$user = mysql_escape_string($_POST['user']);

$obj = new Message();
$obj->setContent($content);
$obj->setUser($user);

$entityManager->persist($obj);
$entityManager->flush();
header('location:main.php');
