<?php
include_once("elem/menu.php");
include_once ("methods/genKepek.php");
menuBetolt();
echo 'kereset kifejezés: '.$_POST["search"];
if (isset($_POST["search"])){
    $intsearch = htmlentities($_POST["search"]);
    genkepek($intsearch);
}
zarasBetolt();
?>