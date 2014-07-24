<?php

require_once 'bootstrap.php';

$postMessage = mysql_escape_string($_POST['message']);
$postName = mysql_escape_string($_POST['name']);

$obj = new Message();
$obj->setContent($postMessage);
$obj->setUser($postName);

$entityManager->persist($obj);
$entityManager->flush();
header('location:main.php');
