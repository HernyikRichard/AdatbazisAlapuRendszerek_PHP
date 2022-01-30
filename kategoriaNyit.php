<?php
include_once("elem/menu.php");
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
        <h1>Kategória felvitel</h1>
        <form action="methods/kategoriControll.php" name="palyazat" class="reg-form" method="post">
            <input class="palya-n" type="text" placeholder="Kategória neve" name="nev">
            <input class="palya-sub" type="submit" name="Regisztráció" value="Kategória felvesz">
        </form>
    </div>
<?php
zarasBetolt();
?>