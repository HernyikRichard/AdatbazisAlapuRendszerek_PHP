<?php
include_once("elem/menu.php");
menuBetolt();
if(isset($_SESSION['user']) && !empty($_SESSION['user'])){
    header("Location: index.php");
}
echo '
    <div class="reg-container">
        <h1>Regisztráció</h1>
        <form method="post" name="regist" class="reg-form" action="methods/registControl.php">
            <input class="reg-inputs" type="text" placeholder="Felhasznaló név" name="nev"><!--f name-->
            <input class="reg-inputs" type="email" placeholder="Email cím" name="email"><!--email -->
            <input class="reg-inputs" type="text" placeholder="Lakóhelyed helyed" name="hely"> <!--helység -->
            <input class="reg-inputs" type="password" placeholder="Jelszó" name="pass"><!--pass -->
            <input class="reg-inputs" type="password" placeholder="Jelszó ismétés" name="repass"><!--re pass-->
            <input class="reg-inputs-reg" type="submit" name="Regisztráció" value="Regisztráció">
        </form>
    </div>
    <a href="login.php" class="kieg">Login</a>
    <a href="index.php" class="kieg">fő oldal</a>
';
zarasBetolt();
?>