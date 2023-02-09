<?php
    require "../config.php";
    session_start();
    if(isset($_GET["taskid"])){
        $_SESSION["task_id"]=$_GET["taskid"];
    }
    $task_id=$_SESSION["task_id"];
    if(isset($_POST["updatedTask"])){
            $request ="UPDATE tasks SET task=? WHERE id=?";
            $statement=$pdo->prepare($request);
            $statement->execute(array($_POST["updatedTask"],$task_id));
            header("location:task.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
         $request ="SELECT * FROM tasks WHERE id=?";
         $statement=$pdo->prepare($request);
         $statement->execute(array($task_id));
         $theTask=$statement->fetch();
    ?>
    <form action="updateTask.php" method="post">
        <input type="text" name="updatedTask" value="<?= $theTask["task"] ?>">
        <br>
        <input type="submit">
    </form>
</body>
</html>