<?php
    require "../config.php";
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        $username = $_POST["username"];
        $fullname=$_POST["fullname"];
        $password=$_POST["password"];
        if(empty($username) or empty($fullname) or empty($password)){
            echo "please enter your informations";
            header("REFRESH:3;URL=signup_form.php");
        }else{
            
            $requast="SELECT * FROM users WHERE username=?";
            $statement =$pdo->prepare($requast);
            $statement->execute(array($username));
            $existe_username=$statement->rowcount();
            if($existe_username==0){
                $request = "INSERT INTO users (username,password,full_name) VALUES (?,?,?)";
                $statement=$pdo->prepare($request);
                $statement->execute(array($username,$password,$fullname));
                $user_id = $pdo->lastInsertId();

                header("location:../tasks/task.php?user_id=".$user_id);

            }else{
                echo "username already existed";
                header("REFRESH:2;URL=signup_form.php");
            }
        }
    }else{
        echo "you can't access";
        header("REFRESH:3;URL=signup_form.php");
    }

    
?>