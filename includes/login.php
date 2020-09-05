<?php
//mono an pathsei to koumpi o xrhsths
if(isset($_POST['login-submit'])){
    require 'dbh.php';

    //pairnoume ta dedomena apo thn forma
    //gia na mpei o xrhsths tha xreiazetai
    //mail eite username KAI kwdiko
    $mailuid = $_POST['mailuid'];
    $password = $_POST['pwd'];

    if(empty($mailuid) || empty($password)){
        header("Location: ../index.php?error=emptyfields");
        exit();
    }
    else{
        //o xrhsths vazei eite mail eite username
        $sql = "SELECT * FROM users2 WHERE uidUsers=? OR emailUsers=?;";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt,$sql)){
            header("Location: ../index.php?error=sqlerror");
            exit();
        }
        else{
            mysqli_stmt_bind_param($stmt,"ss",$mailuid,$mailuid);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            if($row = mysqli_fetch_assoc($result)){
                //to pwdCheck tha einai eite 1 eite 0 (boolean)
                //elegxei an o kwdikos pou egrapse o xrhsths
                //uparxei kapou sth vash sto pwdUsers
                $pwdCheck = password_verify($password,$row['pwdUsers']);
                if($pwdCheck ==  false){
                    header("Location: ../index.php?error=wrongPassword");
                    exit();
                }
                elseif($pwdCheck == true){
                    //we have to create a session
                    session_start();
                    $_SESSION['userId']=$row['idUsers'];
                    $_SESSION['userUId']=$row['uidUsers'];

                    header("Location: ../index.php?login=sucess");
                    exit();
                }
                else{
                    header("Location: ../index.php?error=wrongPassword");
                    exit();
                }
            }
            else{
                header("Location: ../index.php?error=noUserfound");
                exit();
            }
        }
    }

}
else{
    header("Location: ../index.php");
    exit();
}