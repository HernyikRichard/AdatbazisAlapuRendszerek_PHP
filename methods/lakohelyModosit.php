<?php
include_once("csatlakozas.php");
include_once("../elem/menu.php");
include_once "../user/userS.php";

$extNev = $_POST["nev"];

if (isset($extNev)){
    $intNev = htmlentities($extNev);
    $c = connect();
    oci_set_client_identifier($c, "admin");

    $command = '
    DECLARE
        helysegMax number;
        helysegID number;
        vanEhely number;
        felhasznaloMAX number;
    
BEGIN 
    SELECT COUNT(*) INTO vanEhely FROM helyseg WHERE helyseg.nev = :nevhely;
    
    IF vanEhely<1 THEN
        SELECT max(helyseg.id) INTO helysegMAX FROM helyseg;
        INSERT INTO helyseg VALUES(helysegMAX + 1, :nevhely);
    END IF;
    
    SELECT helyseg.id INTO helysegID from helyseg WHERE helyseg.nev = :nevhely;
    
    
    UPDATE FELHASZNALO SET felhasznalo.helyseg_id = helysegID WHERE FELHASZNALO.nev = :fname;
    END;
    ';
    $fname = $_SESSION['user']->getFname();
    echo $fname.'<br>'.$intNev;
    $s = oci_parse($c, $command);
    oci_bind_by_name($s,":nevhely",$intNev);
    oci_bind_by_name($s,":fname",$fname);
    oci_execute($s);
    oci_close($c);
    header("Location: ../profile.php");
}
?>