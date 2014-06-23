<?php

require_once 'bootstrap.php';

if (isset($_POST['id'])) {
    $postId = $_POST['id'];
    if (!is_numeric($getId)) {
        throw new Exception('Id is not a number!');
    }

    $toDelete = $entityManager->find('Message', $postId);
    $errMsg = null;

    if (!$toDelete) {
        echo 'This Id is invalid<br />';
        $errMsg = 'error';
    }

    if (!$errMsg) {
        $entityManager->remove($toDelete);
        $entityManager->flush();
        echo 'success';
    }
}
?>
<form name="form" action='delete.php' method="post">
    Input ID to delete:
<br />
<input type="text" name="id"/>
<input type="submit" value="submit" />
</form>
<a href="main.php">main</a>
