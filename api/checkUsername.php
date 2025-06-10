<?php
    if(!isset($_GET["q"])){
        echo "Non dovresti essere qui";
        exit();
    }

    //imposto l'header della risposta
    header("Content-type: application/json");

    $conn=mysqli_connect("localhost", "root", "", "feltrinelli");
    $username=mysqli_real_escape_string($conn, $_GET["q"]);
    $query="SELECT USERNAME FROM REGISTRAZIONI WHERE USERNAME='$username'";
    $result=mysqli_query($conn, $query) or die(mysqli_error($conn));

    echo json_encode(array("exists" => mysqli_num_rows($result) > 0)); /*
    se l'espressione mysqli_num_rows($result)>0 è true vuol dire che l'username esiste già, false altrimenti.
    viene creato un array associativo con la chiave 'exists' e come valore true o false.
    json_encode trasforma l'array in una stringa json*/ 
    mysqli_close($conn);

?>