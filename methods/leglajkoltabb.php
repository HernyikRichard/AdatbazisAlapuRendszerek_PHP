<?php
function legjobb(){
    $c = connect();
    oci_set_client_identifier($c, "admin");

    $comand='
SELECT
    COUNT(kep.path) as ERTEKELES ,
    kep.path as KEPPATH
from
    kep,ertekeles
WHERE
    ertekeles.kep_id = kep.id and
    ertekeles.ertek = 0
GROUP BY kep.path
ORDER BY ERTEKELES DESC 
';

    $s = oci_parse($c,$comand);
    oci_execute($s);
    echo '<h1>A legkedveltebb kép</h1>';
    while ($row = oci_fetch_array($s, OCI_ASSOC)){
        echo '
            <div class="card-index">
                <img class="kep-s" src="' .$row["KEPPATH"]. '" alt="">
                <p>Like szám: '.$row["ERTEKELES"].'</p>
            </div>';
        break;
    }
    oci_close($c);
}
?>