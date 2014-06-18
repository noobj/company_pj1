<?php

try {
    $pdo = new PDO('mysql:host=localhost;dbname=test','root','12345678');
} catch(PDOException $e) {
    echo "conld not connect";
}

//pagination
$pageRowRecords = 5;
$numPages = 1;
if (isset($_GET['page'])) {
  $numPages = $_GET['page'];
}

$startRowRecords = ($numPages -1) * $pageRowRecords;
$sqlQueryLimit = sprintf(
    'SELECT * FROM message ORDER BY time DESC LIMIT %d, %d',
    $startRowRecords,
    $pageRowRecords
);

$result = $pdo->query($sqlQueryLimit);

$pre = $pdo->prepare("SELECT COUNT(id) FROM `message`");
$pre->execute();
$totalRecords = $pre->fetchColumn();
$totalPages = ceil($totalRecords/$pageRowRecords);

?>
<table border="1" align="center">
    <tr><td>id</td><td>content</td><td>user</td><td>date</td></tr>
<?php

while ($row = $result->fetch()) {
printf("<tr><td>%s</td><td>%s</td><td>%s</td><td>%s</td></tr>",
    $row['id'],
    $row['content'],
    $row['user'],
    $row['time']
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
        echo sprintf("<td><a href=%s?page=%d>%d</a></td>", $_SERVER['PHP_SELF'], $i, $i);
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
