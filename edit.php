<form name="form" action="edit_handle.php" method="post">
    Select ID to edit:
<?php
    $result = $pdo->query('select * from message');
?>
<select name="id">
<?php
while($row = $result->fetch()) {
    echo "<option value=".$row['id'].">".$row['id']."</option>";
}
?>
</select>
<input type="submit" value="submit" />
</form>
<a href="main.php">main</a>

