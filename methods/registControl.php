<?php
include("csatlakozas.php");
include_once("../user/userS.php");
session_start();
//post-ból érkező adatok át adása belső átmeneti változókba.

$extFelhasznalonev = $_POST["nev"];
$extEmail = $_POST["email"];
$extHelyseg = $_POST["hely"];
$extJelszo = $_POST["pass"];
$extJelszoUjra = $_POST["repass"];

//ellenőrzés hogy a mezők közű mindegyik kivan-e tőltve
if (isset($extFelhasznalonev) && $extFelhasznalonev != "" && isset($extEmail) && $extEmail != "" &&
    isset($extHelyseg) && $extHelyseg != "" && isset($extJelszo) && $extJelszo != "" &&
    isset($extJelszoUjra) && $extJelszoUjra != "" && $extJelszo == $extJelszoUjra) {

    //külső nem biztonságos változók megtisztitása.

    $internalFelhasznalonev = htmlspecialchars($extFelhasznalonev);
    $internalEmail = htmlspecialchars($extEmail);
    $internalHelyseg = htmlspecialchars($extHelyseg);
    $internalJelszo = htmlspecialchars($extJelszo);
    $internalJelszoUjra = htmlspecialchars($extJelszoUjra);


    $c = connect();
    oci_set_client_identifier($c, "admin");


    $command = oci_parse($c,'
    DECLARE
        helysegMax number;
        helysegID number;
        vanEhely number;
        felhasznaloMAX number;
    
    BEGIN 
    SELECT COUNT(*) INTO vanEhely FROM helyseg WHERE helyseg.nev = :helyseg;
    
    IF vanEhely<1 THEN
        SELECT max(helyseg.id) INTO helysegMAX FROM helyseg;
        INSERT INTO helyseg VALUES(helysegMAX + 1, :helyseg);
    END IF;
    
    SELECT helyseg.id INTO helysegID from helyseg WHERE helyseg.nev = :helyseg;
    SELECT max(felhasznalo.id) INTO felhasznaloMAX FROM felhasznalo;
    
    INSERT INTO felhasznalo(ID, NEV, EMAIL, JELSZO, HELYSEG_ID, admin) 
           VALUES (felhasznaloMAX+1, :fname, :email, :pass, helysegID, :admin);
    END;
    ');
    $admin = 0;
    oci_bind_by_name($command, ":fname", $internalFelhasznalonev);
    oci_bind_by_name($command, ":email", $internalEmail);
    oci_bind_by_name($command, ":pass", $internalJelszo);
    oci_bind_by_name($command, ":helyseg", $internalHelyseg);
    oci_bind_by_name($command, ":admin", $admin);
    oci_execute($command);

    $_SESSION["user"] = new User($internalFelhasznalonev, $internalEmail,$admin);

    header("Location: ../index.php");
}
?>