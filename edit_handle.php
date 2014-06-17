<?php
try {
    $pdo =new PDO('mysql:host=localhost;dbname=test','root','12345678');
} catch(PDOException $e)
{
  echo "conld not connect";
}

if(isset($_POST['message']))
{
    $sql = "UPDATE message SET content = :content WHERE id = :id;";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':content', $_POST['message']);
    $stmt->bindValue(':id', $_POST['id']);
    $stmt->execute();
    echo "success";
}


if(isset($_POST['id']))
{
    $sql = "SELECT * FROM message WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':id', $_POST['id']);
    $stmt->execute();
    $row = $stmt->fetch();
}
echo "<form action=". $_SERVER['PHP_SELF']." method='post'>";
echo "<input type='textarea' name='message' value=".$row['content']." />";
echo "<input type='hidden' name='id' value=".$_POST['id']."/>";
?>
<input type="submit" value="submit" />
</form>

<a href="main.php">main</a>

