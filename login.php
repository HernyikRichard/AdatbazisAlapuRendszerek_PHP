<?php
include_once("elem/menu.php");
menuBetolt();
if(isset($_SESSION['user']) && !empty($_SESSION['user'])){
    header("Location: index.php");
}
echo'
    <div class="reg-container">
        <h1>Bejelentkezés</h1>
        <form method="post" name="login" class="reg-form" action="methods/loginControl.php">
            <input class="reg-inputs" type="text" placeholder="Felhasznaló név" name="nev"><!--f name-->
            <input class="reg-inputs" type="password" placeholder="Jelszó" name="pass"><!--pass-->
            <input class="reg-inputs" type="submit" name="bejelent" value="Bejelentkezes"> <!--button-->
        </form>
    </div>
    <a href="regist.php">Regisztráció</a>
    <a href="index.php">fő oldal</a>
    ';
zarasBetolt();
?>