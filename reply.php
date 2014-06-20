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

        $obj = new Reply();
        $message = $entityManager->find('Message', $getId);
        $obj->setParent($message);
        $obj->setContent($postMessage);
        $obj->setUser($postName);

        $entityManager->persist($obj);
        $entityManager->flush();
        header('location:main.php');
    }
}
?>
<form action=<?php echo 'reply.php' . '?id=' . $getId; ?> method='post'>
    Name:<input type="text" name="name" /> <br />
    Message:<input type="textarea" name="message" />  <br />
    <input type='hidden' name='messageId' value=<?php echo $getId; ?> />
    <input type="submit" value="submit" />
</form>
