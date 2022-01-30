<?php

function genkepek($keresetszo){

    genHelyseg($keresetszo);
    genKategoria($keresetszo);

}
function genHelyseg($keresetszo){
    echo '<H1>Helységeknél megjelőlt képek</H1>';
    $c = connect();
    oci_set_client_identifier($c, "admin");

    $command ='
        SELECT kep.path AS KEPCIM, felhasznalo.nev AS FELTOLTO, kep.id AS KEPID FROM kep, helyseg, felhasznalo
        WHERE
            kep.helyseg_id = kep.helyseg_id and
            kep.felhasznalo_id = felhasznalo.id and
            helyseg.nev = :kereset';
    $s = oci_parse($c,$command);
    oci_bind_by_name($s,":kereset",$keresetszo);

    oci_execute($s);
    echo '<div class="carnal">';
    while ($row = oci_fetch_array($s, OCI_ASSOC)){
        echo '
            <div class="card">
                <img class="kep-s" src=" ' .$row["KEPCIM"]. '" alt="">
                <p>'.$row["FELTOLTO"].'</p>
            <div class="like" >
                <form method="post" action="ertekel.php">
                      <input type="hidden"  name="kepid" value="'.$row["KEPID"].'">
                      <input type="hidden"  name="ertek" value="1">
                      <input type="hidden"  name="fname" value="'.$_SESSION['user']->getFname().'">
                    <button type="submit"><div class="material-icons">thumb_down</div></button>
                </form>
            </div>
            
            <div class="dislike" >
                <form method="post" action="ertekel.php">
                    <input type="hidden"  name="kepid" value="'.$row["KEPID"].'">
                    <input type="hidden"  name="ertek" value="0">
                    <input type="hidden"  name="fname" value="'.$_SESSION['user']->getFname().'">
                    <button type="submit"><div class="material-icons">thumb_up</div></button>
                </form>
            </div>
            </div>';
    }
    echo '</div>';

    oci_close($c);
    echo '<hr size="4" color="#900c3e" style="border-style:dashed">';
}
function genKategoria($keresetszo){
    echo '<H1>Kategoriáknál megjelőlt képek</H1>';
    $c = connect();
    oci_set_client_identifier($c, "admin");

    $command ='
        SELECT kep.path AS KEPCIM, felhasznalo.nev AS FELTOLTO, kep.id as KEPID FROM kep, kategoria, felhasznalo
            WHERE
            kep.kategoria_id = kategoria.id and
            kep.felhasznalo_id = felhasznalo.id and
            kategoria.nev = :kereset';
    $s = oci_parse($c,$command);
    oci_bind_by_name($s,":kereset",$keresetszo);

    oci_execute($s);
    echo '<div class="carnal">';
    while ($row = oci_fetch_array($s, OCI_ASSOC)){
        echo '
            <div class="card">
                <img class="kep-s" src=" ' .$row["KEPCIM"]. '" alt="">
                <p>'.$row["FELTOLTO"].'</p>
            <div class="like" >
                <form method="post" action="ertekel.php">
                      <input type="hidden"  name="kepid" value="'.$row["KEPID"].'">
                      <input type="hidden"  name="ertek" value="1">
                      <input type="hidden"  name="fname" value="'.$_SESSION['user']->getFname().'">
                    <button type="submit"><div class="material-icons">thumb_down</div></button>
                </form>
            </div>
            
            <div class="dislike" >
                <form method="post" action="ertekel.php">
                    <input type="hidden"  name="kepid" value="'.$row["KEPID"].'">
                    <input type="hidden"  name="ertek" value="0">
                    <input type="hidden"  name="fname" value="'.$_SESSION['user']->getFname().'">
                    <button type="submit"><div class="material-icons">thumb_up</div></button>
                </form>
            </div>
            </div>';
    }
    echo '</div>';



    oci_close($c);
    echo '<hr size="4" color="#900c3e" style="border-style:dashed">';

}

?>
