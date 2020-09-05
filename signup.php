<?php
require "header.php";
?>

<main>
    <div class="sign">

        <h1>Signup</h1>
        <?php
        //edw einai analoga to error poy exoume ftiaksei
        //ti munhma tha vgalei sth selida na kserei o xrhsths
        if(isset($_GET['error'])){
            if($_GET['error']=="emptyfields"){
                echo "<p>Fill in all the fields</p>";
            }
            else if($_GET['error']=="passwordcheck"){
                echo "<p>Passwords do not match</p>";
            }
            else if($_GET['error']=="usertaken"){
                echo "<p>User already exists</p>";
            }
            else if($_GET['signup']=="success"){
                echo "<p>Signup succesfull!</p>";
            }
                
            
        }

        ?>
        <form action="includes/signup.php" method="post">
            <input type="text" name="uid" placeholder="Username">
            <input type="text" name="mail" placeholder="E-mail">
            <input type="password" name="pwd" placeholder="Password">
            <input type="password" name="pwd-repeat" placeholder="Repeat password">
            <button type="submit" name="signup-submit">Signup</button>
        </form>


    </div>
</main>



<style>
.sign {
    width: 200px;
    height: 200px;
    background-color: lightpink;
    padding: 20px;

}
</style>