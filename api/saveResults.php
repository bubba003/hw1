<?php
    session_start();

    if(!isset($_SESSION["username"])){
        header("Location: /login.php");
        exit();
    }

    header("Content-Type: application/json");

    $input= json_decode(file_get_contents('php://input'), true);
    if(!isset($input["copertina"]) || empty($input["copertina"])){
        $input["copertina"]="/img/placeholder.png";
    }

    $conn= mysqli_connect("localhost", "root", "", "feltrinelli");
    if(!$conn){
        echo json_encode(array("success" => false, "error" => "Connessione al database fallita"));
        exit();
    }
    $titolo= mysqli_real_escape_string($conn, $input["titolo"]);
    $copertina= mysqli_real_escape_string($conn, $input["copertina"]);
    $autore= mysqli_real_escape_string($conn, $input["autore"]);
    $tipologia= mysqli_real_escape_string($conn, $input["tipologia"]);
    $url=mysqli_real_escape_string($conn, $input["url"]);
    $prezzo=mt_rand(10, 30);

    $query1="SELECT * FROM PRODOTTI WHERE TITOLO= '$titolo' AND AUTORE='$autore' AND TIPOLOGIA='$tipologia'";
    $query2= "INSERT INTO PRODOTTI(TITOLO, COPERTINA, AUTORE, PREZZO, TIPOLOGIA, LINK) VALUES('$titolo', '$copertina', '$autore', $prezzo, '$tipologia', '$url')";

    $result=mysqli_query($conn, $query1);
    if(mysqli_num_rows($result) > 0){ //prodotto già presente nel database
        mysqli_free_result($result);
        echo json_encode(array("success" => false, "errore" => "Elemento già presente nel database"));
    }
    else{
        mysqli_free_result($result);
        $result=mysqli_query($conn, $query2);
        if($result){
            echo json_encode(array("success" => true));
        }
        else{
            echo json_encode(array("success" => false, "errore" => "Inserimento elemento nel database fallito"));
        }
    }
    mysqli_close($conn);
    exit();
?>