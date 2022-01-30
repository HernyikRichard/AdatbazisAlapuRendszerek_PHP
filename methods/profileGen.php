<?php

function general()
{

    echo '
      <div class="kep">
        <img class="kep-prof"  src="images/deff/def.jpg" class="kep-img" >
            <div class="profil-nev">
            ' . $_SESSION["user"]->getFname() . '
             '.getHely($_SESSION["user"]->getFname()).'
            </div>
      </div>
      <div class="profil-jelszo">
        <div class="elem-jelszo">
            <p>Felhasználónév modositás</p>
            <a href="nevModosit.php">
            <i class="material-icons">edit_note</i></a>
        </div>
        <div class="elem-jelszo">
            <p>Lakohely modositása</p>
            <a href="helysegModosit.php">
            <i class="material-icons">edit_note</i></a>
        </div>
        <div class="elem-jelszo">
            <p>Jelszó Modositás</p>
            <a href="jelszoValtoztat.php">
            <i class="material-icons">edit_note</i></a>
        </div>
      </div>
      ';

    $c = connect();
    oci_set_client_identifier($c, "admin");

    $command = oci_parse($c,
    'SELECT
                kep.path AS KEPCIM
            FROM kep, felhasznalo 
            WHERE
                  kep.felhasznalo_id = felhasznalo.id 
            AND felhasznalo.nev = :FNAME
            ORDER BY kep.feltoltesi_datum DESC, kep.id DESC
            ');

    $fname = $_SESSION["user"]->getFname();
    oci_bind_by_name($command,":FNAME",$fname);
    oci_execute($command);
    echo '<div class="carnal">';
    while ($row = oci_fetch_array($command, OCI_ASSOC)){
        echo '
            <div class="card">
                <img class="kep-s" src=" ' .$row["KEPCIM"]. '" alt="">
            </div>';
    }
    echo '</div>';
    oci_close($c);
}

function getHely($fname){
    $c = connect();
    oci_set_client_identifier($c, "admin");
    echo $fname;
    $command = 'SELECT felhasznalo.nev, helyseg.nev as Name from
                                         felhasznalo,helyseg
WHERE felhasznalo.helyseg_id = helyseg.id and felhasznalo.nev = :FNAME';
    $s = oci_parse($c,$command);
    oci_bind_by_name($s,":FNAME",$fname);
    $out = oci_execute($s);
    echo ''.$out["Name"];
}
?>


