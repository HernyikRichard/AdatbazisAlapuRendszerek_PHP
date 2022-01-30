<?php
function getFelhasznalo(){

    $c = connect();
    oci_set_client_identifier($c, "admin");

    $s = oci_parse($c, '
    SELECT felhasznalo.id as FID, felhasznalo.nev as FNAME, felhasznalo.email as FEMAIL, 
        felhasznalo.jelszo as FPASS, helyseg.nev as FHELY
    FROM
        felhasznalo, helyseg
    WHERE
        felhasznalo.helyseg_id = helyseg.id and felhasznalo.admin < 1
    ');

    oci_execute($s);
    while ($row = oci_fetch_array($s, OCI_ASSOC)){
        echo '
        <div class="entiti">
        <form action="adminMethod/torolFelhasznalo.php" method="post">
            <input type="hidden" name="Fid" value="'.$row["FID"].'"/>
            <label class="entiti-elem">'.$row["FNAME"].'</label>
             <label class="entiti-elem">'.$row["FEMAIL"].'</label> 
             <label class="entiti-elem">'.$row["FPASS"].'</label>
             <label class="entiti-elem">'.$row["FHELY"].'</label>
            <button type="submit"><i class="material-icons">delete</i></button>
        </form>
    </div>
        ';
    }
    oci_close($c);
}


?>