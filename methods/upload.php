<?php
function kategoria(){
    $c = connect();
    oci_set_client_identifier($c, "admin");
    $kategoria = oci_parse($c, '
                    select
                           kategoria.id as ID,
                           kategoria.nev as NEV
                    from kategoria
                    ORDER BY
                             kategoria.id
                    ASC');
    oci_execute($kategoria);
    oci_close($c);
    return $kategoria;
}
function helyseg(){
    $c = connect();
    oci_set_client_identifier($c, "admin");
    $helyseg = oci_parse($c, '
                    select
                           helyseg.id as ID, 
                           helyseg.nev as NEV
                    from
                         helyseg
                    ORDER BY
                             helyseg.id
                    ASC');
    oci_execute($helyseg);
    oci_close($c);
    return $helyseg;
}
function palyaz(){
    $c = connect();
    oci_set_client_identifier($c, "admin");
    $palyazat = oci_parse($c, '
                  select
                         palyazat.id as ID,
                         palyazat.nev as NEV
                  from
                       palyazat
                  ORDER BY
                           palyazat.id
                  ASC');
    oci_execute($palyazat);
    oci_close($c);
    return $palyazat;
}
function kirajzol()
{


    if(isset($_FILES['image'])){
        $errors= array();
        $file_name = $_FILES['image']['name'];
        $file_size = $_FILES['image']['size'];
        $file_tmp = $_FILES['image']['tmp_name'];
        $file_type = $_FILES['image']['type'];
        $array = explode('.', $_FILES['image']['name']);
        $file_ext= strtolower(end($array));

        $expensions= array("jpeg","jpg","png");

        if(in_array($file_ext,$expensions)===false){
            $errors[]="Nem megfelelő filet toltottél fel a kitrjesztés csak jpeg, jpg vagy png.";
        }

        if($file_size > 2097152) {
            $errors[]='A kép mérete max 2 MB lehet';
        }

        if(empty($errors)==true) {
            $newfilename= $_SESSION["user"]->getFname().date('dmYHis').str_replace(" ", "", basename($_FILES["image"]["name"]));

            move_uploaded_file($file_tmp,"images/".$newfilename);
            $imgph = "images/".$newfilename;
            echo                 $_POST["leiras"],
            $_POST["helyseg"],
            $_POST["kategoria"],
            $_POST["palyazat"];

            kephozzaAdd($_SESSION["user"]->getFname(),
                $_POST["leiras"],
                $_POST["helyseg"],
                $_POST["kategoria"],
                $_POST["palyazat"],
                $imgph
            );



            echo "Sikeres feltoltés";
        }else{
            print_r($errors);
        }
    }





    $kategoria = kategoria();
    $helyseg = helyseg();
    $palyazat = palyaz();


    echo '
<div class="reg-container">
        <h1>Kép feltoltés</h1>
        <form action="" name="regist" class="reg-form" method="post" enctype="multipart/form-data">
            <input class="kep-fel-file" type="file" name="image">
            <textarea class="kep-fel-text" name="leiras" placeholder="kép leírás"></textarea>
            <div class="kep-fel-list">
                <label>
                    <select class="kep-fel-list" name="kategoria">
                        <option value="null">Nincs</option>
                        ';
    while ($row = oci_fetch_array($kategoria, OCI_ASSOC)) {
        echo '<option value="' . $row["NEV"] . '">' . $row["NEV"] . '</option>';
    }


    echo '                    
                    </select>
                </label>
            </div>
            <div  class="kep-fel-list">
                <select class="kep-fel-list" name="helyseg">
                    <option value="null">Nincs</option>
                    ';
    while ($row = oci_fetch_array($helyseg, OCI_ASSOC)) {
        echo '<option value="' . $row["NEV"] . '">' . $row["NEV"] . '</option>';
    }

    echo '
                </select>
            </div>
            <div class="kep-fel-list">
                <select class="kep-fel-list" name="palyazat">
                    <option value="null">Nincs</option>';
    while ($row = oci_fetch_array($palyazat, OCI_ASSOC)) {
        echo '<option value="' . $row["NEV"] . '">' . $row["NEV"] . '</option>';
    }
    echo '
                </select>
            </div>
                <input class="palya-sub" type="submit" name="upload" value="kép feltoltes">
        </form>
    </div>
';
}

?>