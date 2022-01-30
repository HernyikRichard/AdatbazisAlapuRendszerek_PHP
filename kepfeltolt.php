<?php
include_once("elem/menu.php");
include_once("methods/upload.php");
include_once("methods/uploadControl.php");

menuBetolt();
if(!(isset($_SESSION['user']) && !empty($_SESSION['user']))){
    header("Location: index.php");
}
kirajzol();
zarasBetolt();
?>