<?php

require_once 'bootstrap.php';

$messageId = $_POST['id'];
if (!is_numeric($messageId)) {
    throw new Exception('Id is not a number!');
}

if (isset($_POST['content'])) {
    $content = mysql_escape_string($_POST['content']);

    $toEdit = $entityManager->find('Message', $messageId);
    $toEdit->setContent($content);
    $entityManager->persist($toEdit);
    $entityManager->flush();
}

if (isset($messageId)) {
    $message = $entityManager->find('Message', $messageId);
    if (!$message) {
        throw new Exception('this id is invalid');
    }
}
?>

<form action="edit_handle.php" method='post'>
<input type="textarea" name="content" value=<?php echo $message->getContent() ?> />
<input type='hidden' name='id' value=<?php echo $messageId ?> />
<input type="submit" value="submit" />
</form>
<a href="main.php">main</a>
