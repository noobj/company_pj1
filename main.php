<?php

require_once 'bootstrap.php';

//for pagination
$pageRowRecords = 3;
$numPages = 1;

if (isset($_GET['page'])) {
    if (!is_numeric($_GET['page'])) {
        throw new \Exception('Dont mess up!');
    }
    $getPage = $_GET['page'];
    $numPages = $getPage;
}
$startRowRecords = ($numPages - 1) * $pageRowRecords;

$qb = $entityManager->createQueryBuilder();
$qb->select('i')
    ->from('Message', 'i')
    ->orderBy('i.commentTime', 'DESC')
    ->setFirstResult($startRowRecords)
    ->setMaxResults($pageRowRecords);

$query = $qb->getQuery();
$messages = $query->getResult();

$qbCount = $entityManager->createQueryBuilder();
$qbCount->select('COUNT(i.id)')->from('Message', 'i');
$totalRecords = $qbCount->getQuery()->getSingleScalarResult();
$totalPages = ceil($totalRecords / $pageRowRecords);

?>
<h1>留言板</h1>
<ul>
<?php

foreach ($messages as $message) {

    $replies = $message->getReplies();
    printf(
        '<li>%s. %s <br />by %s at  %s',
        $message->getId(),
        $message->getContent(),
        $message->getUser(),
        $message->getCommitTime()->format('m/d H:i:s')
    );

    //print replies in desc order
    echo '<ul>';
    $replyCount = $replies->count();
    for ($i = $replyCount - 1 ; $i >= 0 ; $i--) {
        $reply = $replies[$i];
        printf(
            '<li>%s <br />by %s at  %s',
            $reply->getContent(),
            $reply->getUser(),
            $reply->getReplyTime()->format('m/d H:i:s')
        );
    }
    echo '</ul>';
    $msgId = $message->getId();

    echo "<a href=\"reply.php?id=$msgId\">Reply</a>".
        "<br /><a href=\"replyDelete.php?id=$msgId\">Delete Reply</a>";

    echo '</li><hr>';
}
?>

</ul>
<table border="0" align="center">
  <tr>
<?php

//pagination
if ($totalPages > 1) {
    $i = 1;
    while ($i <= $totalPages) {
        echo "<td><a href='main.php?page=$i'>$i</a></td>";

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
    Name:<input type="text" name="user" /> <br />
    Message:<input type="textarea" name="content" />  <br />
    <input type="submit" value="submit" />
</form>
