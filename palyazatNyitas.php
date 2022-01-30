<?php
include_once "elem/menu.php";
menuBetolt();
if(!(isset($_SESSION['user']) && !empty($_SESSION['user']))){
    header("Location: index.php");
}else{
    if ($_SESSION['user']->getAdmin()<1){
        header("Location: index.php");
    }
}
?>
    <div class="reg-container">
        <h1>Palyazat Létrehozása</h1>
        <form action="methods/palyazatControl.php" name="palyazat" class="reg-form" method="post">
            <input class="palya-n" type="text" placeholder="Palyazat neve" name="nev">
            <textarea class="palya-in" name="leiras" id="1" cols="30" rows="10"></textarea>
            <input class="palya-date" type="datetime-local" name="kezd">
            <input class="palya-date" type="datetime-local" name="vege">
            <input class="palya-sub" type="submit" name="Regisztráció" value="Palyazat meghírdetése">
        </form>
    </div>
<?php
zarasBetolt();
?>