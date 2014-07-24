<?php

require_once 'bootstrap.php';

$postId = $_POST['id'];
if (!is_numeric($postId)) {
    throw new Exception('Id is not a number!');
}

if (isset($_POST['message'])) {
    $postMessage = mysql_escape_string($_POST['message']);

    $toEdit = $entityManager->find('Message', $postId);
    $toEdit->setContent($postMessage);
    $entityManager->persist($toEdit);
    $entityManager->flush();
}

if (isset($postId)) {
    $message = $entityManager->find('Message', $postId);
    if (!$message) {
        exit('this id is invalid');
    }
}
?>

<form action="edit_handle.php" method='post'>
<input type="textarea" name="message" value=<?php echo $message->getContent() ?> />
<input type='hidden' name='id' value=<?php echo $postId ?> />
<input type="submit" value="submit" />
</form>
<a href="main.php">main</a>
