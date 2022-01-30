<?php
function kephozzaAdd($FName, $Leiras,$helyseg,$kategoria, $palyazat,$imgph)
{
    $c = connect();
    oci_set_client_identifier($c, "admin");
    $command = oci_parse($c,
"DECLARE

kepID number;
systemDate DATE;
felhasznaloID NUMBER;
helysegID NUMBER;
kategoriaID NUMBER;
palyazatID NUMBER;
imgphat VARCHAR2(200);


helyseg_v NUMBER;
kategoria_v NUMBER;
palyazat_v NUMBER;

BEGIN 

SELECT felhasznalo.id INTO felhasznaloID FROM felhasznalo WHERE felhasznalo.nev = :FNAME;
SELECT max(kep.id) INTO kepID FROM kep;
select CURRENT_DATE INTO systemDate from dual;

SELECT COUNT(helyseg.id) INTO helyseg_v from helyseg WHERE helyseg.nev = :HELYSEGID ;
IF helyseg_v > 0 THEN
    SELECT helyseg.id INTO helysegID from helyseg WHERE helyseg.nev = :HELYSEGID;
END IF;


SELECT COUNT(kategoria.id) INTO kategoria_v from kategoria WHERE kategoria.nev = :KATEGORIAID;
IF kategoria_v > 0 THEN
    SELECT kategoria.id INTO kategoriaID from kategoria WHERE kategoria.nev = :KATEGORIAID;
END IF;


SELECT COUNT(palyazat.id) INTO palyazat_v from palyazat WHERE palyazat.nev = :PALYAZATID;
IF palyazat_v > 0 THEN
    SELECT palyazat.id INTO palyazatID from palyazat WHERE palyazat.nev = :PALYAZATID;    
END IF;


INSERT INTO
    kep (ID, LEIRAS, FELTOLTESI_DATUM, FELHASZNALO_ID, HELYSEG_ID, KATEGORIA_ID, PALYAZAT_ID, PATH)
    VALUES
    (kepID+1, :LEIR, systemDate, felhasznaloID, helysegID, kategoriaID, palyazatID, :KEPPAHT);
END;"
    );

    echo $FName.'<br>';
    echo $Leiras.'<br>';
    echo $helyseg.'<br>';
    echo $kategoria.'<br>';
    echo $palyazat.'<br>';
    echo $imgph.'<br>';

    oci_bind_by_name($command, ":FNAME", $FName);
    oci_bind_by_name($command, ":LEIR", $Leiras);
    oci_bind_by_name($command, ":HELYSEGID", $helyseg);
    oci_bind_by_name($command, ":KATEGORIAID", $kategoria);
    oci_bind_by_name($command, ":PALYAZATID", $palyazat);
    oci_bind_by_name($command, ":KEPPAHT", $imgph);
    oci_execute($command);
    oci_close($c);
}


?>