<?php

require_once 'bootstrap.php';

if (isset($_GET['id'])) {
    $messageId = $_GET['id'];
    if (!is_numeric($messageId)) {
        throw new Exception('Id is not a number!');
    }

    if (isset($_POST['name'])) {
        $user = $_POST['user'];
        $content = $_POST['content'];

        $message = $entityManager->find('Message', $messageId);
        $obj = new Reply($message);
        var_dump($message->getReplies()->first());
        $obj->setContent($content);
        $obj->setUser($user);

        $entityManager->persist($obj);
        $entityManager->flush();
        header('location:main.php');
    }
}
?>
<form action='reply.php?id=<?php echo $messageId; ?>' method='post'>
    Name:<input type="text" name="user" /> <br />
    Message:<input type="textarea" name="content" />  <br />
    <input type='hidden' name='messageId' value=<?php echo $messageId; ?> />
    <input type="submit" value="submit" />
</form>
