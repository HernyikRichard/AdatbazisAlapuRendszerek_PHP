<?php
include_once("elem/menu.php");
include_once("adminMethod/tagokKategoriakHelysegek.php");
menuBetolt();
if(!(isset($_SESSION['user']) && !empty($_SESSION['user']))){
    header("Location: index.php");
}else{
    if ($_SESSION['user']->getAdmin()<1){
        header("Location: index.php");
    }
}
getFelhasznalo();
zarasBetolt();
?>