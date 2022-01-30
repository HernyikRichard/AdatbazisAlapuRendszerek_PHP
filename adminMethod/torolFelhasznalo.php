<?php
include("../methods/csatlakozas.php");

$id = $_POST["Fid"];
echo $id;


$c = connect();
oci_set_client_identifier($c, "admin");
$s = oci_parse($c,'DELETE FROM FELHASZNALO WHERE FELHASZNALO.ID = :torlendo');
oci_bind_by_name($s, ":torlendo",$id);
oci_execute($s);
header("Location: ../tagLeker.php")
?>