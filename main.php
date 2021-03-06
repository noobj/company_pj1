<?php

require_once 'bootstrap.php';

//for pagination
$pageRowRecords = 3;
$numPages = 1;

if (isset($_GET['page'])) {
    if (!is_numeric($_GET['page']))
        throw new Exception ('Dont mess up!');

    $getPage = $_GET['page'];
    $numPages = $getPage;
}
$startRowRecords = ($numPages -1) * $pageRowRecords;

$qb = $entityManager->createQueryBuilder();
$qb->select('i')
    ->from('Message', 'i')
    ->orderBy('i.time', 'DESC')
    ->setFirstResult($startRowRecords)
    ->setMaxResults($pageRowRecords);

$query = $qb->getQuery();
$messages = $query->getResult();

$qbCount = $entityManager->createQueryBuilder();
$qbCount->select('COUNT(i.id)')
    ->from('Message', 'i');
$queryForCount = $qbCount->getQuery();
$c = $queryForCount->getSingleScalarResult();
$totalRecords = $c;
$totalPages = ceil($totalRecords/$pageRowRecords);

?>
<h1>留言板</h1>
<ul>
<?php

foreach ($messages as $message) {

    /*$qbReply = $entityManager->createQueryBuilder();
    $qbReply->select('i')
        ->from('Reply', 'i')
        ->where('i.message = :identifier')
        ->orderBy('i.time', 'DESC')
        ->setParameter('identifier', $message->getId());
    $query = $qbReply->getQuery();
    $replys = $query->getResult();*/
    $replys = $message->getReplys();
    printf(
        '<li>%s. %s <br />by %s at  %s',
        $message->getId(),
        $message->getContent(),
        $message->getUser(),
        $message->getTime()->format('m/d H:i:s')
    );

    //print replys
    echo '<ul>';
    $reply = $replys->current();
    $replyCount = $replys->count();

    //由於ArrayCollection() 沒有previous()可用
    //因此只好使用原始的方法來達到從最後一個INDEX
    //往前到第一個 以達到最後留言的在最上面
    $i = 1;
    $reply = $replys[$replyCount-$i];
    while ($reply) {
    printf(
            '<li>%s <br />by %s at  %s',
            $reply->getContent(),
            $reply->getUser(),
            $reply->getTime()->format('m/d H:i:s')
        );

        $i++;
        $reply = $replys[$replyCount-$i];
    }
    echo '</ul>';
    printf(
        '<a href="reply.php?id=%d">Reply</a> ',
        $message->getId()
    );
    printf(
        '<br /><a href="replyDelete.php?id=%d">Delete Reply</a>',
        $message->getId()
    );

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
        echo sprintf(
            '<td><a href="main.php"?page=%d>%d</a></td>',
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
