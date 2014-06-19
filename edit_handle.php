<?php

require_once 'bootstrap.php';

if (isset($_POST['message'])) {
    $toEdit = $entityManager->find('Message', $_POST['id']);
    $toEdit->setContent($_POST['message']);
    $entityManager->persist($toEdit);
    $entityManager->flush();
}

if (isset($_POST['id'])) {
    $message = $entityManager->find('Message', $_POST['id']);
}
?>

<form action=<?php echo $_SERVER['PHP_SELF']; ?> method='post'>
<input type="textarea" name="message" value=<?php echo $message->getContent() ?> />
<input type='hidden' name='id' value=<?php echo $_POST['id'] ?> />
<input type="submit" value="submit" />
</form>
<a href="main.php">main</a>
