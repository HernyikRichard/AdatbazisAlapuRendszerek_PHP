<?php
include("methods/csatlakozas.php");
$kepid = $_POST["kepid"];
$ertek = $_POST["ertek"];
$fname = $_POST["fname"];

echo $kepid.' '.$ertek.' '.$fname;
$c = connect();
oci_set_client_identifier($c, "admin");

$comand ='
DECLARE
ertekSzam number;
v_date date;
fid number;
BEGIN
SELECT COUNT(ertekeles.id) into ertekSzam from ertekeles;
SELECT SYSDATE INTO v_date FROM dual;
SELECT felhasznalo.id into fid from felhasznalo WHERE felhasznalo.nev = :FID;
INSERT INTO ertekeles 
        (ID, ERTEK, FELHASZNALO_ID, KEP_ID, DATUM)
VALUES (ertekSzam+1, :ERTEK, fid, :KEPID ,v_date);
END;';

$s = oci_parse($c,$comand);

oci_bind_by_name($s, ":ERTEK", $ertek);
oci_bind_by_name($s, ":KEPID", $kepid);
oci_bind_by_name($s, ":FID", $fname);
oci_execute($s);
oci_close($c);
header("Location: index.php");
?>
