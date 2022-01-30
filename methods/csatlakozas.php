<?php
function connect(){
    $pass = "kocsis";
    $tns = "
			(DESCRIPTION =
				(ADDRESS_LIST =
					(ADDRESS =
						(PROTOCOL = TCP)
						(HOST = localhost)
						(PORT = 1521)
					)
				)
				(CONNECT_DATA =
					(SID = xe)
				)
			)";
    $c = oci_connect('kocsis', $pass, $tns, 'UTF8');
    if (!$c) {
        $m = oci_error();
        echo $m['message'], "\n";
        exit;
    } else {
        //echo "sikeres csatlakozas";
    }
// Close the Oracle connection
// oci_close($conn);
    return $c;
}


?>