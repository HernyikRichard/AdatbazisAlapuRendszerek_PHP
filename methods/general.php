<?php
function profile(){



}
function palyazat(){
    $c = connect();
    oci_set_client_identifier($c, "admin");

    $s = oci_parse($c,
        'select palyazat.nev as PNEV,
        palyazat.leiras as PLEIRAS,
        palyazat.kezdo_datum as PKEZD,
        palyazat.veg_datum as PVEG from palyazat');
    oci_execute($s);
    while ($row = oci_fetch_array($s, OCI_ASSOC)){
        echo '
        <table style="width:100%">
        <caption>'.$row["PNEV"].'</caption>
            <tr>
                <th colspan="3">'.$row["PLEIRAS"].'</th>
            </tr>
            </tr>
                    <th>'.$row["PKEZD"].'</th>
                    <th></th>
                    <th>'.$row["PVEG"].'</th>
             </tr>
        </table><br><br><br>';

        oci_close($c);
    }


}

?>