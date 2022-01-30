<?php
include_once("csatlakozas.php");
include_once("../user/user.php");
include_once("../user/userS.php");
$extFelhasznalonev = $_POST["nev"];
$extJelszo = $_POST["pass"];
if (isset($extFelhasznalonev)&& isset($extJelszo)){
    $internalFelhasznalonev = htmlspecialchars($extFelhasznalonev);
    $internalJelszo = htmlspecialchars($extJelszo);
    $c = connect();
    oci_set_client_identifier($c, "admin");

    $command='SELECT felhasznalo.nev AS NEV,
                     felhasznalo.email AS EMAIL,
                     felhasznalo.admin AS ADMIN
              FROM
                   felhasznalo
			  WHERE
			       felhasznalo.nev = :fname 
			       AND felhasznalo.jelszo = :fpass';

    $s = oci_parse($c, $command);
    oci_bind_by_name($s,":fname",$internalFelhasznalonev);
    oci_bind_by_name($s,":fpass",$internalJelszo);

    oci_execute($s);
    $r = oci_fetch_array($s, OCI_ASSOC);
    if($r){
        $_SESSION['user'] =new User($r["NEV"],$r["EMAIL"],$r["ADMIN"]);
        echo 'sikeres';
        header("Location: ../index.php");
    }else{
        header("Location: ../login.php");
    }

}

?>
