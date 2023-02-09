<?php
    require "../config.php";
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        $username = $_POST["username"];
        $password=$_POST["password"];
        if(empty($username) or empty($password)){
            echo "please enter your informations";
            header("REFRESH:3;URL=signup_form.php");
        }else{
            $requast="SELECT * FROM users WHERE username=?";
            $statement =$pdo->prepare($requast);
            $statement->execute(array($username));
            $existe_username=$statement->rowcount();
            if($existe_username==0){
                echo "username mkch";
                header("REFRESH:2;URL=login_form.php");
            }else{
                $user = $statement->fetch();
                if($user["password"]==$password){
                    header("location:../tasks/task.php?user_id=".$user["id"]);
                }else{
                    echo "password incorrect";
                    header("REFRESH:2;URL=login_form.php");
                }
            }
        }
    }else{
        echo "you can't access";
        header("REFRESH:3;URL=login_form.php");
    }

?>