<?php
    session_start();

    if(!isset($_SESSION["username"])){
        header("Location: /login.php");
        exit();
    }

    header("Content-Type: application/json");

    $conn= mysqli_connect("localhost", "root", "", "feltrinelli");
    if(!$conn){
        echo json_encode(array("success" => false, "errore" => "Errore nella connesione al database"));
        exit();
    }
    $input= json_decode(file_get_contents("php://input"), true);

    $username= mysqli_real_escape_string($conn, $_SESSION["username"]);
    $titolo= mysqli_real_escape_string($conn, $input["title"]);
    $copertina= mysqli_real_escape_string($conn, $input["cover"]);
    $autore= mysqli_real_escape_string($conn, $input["author"]);

    $query= "DELETE FROM PREFERITI WHERE USERNAME= '$username' AND TITOLO='$titolo' AND AUTORE='$autore'";

    $result=mysqli_query($conn, $query);
    if($result){//cioè l'eliminazione dell'elemento dai preferiti è avvenuta con successo
        echo json_encode(array("success" => true));
    }
    else{
        echo json_encode(array("success" => false));
    }
    mysqli_close($conn);
    exit();
?>