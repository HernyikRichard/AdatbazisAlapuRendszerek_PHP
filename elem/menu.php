<?php
function menuBetolt(){
    include "methods/csatlakozas.php";
    include "methods/genMethods.php";
    include_once "user/userS.php";

    echo '
        <html>
        <head>
            <link rel="stylesheet" href="css/Style.css">
            <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        </head>
        <body>
        <ul class="control">
    ';
    echo '<li class="elem"><a class="ref" href="index.php">Kezdőlap</a></li>';
    if(isset($_SESSION["user"])){
        $people = $_SESSION["user"];
        echo '
            <li class="elem"><a class="ref" href="kepfeltolt.php">Kepfeltoltes</a></li>
            <li class="elem"><a class="ref" href="palyazat.php">Pályázatok</a></li>
            <li class="elem"><form method="post" action="kereses.php">
        <input class="kereso" type="text" name="search" placeholder="keresés..">
    </form></li>
            
            <li class="elem" style="float:right">
                <a href="logout.php">
                    <i class="material-icons">
                        logout
                    </i>
                </a>
            </li>
            <li class="elem" style="float:right">
                <a href="profile.php">
                    <i class="material-icons">
                        portrait
                    </i>
                </a>
            </li>
        ';
        if ($people->getAdmin()==1){
        echo '<li class="elem"><a class="ref" href="palyazatNyitas.php">Palyazat Kiirasa</a></li>
        <li class="elem"><a class="ref" href="kategoriaNyit.php">Kategória felvitel</a></li>
        <li class="elem"><a class="ref" href="tagLeker.php">Tagok lekérése</a></li>
             ';
        }
    }else{
        echo ' <li class="elem"><a class="ref" href="login.php">Bejelentkezes</a></li>';
    }
    echo '</ul>
          <div class="mezo">';

}
function zarasBetolt(){
    echo '
         </div>
        </body>
        </html>';
}
?>