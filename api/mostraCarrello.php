<?php
    session_start();

    if(!isset($_SESSION["username"])){
        header("Location: /login.php");
        exit();
    }

    header("Content-Type: application/json");

    $conn=mysqli_connect("localhost", "root", "", "feltrinelli");
    if(!$conn){
        echo json_encode(array("success" => false, "error" => "Connessione al database fallita"));
        exit();
    }
    $username= mysqli_real_escape_string($conn, $_SESSION["username"]);
    $query="SELECT * FROM CARRELLO WHERE USERNAME='$username'";

    $result= mysqli_query($conn, $query);
    $array= array();
    if(mysqli_num_rows($result) >0){
        while($row=mysqli_fetch_assoc($result)){
            $array[]= $row;
        }
        echo json_encode(array("success" => true, "carrello" => $array));
    }
    else{//cioè l'utente non ha elementi nel carrello
        echo json_encode(array("success" => false));
        
    }
    mysqli_free_result($result);
    mysqli_close($conn);
    exit();

?>