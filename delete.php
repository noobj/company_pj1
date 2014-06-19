<?php

require_once 'bootstrap.php';

if (isset($_POST['id'])) {
    $toDelete = $entityManager->find('Message',$_POST['id']);
    $entityManager->remove($toDelete);
    $entityManager->flush();
}
?>
<form name="form" action=<?php echo $_SERVER['PHP_SELF'];?> method="post">
    Select ID to delete:
<select name="id">

<?php
$messageRep = $entityManager->getRepository('Message');
$messages = $messageRep->findAll();
foreach ($messages as $message) {
    printf("<option value=%d>%d</option>",
        $message->getId(),
        $message->getId()
    );
}
?>

</select>
<input type="submit" value="submit" />
</form>
<a href="main.php">main</a>
