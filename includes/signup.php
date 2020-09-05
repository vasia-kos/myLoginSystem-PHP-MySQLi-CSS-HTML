<?php

//elegxoume an o xrhsths pathse to koumpi
//etsi mono tha treksei to kwdikas
if(isset($_POST['signup-submit'])){
    require 'dbh.php';
    //pairnw ta dedomena apo thn forma
    $username = $_POST['uid'];
    $email = $_POST['mail'];
    $password = $_POST['pwd'];
    $passwordRepeat = $_POST['pwd-repeat'];


    //edw elegxoume gia tuxwn erros
    /*h forma den einai entelws sumplirwmenh --> kai gurizei to username kai email 
    gia na mhn plhktrologei pali o xrhsths*/
    if(empty($username)||empty($password) || empty($passwordRepeat) ||empty($email)){
        header("Location: ../signup.php?error=emptyfields&uid=".$username."&email=".$email);
        exit();
    }
    elseif(!filter_var($email,FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-Z0-9]*$/",$username)){
        header("Location: ../signup.php?error=invaliduidmail");
        exit();
    }
    else if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
        header("Location: ../signup.php?error=invalidmail&uid=".$username);
        exit();

    }else if(!preg_match("/^[a-zA-Z0-9]*$/",$username)){
        header("Location: ../signup.php?error=invaliduid&mail=".$mail);
        exit();
    }
    else if($password !== $passwordRepeat){
        header("Location: ../signup.php?error=passwordcheck&mail=".$mail."&uid".$username);
        exit();
    }
    else{
        //elegxoume an to user_uid uparxei hdh sth database
        $sql="SELECT uidUsers FROM users2 WHERE uidUsers=? ";
        $stmt=mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt,$sql)){
            header("Location: ../signup.php?error=sqlerror");
            exit();
        }
        else{
            mysqli_stmt_bind_param($stmt,"s",$username);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            $resultCheck = mysqli_stmt_num_rows($stmt);
            if($resultCheck > 0){
                header("Location: ../signup.php?error=usertaken&mail=".$email);
                exit();
            }
            else{
                
            $sql="INSERT INTO users2(uidUsers,emailUsers,pwdUsers) VALUES
            (?,?,?);";
            //connection to the database
            $stmt = mysqli_stmt_init($conn);
            if(!mysqli_stmt_prepare($stmt,$sql)){
                header("Location: ../signup.php?error=sqlerror");
                exit();
            }else{
                //gia pio safe gia to password
                $hashedPwd = password_hash($password,PASSWORD_DEFAULT);
                //edw kanei insert sthn vash dedomenwn
                mysqli_stmt_bind_param($stmt,'sss',$username,$email,$hashedPwd);
                mysqli_stmt_execute($stmt);
                header("Location: ../signup.php?signup=success");
                exit();

            }













            }
        }
    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);


}
else{
    header("Location: ../signup.php");
    exit();
}