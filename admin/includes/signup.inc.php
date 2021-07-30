<?php

if(isset($_POST['submit'])){


    $username = $_POST['username'];
    $password = $_POST['password'];


    if(empty($username) || empty($password)){

        header("Location: ../register.php");
        exit();
    }else{

        if(!preg_match("/^[a-zA-Z]*$/", $username)){

            header("Location: ../register.php");
            exit();
        }
    }
}