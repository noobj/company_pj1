<?php

require_once 'bootstrap.php';

//pagination
$pageRowRecords = 1;
$numPages = 1;


if (isset($_GET['page'])) {
  $numPages = $_GET['page'];
}
$startRowRecords = ($numPages -1) * $pageRowRecords;

$dql = "SELECT i FROM Message i ORDER BY i.time DESC";
$query = $entityManager->createQuery($dql)
    ->setFirstResult($startRowRecords)
    ->setMaxResults($pageRowRecords);

$messages = $query->getResult();

$messageRep = $entityManager->getRepository('Message');
$i = $messageRep->findAll();
$c = count($i);

$totalRecords = $c;
$totalPages = ceil($totalRecords/$pageRowRecords);

?>
<table border="1" align="center">
    <tr><td>id</td><td>content</td><td>user</td><td>date</td></tr>
<?php
foreach ($messages as $message) {
    echo sprintf("<tr><td>%s</td><td>%s</td><td>%s</td><td>%s</td></tr>",
        $message->getId(),
        $message->getContent(),
        $message->getUser(),
        $message->getTime()
    );
}
?>

</table>
<table border="0" align="center">
  <tr>
<?php
//pagination
if ($totalPages > 1) {
    $i = 1;
    while ($i <= $totalPages) {
        echo sprintf("<td><a href=%s?page=%d>%d</a></td>",
            $_SERVER['PHP_SELF'],
            $i,
            $i
        );
        $i++;
    }
}

?>
</tr>
</table>

<hr />
<a href="edit.php">edit</a>
<a href="delete.php">delete</a>
<hr />
<form name="form" action="handle.php" method="post">
    Name:<input type="text" name="name" /> <br />
    Message:<input type="textarea" name="message" />  <br />
    <input type="submit" value="submit" />
</form>
