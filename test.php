<?php

require_once 'bootstrap.php';

 $toDelete = $entityManager->find('Message', 5);
 var_dump($toDelete);