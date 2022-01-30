<?php
include_once("elem/menu.php");
include_once("methods/profileGen.php");
menuBetolt();
if(!(isset($_SESSION['user']) && !empty($_SESSION['user']))){
    header("Location: index.php");
}
general();
zarasBetolt();
?>