<?php
    try{
    $pdo =new PDO('mysql:host=localhost;dbname=test','root','12345678');
    }catch(PDOException $e)
    {
        echo "conld not connect";
    }
    
    if(isset($_POST['id']))
    {
        $sql = "DELETE FROM message WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':id', $_POST['id']);
        $stmt->execute();
    }
        
        
        
?>


<form name="form" action=<?php echo $_SERVER['PHP_SELF'];?> method="post">
    Select ID to delete:
<?php


    $result = $pdo->query('select * from message');
?>
<select name="id">
    <?php
        while($row = $result->fetch())
        {
            echo "<option value=".$row['id'].">".$row['id']."</option>";
        }
    ?>
</select>
<input type="submit" value="submit" />
</form>
<a href="main.php">main</a>