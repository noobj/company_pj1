<?php
    try{
    $pdo =new PDO('mysql:host=localhost;dbname=test','root','12345678');
    }catch(PDOException $e)
    {
        echo "conld not connect";
    }
    
    $sql = "insert into message (content,user) values (:content,:user)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(':content' => $_POST['message'],':user' => $_POST['name']));
    
?>

<meta http-equiv="refresh" content="0;url='main.php'">