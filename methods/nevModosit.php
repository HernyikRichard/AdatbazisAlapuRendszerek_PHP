<?php
include_once("csatlakozas.php");
include_once("../elem/menu.php");
include_once "../user/userS.php";
$extNev = $_POST["nev"];

if (isset($extNev)){
$intNev = htmlentities($extNev);
$c = connect();
oci_set_client_identifier($c, "admin");

    $command = 'UPDATE FELHASZNALO SET NEV = :nevNew WHERE FELHASZNALO.nev = :nevOld';
    $oldNev = $_SESSION['user']->getFname();
    echo $oldNev.'<br>';
    echo $intNev.'<br>';

    $s = oci_parse($c, $command);
    oci_bind_by_name($s,":nevNew",$intNev);
    oci_bind_by_name($s,":nevOld",$oldNev);
    oci_execute($s);
    oci_close($c);
    $_SESSION['user']->setFname($intNev);
    header("Location: ../profile.php");

}
?>