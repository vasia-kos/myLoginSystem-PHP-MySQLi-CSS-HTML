<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <header>
        <nav class="navigation">
            <ul class="links">
                <li><a href="index.php">Home</a></li>
                <li><a href="#"></a>Portofolio</li>
                <li><a href="#"></a>About me</li>
                <li><a href="#"></a>Contact</li>
            </ul>
            <?php 
                //an exei kanei login o xrhsths
                //tha feugei to signup form
                //dld an uparxei to session
                if(isset($_SESSION['userId'])){
                  echo '
                    <form action="includes/logout.php" method="post">
                        <button type="submit" name="logout-submit">Logout</button>
                    </form>';
                }
                else{
                      echo '<form action="includes/login.php" method="post">
                        <input type="text" name="mailuid" placeholder="Username/E-mail...">
                        <input type="password" name="pwd" placeholder="Password...">
                        <button type="submit" name="login-submit">Login</button>
                        </form>                    
                        <a href="signup.php">Signup</a>';
                }
            ?>


        </nav>
    </header>

</body>


</html>
<style>
.navigation {
    display: flex;
    justify-content: space-around;
    align-items: center;
    flex-direction: row;
    height: 50px;

    background-color: lightblue;
}


.links {
    display: flex;
    justify-content: space-around;
    list-style: none;
    width: 50%;


}

a {
    text-decoration: none;
}

.login {}
</style>