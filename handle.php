<?php

require_once 'bootstrap.php';

$obj = new Message(new \DateTime("now"));
$obj->setContent($_POST['message']);
$obj->setUser($_POST['name']);

$entityManager->persist($obj);
$entityManager->flush();
header("location:main.php");
