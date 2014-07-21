<?php

require_once 'bootstrap.php';

if (isset($_GET['id'])) {
    $getId = $_GET['id'];
    if (!is_numeric($getId)) {
        throw new Exception('Id is not a number!');
    }

    if (isset($_POST['name'])) {
        $postName = $_POST['name'];
        $postMessage = $_POST['message'];

        $message = $entityManager->find('Message', $getId);
        $obj = new Reply($message);
        var_dump($message->getReplies()->first());
        $obj->setContent($postMessage);
        $obj->setUser($postName);

        $entityManager->persist($obj);
        $entityManager->flush();
        header('location:main.php');
    }
}
?>
<form action='reply.php?id=<?php echo $getId; ?>' method='post'>
    Name:<input type="text" name="name" /> <br />
    Message:<input type="textarea" name="message" />  <br />
    <input type='hidden' name='messageId' value=<?php echo $getId; ?> />
    <input type="submit" value="submit" />
</form>
