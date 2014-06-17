

<?php

    try{
    $pdo =new PDO('mysql:host=localhost;dbname=test','root','12345678');
    }catch(PDOException $e)
    {
        echo "conld not connect";
    }

        //pagination
        $pageRow_records = 5;
        $num_pages = 1;
        if (isset($_GET['page'])) {
          $num_pages = $_GET['page'];
        }

        $startRow_records = ($num_pages -1) * $pageRow_records;
        $sql_query = "SELECT * FROM `message` ORDER BY `message`.`time` DESC";
        $sql_query_limit = $sql_query." LIMIT ".$startRow_records.", ".$pageRow_records;
        $result = $pdo->query($sql_query_limit);
        
        $pre = $pdo->prepare("SELECT COUNT(*) FROM `message`");
        $pre->execute();
        $total_records = $pre->fetchColumn();
        
        $total_pages = ceil($total_records/$pageRow_records);

    ?>
<table border="1" align="center">
    <tr><td>id</td><td>content</td><td>user</td><td>date</td></tr>
<?php
    
  while($row = $result->fetch()){
        echo ' <tr><td>'.$row['id'].'</td><td>'.$row['content'].'</td>  <td>'.$row['user'].'</td><td> '.$row['time']."</td>  </tr>";
    }
    
 ?>

</table>
<table border="0" align="center">
  <tr>
 <?php 
         //pagination
    if ($total_pages > 1) { 
     $i = 1;
     while($i <= $total_pages)
     {
       echo "<td><a href=".$_SERVER['PHP_SELF']."?page=".$i.">".$i."</a></td>";
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




