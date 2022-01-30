<?php
include("csatlakozas.php");
include_once("../user/userS.php");

$extNev = $_POST["nev"];




if (isset($extNev)){
    $internalNev = htmlspecialchars($extNev);
    $c = connect();
    oci_set_client_identifier($c, "admin");
    $command = oci_parse($c,'
DECLARE
        katID number;
BEGIN 
    SELECT max(kategoria.id) INTO katID FROM kategoria;


INSERT INTO KATEGORIA (ID, NEV) VALUES (katID+1, :nev);
END;
    ');
    echo$command;
    oci_bind_by_name($command, ":nev", $internalNev);


    oci_execute($command);
    header("Location: ../kategoriaNyit.php");
}