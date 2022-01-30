<?php
include_once("elem/menu.php");
menuBetolt();
if(!(isset($_SESSION['user']) && !empty($_SESSION['user']))){
    header("Location: index.php");
}
?>
    <div class="reg-container">
        <h1>Jelszó modositás</h1>
        <form action="methods/jelszoValtoztat.php" name="palyazat" class="reg-form" method="post">
            <input class="palya-n" type="text" placeholder="Új jelszavad" name="nev">
            <input class="palya-sub" type="submit" name="Regisztráció" value="jelszó modositás">
        </form>
    </div>
<?php

zarasBetolt();
?>