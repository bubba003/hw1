<?php
    session_start();

    if(!isset($_SESSION["username"])){
        header("Location: /login.php");
        exit();
    }

    header("Content-Type: application/json");

    $input= json_decode(file_get_contents("php://input"), true);

    $conn=mysqli_connect("localhost", "root", "", "feltrinelli");
    if(!$conn){
        echo json_encode(array("success" => false, "errore" => "Connessione al database fallita"));
        exit();
    }

    $username= mysqli_real_escape_string($conn, $_SESSION["username"]);
    $titolo= mysqli_real_escape_string($conn, $input["title"]);
    $autore= mysqli_real_escape_string($conn, $input["author"]);
    $quantita=intval($input["quantity"]);
    $query;
    if($quantita > 1){
        $query="UPDATE CARRELLO SET QUANTITY=QUANTITY-1 WHERE USERNAME='$username' AND TITOLO='$titolo' AND AUTORE='$autore'";
    }
    else{
        $query="DELETE FROM CARRELLO WHERE USERNAME='$username' AND TITOLO='$titolo' AND AUTORE='$autore' ";
    }

    $result= mysqli_query($conn, $query);
    if($result){
        if($quantita >1){
            echo json_encode(array("success" => true, "deleted" => false));
        }
        else{
            echo json_encode(array("success" => true, "deleted" => true));
        }
    }
    else{
        echo json_encode(array("success" => false, "deleted" => false));
    }
    mysqli_close($conn);
    exit();
?>