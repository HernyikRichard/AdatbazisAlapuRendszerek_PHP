<?php
include("csatlakozas.php");
include_once("../user/userS.php");

$extNev = $_POST["nev"];
$extLeiras = $_POST["leiras"];
$extKezd = $_POST["kezd"];
$extVege = $_POST["vege"];



if (isset($extNev) && isset($extLeiras) && isset($extKezd) && isset($extVege)){
    $internalNev = htmlspecialchars($extNev);
    $internalLeiras = htmlspecialchars($extLeiras);
    $internalKezd = htmlspecialchars($extKezd);
    $internalVege = htmlspecialchars($extVege);

    $kezd = explode("T", $internalKezd);
    $veg = explode("T", $internalVege);

    echo $kezd[0];
    echo $veg[0];


    $c = connect();
    oci_set_client_identifier($c, "admin");
    $command = oci_parse($c,'
DECLARE
        palyzatID number;
        datesKEZD Date;
        datesVEGE Date;
BEGIN 
    SELECT max(palyazat.id) INTO palyzatID FROM palyazat;

    datesKEZD :=TO_DATE(:kezd,\'yyyy-mm-dd\');
    datesVEGE :=TO_DATE(:vege,\'yyyy-mm-dd\');

    INSERT INTO PALYAZAT (ID, LEIRAS, KEZDO_DATUM, VEG_DATUM, NEV)
    VALUES (palyzatID+1, :leir, datesKEZD, datesVEGE, :nev);
END;
    ');
    echo$command;
    oci_bind_by_name($command, ":nev", $internalNev);
    oci_bind_by_name($command, ":leir", $internalLeiras);
    oci_bind_by_name($command, ":kezd", $kezd[0]);
    oci_bind_by_name($command, ":vege", $veg[0]);

    oci_execute($command);
    header("Location: ../palyazatNyitas.php");
}