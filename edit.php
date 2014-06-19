<?php

require_once 'bootstrap.php';
?>
<form name="form" action="edit_handle.php" method="post">
    Select ID to edit:

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
