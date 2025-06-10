<?php
    session_start();

    if(!isset($_SESSION["username"])){
        header("Location: /login.php");
        exit();
    }

    $conn= mysqli_connect("localhost", "root", "", "feltrinelli");
    if(!$conn){
        echo json_encode(array("success" => false, "error" => "Connessione al server fallita"));
        exit();
    }
    $input= json_decode(file_get_contents('php://input'), true); //serve a leggere il body grezzo della richiesta http
    /*siccome in lato client (javascript) nella richiesta http vi è headers: content-type: application/json
    bisogna evitare di usare $_POST in PHP perché PHP non popola $_POST*/

    $username= mysqli_real_escape_string($conn, $_SESSION["username"]);
    $titolo= mysqli_real_escape_string($conn, $input["title"]);
    $copertina= mysqli_real_escape_string($conn, $input["copertina"]);
    $autore= mysqli_real_escape_string($conn, $input["author"]);
    $tipologia= mysqli_real_escape_string($conn, $input["type"]);

    $query1="INSERT INTO LIKES(USERNAME, TITOLO, COPERTINA, AUTORE, TIPOLOGIA) VALUES ('$username', '$titolo', '$copertina', '$autore', '$tipologia')";
    $query2="SELECT * FROM LIKES WHERE USERNAME= '$username' AND TITOLO='$titolo' AND AUTORE='$autore' AND TIPOLOGIA='$tipologia'";
    $query3= "DELETE FROM LIKES WHERE USERNAME= '$username' AND TITOLO='$titolo' AND AUTORE='$autore' AND TIPOLOGIA='$tipologia'";
    
    $result= mysqli_query($conn, $query2);
    if(mysqli_num_rows($result) >0){ //cioè l'utente ha già messo like a quel prodotto
        mysqli_free_result($result);
        $result= mysqli_query($conn, $query3);
        if($result){
            echo json_encode(array("success" => true, "deleted" => true));
        }
        else{
            echo json_encode(array("success" => false, "deleted" => false));
        }
        mysqli_close($conn);
        exit();
    }

    else{ //cioè l'utente non ha ancora messo like a quel prodotto
        mysqli_free_result($result);
        $result= mysqli_query($conn, $query1);
        if($result){
            echo json_encode(array("success" => true, "deleted" => false)); //inserimento riuscito
        }
        else{
            echo json_encode(array("success" => false, "deleted" => false)); //errore inserimento
        }
        mysqli_close($conn);
        exit();
    }
?>